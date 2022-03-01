<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horario;
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
use function daysWeekText;
use function response;
use function view;

class CalendarioController extends Controller
{
    public function index()
    {

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
            return response(['error' =>  $validate->errors()->first('date')], Response::HTTP_NOT_FOUND);
        }

        //User
        $user = Auth::user();

        //Citas médicas
        $datesOperative = $user->medical_dates;

        //Horario
        $horario = $user->horario;

        //Validar el número del dia de la semana
        $diaSemana = date('w', strtotime($request->date));

        //Crear las citas libres
        $intervaloCita = ($horario->date_duration + $horario->date_interval) * 60;
        $listDates = array();

        //Search interval schedule in configuration
        foreach ($horario->horario as $item)
        {

            if (in_array( $diaSemana, $item['daysOfWeek']))
            {
                $startDate = strtotime("$request->date " . $item['startTime']);
                $endDate = strtotime("$request->date " . $item['endTime']);

                //Add posible dates
                for($date = $startDate; ($date + $intervaloCita) <= $endDate; $date+= $intervaloCita){

                    $startTime = date('Y-m-d H:i', $date);
                    $endTime = date('Y-m-d H:i', $date + $intervaloCita );


                    //validate exist or conflict date
                    $valid = true;
                    foreach ($datesOperative as $dateOperative) {
                        if (
                            //Check that start new date is between start operative & end operative
                            (strtotime($dateOperative->start_date) <= strtotime($startTime)
                                && strtotime($dateOperative->end_date) >= strtotime($startTime))
                            or
                            //Check that end new date is between start operative & end operative
                            (strtotime($dateOperative->start_date) <= strtotime($endTime)
                                && strtotime($dateOperative->end_date) >= strtotime($endTime))
                            or
                            //Check that start operative is between start new date & end new date
                            (strtotime($startTime) <= strtotime($dateOperative->start_date)
                                && strtotime($startTime) >= strtotime($dateOperative->start_date))
                            or
                            //Check that end operative is between start new date & end new date
                            (strtotime($startTime) <= strtotime($dateOperative->end_date)
                                && strtotime($startTime) >= strtotime($dateOperative->end_date))
                        )
                        {
                            $valid = false;
                            break;
                        }
                    }

                    if ($valid)
                    {
                        //Add date in list
                        $listDates[] = [
                            'startTime' => $startTime,
                            'endTime' => $endTime,
                            'nameOperative' => "$user->last_name $user->name"
                        ];
                    }
                }
            }
        }

        return response(['data' => $listDates], Response::HTTP_OK);
    }

    /**
     * Permite ver una cita
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function ver_cita(Request $request)
    {
        $dates = MedicalDate::query()
            ->select(['id', 'start_date as start', 'end_date as end', 'status'])
            ->selectRaw('CASE type_date WHEN "reservado" THEN "background" WHEN "cita" THEN "auto" END AS display')
            ->addSelect([
                'type-date' => DateType::query()
                    ->select('date_types.name')
                    ->whereColumn('date_type_id', 'date_types.id')
                    ->take(1)
            ])
            ->addSelect([
                'title' => Patient::query()
                    ->selectRaw('concat(patients.name, " ", patients.last_name)')
                    ->whereColumn('patient_id', 'patients.id')
                    ->take(1)
            ])
            //->addSelect('concat(type-date, " ", patient)')
            ->where('start_date', '>=', date('Y-m-d') . " 00:00")
            ->where(function ($query){
                return $query->where('status', 4)
                    ->orWhereNull('status');
            })
            ->get();

        return response($dates->toArray(), Response::HTTP_OK);
    }

    /**
     * Permite crear una cita
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function crear_cita(Request $request)
    {
        $all = array_merge($request->all(), ['date' => json_decode($request->get('new-date'), true)]);

        //Validate date
        $validate = Validator::make($all, [
            'date.*'  => ['required', 'date_format:Y-m-d H:i'],
            'id_card'   => ['required', 'exists:tenant.patients,id_card'],
            'date-type'  => ['required', 'exists:tenant.date_types,id'],
            'consent'  => ['required', 'exists:tenant.consents,id'],
            'agreement'  => ['exists:tenant.agreements,id'],
            'place'  => ['required'],
            //'description'  => ['required'],
            'money'  => ['required'],
        ]);

        if ($validate->fails()) {
            return response(['error' =>  $validate->errors()->all()], Response::HTTP_NOT_FOUND);
        }

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
        {
            return response(['error' => __('calendar.date-not-free')], Response::HTTP_NOT_FOUND);
        }

        $patient = Patient::select('id')->where('id_card', '=', $all['id_card'])->where('status', '=', 1)->first();

        //dd($all);

        $query = [
            'start_date'    => date('Y-m-d H:i', strtotime($all['date']['start'])),
            'end_date'      => date('Y-m-d H:i', strtotime($all['date']['end'])),
            'type_date'     => 'cita',
            'place'         => $all['place'],
            'description'   => $all['description'],
            'money'         => $all['money'],
            'user_id'       => $user->id,
            'patient_id'    => $patient->id,
            'date_type_id'  => (isset($all['date-type'])) ? $all['date-type']:null,
            'consent_id'    => (isset($all['consent'])) ? $all['consent']:null,
            'agreement_id'  => (isset($all['agreement'])) ? $all['agreement']:null,
        ];

        $date = MedicalDate::create($query);

        return response([
            'message' => __('calendar.date-create'),
            'event' => [
                'start' => '',
                'end' => '',
                'display' => '',
                'title' => $patient->full_name
            ]], Response::HTTP_CREATED);
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

        return view('panelAdministrativoProf.configurar-calendario', compact('config'));
    }

    public function dias(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'duracion' => ['required', 'integer'],
            'descanso' => ['required', 'integer']
        ]);

        if ($validator->failed())
        {
            return response(['error' => $validator->errors()->all()], Response::HTTP_NOT_FOUND);
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
            'message' => 'Configuración de la cita listo'
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

        if ($validator->failed())
        {
            return response(['error' => $validator->errors()->all()], Response::HTTP_NOT_FOUND);
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

        //parce days in text
        foreach ($schedule[0]['daysOfWeek'] as $key => $item) $schedule[0]['daysOfWeek'][$key] = daysWeekText($item);

        return response([
            'message' => 'Horario Agregado', 'item' => $schedule[0]
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
            'id'    => ['required', 'integer'],
        ]);

        if ($validator->failed())
        {
            return response(['error' => $validator->errors()->all()], Response::HTTP_NOT_FOUND);
        }

        //user
        $user = Auth::user();
        //schedule
        $schedule = $user->calendar_config->schedule_on;

        //delete schedule
        $key_schedule_delete = array_search($request->id, array_column($schedule, 'id'));
        unset($schedule[$key_schedule_delete]);

        //save
        $user->calendar_config->schedule_on = $schedule;
        $user->calendar_config->save();

        return response([
            'message' => __('calendar.deleted-schedule-confirmation')
        ], Response::HTTP_OK);
    }
}
