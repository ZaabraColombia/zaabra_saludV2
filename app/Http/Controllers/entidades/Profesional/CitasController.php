<?php

namespace App\Http\Controllers\entidades\Profesional;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitasController extends Controller
{
    public function index()
    {
        $citas = Cita::query()
            ->where('profesional_ins_id', Auth::user()->id_profesional_inst)
            ->whereNotIn('estado', ['reservado'])
            ->with([
                'paciente',
                'paciente.user',
                'paciente.user.tipo_documento',
                'especialidad'
            ])
            ->get();
        return view('instituciones.profesionales.citas.index', compact('citas'));
    }
}
