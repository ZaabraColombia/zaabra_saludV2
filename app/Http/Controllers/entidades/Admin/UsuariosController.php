<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $tipo_documento = TipoDocumento::all();

        return view('instituciones.admin.configuracion.usuarios.crear', compact('tipo_documento'));
    }
}
