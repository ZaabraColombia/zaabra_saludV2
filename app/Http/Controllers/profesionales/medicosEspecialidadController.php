<?php

namespace App\Http\Controllers\profesionales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class medicosEspecialidadController extends Controller
{
    

    public function index($idEspecialidad)
    {
        $objcarruselprofesionalespremiun= $this->cargarCarruselProfesionalesPremiun($idEspecialidad);
        $objmedicospagonormal  = $this->cargarMedicosPagoNormal($idEspecialidad);
        $objmedicossinpago  = $this->cargarMedicosSinPago($idEspecialidad);
        $objcarruselPublicidadprofesionales = $this->cargarCarruselProfesionales();

        return view('profesionales.Profesionales', compact(
            'objcarruselprofesionalespremiun',
            'objmedicospagonormal',
            'objmedicossinpago',
            'objcarruselPublicidadprofesionales',
        ));

    }

         // consulta para cargar todas los profesionales segun su especialidad y que pagan premiun
         public function cargarCarruselProfesionalesPremiun($idEspecialidad){
            return DB::select("SELECT pf.idPerfilProfesional, us.primernombre, us.primerapellido, ep.nombreEspecialidad, mn.nombre, pf.descripcionPerfil, un.nombreuniversidad, pf.fotoperfil
            FROM  users us
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
            INNER JOIN municipios mn ON pf.id_municipio=mn.id_municipio
            INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
            JOIN (SELECT id_universidad, idPerfilProfesional
            FROM perfilesprofesionalesuniversidades GROUP BY idPerfilProfesional) AS pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
            INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
            WHERE pg.idtipopago=12 AND pf.idespecialidad=$idEspecialidad AND pf.aprobado<>0");
             }

            // consulta para cargar todas los profesionales segun su especialidad y el pago normal
            public function cargarMedicosPagoNormal($idEspecialidad){
            return DB::select("SELECT pf.idPerfilProfesional, us.primernombre, us.primerapellido, ep.nombreEspecialidad, mn.nombre ciudad, pf.descripcionPerfil, un.nombreuniversidad, pf.fotoperfil
            FROM  users us
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
            INNER JOIN municipios mn ON pf.id_municipio=mn.id_municipio
            INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
            JOIN (SELECT id_universidad, idPerfilProfesional
            FROM perfilesprofesionalesuniversidades GROUP BY idPerfilProfesional) AS pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
            INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
            WHERE pg.idtipopago=13 AND pf.idespecialidad=$idEspecialidad AND pf.aprobado<>0");
             }

            // consulta para cargar todas los profesionales segun su especialidad y el pago normal
            public function cargarMedicosSinPago($idEspecialidad){
            return DB::select("SELECT us.primernombre, us.primerapellido, ep.nombreEspecialidad
             FROM  users us
            INNER JOIN pagos pg ON us.id=pg.idUsuario
            INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
            INNER JOIN municipios mn ON pf.id_municipio=mn.id_municipio
            INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
            JOIN (SELECT id_universidad, idPerfilProfesional
            FROM perfilesprofesionalesuniversidades GROUP BY idPerfilProfesional) AS pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
            INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
            WHERE pg.idtipopago=14 AND pf.idespecialidad=$idEspecialidad AND pf.aprobado<>0");
            }


            // consulta para cargar carrusel profesionales 
            public function cargarCarruselProfesionales(){
            $consultaCarruselProfesiones = DB::table('ventabanners')
            ->select('rutaImagenVenta')
            ->where('aprobado', '<>', 0)
            ->where('idtipobanner', '=', 10)
            ->get();
            return $consultaCarruselProfesiones;
            }

}


