<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class especialidadesController extends Controller
{
    public function index($idProfesion)
    {

    
        //esta varible se llena con los datos recolectados en cada una de las consultas y entregan los datos
        //en la vista galeria  
        $objbannersprincipalEspecialidades = $this->cargarBannerPrincipalEspecialidades();
        $objEspecialidades = $this->cargarEspecialidades($idProfesion);
        $objbannerssecundarioEspecialidades = $this->cargarBannerSecundarioEspecialidades();
        $objcarruselespecialidades = $this->cargarCarruselEspecialidades();

  
        return view('galeriaespecialidades', compact(
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

}
    // consulta para cargar todas las Especialidades disponibles y que esten activas
    public function cargarEspecialidades($idProfesion){
        return DB::select("SELECT es.urlimagen, es.nombreEspecialidad
        FROM profesiones pr
        INNER JOIN  especialidades es ON pr.idProfesion = es.idProfesion 
        WHERE  es.estado <>0  AND es.idProfesion=$idProfesion ORDER BY es.orden ASC ");
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
