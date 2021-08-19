<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\controller;

use Illuminate\Http\Request;

class adminPagosProfesionalController extends Controller
{
    public function index() {
        return view('panelAdministrativoProf.pagosProfesional');
    }
}
