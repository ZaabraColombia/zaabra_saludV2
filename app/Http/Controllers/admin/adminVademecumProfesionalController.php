<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class adminVademecumProfesionalController extends Controller
{
    public function index(){
        return view('panelAdministrativoProf.vademecumProfesional');
    }
}
