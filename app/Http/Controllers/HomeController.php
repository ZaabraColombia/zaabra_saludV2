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
       // $this->middleware('auth');
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
        $objbannersparallaxHome = $this->cargarParallax();
        $objprofesionaleshome = $this->cargarProfesionaleshome();
        $objcarruselhome = $this->cargarcarruselhome();
     
        return view('home', compact(
            'objbannersprincipalHome',
            'objbannersparallaxHome',
            'objprofesionaleshome',
            'objcarruselhome'
        ));


    }

    public function cargarBannerPrincipalHome(){
        $consultaBanner = DB::table('ventabanners')
        ->select()
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 1)
        ->get();
        return $consultaBanner ;
    }


    public function cargarParallax(){
        $consultaparallax = DB::table('ventabanners')
        ->select()
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 2)
        ->get();
        return $consultaparallax ;
    }


    public function cargarProfesionaleshome(){
        return DB::select('SELECT us.primernombre, us.primerapellido, pf.descripcionPerfil, sp.nombreEspecialidad, un.nombreuniversidad,pf.fotoperfil
        FROM pagos  pg
        INNER JOIN users us ON pg.idUsuario=us.id
        INNER JOIN  perfilesprofesionales pf ON us.id=pf.idUser
        INNER JOIN  areas ar ON pf.idarea=ar.idArea
        INNER JOIN  profesiones pr ON pf.idprofesion=pr.idProfesion
        INNER JOIN  especialidades sp ON pf.idespecialidad=sp.idEspecialidad
        INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
        INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
        where pg.aprobado=1  and pf.aprobado <> 0');
    }

    public function cargarcarruselhome(){
        $consulcarrusel = DB::table('ventabanners')
        ->select()
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 4)
        ->get();
        return $consulcarrusel ;
    }
}




