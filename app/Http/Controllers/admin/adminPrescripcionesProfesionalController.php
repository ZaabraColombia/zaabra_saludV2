<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class adminPrescripcionesProfesionalController extends Controller
{
    public function index(){
        return view('panelAdministrativoProf.prescripcionesProfesional');
    }
}
