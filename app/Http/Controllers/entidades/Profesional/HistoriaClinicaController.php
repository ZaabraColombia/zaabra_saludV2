<?php

namespace App\Http\Controllers\entidades\Profesional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HistoriaClinicaController extends Controller
{
    public function cie10()
    {
        return view('instituciones.profesionales.catalogos.cie10');
    }
    public function cups()
    {
        return view('instituciones.profesionales.catalogos.cups');
    }

    public function cums()
    {
        return view('instituciones.profesionales.catalogos.cums');
    }
}
