<?php

namespace App\Http\Controllers\entidades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class entidadesController extends Controller
{
    
    public function index()
    {
        //esta varible se llena con los datos recolectados en cada una de las consultas y entregan los datos
        //en la vista galeria  
        $objbannersprincipalInstituciones = $this->cargarBannerPrincipalInstituciones();
        $objinstituciones = $this->cargarInstituciones();
        $objcarruselInstituciones = $this->cargarCarruselInstituciones();


        return view('instituciones.Entidades', compact(
            'objbannersprincipalInstituciones',
            'objinstituciones',
            'objcarruselInstituciones'
        ));
    }


    // consulta para cargar banner principal 
    public function cargarBannerPrincipalInstituciones(){
        $consultaBannerPrincipalInstituciones = DB::table('ventabanners')
        ->select('rutaImagenVenta')
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 11)
        ->get();
        return $consultaBannerPrincipalInstituciones;
    }

    // consulta para cargar todas las profesiones disponibles, activas y en el orden secuencial según diseño
    public function cargarInstituciones(){
        return DB::select('SELECT tp.nombretipo, tp.descripcioninstitucion, tp.urlimagen,tp.id
        FROM tipoinstitucion  tp
        WHERE tp.estado<>0');
    }

    // consulta para cargar carrusel profesiones 
    public function cargarCarruselInstituciones(){
        $consultaCarruselTipoInstituciones = DB::table('ventabanners')
        ->select('rutaImagenVenta')
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 12)
        ->get();
        return $consultaCarruselTipoInstituciones;
    }


}