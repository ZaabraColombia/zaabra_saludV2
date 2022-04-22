<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\especialidades;
use App\Models\Paciente;
use App\Models\profesionales_instituciones;
use App\Models\Servicio;
use App\Models\TipoServicio;
use App\Models\User;
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
            //->where(DB::raw("DATE_FORMAT(fecha_inicio, '%Y-%c-%e') = '{$request->fecha}'"))
            ->whereIn('profesional_ins_id', $request->get('ids'));

        //dd($query->get()->toJson());

        return datatables()->eloquent($query)->toJson();
    }

    /**
     * Vista que permite crear una cita
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $profesionales = profesionales_instituciones::query()
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

        //paciente
        $paciente = $request->paciente;
        $paciente = Paciente::query()
            ->whereHas('user', function ($query) use ($paciente){
                $query->where('numerodocumento', $paciente);
            })
            ->first();

        //Validar el límite de agenda * servicio * usuario // Terminar
//        $citas = Cita::query()
//            ->where('paciente_id', $paciente->id)
//            ->where('estado', 'like', 'agendado')
//            ->where('tipo_cita_id', $servicio->id)
//            ->count();
//
//        if ($citas >= $servicio->citas_activas) {
//            return response([
//                'message' => [
//                    'title' => 'Error',
//                    'text'  => 'Ya tiene citas agendadas con el servicios de la institución'
//                ]
//            ], Response::HTTP_NOT_FOUND);
//        }

        //Citas médicas
        $fecha = $request->get('date-calendar');
        $datesOperatives = $profesional->citas()
            ->select(['id_cita', 'fecha_inicio', 'fecha_fin'])
            ->whereNotIn('estado', ['cancelado', 'completado'])
            ->whereRaw("date_format(fecha_inicio, '%Y-%c-%d') = $fecha")
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
                $startDate = strtotime("$fecha " . $item['startTime']);
                $endDate = strtotime("$fecha " . $item['endTime']);

                //generar posibles citas
                $listDates = generar_citas($startDate, $endDate, $intervaloCita, $datesOperatives, 2);

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
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request){
        $request->validate([
            'paciente' => ['required'],
            'paciente' => ['required'],
            'paciente' => ['required'],
            'paciente' => ['required'],
            'paciente' => ['required'],
            'paciente' => ['required'],
        ]);


        return redirect();
    }


}
