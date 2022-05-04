<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use function view;

class PrescripcionesController extends Controller
{
    public function index(){
        return view('paciente.admin.prescripciones');
    }
}
