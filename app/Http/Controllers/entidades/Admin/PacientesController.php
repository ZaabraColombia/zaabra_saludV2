<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacientesController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::query()
            ->whereHas('citas.profesional_ins', function ($query) {
                $query->where('id_institucion', '=', Auth::user()->institucion->id);
            })
            ->with('user')
            ->get();

        return view('instituciones.admin.pacientes', compact('pacientes'));
    }
}
