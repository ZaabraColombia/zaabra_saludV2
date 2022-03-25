<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use function view;

class CitasController extends Controller
{
    public function index(){
        $citas = Cita::query()
            ->where('paciente_id', '=', Auth::user()->paciente->id)
            ->with([
                'pago',
                'tipo_consulta',
                'profesional',
                'profesional.user',
                'profesional_ins',
                'profesional_ins.institucion',
                'profesional_ins.institucion.user',
            ])
            ->get();

        //dd($citas);

        return view('paciente.admin.citas', compact('citas'));
    }
}


