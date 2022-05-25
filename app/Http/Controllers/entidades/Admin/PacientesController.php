<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PacientesController extends Controller
{
    public function index()
    {
        Gate::authorize('accesos-institucion','ver-pacientes');

        $pacientes = Paciente::query()
            ->whereHas('citas.profesional_ins', function ($query) {
                $query->where('id_institucion', '=', Auth::user()->institucion->id);
            })
            ->with('user')
            ->orderBy(User::query()->select('nombre_completo')->whereColumn('users.id', 'id_usuario'))
            ->search(\request('search'))
            ->simplePaginate(12);

        return view('instituciones.admin.pacientes', compact('pacientes'));
    }
}
