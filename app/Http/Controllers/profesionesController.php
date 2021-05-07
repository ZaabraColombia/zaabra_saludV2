<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class profesionesController extends Controller
{

    
    
    public function index()
    {
        //esta varible se llena con los datos recolectados en cada una de las consultas y entregan los datos
        //en la vista galeria  
        $objbannersprincipalProfesiones = $this->cargarBannerPrincipalProfesiones();
        $objprofesiones = $this->cargarProfesiones();
        $objcarruselprofesiones = $this->cargarCarruselProfesiones();

        return view('galeriaProfesiones', compact(
            'objbannersprincipalProfesiones',
            'objprofesiones',
            'objcarruselprofesiones'
        ));
    }


    // consulta para cargar banner principal 
    public function cargarBannerPrincipalProfesiones(){
        $consultaBannerProfesiones = DB::table('ventabanners')
        ->select('rutaImagenVenta')
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 5)
        ->get();
        return $consultaBannerProfesiones;
    }

     // consulta para cargar todas las profesiones disponibles y que esten activas
    public function cargarProfesiones(){
        $consultaProfesiones = DB::table('profesiones')
        ->select('nombreProfesion')
        ->where('estado', '<>', 0)
        ->get();
        return $consultaProfesiones;
        }

        // consulta para cargar carrusel profesiones 
        public function cargarCarruselProfesiones(){
            $consultaCarruselProfesiones = DB::table('ventabanners')
            ->select('rutaImagenVenta')
            ->where('aprobado', '<>', 0)
            ->where('idtipobanner', '=', 6)
            ->get();
            return $consultaCarruselProfesiones;
        }

}
