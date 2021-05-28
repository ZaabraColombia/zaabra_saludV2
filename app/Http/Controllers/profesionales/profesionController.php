<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\profesiones;

class profesionController extends Controller
{

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /*lista todas las profesiones*/
    public function listaProfesiones()
    {
        $profesiones = profesiones::all();
        return $profesiones;
    }

    public function mostrarProfesion(Request $request,$idArea)
    {
        if($request->ajax()){
            $profesiones = profesiones::where('idArea', '=',$idArea)->get();
            return response()->json($profesiones); 
        }
           
    }

}
