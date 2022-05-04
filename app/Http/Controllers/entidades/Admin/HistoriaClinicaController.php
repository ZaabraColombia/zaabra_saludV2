<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HistoriaClinicaController extends Controller
{
    public function cie10()
    {
        Gate::authorize('accesos-institucion','ver-catalogos');
        return view('instituciones.admin.catalogos.cie10');
    }
    public function cups()
    {
        Gate::authorize('accesos-institucion','ver-catalogos');
        return view('instituciones.admin.catalogos.cups');
    }

    public function cums()
    {
        Gate::authorize('accesos-institucion','ver-catalogos');
        return view('instituciones.admin.catalogos.cums');
    }
}
