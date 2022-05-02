<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\Convenios;
use App\Models\Cups;
use App\Models\especialidades;
use App\Models\Servicio;
use App\Models\TipoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ServicioController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $servicios = Servicio::query()
            ->where('profesional_id', '=', Auth::user()->profesional->idPerfilProfesional)
            ->get();

        return view('profesionales.admin.configuracion.servicios.index', compact('servicios'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $especialidades = especialidades::all();
        $tipo_servicios = TipoServicio::all();
        $convenios = Convenios::query()
            ->where('id_user', '=', Auth::user()->profesional->idUser)
            ->activado()
            ->get();

        return view('profesionales.admin.configuracion.servicios.crear', compact('especialidades',
            'convenios', 'tipo_servicios'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validator($request);

        $request->merge(['profesional_id' => Auth::user()->profesional->idPerfilProfesional]);

        $servicio = Servicio::query()->create($request->all());

        if ($servicio->convenios) {
            $array = collect($request->get('convenios-lista'))->map(function ($item) {
                return ['valor_convenio' => $item['valor_convenio'], 'valor_paciente' => $item['valor_paciente']];
            })->toArray();
        } else {
            $array = array();
        }
        $servicio->convenios_lista()->sync($array);

        return redirect()->route('profesional.configuracion.servicios.index')
            ->with('success', "El servicio {$servicio->nombre} ha sido creado");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Servicio $servicio
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Servicio $servicio)
    {
        $especialidades = especialidades::all();
        $tipo_servicios = TipoServicio::all();

        $convenios = Convenios::query()
            ->where('id_user', '=', Auth::user()->profesional->idUser)
            ->activado()
            ->get();

        $lista = $servicio->convenios_lista->keyBy('id')->map(function ($item){
            return [
                'convenio_id' => $item->pivot->convenio_id,
                'valor_paciente' => $item->pivot->valor_paciente,
                'valor_convenio' => $item->pivot->valor_convenio,
            ];
        })->toArray();

        return view('profesionales.admin.configuracion.servicios.editar', compact('especialidades',
            'convenios','servicio','lista', 'tipo_servicios'));
    }

    /**
     * @param Request $request
     * @param Servicio $servicio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,Servicio $servicio)
    {

        $this->validator($request);

        $servicio->update($request->all());

        if ($servicio->convenios)
        {
            $array = collect($request->get('convenios-lista'))->map(function ($item) {
                return ['valor_convenio' => $item['valor_convenio'], 'valor_paciente' => $item['valor_paciente']];
            })->toArray();
        }else{
            $array = array();
        }

        $servicio->convenios_lista()->sync($array);

        return redirect()->route('profesional.configuracion.servicios.index')
            ->with('success', "El servicio {$servicio->nombre} ha sido editado");
    }

    private function validator(Request $request)
    {

        $request->validate([
            'duracion' => ['required', 'min:0'],
            'descanso' => ['required', 'min:0'],
            'valor' => ['required', 'min:0'],
            'nombre' => ['required', 'max:100'],
            'descripcion' => ['nullable'],
            'especialidad_id' => ['required'],
            'convenios' => ['required', 'boolean'],
            'tipo_atencion' => ['required', Rule::in(['presencial', 'virtual'])],
            'citas_activas' => ['required', 'integer', 'min:1'],
            'tipo_servicio_id' => ['required', 'exists:tipo_servicios,id'],
            //'codigo_cups'       => ['required', 'exists:cups,code'],
            'codigo_cups' => ['required', function ($attribute, $value, $fail) {
                $validation = Cups::query()
                    ->selectRaw('count(id) as aggregate')
                    ->where('code', 'like', "%$value")
                    ->first();
                if ($validation->aggregate = 0) $fail("El CUPS no existe");
            }],

            'agendamiento_virtual' => ['nullable', 'boolean'],
            'estado' => ['nullable', 'boolean'],

            'convenios-lista.*' => ['required_if:convenios,1'],
            'convenios-lista.*.convenio_id' => ['required_if:convenios,1', 'exists:convenios,id'],
            'convenios-lista.*.valor_paciente' => ['required_if:convenios,1', 'numeric'],
            'convenios-lista.*.valor_convenio' => ['required_if:convenios,1', 'numeric'],
        ], [], [
            'duracion' => 'Duración',
            'descanso' => 'Descanso',
            'valor' => 'Valor',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'especialidad_id' => 'Especialidad',
            'convenios' => 'Vincular convenios',
            'tipo_atencion' => 'Tipo de atención',
            'citas_activas' => 'Número de citas activas por paciente',
            'tipo_servicio_id' => 'Tipo de servicio',
            'codigo_cups' => 'Vincular convenios',

            'convenios-lista.*' => 'Convenios',
            'convenios-lista.*.convenio_id' => 'Convenio',
            'convenios-lista.*.valor_paciente' => 'Valor a pagar paciente',
            'convenios-lista.*.valor_convenio' => 'Valor a pagar convenio',
        ]);
    }
}
