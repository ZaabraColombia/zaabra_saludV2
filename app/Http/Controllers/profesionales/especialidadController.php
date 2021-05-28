<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\especialidades;

class especialidadController extends Controller
{
        /*lista todas las especialidades*/
        public function listaEspecialidades()
        {
            $especialidades = especialidades::all();
            return $especialidades;
        }

        public function mostrarESpecialidad(Request $request,$idProfesion)
        {
            if($request->ajax()){
                $especialidades = especialidades::where('idProfesion', '=',$idProfesion)->get();
                return response()->json($especialidades); 
            }
               
        }
}
