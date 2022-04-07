<?php

namespace App\Http\Controllers\entidades\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CitasController extends Controller
{
    public function index() {
        
        return view('instituciones.admin.citas');

        Gate::authorize('accesos-institucion','ver-citas');

    }
}
