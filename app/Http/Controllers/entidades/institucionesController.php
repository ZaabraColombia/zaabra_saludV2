<?php

namespace App\Http\Controllers\entidades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class institucionesController extends Controller
{
    public function index($id)
    {
        $objcarruselinstitucionespremiun= $this->cargarCarruselinstitucionesPremiun($id);
        $objinstitucionespagonormal  = $this->cargarinstitucionesPagoNormal($id);
        $objinstitucionessinpago  = $this->cargarinstitucionesSinPago($id);
        $objcarruselPublicidadinstituciones = $this->cargarCarruselInstituciones();

        return view('instituciones.Instituciones', compact(
            'objcarruselinstitucionespremiun',
            'objinstitucionespagonormal',
            'objinstitucionessinpago',
            'objcarruselPublicidadinstituciones',
        ));

    }

         // consulta para cargar todas los profesionales segun su especialidad y que pagan premiun
         public function cargarCarruselinstitucionesPremiun($id){
            return DB::select("SELECT us.primernombre, us.primerapellido, ep.nombreEspecialidad, mn.nombre, pf.descripcionPerfil, un.nombreuniversidad, pf.fotoperfil
            FROM  users us
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
            INNER JOIN municipio mn ON pf.id_municipio=mn.id_municipio
            INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
            INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
            INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
            WHERE pg.idtipopago=12 AND pf.idespecialidad=$id AND pf.aprobado<>0");
        }

            // consulta para cargar todas los profesionales segun su especialidad y el pago normal
            public function cargarinstitucionesPagoNormal($id){
            return DB::select("SELECT us.primernombre, us.primerapellido, ep.nombreEspecialidad, mn.nombre, pf.descripcionPerfil, un.nombreuniversidad, pf.fotoperfil
            FROM  users us
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
            INNER JOIN municipio mn ON pf.id_municipio=mn.id_municipio
            INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
            INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
            INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
            WHERE pg.idtipopago=13 AND pf.idespecialidad=$id AND pf.aprobado<>0");
        }

            // consulta para cargar todas los profesionales segun su especialidad y el pago normal
            public function cargarinstitucionesSinPago($id){
            return DB::select("SELECT us.primernombre, us.primerapellido, ep.nombreEspecialidad
            FROM  users us
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
            INNER JOIN municipio mn ON pf.id_municipio=mn.id_municipio
            INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
            INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
            INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
            WHERE pg.idtipopago=14 AND pf.idespecialidad=$id AND pf.aprobado<>0");
        }


            // consulta para cargar carrusel profesionales 
            public function cargarCarruselInstituciones(){
            $consultaCarruselProfesiones = DB::table('ventabanners')
            ->select('rutaImagenVenta')
            ->where('aprobado', '<>', 0)
            ->where('idtipobanner', '=', 10)
            ->get();
            return $consultaCarruselProfesiones;
        }
}
