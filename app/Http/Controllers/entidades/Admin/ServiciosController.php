<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\Convenios;
use App\Models\Cups;
use App\Models\especialidades;
use App\Models\Servicio;
use App\Models\tipoinstituciones;
use App\Models\TipoServicio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiciosController extends Controller
{

    /**
     * Mostrar lista de servicios
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        Gate::authorize('accesos-institucion','ver-servicios');

        $servicios = Servicio::query()
            ->with('tipo_servicio')
            ->where('institucion_id', '=', Auth::user()->institucion->id )
            ->with(['especialidad', 'tipo_servicio'])
            ->get();

        return view('instituciones.admin.configuracion.servicios.index', compact('servicios'));
    }

    /**
     * Mostrar formulario para crear servicio
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        Gate::authorize('accesos-institucion','editar-servicio');
        $especialidades = especialidades::query()->orderBy('nombreEspecialidad')->get();
        $tipo_servicios = TipoServicio::all();
        $convenios = Convenios::query()
            ->where('id_user', '=', Auth::user()->institucion->user->id)
            ->activado()
            ->get();

        return view('instituciones.admin.configuracion.servicios.crear', compact('especialidades',
            'convenios', 'tipo_servicios'));
    }

    /**
     * Validar y crear servicio
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Gate::authorize('accesos-institucion','editar-servicio');

        $this->validator($request);

        $request->merge(['institucion_id' => Auth::user()->institucion->id]);
        $valor = str_replace('.' , '', $request->valor);

        $servicio = Servicio::query()->create(array_merge($request->except('valor'), ['valor' => $valor]));


        if ($servicio->convenios)
        {
            $array = collect($request->get('convenios-lista'))->map(function ($item) {
                return [
                    'valor_convenio' => str_replace('.' , '', $item['valor_convenio']),
                    'valor_paciente' => str_replace('.' , '', $item['valor_paciente'])];
            })->toArray();
        }else{
            $array = array();
        }
        $servicio->convenios_lista()->sync($array);

        return redirect()->route('institucion.configuracion.servicios.index')
            ->with('success', "El servicio {$servicio->nombre} ha sido creado");
    }

    /**
     * @param $convenio
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function show($servicio)
    {
        $validate = Validator::make(['servicio' => $servicio], [
            'servicio' => [
                'required',
                Rule::exists('servicios', 'id')
                    ->where('institucion_id', Auth::user()->institucion->id)
            ]
        ]);

        if ($validate->fails())
            return response([
                'message' => [
                    'title' => 'No se encontr?? el servicio',
                    'text'  => ''
                ]
            ]);

        $servicio = Servicio::query()
            ->select('servicios.*')
            ->addSelect([
                'especialidad'  => especialidades::query()->select('nombreespecialidad as especialidad')->whereColumn('especialidad_id', 'idEspecialidad')->take(1),
                'tipo_servicio' => TipoServicio::query()->select('nombre as tipo_servicio')->whereColumn('tipo_servicio_id', 'tipo_servicios.id')->take(1),
                'cup'           => Cups::query()->selectRaw('concat(cups.code, "-", cups.description) as cup')->whereColumn('codigo_cups', 'cups.code')->take(1),
            ])
            ->where('id', $servicio)
            ->with([
                'convenios_lista:id,tipo_documento_id,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido'
            ])
            ->first();

        return response([
            'item' => $servicio
        ], Response::HTTP_OK);
    }

    /**
     * Mostar formulario para editar en servicio
     *
     * @param Servicio $servicio
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Servicio $servicio)
    {
        Gate::authorize('accesos-institucion','editar-servicio');
        Gate::authorize('update-servicio-institucion', $servicio);

        $especialidades = especialidades::query()->orderBy('nombreEspecialidad')->get();
        $tipo_servicios = TipoServicio::all();

        $convenios = Convenios::query()
            ->where('id_user', '=', Auth::user()->institucion->user->id)
            ->activado()
            ->get();

        $lista = $servicio->convenios_lista->keyBy('id')->map(function ($item){
            return [
                'convenio_id' => $item->pivot->convenio_id,
                'valor_paciente' => $item->pivot->valor_paciente,
                'valor_convenio' => $item->pivot->valor_convenio,
            ];
        })->toArray();

        return view('instituciones.admin.configuracion.servicios.editar', compact('especialidades',
            'convenios','servicio','lista', 'tipo_servicios'
        ));
    }


    public function update(Request $request, Servicio $servicio)
    {
        Gate::authorize('accesos-institucion','editar-servicio');
        Gate::authorize('update-servicio-institucion', $servicio);

        $this->validator($request);

        $servicio->valor = str_replace('.' , '', $request->valor);

        $servicio->update($request->except('valor'));

        if ($servicio->convenios)
        {
            $array = collect($request->get('convenios-lista'))->map(function ($item) {
                return [
                    'valor_convenio' => str_replace('.' , '', $item['valor_convenio']),
                    'valor_paciente' => str_replace('.' , '', $item['valor_paciente'])];
            })->toArray();
        }else{
            $array = array();
        }

        $servicio->convenios_lista()->sync($array);

        return redirect()->route('institucion.configuracion.servicios.index')
            ->with('success', "El servicio {$servicio->nombre} ha sido editado");
    }


    private function validator(Request $request)
    {

        $request->validate([
            'duracion'          => ['required', 'min:0'],
            'descanso'          => ['required', 'min:0'],
            'valor'             => ['required', 'min:0'],
            'nombre'            => ['required', 'max:100'],
            'descripcion'       => ['nullable'],
            'especialidad_id'   => ['required'],
            'convenios'         => ['required', 'boolean'],
            'tipo_atencion'     => ['required', Rule::in(['presencial', 'virtual'])],
            'citas_activas'     => ['required', 'integer', 'min:1'],
            'tipo_servicio_id'  => ['required', 'exists:tipo_servicios,id'],
            //'codigo_cups'       => ['required', 'exists:cups,code'],
            'codigo_cups'       => ['required', function ($attribute, $value, $fail) {
                $validation = Cups::query()->selectRaw('count(id) as aggregate')->where('code', 'like', "%$value")->first();
                if ($validation->aggregate = 0) $fail("El CUPS no existe");
            }],

            'agendamiento_virtual'  => ['nullable', 'boolean'],
            'estado'                => ['nullable', 'boolean'],

            'convenios-lista.*'                 => ['required_if:convenios,1'],
            'convenios-lista.*.convenio_id'     => ['required_if:convenios,1', 'exists:convenios,id'],
            'convenios-lista.*.valor_paciente'  => ['required_if:convenios,1', 'numeric'],
            'convenios-lista.*.valor_convenio'  => ['required_if:convenios,1', 'numeric'],
        ], [], [
            'duracion'          => 'Duraci??n',
            'descanso'          => 'Descanso',
            'valor'             => 'Valor',
            'nombre'            => 'Nombre',
            'descripcion'       => 'Descripci??n',
            'especialidad_id'   => 'Especialidad',
            'convenios'         => 'Vincular convenios',
            'tipo_atencion'     => 'Tipo de atenci??n',
            'citas_activas'     => 'N??mero de citas activas por paciente',
            'tipo_servicio_id'  => 'Tipo de servicio',
            'codigo_cups'       => 'Vincular convenios',

            'convenios-lista.*' => 'Convenios',
            'convenios-lista.*.convenio_id' => 'Convenio',
            'convenios-lista.*.valor_paciente' => 'Valor a pagar paciente',
            'convenios-lista.*.valor_convenio' => 'Valor a pagar convenio',
        ]);
    }

}
