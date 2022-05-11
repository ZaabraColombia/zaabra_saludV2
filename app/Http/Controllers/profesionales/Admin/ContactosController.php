<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contacto;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ContactosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        Gate::authorize('accesos-profesional', 'ver-contactos');
        $contactos = Contacto::query()
            ->where('user_id', '=', Auth::user()->profesional->idUser)
            ->get();

        return view('profesionales.admin.contactos.contactos', compact('contactos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('accesos-profesional', 'ver-contactos');

        //dd();
        $validator = $this->validador($request);

        if ($validator->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //$request->merge(['user_id' => Auth::user()->profesional->idUser]);

        $respueta = $request->all();
        $respueta['user_id'] = Auth::user()->profesional->idUser;

        if ($request->file('foto'))
        {
            $respueta['foto'] = $request->file('foto')
                ->move("img/user/{$respueta['user_id']}/contactos",
                    Str::random(10) . ".{$request->file('foto')->extension()}"
                );
        }

        $contacto = Contacto::query()->create($respueta);
        $array = $contacto->toArray();
        $array['foto'] = asset($array['foto'] ?? 'img/menu/avatar.png');

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "Contacto {$contacto->nombre} creado"
            ],
            'item' => $array,
            'type' => 'created'
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        Gate::authorize('accesos-profesional', 'ver-contactos');

        $contacto = Contacto::query()
            ->where('id', '=', $id)
            ->where('user_id', '=', Auth::user()->profesional->idUser)
            ->first();
        Gate::authorize('update-contactos-profesional', $contacto);

        if (empty($contacto)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'El contacto no esta disponible'
            ]
        ], Response::HTTP_NOT_FOUND);

        $array = $contacto->toArray();
        $array['foto'] = asset($array['foto'] ?? 'img/menu/avatar.png');

        return response([
            'item' => $array,
        ], Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('accesos-profesional', 'editar-contacto');
        //dd($request->file('foto'));
        $validator = $this->validador($request);

        if ($validator->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        $contacto = Contacto::query()
            ->where('id', '=', $id)
            ->where('user_id', '=', Auth::user()->profesional->idUser)
            ->first();
        Gate::authorize('update-contactos-profesional', $contacto);

        if (empty($contacto)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'El contacto no esta disponible'
            ]
        ], Response::HTTP_NOT_FOUND);

        $respueta = $request->all();
        $user_id = Auth::user()->profesional->idUser;

        if ($request->file('foto'))
        {
            if (!empty($contacto->foto)) unlink($contacto->foto);
            $respueta['foto'] = $request->file('foto')
                ->move("img/user/{$user_id}/contactos",
                    Str::random(10) . ".{$request->file('foto')->extension()}"
                );
        }

        $contacto->update($respueta);

        $array = $contacto->toArray();
        $array['foto'] = asset($array['foto'] ?? 'img/menu/avatar.png');

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "Contacto {$contacto->nombre} editado"
            ],
            'item' => $array,
            'type' => 'updated'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('accesos-profesional', 'eliminar-contactos');
        $contacto = Contacto::query()
            ->where('id', '=', $id)
            ->where('user_id', '=', Auth::user()->profesional->idUser)
            ->first();
        Gate::authorize('update-contactos-profesional', $contacto);

        if (empty($contacto)) return response([
            'message' => [
                'title' => 'Error',
                'text'  => 'El contacto no esta disponible'
            ]
        ], Response::HTTP_NOT_FOUND);

        $contacto->delete();

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "Contacto {$contacto->nombre} eliminado"
            ],

            'type' => 'deleted'
        ], Response::HTTP_OK);
    }


    private function validador(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), [
            'nombre'    => ['required', 'max:100'],
            'direccion' => ['nullable', 'max:100'],
            'ciudad'    => ['nullable', 'max:100'],
            'telefono'  => ['required', 'max:12'],
            'telefono_adicional'    => ['nullable', 'max:12'],
            'numero_identificacion' => ['nullable', 'max:50'],
            'dependencia'   => ['nullable', 'max:100'],
            'tipo'          => ['nullable', Rule::in(['proveedor', 'paciente', 'otro'])],
            'tipo_cuenta'   => ['nullable', Rule::in(['ahorro', 'corriente'])],
            'numero_cuenta' => ['nullable', 'max:50'],
            'foto'          => ['nullable', 'image'],
            //'observacion'   => ['']
        ], [], [
            'nombre'    => 'Nombre',
            'direccion' => 'Dirección',
            'ciudad'    => 'Ciudad',
            'telefono'  => 'Teléfono',
            'telefono_adicional'    => 'Teléfono opcional',
            'numero_identificacion' => 'Número de identificación',
            'dependencia'   => 'Dependencia',
            'tipo'          => 'Tipo de contacto',
            'tipo_cuenta'   => 'Tipo de cuenta bancaria',
            'numero_cuenta' => 'Número de cuenta bancaria',
            'foto'          => 'Foto de perfil',
        ]);
    }
}
