<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use function view;

class InicioController extends Controller{

    public function index(){
        return view('paciente.admin.panel');
    }

}

