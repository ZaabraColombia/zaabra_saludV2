<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmacionCitaEmail;
use App\Models\Antiguedad;
use App\Models\Cita;
use App\Models\Convenios;
use App\Models\Horario;
use App\Models\Paciente;
use App\Models\PagoCita;
use App\Models\paises;
use App\Models\Servicio;
use App\Models\tipoconsultas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function response;
use function view;

class CalendarioController extends Controller
{
    /**
     * Retorna la vista del calendario
     *
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        $user = Auth::user();
        $profesional = User::query()->with('horario')->find($user->profesional->idUser);
        $horario = $profesional->horario;

        //Validar calendario
        if (!isset($horario) or !is_array($horario->horario) or empty($horario->dias_agenda))
            return redirect()->route('profesional.agenda.configurar-calendario')
                ->withErrors(['configurar' => 'Por favor configurar el calendario'] );

        //Dias de la semana disponibles
        $dias_disponibles = collect($horario->horario)
            ->pluck('daysOfWeek')->collapse()// retornar todos los días
            ->unique()->values()->all();// unificar los dias

        $dias_bloqueados = collect([0, 1, 2, 3, 4, 5, 6])->diff($dias_disponibles)->values()->all();

        $servicios = Servicio::query()
            ->where('profesional_id', '=', $profesional->profesional->idPerfilProfesional)
            ->get();

        $paises = paises::all();

        return view('profesionales.admin.calendario.calendario', compact('dias_disponibles',
            'dias_bloqueados', 'horario', 'servicios', 'paises', 'user'));
    }

    /**
     * Permite listar las citas libres por día
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function citas_libres(Request $request)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        //Validate date
        $validate = Validator::make($request->all(), [
            'date'      => ['required', 'date_format:Y-m-d'],
            'servicio'  => [
                'required',
                Rule::exists('servicios', 'id')
                    ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
                    ->where('estado', 1)
            ]
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
        //servicio
        $servicio = Servicio::query()->find($request->get('servicio'));

        //Citas médicas
        //$datesOperatives = $user->profesional->citas;
        $datesOperatives = Cita::query()
            ->where('profesional_id', $user->profesional->idPerfilProfesional)
            ->whereNotIn('estado', ['completo', 'cancelado'])
            ->whereDate('fecha_inicio', $request->date)
            ->get()
            ->toArray();

        //Horario
        $horario = Horario::query()
            ->where('user_id', $user->profesional->idUser)
            ->first();

        //Validar el número del dia de la semana
        $diaSemana = date('w', strtotime($request->date));

        //crear intervalos
        $intervaloCita = ($servicio->duracion + $servicio->descanso) * 60;
        //Crear las citas libres
        $listDates = array();

        //Buscar los dias disponibles
        foreach ($horario->horario as $item)
        {

            if (in_array( $diaSemana, $item['daysOfWeek']))
            {
                $startDate = strtotime("$request->date " . $item['startTime']);
                $endDate = strtotime("$request->date " . $item['endTime']);

                $listDates = array_merge($listDates, generar_citas($startDate, $endDate, $intervaloCita, $datesOperatives));
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
     * Permite listoar todos los convenios
     *
     * @param $servicio
     * @return Application|ResponseFactory|Response
     */
    public function convenios($servicio)
    {
        $servicio = Servicio::query()
            ->where('id', $servicio)
            ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
            ->where('estado', 1)
            ->with(['convenios_lista' => function($query) {
                return $query
                    ->with('tipo_identificacion')
                    ->select('convenios.id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                    ->where('estado', 1);
            }])
            ->first();

        if (empty($servicio))
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => 'No se encontró el servicio'
                ]
            ], Response::HTTP_NOT_FOUND);

        return response([
            'items' => $servicio->convenios_lista
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
        Gate::authorize('accesos-profesional', 'ver-calendario');

        $dates = Cita::query()
            ->select(['id_cita', 'fecha_inicio as start', 'fecha_fin as end', 'paciente_id', 'estado', 'fecha_fin'])
            //->selectRaw('CASE estado WHEN "reservado" THEN "background" WHEN "agendado" THEN "auto" END AS display')
            ->addSelect([
                'tipo_cita' => tipoconsultas::query()
                    ->select('nombreconsulta')
                    ->whereColumn('tipo_cita_id', 'tipoconsultas.id')
                    ->take(1)
            ])
            ->where('profesional_id', '=', Auth::user()->profesional->idPerfilProfesional)
            ->where('estado', '!=', 'cancelado')
            ->where('estado', '!=', 'completado')
            //->where('Fecha_inicio', '>=', date('Y-m-d') . " 00:00")
            ->with(['paciente', 'paciente.user', 'pago'])
            ->get();

        $horario = Horario::query()
            ->where('user_id', Auth::user()->profesional->idUser)->first();

        $data = array();

        foreach ($dates as $date) {
            if ($date->estado == 'reservado')
            {
                $data[] = [
                    'id'    => $date->id_cita,
                    'start' => $date->start,
                    'end'   => $date->end,
                    'backgroundColor' => $horario->color_bloqueado ?? '#F37725',
                    'textColor'     => color_contrast($horario->color_bloqueado ?? '#F37725'),
                    'borderColor'   => 'black',
                    'display'   => 'block',
                    'title'     => 'Bloqueado',
                    'estado'    => $date->estado,
                    'desbloquear' => $date->fecha_fin->diffInDays(Carbon::today()) < 1,
                    'ver'       => route('profesional.agenda.calendario.ver-cita', ['cita' => $date->id_cita]),
                ];
            } else {

                //validar background
                switch ($date->pago->tipo ?? '')
                {
                    case 'presencial':
                        $color = $horario->color_cita_presencial ?? '#D6FFFB';
                        //Color cita pago
                        $background = $color;
                        $color = color_contrast($color);
                        break;
                    case 'virtual':
                        $color = ($date->pago->aprobado) ? $horario->color_cita_pagada ?? '#1B85D7':$horario->color_cita_agendada ?? '#019F86';
                        //Si esta aprobado es pagado, si no es pagado se establece como no pagado
                        $background = $color;
                        $color = color_contrast($color);
                        break;
                    default:
                        $background = '#ffffff';
                        $color = '#000000';
                        break;
                }

                $data[] = [
                    'id'    => $date->id_cita,
                    'start' => $date->start,
                    'end'   => $date->end,
                    'backgroundColor' => $background,
                    'textColor'     => $color,
                    'borderColor'   => '#696969',
                    'display'       => 'block',
                    'estado'        => $date->estado,
                    'title'         => $date->paciente->user->nombre_completo,
                    'ver'           => route('profesional.agenda.calendario.ver-cita', ['cita' => $date->id_cita]),
                ];

            }
        }

        return response($data, Response::HTTP_OK);
    }

    /**
     * Permite ver una cita
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function ver_cita($cita)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        //Validate date
        $validate = Validator::make(['cita' => $cita], [
            'cita'  => [
                'required',
                Rule::exists('citas', 'id_cita')
                    ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
            ]
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        $date = Cita::query()
            ->with(['profesional', 'paciente', 'paciente.user', 'servicio', 'servicio.tipo_servicio', 'pago'])
            ->find($cita);

        if ($date->estado == 'reservado') {
            $ver = [
                'id' => $date->id_cita,
                'fecha_inicio'  => $date->fecha_inicio->format('Y-m-d h:i:s'),
                'fecha_fin'     => $date->fecha_fin->format('Y-m-d h:i:s'),
                'comentario'    => $date->comentario,
            ];
            $data = [
                'fecha_inicio'  => $date->fecha_inicio->format('Y-m-d\TH:i:s'),
                'fecha_fin'     => $date->fecha_fin->format('Y-m-d\TH:i:s'),
                'comentario'    => $date->comentario,
                'estado'        => $date->estado,
                'ver'           => route('profesional.agenda.calendario.ver-cita', ['cita' => $date->id_cita]),
                'reagendar'     => route('profesional.agenda.calendario.editar-reservar-calendario', ['cita' => $date->id_cita]),
                'cancelar'      => ($date->fecha_fin->diffInDays(Carbon::today()) <= 1) ?
                    route('profesional.agenda.calendario.cancelar-reserva-calendario', ['cita' => $date->id_cita]):null,
            ];
        } else {
            $ver = [
                'nombre_paciente'   => $date->paciente->user->nombre_completo,
                'numero_id'         => $date->paciente->user->identificacion,
                'correo_paciente'   => $date->paciente->user->emai,
                'tipo_servicio'     => $date->servicio->tipo_servicio->nombre ?? '',
                'servicio_text'     => $date->servicio->nombre ?? '',
                'servicio_id'       => $date->servicio->id ?? '',
                'fecha'             => $date->fecha,
                'hora'              => $date->hora,
                'atencion'          => $date->servicio->tipo_atencion ?? '',
                'lugar'             => $date->lugar
            ];
            $data = [
                'id'            => $date->id_cita,
                'estado'        => $date->estado,
                'servicio'      => $date->tipo_cita_id,
                'fecha'         => $date->fecha,
                'convenio'      => $date->convenio_id,
                'valor'         => $date->pago->valor,
                'valor_convenio' => $date->pago->valor_convenio,
                'modalidad'     => $date->pago->tipo,
                'pais'          => $date->pais_id,
                'departamento'  => $date->departamento_id,
                'provincia'     => $date->provincia_id,
                'ciudad'        => $date->ciudad_id,
                'lugar'         => $date->lugar,
                'ver'           => route('profesional.agenda.calendario.ver-cita', ['cita' => $date->id_cita]),
                //'editar'        => route('profesional.agenda.calendario.actualizar-cita', ['cita' => $date->id_cita]),
                'reagendar'     => route('profesional.agenda.calendario.reagendar-cita', ['cita' => $date->id_cita]),
                'cancelar'      => route('profesional.agenda.calendario.cancelar-cita', ['cita' => $date->id_cita]),
                'completar'     => route('profesional.agenda.calendario.completar-cita', ['cita' => $date->id_cita]),
            ];
        }

        return response([
            'item' => ['ver' => $ver ?? array(),'data' => $data],
        ], Response::HTTP_OK);
    }

    /**
     * Permite crear una cita
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function crear_cita(Request $request)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        $all = array_merge($request->all(), ['disponibilidad' => json_decode($request->get('disponibilidad'), true)]);

        //Validate date
        $validate = Validator::make($all, [
            'disponibilidad'    => ['required'],
            'disponibilidad.*'  => ['required', 'date_format:Y-m-d H:i'],
            'numero_id' => ['required'],
            'lugar'     => ['required'],
            'cantidad'  => ['required'],
            'pais_id'           => ['required', 'exists:pais,id_pais'],
            'departamento_id'   => ['required', 'exists:departamentos,id_departamento'],
            'provincia_id'      => ['required', 'exists:provincias,id_provincia'],
            'ciudad_id'         => ['required', 'exists:municipios,id_municipio'],
            'modalidad_pago' => ['required', Rule::in(['virtual', 'presencial'])],
            'convenio'  => [
                'nullable',
                Rule::exists('convenios', 'id')
                    ->where('estado', 1)
                    ->where('id_user', Auth::user()->profesional->idUser)
            ],
            'servicio'  => [
                'required',
                Rule::exists('servicios', 'id')
                    ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
                    ->where('estado', 1)
            ]
        ], [], [
            'disponibilidad' => 'Disponibilidad',
            'numero_id' => 'Número de identificación',
            'tipo_cita' => 'Tipo de cita',
            'lugar'     => 'Lugar',
            'cantidad'  => 'Cantidad',
            'modalidad_pago' => 'Modalidad de pago',
            'pais_id'   => 'Pais',
            'departamento_id'=> 'Departamento',
            'provincia_id'   => 'Provincia',
            'ciudad_id' => 'Ciudad',
            'servicio'  => 'Servicio',
            'convenio' => 'Convenio'
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
        $date_count = Cita::query()->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->validar($all['disponibilidad']['start'], $all['disponibilidad']['end'])->count();


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
            'tipo_cita_id'  => $all['servicio'],
            'convenio_id'   => $all['convenio'],
            'profesional_id'=> $user->profesional->idPerfilProfesional,
            'paciente_id'   => $patient->paciente->id,
            'pais_id'       => $all['pais_id'],
            'departamento_id'=> $all['departamento_id'],
            'provincia_id'  => $all['provincia_id'],
            'ciudad_id'     => $all['ciudad_id'],
        ];
        $date = Cita::query()->create($query);


        //Crear pago
        $pago = PagoCita::query()->create([
            'fecha'     => date('Y-m-d h:i'),
            'vencimiento' => date('Y-m-d H:i', strtotime($date->fecha_inicio. " -3 hours")),
            'valor'     => $all['cantidad'],
            'aprobado'  => 0,
            'tipo'      => $all['modalidad_pago'],
            'cita_id'   => $date->id_cita,
        ]);

        //permite registrar el usuario como antiguo
        Antiguedad::query()
            ->firstOrCreate([
                'paciente_id'       => $patient->paciente->id,
                'profesional_id'    => $user->profesional->idPerfilProfesional,
            ], ['confirmacion' => true]);

        //Enviar notificación de confirmación de cita
        //Mail::to($patient->email)->send(new ConfirmacionCitaEmail($date, 'profesional'));

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "Cita agendada para el paciente {$patient->nombre_completo}"
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * Permite actualizar cita
     *
     * @param Request $request
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function actualizar_cita(Request $request, $cita)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        $request->merge(['cita' => $cita]);
        //Validate date
        $validate = Validator::make($request->all(), [
            'cita'      => [
                'required',
                Rule::exists('citas', 'id_cita')
                    ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
            ],
            'lugar'     => ['required'],
            'cantidad'  => ['required'],
            'pais_id'           => ['required', 'exists:pais,id_pais'],
            'departamento_id'   => ['required', 'exists:departamentos,id_departamento'],
            'provincia_id'      => ['required', 'exists:provincias,id_provincia'],
            'ciudad_id'         => ['required', 'exists:municipios,id_municipio'],
            'modalidad_pago' => ['required', Rule::in(['virtual', 'presencial'])],
            'convenio'  => [
                'nullable',
                Rule::exists('convenios', 'id')
                    ->where('estado', 1)
                    ->where('id_user', Auth::user()->profesional->idUser)
            ],
            'servicio'  => [
                'required',
                Rule::exists('servicios', 'id')
                    ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
                    ->where('estado', 1)
            ]
        ], [
            'id_cita.required' => 'Algo salio mal con la cita, por favor cierre y vuélvalo a intentar'
        ], [
            'tipo_cita' => 'Tipo de cita',
            'lugar'     => 'Lugar',
            'cantidad'  => 'Cantidad',
            'pais_id'   => 'Pais',
            'departamento_id'=> 'Departamento',
            'provincia_id'   => 'Provincia',
            'ciudad_id' => 'Ciudad',
            'modalidad_pago' => 'Modalidad de pago',
            'servicio'  => 'Servicio',
            'convenio' => 'Convenio'
        ]);

        if ($validate->fails()) return response([
            'message' => [
                'title' => 'Error',
                'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
            ]
        ], Response::HTTP_NOT_FOUND);

        $user = Auth::user();
        $cita = Cita::query()
            ->where('id_cita', '=', $request->get('id_cita'))
            ->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->first();

        if (empty($cita)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'Cita no seleccionada'
            ]
        ], Response::HTTP_NOT_FOUND);

        $cita->update([
            'lugar'         => $request->get('lugar'),
            'tipo_cita_id'  => $request->get('tipo_cita'),
            'pais_id'       => $request->get('pais_id'),
            'departamento_id'=> $request->get('departamento_id'),
            'provincia_id'  => $request->get('provincia_id'),
            'ciudad_id'     => $request->get('ciudad_id'),
        ]);

        $pago = $cita->pago;

        $pago->update([
            'valor'     => $request->get('cantidad'),
            'tipo'      => $request->get('modalidad_pago'),
        ]);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Cita editada'
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Permite cancelar cita
     *
     * @param Request $request
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function cancelar_cita(Request $request, $cita)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        $user = Auth::user();
        $cita = Cita::query()
            ->where('id_cita', '=', $cita)
            ->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->first();

        if (empty($cita)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'Cita no seleccionada'
            ]
        ], Response::HTTP_NOT_FOUND);

        $cita->update([
            'estado' => 'cancelado'
        ]);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Cita cancelada'
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Reprogramar cita
     *
     * @param Request $request
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function reagendar_cita(Request $request, $cita)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        $all = ['fecha' => json_decode($request->get('disponibilidad'), true), 'cita' => $cita];
        //Validate date
        $validate = Validator::make($all, [
            'cita'      => [
                'required',
                Rule::exists('citas', 'id_cita')
                    ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
            ],
            'fecha.*'  => ['required', 'date_format:Y-m-d H:i'],
        ]);

        if ($validate->fails())
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);


        //user
        $user = Auth::user();

        //Validar disponibilidad de la cita
        $date_count = Cita::query()
            ->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->validar($all['fecha']['start'], $all['fecha']['end'])
            ->count();

        if ($date_count > 0)
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => 'La cita no esta disponible'
                ]
            ], Response::HTTP_NOT_FOUND);

        $cita = Cita::query()
            ->where('id_cita', '=', $cita)
            ->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->first();

        if (empty($cita)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'Cita no seleccionada'
            ]
        ], Response::HTTP_NOT_FOUND);


        $cita->update([
            'fecha_inicio'  => date('Y-m-d H:i', strtotime($all['fecha']['start'])),
            'fecha_fin'     => date('Y-m-d H:i', strtotime($all['fecha']['end'])),
        ]);

        //vencimiento
//        $fechaVencimiento = Carbon::now();
//        $fecha = $cita->fecha_inicio;
//        $fechaVencimiento = $fechaVencimiento->addDays(8);
//
//        if ($fechaVencimiento->greaterThan($fecha->subHour(1)))
//        {
//            $fechaVencimiento = $fecha;
//        }

        $cita->pago->update([
            'vencimiento' => $cita->fecha_inicio->subHours(3)
        ]);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Cita reagendada'
            ]
        ], Response::HTTP_CREATED);
    }


    /**
     * Permite finalizar una cita
     *
     * @param Request $request
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function completar_cita(Request $request, $cita)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        //Validate date
        $validate = Validator::make(array_merge($request->all(), ['cita' => $cita]), [
            'cita'      => [
                'required',
                Rule::exists('citas', 'id_cita')
                    ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
            ],
            'segundos'      => ['required', 'integer', 'min:0'],
            'comentario'   => ['nullable'],
        ], [
            'id_cita.required'  => 'Algo salio mal con la cita, por favor cierre y vuélvalo a intentar',
            'segundos.min'      => 'El conometro debe tener mínimo 5 minutos',
        ], [
            'tipo_cita'     => 'Tipo de cita',
            'segundos'      => 'Cronometro',
            'comentario'    => 'Comentario',
        ]);

        if ($validate->fails()) return response([
            'message' => [
                'title' => 'Error',
                'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
            ]
        ], Response::HTTP_NOT_FOUND);

        $user = Auth::user();

        $cita = Cita::query()
            ->where('id_cita', '=', $cita)
            ->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->first();

        if (empty($cita)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'Cita no seleccionada'
            ]
        ], Response::HTTP_NOT_FOUND);

        $cita->update([
            'duracion'  => $request->get('segundos'),
            'comentario'=> $request->get('comentarios'),
            'estado'    => 'completado',
        ]);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Cita completada'
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Permite crear una reserva en el calendario
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function reservar(Request $request)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        //Validate date
        $validate = Validator::make($request->all(), [
            'fecha_inicio'  => ['required', 'date'],
            'fecha_fin'     => ['required', 'date'],
            //'comentarios'   => ['required'],
        ], [], [
            'fecha_inicio'  => 'Fecha inicio',
            'fecha_fin'     => 'Fecha fin',
            //'comentarios'   => 'Comentarios'
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

        $all = $request->all();

        //Validar la disponibilidad de la cita
        $date_count = Cita::query()->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->validar($all['fecha_inicio'], $all['fecha_fin'])
            ->count();


        if ($date_count > 0)
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => 'Reserva no disponible, revise si no existe alguna cita cruzada'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //crear cita
        $query = [
            'fecha_inicio'  => date('Y-m-d H:i', strtotime($all['fecha_inicio'])),
            'fecha_fin'     => date('Y-m-d H:i', strtotime($all['fecha_fin'])),
            'estado'        => 'reservado',
            'profesional_id'=> $user->profesional->idPerfilProfesional,
            'comentario'   => $all['comentarios'] ?? '',
        ];
        Cita::query()->create($query);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "La reserva esta agendada"
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * Permite crear una reserva en el calendario
     *
     * @param Request $request
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function reservar_editar(Request $request, $cita)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        $request->merge(['cita' => $cita]);
        //Validate date
        $validate = Validator::make($request->all(), [
            'cita'      => [
                'required',
                Rule::exists('citas', 'id_cita')
                    ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
            ],
            'fecha_inicio'  => ['required', 'date'],
            'fecha_fin'     => ['required', 'date'],
            //'comentario'    => ['nullable'],
        ], [], [
            'fecha_inicio'  => 'Fecha inicio',
            'fecha_fin'     => 'Fecha fin',
            //'comentario'    => 'Comentario'
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

        $all = $request->all();

        //Validar la disponibilidad de la cita
        $date_count = Cita::query()
            ->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->validar($all['fecha_inicio'], $all['fecha_fin'])
            ->where('id_cita', '!=', $all['cita'])
            ->count();


        if ($date_count > 0)
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => 'Reserva no disponible, revise si no existe alguna cita cruzada'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        $cita = Cita::query()
            ->where('id_cita', '=', $request->get('cita'))
            ->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->first();

        if (empty($cita)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'Cita no seleccionada'
            ]
        ], Response::HTTP_NOT_FOUND);

        //crear cita
        $query = [
            'fecha_inicio'  => date('Y-m-d H:i', strtotime($all['fecha_inicio'])),
            'fecha_fin'     => date('Y-m-d H:i', strtotime($all['fecha_fin'])),
            'estado'        => 'reservado',
            'comentario'   => $all['comentarios'] ?? '',
        ];

        $cita->update($query);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "La reserva esta editada"
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * Permite cancelar reserva
     *
     * @param Request $request
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function reservar_cancelar(Request $request, $cita)
    {
        Gate::authorize('accesos-profesional', 'ver-calendario');

        $user = Auth::user();
        $cita = Cita::query()
            ->where('id_cita', '=', $cita)
            ->where('profesional_id', '=', $user->profesional->idPerfilProfesional)
            ->first();

        if (empty($cita)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'Bloqueo no encontrado'
            ]
        ], Response::HTTP_NOT_FOUND);

        if ($cita->fecha_fin->diffInDays(Carbon::today()) > 1) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'El bloqueo no se puede desbloquear, se estableció en el registro'
            ]
        ], Response::HTTP_NOT_FOUND);

        $cita->update([
            'estado' => 'cancelado'
        ]);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Reserva cancelada'
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Vista para configurar el calendario
     *
     * @return Application|Factory|View
     */
    public function configuracion()
    {
        Gate::authorize('accesos-profesional', 'configurar-calendario');

        $user = Auth::user();
        $config = Horario::query()->firstOrNew(['user_id' => $user->profesional->idUser]);

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
        Gate::authorize('accesos-profesional', 'configurar-calendario');

        $validator = Validator::make($request->all(),[
            'dias_agenda' => ['required', 'integer']
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

        //Actualizar o crear registro
        Horario::query()->updateOrCreate([
            'user_id' => $user->profesional->idUser
        ], [
            'dias_agenda' => $request->get('dias_agenda')
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
        Gate::authorize('accesos-profesional', 'configurar-calendario');

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
        $horario = Horario::query()->firstOrNew(['user_id' => $user->profesional->idUser]);

        $semana     = $request->get('semana');
        $hora_inicio = $request->get('hora_inicio');
        $hora_fin   = $request->get('hora_final');

        //validar si el horario se cruza con otro
        $validar = collect($horario->horario)->filter(function ($item) use ($semana, $hora_inicio, $hora_fin) {
            $flag = false;

            foreach ($semana as $s)
            {
                if (in_array($s, $item['daysOfWeek']))
                {
                    if (
                        //Validar si la hora de inicio está entre la hora inicio y fin de la cita existente
                        (strtotime($item['startTime']) <= strtotime($hora_inicio)
                            && strtotime($item['endTime']) > strtotime($hora_inicio))
                        or
                        //Validar si la hora de fin está entre la hora inicio y fin de la cita existente
                        (strtotime($item['startTime']) < strtotime($hora_fin)
                            && strtotime($item['endTime']) >= strtotime($hora_fin))
                        or
                        //Validar si la hora inicio existente está entre la hora inicio y fin
                        (strtotime($hora_inicio) <= strtotime($item['startTime'])
                            && strtotime($hora_fin) > strtotime($item['startTime']))
                        or
                        //Validar si la hora din existente está entre la hora inicio y fin
                        (strtotime($hora_inicio) < strtotime($item['endTime'])
                            && strtotime($hora_fin) >= strtotime($item['endTime']))
                    )
                    {
                        $flag = true;
                        break;
                    }
                }
            }

            return ($flag) ? $item:null;
        });

        if ($validar->isNotEmpty())
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => 'El horario esta cruzado con otro'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

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

        //Dias en texto
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
        Gate::authorize('accesos-profesional', 'configurar-calendario');

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
        $horario = Horario::query()->where('user_id', $user->profesional->idUser)->first();
        //schedule
        $schedule = $horario->horario;

        //delete schedule
        $array = array_filter(array_combine(array_keys($schedule), array_column($schedule, 'id')));
        $key_schedule_delete = array_search($request->id, $array);

        unset($schedule[$key_schedule_delete]);

        //save
        $horario->horario = $schedule;
        $horario->save();

        return response([
            'message'   => [
                'title' => 'Hecho',
                'text'  => 'Horario Eliminado'
            ],
        ], Response::HTTP_OK);
    }

    /**
     * Permite actualizar los colores del calendario
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function colores(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'color_cita_pagada'     => ['required'],
            'color_cita_presencial' => ['required'],
            'color_cita_agendada'   => ['required'],
            'color_cita_cancelada'  => ['required'],
            'color_bloqueado'       => ['required'],
        ], [], [
            'color_cita_pagada'     => 'Cita pagada',
            'color_cita_presencial' => 'Cita presencial',
            'color_cita_agendada'   => 'Cita agendada',
            'color_cita_cancelada'  => 'Cita cancelada',
            'color_bloqueado'       => 'Bloqueos'
        ]);

        if ($validator->fails())
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);

        $horario = Horario::query()
            ->where('user_id', Auth::user()->profesional->idUser)->first();

        $horario->update($request->all());

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Se actualizaron los colores de la agenda'
            ]
        ], Response::HTTP_OK);
    }
}
