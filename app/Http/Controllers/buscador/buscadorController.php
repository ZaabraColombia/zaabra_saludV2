<?php

namespace App\Http\Controllers\buscador;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\pais;
use Illuminate\Http\Request;

class buscadorController extends Controller
{
    public function filtroBusquedad(Request $request){
       
        //Recuperamos lo que el usuario escribió en el buscador
        $term = $request->get('term');
    
        $querys = pais::where('nombre','like','%' . $term . '%')->get();
    
        $data=[];

       foreach($querys as $query){
        $data[]=[
            'label'=>$query->nombre
        ];
       }

        return $data;

        }
}

