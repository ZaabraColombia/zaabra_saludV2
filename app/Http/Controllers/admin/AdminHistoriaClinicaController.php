<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminHistoriaClinicaController extends Controller
{
    public function index(){
        return view('panelAdministrativo.pagos');
    }

    public function cie10()
    {
        return view('panelAdministrativoProf.cie10');
    }
    public function cups()
    {
        return view('panelAdministrativoProf.cups');
    }

    public function cums()
    {
        return view('panelAdministrativoProf.cums');
    }
}
