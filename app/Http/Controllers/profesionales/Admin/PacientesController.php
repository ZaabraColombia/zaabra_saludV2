<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PacientesController extends Controller
{
    public function index()
    {
        Gate::authorize('accesos-profesional', 'ver-pacientes');

        $pacientes = Paciente::query()
            ->whereHas('citas', function ($query) {
                $query->where('profesional_id', '=', Auth::user()->profecional->idPerfilProfesional);
            })
            ->with('user')
            ->get();

        return view('profesionales.admin.pacientes', compact('pacientes'));
    }
}
