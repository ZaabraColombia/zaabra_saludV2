<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class adminHistoriaClinicaProfesional extends Controller
{
    public function index(){
        return view('panelAdministrativoProf.historiaClinicaProfesional');
    }

    public function registrar(){
        return view('panelAdministrativoProf.registroPaciente');
    }

    public function registro(){
        return view('panelAdministrativoProf.pacienteRegistrado');
    }

    public function consulta(){
        return view('panelAdministrativoProf.editarConsulta');
    }

    public function patologia(){
        return view('panelAdministrativoProf.editarPatologia');
    }

    public function Expediente(){
        return view('panelAdministrativoProf.editarExpediente');
    }
}