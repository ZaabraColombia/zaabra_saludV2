<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     
    public function index()
    {
        //esta varible se llena con los banner principales del home encontrados en el metodo que realiza 
        // la consulta en la base de datos
        $objbannersprincipalHome = $this->cargarBannerPrincipalHome();
        
        dd($objbannersprincipalHome);
        
        return view('app', compact(
            'objbannersprincipalHome'  
        ));


    }

    public function cargarBannerPrincipalHome(){
        $consultaBanner = DB::table('ventabanners')
        ->select()
        ->where('aprobado', '<>', 0)
        ->get();


   
        return $consultaBanner ;

    }
}
