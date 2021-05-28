<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\areas;

class areaController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    /*lista todas las areas*/
    public function listaArea()
    {
        $areas = areas::all();
        return $areas;
    }

}


