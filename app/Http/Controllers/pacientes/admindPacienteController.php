<?php

namespace App\Http\Controllers\pacientes;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class admindPacienteController extends Controller{

    public function index(){
        return view('panelAdministrativo.panelAdministrativo');
    }

    public function cita(){
        return view('panelAdministrativo.panelAdministrativo');
    }
}


