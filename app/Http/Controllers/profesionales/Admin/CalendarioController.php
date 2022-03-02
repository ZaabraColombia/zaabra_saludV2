<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Horario;
use App\Models\Paciente;
use App\Models\PagoCita;
use App\Models\tipoconsultas;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function response;
use function view;

class CalendarioController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        //Validar calendario

        if (!isset($user->horario) or !is_array($user->horario->horario)
            or empty($user->horario->duracion) or empty($user->horario->descanso))
            return redirect()->route('profesional.configurar-calendario')
                ->with('warning', 'Por favor configurar el calendario');

        $weekNotBusiness = array();
        foreach (array_column($user->horario->horario, 'daysOfWeek') as $item)
            $weekNotBusiness = array_merge($weekNotBusiness, $item);

        $horario = $user->horario;
        $weekNotBusiness = array_unique($weekNotBusiness);
        $tipoCitas = tipoconsultas::query()
            ->where('idperfil', '=', $user->id)
            ->get();

        return view('profesionales.admin.calendario.calendario', compact(
            'weekNotBusiness',
            'horario',
            'tipoCitas',
            'user'
        ));
    }

    /**
     * Permite listar las citas libres por día
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function citas_libres(Request $request)
    {
        //Validate date
        $validate = Validator::make($request->all(), [
            'date'  => ['required', 'date_format:Y-m-d']
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //User
        $user = Auth::user();

        //Citas médicas
        $datesOperatives = $user->citas;

        //Horario
        $horario = $user->horario;

        //Validar el número del dia de la semana
        $diaSemana = date('w', strtotime($request->date));

        //crear intervalos
        $intervaloCita = ($horario->duracion + $horario->descanso) * 60;
        //Crear las citas libres
        $listDates = array();

        //Buscar los dias disponibles
        foreach ($horario->horario as $item)
        {

            if (in_array( $diaSemana, $item['daysOfWeek']))
            {
                $startDate = strtotime("$request->date " . $item['startTime']);
                $endDate = strtotime("$request->date " . $item['endTime']);

                //generar posibles citas
                for($date = $startDate; ($date + $intervaloCita) <= $endDate; $date+= $intervaloCita){

                    $startTime = date('Y-m-d H:i', $date);
                    $endTime = date('Y-m-d H:i', $date + $intervaloCita );


                    //Validar la disponibilidad de las citas
                    $valid = true;
                    if (!empty($datesOperatives)) {
                        foreach ($datesOperatives as $dateOperative) {
                            if (
                                //Validar si la hora de inicio está entre la hora inicio y fin de la cita existente
                                (strtotime($dateOperative->start_date) <= strtotime($startTime)
                                    && strtotime($dateOperative->end_date) >= strtotime($startTime))
                                or
                                //Validar si la hora de fin está entre la hora inicio y fin de la cita existente
                                (strtotime($dateOperative->start_date) <= strtotime($endTime)
                                    && strtotime($dateOperative->end_date) >= strtotime($endTime))
                                or
                                //Validar si la hora inicio existente está entre la hora inicio y fin
                                (strtotime($startTime) <= strtotime($dateOperative->start_date)
                                    && strtotime($startTime) >= strtotime($dateOperative->start_date))
                                or
                                //Validar si la hora din existente está entre la hora inicio y fin
                                (strtotime($startTime) <= strtotime($dateOperative->end_date)
                                    && strtotime($startTime) >= strtotime($dateOperative->end_date))
                            )
                            {
                                $valid = false;
                                break;
                            }
                        }
                    }

                    if ($valid)
                    {
                        //Agregar la disponibilidad
                        $listDates[] = [
                            'startTime' => $startTime,
                            'endTime' => $endTime
                        ];
                    }
                }
            }
        }

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Fechas disponibles'
            ],
            'data' => $listDates
        ], Response::HTTP_OK);
    }

    /**
     * Permite ver una cita
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function ver_citas(Request $request)
    {
        $dates = Cita::query()
            ->select(['id_cita as id', 'fecha_inicio as start', 'fecha_fin as end', 'paciente_id'])
            ->selectRaw('CASE estado WHEN "reservado" THEN "background" WHEN "agendado" THEN "auto" END AS display')
            ->addSelect([
                'tipo_cita' => tipoconsultas::query()
                    ->select('nombreconsulta')
                    ->whereColumn('tipo_cita_id', 'tipoconsultas.id')
                    ->take(1)
            ])
            ->where('profesional_id', '=', Auth::user()->profecional->idPerfilProfesional)
            ->where('Fecha_inicio', '>=', date('Y-m-d') . " 00:00")
            ->with(['paciente', 'paciente.user'])->get();

        $data = array();
        foreach ($dates as $date) {
            $data[] = [
                'id'    => $date->id,
                'start' => $date->start,
                'end'   => $date->end,
                'display' => $date->display,
                'title' => $date->paciente->user->nombre_completo,
            ];
        }

        return response($data, Response::HTTP_OK);
    }

    /**
     * Permite crear una cita
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function crear_cita(Request $request)
    {
        $all = array_merge($request->all(), ['disponibilidad' => json_decode($request->get('disponibilidad'), true)]);

        //Validate date
        $validate = Validator::make($all, [
            'disponibilidad.*' => ['required', 'date_format:Y-m-d H:i'],
            'numero_id' => ['required'],
            'tipo_cita' => ['required'],
            'lugar'     => ['required'],
            'cantidad'  => ['required'],
            'modalidad_pago' => ['required']
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //user
        $user = Auth::user();

        //Validar la disponibilidad de la cita
        $date_count = Cita::query()->where('profesional_id', '=', $user->id)
            ->where(function ($query) use ($all){
                $query->whereRaw('(fecha_inicio >= "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])) .
                    '" and fecha_inicio < "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])) . '")')
                    ->orWhereRaw('(fecha_fin > "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])) .
                        '" and fecha_fin <= "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])) . '")')
                    ->orWhereRaw('(fecha_inicio <= "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])) .
                        '" and fecha_fin > "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])) . '")')
                    ->orWhereRaw('(fecha_inicio < "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])) .
                        '" and fecha_fin >= "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])) . '")');
            })->count();

        if ($date_count > 0)
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => 'Cita no disponible'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        $patient = User::query()
            ->select('id')
            ->where('numerodocumento', '=', $all['numero_id'])
            ->first();

        //crear cita
        $query = [
            'fecha_inicio'  => date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])),
            'fecha_fin'     => date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])),
            'estado'        => 'agendado',
            'lugar'         => $all['lugar'],
            'tipo_cita_id'  => $all['tipo_cita'],
            //'money'         => $all['money'],
            'profesional_id'=> $user->profecional->idPerfilProfesional,
            'paciente_id'   => $patient->paciente->id,
        ];
        $date = Cita::query()->create($query);

        //Crear pago
        $pago = PagoCita::query()->create([
            'fecha'     => date('Y-m-d h:i'),
            'vencimiento' => date('Y-m-d h:i + 30 minutes'),
            'valor'     => $all['cantidad'],
            'aprobado'  => 0,
            'tipo'      => $all['modalidad_pago'],
            'cita_id'   => $date->id_cita,
        ]);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Cita agendada'
            ],
            'event' => [
                'start'     => $date->fecha_inicio,
                'end'       => $date->fecha_fin,
                //'display'   => '',
                'title'     => $patient->nombre_completo
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * Permite editar una cita
     *
     * @param $id
     * @return Application|ResponseFactory|Response
     */
    public function editar_cita($id){

        $date = MedicalDate::query()
            ->with('patient:id,name,last_name,id_card,email')
            ->where('id', $id)
            ->first();

        return response(['date' => $date->toArray()], Response::HTTP_OK);
    }

    /**
     * Permite actualizar cita
     *
     * @param Request $request
     * @param MedicalDate $date
     * @return Application|ResponseFactory|Response
     */
    public function actualizar_cita(Request $request, MedicalDate $date)
    {
        //Validate date
        $validate = Validator::make($request->all(), [
            'date-type'  => ['required', 'exists:tenant.date_types,id'],
            'consent'  => ['required', 'exists:tenant.consents,id'],
            'agreement'  => ['exists:tenant.agreements,id'],
            'place'  => ['required'],
            'money'  => ['required'],
        ]);

        if ($validate->fails()) return response([
            'error' =>  $validate->errors()->all()
        ], Response::HTTP_NOT_FOUND);

        $query = [
            'place'         => $request->place,
            'description'   => $request->description,
            'money'         => $request->money,
            'date_type_id'  => $request->get('date-type'),
            'consent_id'    => $request->get('consent'),
            'agreement_id'  => $request->get('agreement'),
        ];

        $date->update($query);
        return response(['message' => __('calendar.date-edit'),], Response::HTTP_OK);
    }

    /**
     * Permite cancelar cita
     *
     * @param MedicalDate $date
     * @return Application|ResponseFactory|Response
     */
    public function cancelar_cita(MedicalDate $date)
    {
        $date->update([
            'status' => 'cancelado'
        ]);

        return response(['message' => __('calendar.date-cancel'),], Response::HTTP_OK);
    }

    /**
     * Reprogramar cita
     *
     * @param Request $request
     * @param MedicalDate $date
     * @return Application|ResponseFactory|Response
     */
    public function reprogramar_cita(Request $request, MedicalDate $date)
    {
        $all = ['date' => json_decode($request->get('new-date'), true)];
        //Validate date
        $validate = Validator::make($all, [
            'date.*'  => ['required', 'date_format:Y-m-d H:i'],
        ]);

        if ($validate->fails())
            return response([
                'error' =>  $validate->errors()->all()
            ], Response::HTTP_NOT_FOUND);


        //user
        $user = Auth::user();

        //validate date free
        $date_count = MedicalDate::where('user_id', '=', $user->id)
            //->whereDate('start_date', '=', date('Y-m-d', strtotime($all['date']['start'])))
            ->where(function ($query) use ($all){
                $query->whereRaw('(start_date >= "' . date('Y-m-d H:i', strtotime($all['date']['start'])) .
                    '" and start_date < "' . date('Y-m-d H:i', strtotime($all['date']['end'])) . '")')
                    ->orWhereRaw('(end_date > "' . date('Y-m-d H:i', strtotime($all['date']['start'])) .
                        '" and end_date <= "' . date('Y-m-d H:i', strtotime($all['date']['end'])) . '")')
                    ->orWhereRaw('(start_date <= "' . date('Y-m-d H:i', strtotime($all['date']['start'])) .
                        '" and end_date > "' . date('Y-m-d H:i', strtotime($all['date']['start'])) . '")')
                    ->orWhereRaw('(start_date < "' . date('Y-m-d H:i', strtotime($all['date']['end'])) .
                        '" and end_date >= "' . date('Y-m-d H:i', strtotime($all['date']['end'])) . '")');
            })->count();

        if ($date_count > 0)
            return response(['error' => __('calendar.date-not-free')], Response::HTTP_NOT_FOUND);


        $query = [
            'start_date'    => date('Y-m-d H:i', strtotime($all['date']['start'])),
            'end_date'      => date('Y-m-d H:i', strtotime($all['date']['end'])),
            'status'        => 'reasignado',
        ];

        $date->update($query);

        return response([
            'message' => __('calendar.date-reschedule')], Response::HTTP_CREATED);
    }

    /**
     * Vista para configurar el calendario
     *
     * @return Application|Factory|View
     */
    public function configuracion()
    {
        $user = Auth::user();
        $config = $user->horario;

        if (empty($config))
        {
            $config = new Horario();
        }

        return view('profesionales.admin.calendario.configurar-calendario', compact('config'));
    }

    /**
     * Configurar los parámetros del día
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function cita(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'duracion' => ['required', 'integer'],
            'descanso' => ['required', 'integer']
        ]);

        if ($validator->fails())
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //user
        $user = Auth::user();

        //Update date
        $horario = Horario::query()->updateOrCreate([
            'user_id' => $user->id
        ], [
            'duracion' => $request->get('duracion'),
            'descanso' => $request->get('descanso')
        ]);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Configuración de la cita listo'
            ]
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Agregar un horario
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function horario_agregar(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'semana.*'    => ['required', Rule::in([0, 1, 2, 3, 4, 5, 6])],
            'hora_inicio'=> ['required', 'date_format:H:i'],
            'hora_final'=> ['required', 'date_format:H:i']
        ]);

        if ($validator->fails())
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //user
        $user = Auth::user();
        $horario = $user->horario;
        $schedule[] = [
            'id' => Str::random(10),
            'daysOfWeek'    => $request->get('semana'),
            'startTime'     => $request->get('hora_inicio'),
            'endTime'       => $request->get('hora_final'),
        ];
        //add schedule
        if (is_array($horario->horario))
        {
            $horario->horario = array_merge($horario->horario, $schedule);
        } else {
            $horario->horario = $schedule;
        }

        $horario->save();

        //dd($schedule[0]['daysOfWeek']);

        //parce days in text
        foreach ($schedule[0]['daysOfWeek'] as $key => $item) $schedule[0]['daysOfWeek'][$key] = daysWeekText($item);

        return response([
            'message'   => [
                'title' => 'Hecho',
                'text'  => 'Horario Agregado'
            ],
            'item'      => $schedule[0]
        ], Response::HTTP_ACCEPTED);
    }

    /**
     *  Eliminar un horario
     *
     * @return Application|ResponseFactory|Response
     */
    public function horario_eliminar(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'id'    => ['required'],
        ]);

        if ($validator->fails())
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //user
        $user = Auth::user();
        //schedule
        $schedule = $user->horario->horario;

        //delete schedule
        $array = array_filter(array_combine(array_keys($schedule), array_column($schedule, 'id')));
        $key_schedule_delete = array_search($request->id, $array);

        unset($schedule[$key_schedule_delete]);

        //save
        $user->horario->horario = $schedule;
        $user->horario->save();

        return response([
            'message'   => [
                'title' => 'Hecho',
                'text'  => 'Horario Eliminado'
            ],
        ], Response::HTTP_OK);
    }
}
