<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function cie10()
    {
        return view('instituciones.admin.catalogos.cie10');
    }
    public function cups()
    {
        return view('instituciones.admin.catalogos.cups');
    }

    public function cums()
    {
        return view('instituciones.admin.catalogos.cums');
    }
}
