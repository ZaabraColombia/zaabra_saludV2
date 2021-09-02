<?php

namespace App\Http\Controllers\entidades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tipoinstituciones;

class institucionesController extends Controller
{
    public function index($id)
    {
        $objcarruselinstitucionespremiun= $this->cargarCarruselinstitucionesPremiun($id);
        $objinstitucionespagonormal  = $this->cargarinstitucionesPagoNormal($id);
        $objinstitucionessinpago  = $this->cargarinstitucionesSinPago($id);
        $objtipoinstitucion  = tipoinstituciones::find($id);
        $objcarruselPublicidadinstituciones = $this->cargarCarruselInstituciones();

        return view('instituciones.Instituciones', compact(
            'objcarruselinstitucionespremiun',
            'objinstitucionespagonormal',
            'objinstitucionessinpago',
            'objcarruselPublicidadinstituciones',
            'objtipoinstitucion'
        ));

    }

         // consulta para cargar todas los profesionales segun su especialidad y que pagan premiun
         public function cargarCarruselinstitucionesPremiun($id){
            return DB::select("SELECT ins.id, us.nombreinstitucion, ins.url, mn.nombre, ins.imagen, ins.quienessomos, tns.nombretipo
            FROM  users us
            INNER JOIN instituciones ins ON us.id=ins.idUser
            INNER JOIN tipoinstituciones tns ON ins.idtipoInstitucion=tns.id
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            INNER JOIN municipios mn ON ins.id_municipio=mn.id_municipio
            WHERE pg.idtipopago=15 and ins.idtipoInstitucion = $id ");
        }

            // consulta para cargar todas los profesionales segun su especialidad y el pago normal
            public function cargarinstitucionesPagoNormal($id){
            return DB::select("SELECT ins.id, us.nombreinstitucion, ins.url, mn.nombre, ins.imagen, ins.quienessomos, tns.nombretipo
            FROM  users us
            INNER JOIN instituciones ins ON us.id=ins.idUser
            INNER JOIN tipoinstituciones tns ON ins.idtipoInstitucion=tns.id
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            INNER JOIN municipios mn ON ins.id_municipio=mn.id_municipio
            WHERE pg.idtipopago=16 and ins.idtipoInstitucion = $id");
        }

            // consulta para cargar todas los profesionales segun su especialidad y el pago normal
            public function cargarinstitucionesSinPago($id){
            return DB::select("SELECT  us.nombreinstitucion, tns.nombretipo
            FROM  users us
            INNER JOIN instituciones ins ON us.id=ins.idUser
            INNER JOIN tipoinstituciones tns ON ins.idtipoInstitucion=tns.id
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            WHERE pg.idtipopago=17 and ins.idtipoInstitucion = $id");
        }


            // consulta para cargar carrusel profesionales 
            public function cargarCarruselInstituciones(){
            $consultaCarruselProfesiones = DB::table('ventabanners')
            ->select('rutaImagenVenta')
            ->where('aprobado', '<>', 0)
            ->where('idtipobanner', '=', 12)
            ->get();
            return $consultaCarruselProfesiones;
        }
}
