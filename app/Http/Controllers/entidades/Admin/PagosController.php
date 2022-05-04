<?php

namespace App\Http\Controllers\entidades\Admin;
use App\Http\Controllers\controller;

use App\Models\PagoCita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PagosController extends Controller
{
    public function index() {

        Gate::authorize('accesos-institucion','ver-pagos');

        $pagos = PagoCita::query()
            ->with([
                'cita',
                'cita.tipo_consulta',
                'cita.paciente',
                'cita.paciente.user'
            ])
            ->whereHas('cita.profesional_ins', function ($query) {
                $query->where('id_institucion', '=', Auth::user()->institucion->id);
            })
            ->get();

        return view('instituciones.admin.pagos', compact('pagos'));
    }
}
