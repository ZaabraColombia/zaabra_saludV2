<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use function view;

class CitasController extends Controller
{
    public function index(Request $request){
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

        $confirmation = (isset($request->confirmation)) ? [
            'message' => 'La cita se  pago correctamente'
        ]:null;
        //dd($citas);

        return view('paciente.admin.citas', compact('citas', 'confirmation'));
    }
}


