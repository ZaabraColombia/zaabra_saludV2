<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class especialidadesController extends Controller
{
    public function index()
    {
        //esta varible se llena con los datos recolectados en cada una de las consultas y entregan los datos
        //en la vista galeria  
        $objbannersprincipalEspecialidades = $this->cargarBannerPrincipalEspecialidades();
        $objEspecialidades = $this->cargarEspecialidades();
        $objbannerssecundarioEspecialidades = $this->cargarBannerSecundarioEspecialidades();
        $objcarruselespecialidades = $this->cargarCarruselEspecialidades();

        return view('galeriaProfesiones', compact(
            'objbannersprincipalEspecialidades',
            'objEspecialidades',
            'objbannerssecundarioEspecialidades',
            'objcarruselespecialidades'
        ));
    }


    // consulta para cargar banner principal 
    public function cargarBannerPrincipalEspecialidades(){
        $consultaBannerEspecialidades = DB::table('ventabanners')
        ->select('rutaImagenVenta')
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 7)
        ->get();
        return $consultaBannerEspecialidades;
    }

     // consulta para cargar todas las profesiones disponibles y que esten activas
    public function cargarEspecialidades(){
        $consultaEspecialidades = DB::table('especialidades')
        ->select('nombreProfesion')
        ->select('urlimagen')
        ->where('estado', '<>', 0)
        ->get();
        return $consultaEspecialidades;
        }

          // consulta para cargar banner principal 
    public function cargarBannerSecundarioEspecialidades(){
        $consultaBannerSecundarioEspecialidades = DB::table('ventabanners')
        ->select('rutaImagenVenta')
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 8)
        ->get();
        return $consultaBannerSecundarioEspecialidades;
    }

        // consulta para cargar carrusel profesiones 
        public function cargarCarruselEspecialidades(){
            $consultaCarruselEspecialidades = DB::table('ventabanners')
            ->select('rutaImagenVenta')
            ->where('aprobado', '<>', 0)
            ->where('idtipobanner', '=', 9)
            ->get();
            return $consultaCarruselEspecialidades;
        }
}
