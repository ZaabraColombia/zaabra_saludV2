<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SEO;

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

        SEO::setTitle('Zaabra Salud | Agende su cita hoy!');
        SEO::setDescription('Agende su cita con especialistas y entidades médicas fácil y rápido.¡Encuentre opiniones de otros pacientes y más!');
        SEO::setCanonical('https://zaabrasalud.co/');


        //esta varible se llena con los datos recolectados en cada una de las consultas y entregan los datos en la vista del home
        $objbannersprincipalHome = $this->cargarBannerPrincipalHome();
        $objbannersparallaxHome = $this->cargarParallax();
        $objprofesionaleshome = $this->cargarProfesionaleshome();
        $objbanneruniversidad = $this->cargarbannerUniversidad();
        $objcarruselTriple = $this->cargarBannertriple();

        return view('home', compact(
            'objbannersprincipalHome',
            'objbannersparallaxHome',
            'objprofesionaleshome',
            'objbanneruniversidad',
            'objcarruselTriple'
        ));


    }
// consulta para cargar banner principal del home
    public function cargarBannerPrincipalHome(){
        $consultaBanner = DB::table('ventabanners')
        ->select()
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 1)
        ->get();
        return $consultaBanner ;
    }

// consulta para cargar el parallax del home
    public function cargarParallax(){
        $consultaparallax = DB::table('ventabanners')
        ->select()
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 2)
        ->get();
        return $consultaparallax ;
    }

// consulta para cargar profesionales que realizen el pago por aparecer en el home
    public function cargarProfesionaleshome(){
        return DB::select('SELECT pf.idPerfilProfesional, CONCAT("Dr.(a) ",  us.primernombre) AS primernombre, us.primerapellido, pf.descripcionPerfil, sp.nombreEspecialidad, un.nombreuniversidad,pf.fotoperfil, pf.slug
        FROM pagos  pg
        INNER JOIN users us ON pg.idUsuario=us.id
        INNER JOIN  perfilesprofesionales pf ON us.id=pf.idUser
        INNER JOIN  areas ar ON pf.idarea=ar.idArea
        INNER JOIN  profesiones pr ON pf.idprofesion=pr.idProfesion
        INNER JOIN  especialidades sp ON pf.idespecialidad=sp.idEspecialidad
        INNER JOIN universidades un ON pf.id_universidad=un.id_universidad
        where pg.aprobado=1  and pf.aprobado <> 0 and pg.idtipopago =3');
    }
    // consulta para cargar el banner triple del home
    public function cargarBannertriple(){
        $consultaTriple = DB::table('ventabanners')
        ->select()
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 3)
        ->get();
        return $consultaTriple;
    }
    // consulta para buscar los logos del carrusel de universidades
    public function cargarbannerUniversidad(){
        $consuluniversidad = DB::table('ventabanners')
        ->select()
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 4)
        ->get();
        return $consuluniversidad ;
    }

}




