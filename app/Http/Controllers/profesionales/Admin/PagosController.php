<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\PagoCita;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PagosController extends Controller
{
    public function index()
    {
        Gate::authorize('accesos-profesional', 'ver-pagos');

        $pagos = PagoCita::query()
            ->with([
                'cita',
                'cita.tipo_consulta',
                'cita.paciente',
                'cita.paciente.user'
            ])
            ->whereHas('cita', function ($query) {
                $query->where('profesional_id', '=', Auth::user()->profesional->idPerfilProfesional);
            })
            ->get();

        return view('profesionales.admin.pagos', compact('pagos'));
    }
}
