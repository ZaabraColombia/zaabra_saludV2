<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function cie10()
    {
        return view('profesionales.admin.historia-clinica.cie10');
    }
    public function cups()
    {
        return view('profesionales.admin.historia-clinica.cups');
    }

    public function cums()
    {
        return view('profesionales.admin.historia-clinica.cums');
    }
}
