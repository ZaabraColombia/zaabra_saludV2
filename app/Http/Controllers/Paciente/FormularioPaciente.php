<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormularioPaciente extends Controller
{

    public function index()
    {

        $user = auth()->user();
        dd($user);

        //Vista
        return view('paciente.formulario_paciente', compact(
            'user'
        ));
    }


    //Guardar la información basica del paciente
    public function basico(Request $request)
    {

    }
}
