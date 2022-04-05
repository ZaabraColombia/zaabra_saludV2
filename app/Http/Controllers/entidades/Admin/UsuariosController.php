<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acceso;
use App\Models\Auxiliar;
use App\Models\pais;
use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsuariosController extends Controller
{
    /**
     * Mostrar vista para listar usuarios
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $usuarios = User::query()
            ->where('institucion_id', Auth::user()->institucion->id)
            ->get();

        return view('instituciones.admin.configuracion.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostar formulario para crear usuario
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $tipo_documentos = TipoDocumento::all();
        $accesos = Acceso::query()
            ->institucion()
            ->get();
        $paises = pais::all();

        return view('instituciones.admin.configuracion.usuarios.crear', compact('tipo_documentos',
            'accesos', 'paises'));
    }

    /**
     * Validar y guardar usuario de una institución
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validator($request, 'created');

        //Crear usuario
        $user = User::query()->create([
            'primernombre'      => $request->get('primer_nombre'),
            'segundonombre'     => $request->get('segundo_nombre'),
            'primerapellido'    => $request->get('primer_apellido'),
            'segundoapellido'   => $request->get('segundo_apellido'),
            'tipodocumento'     => $request->get('tipo_documento'),
            'numerodocumento'   => $request->get('numero_documento'),
            'email'             => $request->get('email'),
            'password'          => $request->get('password'),
            'institucion_id'    => Auth::user()->institucion->id,
            'estado'            => 1,
        ]);

        //Crear el registro del auxiliar
        $auxiliar = Auxiliar::query()->create([
            'fecha_nacimiento'  => $request->get('fecha_nacimiento'),
            'direccion'         => $request->get('direccion'),
            'telefono'          => $request->get('telefono'),
            'celular'           => $request->get('celular'),
            'pais_id'           => $request->get('pais_id'),
            'departamento_id'   => $request->get('departamento_id'),
            'provincia_id'      => $request->get('provincia_id'),
            'ciudad_id'         => $request->get('ciudad_id'),
            'user_id'           => $user->id
        ]);

        //crear acceso
        $user->accesos()->sync($request->get('accesos'));

        return redirect()
            ->route('institucion.configuracion.usuarios.index')
            ->with('success', "Usuario {$user->nombre_completo} ha sido creado");
    }


    private function validator(Request $request, string $method = null)
    {
        $request->validate([
            'primer_nombre'     => ['required', 'max:50'],
            'segundo_nombre'    => ['nullable', 'max:50'],
            'primer_apellido'   => ['required', 'max:50'],
            'segundo_apellido'  => ['nullable', 'max:50'],
            'tipo_documento'    => ['required', 'exists:tipo_documentos,id'],
            'numero_documento'  => ['required', 'max:50'],
            'fecha_nacimiento'  => ['required', 'date'],
            'direccion'         => ['required', 'max:100'],
            'telefono'          => ['required', 'max:50'],
            'celular'           => ['required', 'max:50'],
            'pais_id'           => ['required', 'exists:pais,id_pais'],
            'departamento_id'   => ['required', 'exists:departamentos,id_departamento'],
            'provincia_id'      => ['required', 'exists:provincias,id_provincia'],
            'ciudad_id'         => ['required', 'exists:municipios,id_municipio'],
            'email'             => ['required', 'email', 'unique:users'],
            'accesos.*'         => ['nullable', 'exists:accesos,id'],
            'password'          => [($method == 'create') ? 'required':'nullable', 'confirmed', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ]
        ], [],[
            'primer_nombre'     => 'Primer nombre',
            'segundo_nombre'    => 'Segundo nombre',
            'primer_apellido'   => 'Primer apellido',
            'segundo_apellido'  => 'Segundo apellido',
            'tipo_documento'    => 'Tipo de documento',
            'numero_documento'  => 'Número de documento',
            'fecha_nacimiento'  => 'Fecha de nacimiento',
            'direccion'         => 'Dirección',
            'telefono'          => 'Teléfono',
            'celular'           => 'Celular',
            'pais_id'           => 'Pais',
            'departamento_id'   => 'Departamento',
            'provincia_id'      => 'Provincia',
            'ciudad_id'         => 'Ciudad',
            'email'             => 'Correo'
        ]);
    }
}
