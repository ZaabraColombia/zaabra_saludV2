<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CitasController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        Gate::authorize('accesos-profesional', 'ver-citas');
        $citas = Cita::query()
            ->where('profesional_id', '=', Auth::user()->profecional->idPerfilProfesional)
            ->orderByDesc('fecha_inicio')
            ->with( ['paciente', 'paciente.user', 'tipo_consulta'])
            ->get();

        //dd($citas);

        return view('profesionales.admin.citas', compact('citas'));
    }
}
