<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class adminCalendarioProfesionalController extends Controller
{
    public function index(){
        return view('panelAdministrativoProf.calendarioProfesional');
    }
}