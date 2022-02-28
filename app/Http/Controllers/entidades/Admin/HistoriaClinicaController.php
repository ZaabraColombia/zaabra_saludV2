<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
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
