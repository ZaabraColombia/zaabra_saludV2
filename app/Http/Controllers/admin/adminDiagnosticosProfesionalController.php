<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class adminDiagnosticosProfesionalController extends Controller
{
    public function index(){
        return view('panelAdministrativoProf.diagnosticosProfesional');
    }
}
