<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class adminController extends Controller{
    public function index(){
        return view('panelAdministrativo.panelPrincipal');
    }

    public function cita(){
        return view('panelAdministrativo.panelAdministrativo');
    }

    public function oscar2(){
        return view('panelAdministrativo.panelServicios');
    }
}

