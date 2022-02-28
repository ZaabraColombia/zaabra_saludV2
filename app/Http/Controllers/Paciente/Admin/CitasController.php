<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use function view;

class CitasController extends Controller
{
    public function index(){
        return view('panelAdministrativoPac.citas');
    }
}


