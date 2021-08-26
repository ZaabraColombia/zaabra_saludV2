<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\perfilesprofesionales;
use Illuminate\Http\Request;

class adminCalendarioController extends Controller{
    public function index(Request $request){

        if (isset($request->id))
        {
            $profesional = perfilesprofesionales::where('idPerfilProfesional','=',$request->id)->first();

            if (!empty($profesional)) {
                return view('panelAdministrativo.calendario', compact('profesional'));
            }else{
                return view('panelAdministrativo.calendario', ['error' => 'El perfil no existe']);
            }
        }

        return view('panelAdministrativo.calendario');
    }
}
