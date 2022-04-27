<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmacionCitaEmail;
use App\Models\Antiguedad;
use App\Models\Cita;
use App\Models\especialidades;
use App\Models\Paciente;
use App\Models\PagoCita;
use App\Models\profesionales_instituciones;
use App\Models\Servicio;
use App\Models\TipoServicio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CalendarioController extends Controller
{
    public function iniciar_control()
    {
        $institucion = Auth::user()->institucion->id;

        //Profesionales
        $profesionales = profesionales_instituciones::query()
            ->select('id_profesional_inst', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
            //->nombreCompleto()
            ->where('estado', 1)
            ->where('id_institucion', $institucion)
            ->get();

        //Servicios
        $servicios = Servicio::query()
            ->select(['id', 'nombre'])
            ->where('institucion_id', $institucion)
            ->where('estado', 1)
            ->get();

        //Especialidades
        $especialidades = especialidades::query()
            ->where('estado', 1)
            ->whereHas('servicios', function (Builder $query) use ($institucion){
                $query->where('servicios.institucion_id', $institucion)
                    ->where('servicios.estado', 1);
            })
            ->get();

        return view('instituciones.admin.calendario.filtro', compact('profesionales',
            'servicios', 'especialidades'));
    }


    public function buscar(Request $request)
    {
        $request->validate([
            'id'    => ['required'],
            'tipo'  => ['required', Rule::in(['profesional', 'servicio', 'especialidad'])]
        ]);

        $institucion = Auth::user()->institucion->id;
        $id = $request->get('id');

        $profesionales = array();

        switch ($request->get('tipo'))
        {
            case 'profesional':
                $profesionales[] = profesionales_instituciones::query()
                    ->select('id_profesional_inst as id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                    ->nombreCompleto()
                    ->where('id_profesional_inst', $id)
                    ->where('estado', 1)
                    ->where('id_institucion', $institucion)
                    ->first()->toArray();
                break;
            case 'servicio':
                $profesionales = profesionales_instituciones::query()
                    ->select('id_profesional_inst as id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                    ->nombreCompleto()
                    ->whereHas('servicios', function (Builder $query) use ($institucion, $id) {
                        $query->where('institucion_id', $institucion)
                            ->where('servicios.id', $id);
                    })
                    ->where('estado', 1)
                    ->where('id_institucion', $institucion)
                    ->get()->toArray();
                break;
            case 'especialidad':
                $profesionales = profesionales_instituciones::query()
                    ->select('id_profesional_inst as id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                    ->nombreCompleto()
                    ->whereHas('servicios', function (Builder $query) use ($institucion, $id) {
                        $query->where('institucion_id', $institucion)
                            ->where('servicios.especialidad_id', $id);
                    })
                    ->where('estado', 1)
                    ->where('id_institucion', $institucion)
                    ->get()->toArray();
                break;
        }

        return response([
            'items' => $profesionales
        ], Response::HTTP_OK);
    }


    public function citas(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'fecha' => ['required', 'date'],
            'lista-profesionales' => ['required'],
            'lista-profesionales.*.id' => [
                //'required',
                Rule::exists('profesionales_instituciones', 'id_profesional_inst')->where(function ($query) {
                    $query->where('id_institucion', Auth::user()->institucion->id)
                        ->where('estado', 1);
                })
            ],
        ], [
            //'lista-profesionales.*.id.required' => 'Asegúrese que los profesionales eaten agregados de forma correcta',
            'lista-profesionales.*.id.exists'   => 'Asegúrese que el profesional estén agregados de forma correcta',
        ]);

        $lista = array_column($request->get('lista-profesionales'), 'id');
        $fecha = $request->fecha;

        return view('instituciones.admin.calendario.citas', compact('lista', 'fecha'));
    }

    public function lista_citas(Request $request)
    {
        $query = Cita::query()
            ->with([
                'paciente:id,id_usuario,celular',
                'paciente.user:id,primernombre,segundonombre,primerapellido,segundoapellido,numerodocumento',
                'profesional_ins:id_profesional_inst,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido'
            ])
            ->whereNotIn('estado', ['cancelado'])
            //->where(DB::raw("DATE_FORMAT(fecha_inicio, '%Y-%c-%e') = '{$request->fecha}'"))
            ->whereIn('profesional_ins_id', $request->get('ids'));

        return datatables()
            ->eloquent($query)
            ->addColumn('edit', function (Cita $cita){
                return route('institucion.calendario.ver-cita', ['cita' => $cita->id_cita]);
            })
            ->toJson();
    }

    /**
     * Vista que permite crear una cita
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $profesionales = profesionales_instituciones::query()
            ->with([
                'sede',
                'sede.ciudad'
            ])
            ->where('id_institucion', Auth::user()->institucion->id)
            ->get();

        return view('instituciones.admin.calendario.crear-cita', compact('profesionales'));
    }

    /**
     * Permite ver citas libres
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function citas_libre(Request $request)
    {

        //Validate date
        $validate = Validator::make($request->all(), [
            'profesional'   => [
                'required',
                Rule::exists('profesionales_instituciones', 'id_profesional_inst')
                    ->where('id_institucion', Auth::user()->institucion->id)
                //->where('estado', 1)
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

        //profesional
        $profesional = profesionales_instituciones::query()->find($request->profesional);

        //Validate date
        $validate = Validator::make($request->all(), [
            'paciente'      => [
                'required',
                'exists:users,numerodocumento'
            ],
            'date-calendar'  => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:' . date('Y-m-d', strtotime(date('Y-m-d') . "+{$profesional->disponibilidad_agenda} days"))
            ],
            'tipo_servicio' => [
                'required',
                Rule::exists('servicios', 'id')->where(function ($query) use ($profesional){
                    return $query->where('institucion_id', $profesional->institucion->id)
                        ->where('agendamiento_virtual', 1);
                })
            ]
        ], [], [
            'paciente'  => 'Paciente',
            'date-calendar' => 'Fecha',
            'tipo_servicio'  => 'Servicio'
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //Servicio
        $servicio = Servicio::find($request->tipo_servicio);

        //Citas médicas
        $fecha = $request->get('date-calendar');
        $datesOperatives = $profesional->citas()
            ->select(['id_cita', 'fecha_inicio', 'fecha_fin'])
            ->whereNotIn('estado', ['cancelado', 'completado'])
            //->whereRaw("date_format(fecha_inicio, '%Y-%c-%d') = $fecha")
            ->whereDate('fecha_inicio', $fecha)
            ->get()
            ->toArray();

        //Horario
        $horario = $profesional->horario;

        //Validar el número del dia de la semana
        $diaSemana = date('w', strtotime($request->date));

        //crear intervalos
        $intervaloCita = ($servicio->duracion + $servicio->descanso) * 60;

        //Crear las citas libres
        $listDates = array();

        //Buscar los dias disponibles
        foreach ($horario as $item)
        {

            if (in_array( $diaSemana, $item['daysOfWeek']))
            {
                //inicio y fin
                $startDate = strtotime("$fecha " . $item['startTime']);
                $endDate = strtotime("$fecha " . $item['endTime']);

                //generar posibles citas
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
     * Permite crear una cita
     *
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function store(Request $request)
    {

        //Validate date
        $validate = Validator::make($request->all(), [
            'profesional'   => [
                'required',
                Rule::exists('profesionales_instituciones', 'id_profesional_inst')
                    ->where('id_institucion', Auth::user()->institucion->id)
                //->where('estado', 1)
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

        //profesional
        $profesional = profesionales_instituciones::query()->find($request->profesional);

        $validate = Validator::make($request->all(), [
            'hora'    => ['required'],
            'hora.*'  => [
                'required',
                'date_format:Y-m-d H:i',
                'before_or_equal:' . date('Y-m-d H:i', strtotime(date('Y-m-d') . " 23:59 +{$profesional->disponibilidad_agenda} days"))
            ],
            'paciente'      => [
                'required',
                'exists:users,numerodocumento'
            ],
            'tipo_servicio' => [
                'required',
                Rule::exists('servicios', 'id')->where(function ($query) use ($profesional){
                    return $query->where('institucion_id', $profesional->institucion->id)
                        ->where('agendamiento_virtual', 1);
                })
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

        //Servicio
        $convenio = $request->convenio;
        $tipo_servicio = $request->tipo_servicio;

        $servicio = Servicio::query()
            ->with(['convenios_lista' => function ($query) use ($convenio, $tipo_servicio){
                if (isset($tipo_servicio) and isset($convenio)) return $query
                    ->where('convenios.id', $convenio)
                    ->first();
                return $query->first();
            }])
            ->find($request->tipo_servicio);

        $paciente = $request->paciente;
        $paciente = Paciente::query()
            ->whereHas('user', function ($query) use ($paciente){
                $query->where('numerodocumento', $paciente);
            })
            ->first();

        //Validar el límite de agenda * servicio* usuario
//        $citas = Cita::query()
//            ->where('paciente_id', $paciente->id)
//            ->where('estado', 'like', 'agendado')
//            ->where('tipo_cita_id', $request->tipo_servicio)
//            ->count();
//
//        //dd(Auth::user()->paciente->id);
//        if ($citas >= $servicio->citas_activas) {
//            return redirect()
//                ->back()
//                ->withErrors(['cita' => 'Ya tiene citas agendadas con el servicios de la institución']);;
//        }

        $fecha = json_decode($request->hora);
        $inicio = $fecha->start;
        $fin    = $fecha->end;


        $validar_cita = Cita::query()
            ->validar($inicio, $fin)
            ->whereNotIn('estado', ['cancelado', 'completado'])
            ->count();

        if ($validar_cita > 0)
        {
            return redirect()
                ->back()
                ->withErrors(['cita' => 'Cita no disponible']);
        }


        //crear cita
        $date = Cita::query()->create([
            'fecha_inicio'  => date('Y-m-d H:i', strtotime($inicio)),
            'fecha_fin'     => date('Y-m-d H:i', strtotime($fin)),
            'estado'        => 'agendado',
            'lugar'         => ($profesional->sede->direccion ?? $profesional->institucion->direccion) . " - Consultorio " . ($profesional->consultorio),
            'pais_id'       => $profesional->sede->pais_id ?? $profesional->institucion->idPais,
            'departamento_id' => $profesional->sede->departamento_id ?? $profesional->institucion->id_departamento,
            'provincia_id'  => $profesional->sede->provincia_id ?? $profesional->institucion->id_provincia,
            'ciudad_id'     => $profesional->sede->ciudad_id ?? $profesional->institucion->id_municipio,
            'tipo_cita_id'  => $servicio->id,
            'profesional_ins_id'=> $profesional->id_profesional_inst,
            'paciente_id'   => $paciente->id,
            'especialidad_id'   => $servicio->especialidad_id,
        ]);

        $fechaPago = Carbon::now();

        //permite registrar el usuario como antiguo
        Antiguedad::query()
            ->firstOrCreate([
                'paciente_id' => $paciente->id,
                'institucion_id' => $profesional->id_institucion,
            ], ['confirmacion' => true]);

        //Crear pago
        $pago = PagoCita::query()->create([
            'fecha'         => $fechaPago,
            'vencimiento'   => date('Y-m-d H:i', strtotime($inicio. " -3 hours")),
            'valor'         => (isset($tipo_servicio) and isset($convenio)) ? $servicio->convenios_lista[0]->pivot->valor_paciente:$servicio->valor ,
            'valor_convenio' => (isset($tipo_servicio) and isset($convenio)) ? $servicio->convenios_lista[0]->pivot->valor_convenio:0,
            'aprobado'  => 0,
            'tipo'      => $request->modalidad,
            'cita_id'   => $date->id_cita,
        ]);

        //Enviar notificación de confirmación de cita
        //Mail::to($paciente->email)->send(new ConfirmacionCitaEmail($date, 'institucion'));

        return redirect()
            ->route('institucion.panel')
            ->with('success', "Cita asignada con {$profesional->nombre_completo}");
    }

    /**
     * Permite buscar una cita
     *
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function show($cita)
    {
        $cita = Cita::query()
            ->whereHas('profesional_ins', function (Builder $query) {
                return $query->where('id_institucion', Auth::user()->institucion->id);
            })
            ->addSelect([
                'paciente' => User::query()->select('numerodocumento as paciente')
                    ->whereHas('paciente', function ($query){
                        return $query->whereColumn('pacientes.id', 'citas.paciente_id');
                    })
            ])
            ->where('id_cita', $cita)
            ->first();

        if (empty($cita)) return response([
            'title'     => 'Error',
            'message'   => 'No se encuentra la cita'
        ], Response::HTTP_NOT_FOUND);

        $cita->edit     = route('institucion.calendario.actualizar-cita', ['cita' => $cita->id_cita]);
        $cita->cancel   = route('institucion.calendario.cancelar-cita', ['cita' => $cita->id_cita]);

        return response([
            'item' => $cita
        ], Response::HTTP_OK);
    }

    /**
     * Permite reagendar una cita
     *
     * @param Request $request
     * @param $cita
     * @return Response
     */
    public function update(Request $request, $cita)
    {

        //Validate date
        $validate = Validator::make($request->all(), [
            'profesional'   => [
                'required',
                Rule::exists('profesionales_instituciones', 'id_profesional_inst')
                    ->where('id_institucion', Auth::user()->institucion->id)
                //->where('estado', 1)
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

        //profesional
        $profesional = profesionales_instituciones::query()->find($request->profesional);

        $validate = Validator::make($request->all(), [
            'hora'    => ['required'],
            'hora.*'  => [
                'required',
                'date_format:Y-m-d H:i',
                'before_or_equal:' . date('Y-m-d H:i', strtotime(date('Y-m-d') . " 23:59 +{$profesional->disponibilidad_agenda} days"))
            ],
            'paciente'      => [
                'required',
                'exists:users,numerodocumento'
            ],
            'tipo_servicio' => [
                'required',
                Rule::exists('servicios', 'id')->where(function ($query) use ($profesional){
                    return $query->where('institucion_id', $profesional->institucion->id)
                        ->where('agendamiento_virtual', 1);
                })
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

        //Servicio
        $convenio = $request->convenio;
        $tipo_servicio = $request->tipo_servicio;

        $servicio = Servicio::query()
            ->with(['convenios_lista' => function ($query) use ($convenio, $tipo_servicio){
                if (isset($tipo_servicio) and isset($convenio)) return $query
                    ->where('convenios.id', $convenio)
                    ->first();
                return $query->first();
            }])
            ->find($request->tipo_servicio);

        $paciente = $request->paciente;
        $paciente = Paciente::query()
            ->whereHas('user', function ($query) use ($paciente){
                $query->where('numerodocumento', $paciente);
            })
            ->first();

        $fecha = json_decode($request->hora);
        $inicio = $fecha->start;
        $fin    = $fecha->end;

        $validar_cita = Cita::query()
            ->validar($inicio, $fin)
            ->whereNotIn('estado', ['cancelado', 'completado'])
            ->count();

        if ($validar_cita > 0)
        {
            return response([
                'message' => [
                    'title'     => 'error',
                    'text'   => 'Cita no disponible'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //Validar cita
        $cita = Cita::query()
            ->where('id_cita', $cita)
            ->where('paciente_id', $paciente->id)
            ->where('tipo_cita_id', $servicio->id)
            ->whereHas('profesional_ins', function ($query){
                return $query->where('id_institucion', Auth::user()->institucion->id);
            })
            ->first();

        if (empty($cita))
            return response([
                'message' => [
                    'title'     => 'error',
                    'text'   => 'La cita no esta disponible'
                ]
            ], Response::HTTP_NOT_FOUND);

        //crear cita
        $cita->update([
            'fecha_inicio'  => date('Y-m-d H:i', strtotime($inicio)),
            'fecha_fin'     => date('Y-m-d H:i', strtotime($fin)),
            'profesional_ins_id'=> $profesional->id_profesional_inst,
            'especialidad_id'   => $servicio->especialidad_id,
        ]);

        //Editar pago
        if (isset($cita->pago))
            $cita->pago->update([
                'vencimiento'   => date('Y-m-d H:i', strtotime($inicio. " -3 hours")),
            ]);

        //Enviar notificación de confirmación de cita
        //Mail::to($paciente->email)->send(new ConfirmacionCitaEmail($date, 'institucion'));

        //dd($cita);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "La cita del paciente {$paciente->nombre_completo} se reagendo correctamente"
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Permite cancelar una cita
     *
     * @param Request $request
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function cancelar(Request $request, $cita)
    {
        //Validate date
        $validate = Validator::make($request->all(), [
            'profesional'   => [
                'required',
                Rule::exists('profesionales_instituciones', 'id_profesional_inst')
                    ->where('id_institucion', Auth::user()->institucion->id)
                //->where('estado', 1)
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

        //profesional
        $profesional = profesionales_instituciones::query()->find($request->profesional);

        //Validar cita
        $cita = Cita::query()
            ->where('id_cita', $cita)
            ->where('profesional_ins_id', $profesional->id_profesional_inst)
            ->whereHas('profesional_ins', function ($query){
                return $query->where('id_institucion', Auth::user()->institucion->id);
            })
            ->first();

        if (empty($cita))
            return response([
                'message' => [
                    'title'     => 'error',
                    'text'   => 'La cita no esta disponible'
                ]
            ], Response::HTTP_NOT_FOUND);


        //cancelar cita
        $cita->update(['estado' => 'cancelado']);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "La cita del paciente {$cita->paciente->user->nombre_completo} se cancelo correctamente"
            ]
        ], Response::HTTP_OK);
    }
}
