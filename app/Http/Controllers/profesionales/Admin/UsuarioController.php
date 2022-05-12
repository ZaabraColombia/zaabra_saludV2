<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acceso;
use App\Models\Auxiliar;
use App\Models\pais;
use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsuarioController extends Controller
{
    const LIMITE_ESTADO = 1;

    public function index()
    {
        Gate::authorize('accesos-profesional', 'ver-usuarios');
        $usuarios = User::query()
            ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
            ->get();

        return view('profesionales.admin.configuracion.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        Gate::authorize('accesos-profesional', 'agregar-usuario');

        $tipo_documentos = TipoDocumento::all();
        $accesos = Acceso::query()
            ->profesional()
            ->get();
        $paises = pais::all();

        return view('profesionales.admin.configuracion.usuarios.crear', compact('tipo_documentos',
            'accesos', 'paises'));
    }

    public function store(Request $request)
    {
        Gate::authorize('accesos-profesional', 'agregar-usuario');

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
            'profesional_id'    => Auth::user()->profesional->idPerfilProfesional,
            'estado'            => 1,
            'password'          => Hash::make($request->get('password')),
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

        //crear rol
        $user->roles()->create(['idrol' => 5]);

        //crear acceso
        $accesos = (is_array($request->get('accesos'))) ? $request->get('accesos') : array();
        $user->accesos()->sync($accesos);

        return redirect()
            ->route('profesional.configuracion.usuarios.index')
            ->with('success', "Usuario {$user->nombre_completo} ha sido creado");
    }


    public function show($user)
    {
        Gate::authorize('accesos-profesional', 'ver-usuarios');

        $user = User::query()->with(['auxiliar', 'accesos', 'tipo_documento'])->find($user);
        Gate::authorize('update-usuario-profesional', $user);

        return response([
            'item' => [
                'nombres'               => $user->nombres,
                'apellidos'             => $user->apellidos,
                'estado'                => ($user -> estado)? 'Activado' : 'Desactivado',
                'numero_identificacion' => $user->identificacion,
                'fecha_nacimiento'      => $user->auxiliar->fecha_nacimiento,
                'direccion'             => $user->auxiliar->direccion,
                'correo'                => $user->email,
                'telefonos'             => "{$user->auxiliar->telefono} - {$user->auxiliar->celular}",
                'celular'               => $user->auxiliar->celular,
                'pais'                  => $user->auxiliar->pais->nombre,
                'departamento'          => $user->auxiliar->departamento->nombre,
                'provincia'             => $user->auxiliar->provincia->nombre,
                'ciudad'                => $user->auxiliar->ciudad->nombre,
                'accesos'               => $user->accesos
            ]
        ], Response::HTTP_OK);
    }

    public function edit($user)
    {

        Gate::authorize('accesos-profesional', 'editar-usuario');
        $user = User::find($user);
        Gate::authorize('update-usuario-profesional', $user);

        $tipo_documentos = TipoDocumento::all();
        $accesos = Acceso::query()
            ->profesional()
            ->get();
        $paises = pais::all();

        //extraer accesos
        $accesosUsuario = $user->accesos->map(function ($item){ return $item->id; })->toArray();

        return view('profesionales.admin.configuracion.usuarios.editar', compact('tipo_documentos',
            'accesos', 'paises', 'user', 'accesosUsuario'));
    }

    public function update(Request $request, $user)
    {
        Gate::authorize('accesos-profesional', 'editar-usuario');
        $user = User::find($user);
        Gate::authorize('update-usuario-profesional', $user);

        $this->validator($request, 'updated', $user->id);

        //Crear usuario
        $user->update([
            'primernombre'      => $request->get('primer_nombre'),
            'segundonombre'     => $request->get('segundo_nombre'),
            'primerapellido'    => $request->get('primer_apellido'),
            'segundoapellido'   => $request->get('segundo_apellido'),
            'tipodocumento'     => $request->get('tipo_documento'),
            'numerodocumento'   => $request->get('numero_documento'),
            'email'             => $request->get('email'),
            'estado'            => $request->get('estado'),
        ]);

        if (!empty($request->get('password')))
        {
            $user->update(['password' => Hash::make($request->get('password'))]);
        }

        //Crear el registro del auxiliar
        $user->auxiliar->update([
            'fecha_nacimiento'  => $request->get('fecha_nacimiento'),
            'direccion'         => $request->get('direccion'),
            'telefono'          => $request->get('telefono'),
            'celular'           => $request->get('celular'),
            'pais_id'           => $request->get('pais_id'),
            'departamento_id'   => $request->get('departamento_id'),
            'provincia_id'      => $request->get('provincia_id'),
            'ciudad_id'         => $request->get('ciudad_id')
        ]);

        //crear acceso
        $user->accesos()->sync($request->get('accesos'));

        return redirect()
            ->route('profesional.configuracion.usuarios.index')
            ->with('success', "Usuario {$user->nombre_completo} ha sido editado");
    }

    private function validator(Request $request, string $method = null, $id = null)
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
            'email'             => ['required', 'email', 'unique:users,email' . ($method != 'created' ? ",$id":'')],
            'accesos.*'         => [
                'nullable',
                Rule::exists('accesos', 'id')
                    ->where('tipo', 'profesional')
            ],
            'estado'            => [
                'nullable',
                'boolean',
                function ($attribute, $value, $fail) use ($method, $id){
                    if ($value == 1)
                    {

                        $flag = User::query()
                            ->where('profesional_id', Auth::user()->profesional->idPerfilProfesional)
                            ->where('estado', 1);

                        if ($method == 'updated' and $id != null)
                            $flag->where('users.id', '!=', $id);


                        if (self::LIMITE_ESTADO < $flag->count() + 1 )
                            $fail("El $attribute no puede tener mas de " . self::LIMITE_ESTADO . " usuarios activos");
                    }
                }
            ],
            'password'          => [
                ($method == 'created') ? 'required':'nullable',
                'confirmed',
                Password::min(8)
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
