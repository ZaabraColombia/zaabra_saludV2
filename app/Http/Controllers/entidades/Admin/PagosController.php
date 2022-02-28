<?php

namespace App\Http\Controllers\entidades\Admin;
use App\Http\Controllers\controller;

use Illuminate\Http\Request;

class PagosController extends Controller
{
    public function index() {
        return view('panelAdministrativoProf.pagosProfesional');
    }
}
