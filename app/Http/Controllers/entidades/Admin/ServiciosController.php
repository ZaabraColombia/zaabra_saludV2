<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\Convenios;
use App\Models\especialidades;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ServiciosController extends Controller
{

    /**
     * Mostrar lista de servicios
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $servicios = Servicio::query()
            ->where('institucion_id', '=', Auth::user()->institucion->id )
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
        $especialidades = especialidades::all();
        $convenios = Convenios::query()
            ->where('id_user', '=', Auth::user()->institucion->user->id)
            ->activado()
            ->get();

        return view('instituciones.admin.configuracion.servicios.crear', compact('especialidades', 'convenios'));
    }

    /**
     * Validar y crear servicio
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validator($request);

        $request->merge(['institucion_id' => Auth::user()->institucion->id]);

        $servicio = Servicio::query()->create($request->all());

        if ($servicio->convenios)
        {
            $array = collect($request->get('convenios-lista'))->map(function ($item) {
                return ['valor_convenio' => $item['valor_convenio'], 'valor_paciente' => $item['valor_paciente']];
            })->toArray();
        }else{
            $array = array();
        }
        $servicio->convenios_lista()->sync($array);

        return redirect()->route('institucion.configuracion.servicios.index')
            ->with('success', "El servicio {$servicio->nombre} ha sido creado");
    }

    /**
     * Mostar formulario para editar en servicio
     *
     * @param Servicio $servicio
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Servicio $servicio)
    {
        Gate::authorize('update-servicio-institucion', $servicio);

        $especialidades = especialidades::all();
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

        return view('instituciones.admin.configuracion.servicios.editar', compact(
            'especialidades',
            'convenios',
            'servicio',
            'lista'
        ));
    }


    public function update(Request $request, Servicio $servicio)
    {

        Gate::authorize('update-servicio-institucion', $servicio);

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
            'descripcion'       => ['required'],
            'especialidad_id'   => ['required'],
            'convenios'         => ['required', 'boolean'],

            'convenios-lista.*'                 => ['required_if:convenios,1'],
            'convenios-lista.*.convenio_id'     => ['required_if:convenios,1', 'exists:convenios,id'],
            'convenios-lista.*.valor_paciente'  => ['required_if:convenios,1', 'numeric'],
            'convenios-lista.*.valor_convenio'  => ['required_if:convenios,1', 'numeric'],
        ], [], [
            'duracion'          => 'Duración',
            'descanso'          => 'Descanso',
            'valor'             => 'Valor',
            'nombre'            => 'Nombre',
            'descripcion'       => 'Descripción',
            'especialidad_id'   => 'Especialidad',
            'convenios'         => 'Vincular convenios',
            'convenios-lista.*' => 'Convenios',
            'convenios-lista.*.convenio_id' => 'Convenio',
            'convenios-lista.*.valor_paciente' => 'Valor a pagar paciente',
            'convenios-lista.*.valor_convenio' => 'Valor a pagar convenio',
        ]);
    }

}
