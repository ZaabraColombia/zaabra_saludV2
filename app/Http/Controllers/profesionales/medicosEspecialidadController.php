<?php

namespace App\Http\Controllers\profesionales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SEO;


class medicosEspecialidadController extends Controller{

    public function index($nombreEspecialidad){

        /*Realiza una consulta sql con el valor entrante de la seleccion de la
        profesion y retorna el id el cual se pasa a los demas funciones*/
        $objIdEspeciialidad = $this->especialidadId($nombreEspecialidad);
        $idEspecialidad = $objIdEspeciialidad->idEspecialidad;

        SEO::setTitle('Especialidad | '.$objIdEspeciialidad->nombreEspecialidad);
        SEO::setDescription('Encuentra un especialista médico en tu ciudad! Consulta opiniones de pacientes, pregunta a los expertos en salud y agenda ahora cita por Internet.');
        SEO::setCanonical('https://zaabrasalud.co/ramas-de-la-salud');


        $objcarruselprofesionalespremiun= $this->cargarCarruselProfesionalesPremiun($idEspecialidad);
        $objmedicospagonormal  = $this->cargarMedicosPagoNormal($idEspecialidad);
        $objmedicossinpago  = $this->cargarMedicosSinPago($idEspecialidad);
        $objcarruselPublicidadprofesionales = $this->cargarCarruselProfesionales();

        return view('profesionales.Especialistas', compact(
            'objcarruselprofesionalespremiun',
            'objmedicospagonormal',
            'objmedicossinpago',
            'objcarruselPublicidadprofesionales',
        ));
    }

    public function especialidadId($nombreEspecialidad){
        $idEspecialidad = DB::table('especialidades')
            ->select('especialidades.idEspecialidad', 'especialidades.nombreEspecialidad')
            ->where('especialidades.slug', 'like','%'.$nombreEspecialidad.'%')
            ->distinct()
            ->first();
        return $idEspecialidad;
    }

    // consulta para cargar todas los profesionales segun su especialidad y que pagan premiun
    public function cargarCarruselProfesionalesPremiun($idEspecialidad){
        return DB::select("SELECT pf.idPerfilProfesional, CONCAT('Dr.(a) ',  us.primernombre) AS primernombre, us.primerapellido, CONCAT('Especialista en ',  ep.nombreEspecialidad) AS nombreEspecialidad, mn.nombre, pf.descripcionPerfil, un.nombreuniversidad, pf.fotoperfil, pf.slug
    FROM  users us
    INNER JOIN pagos pg ON us.id=pg.idUsuario
    INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
    INNER JOIN municipios mn ON pf.id_municipio=mn.id_municipio
    INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
    INNER JOIN universidades un ON pf.id_universidad=un.id_universidad
    WHERE pg.idtipopago=12 AND pf.idespecialidad=$idEspecialidad AND pf.aprobado<>0");
    }

    // consulta para cargar todas los profesionales segun su especialidad y el pago normal
    public function cargarMedicosPagoNormal($idEspecialidad){
        return DB::select("SELECT pf.idPerfilProfesional, CONCAT('Dr.(a) ',  us.primernombre) AS primernombre, us.primerapellido, ep.nombreEspecialidad, CONCAT('Especialista en ',  ep.nombreEspecialidad) AS concatNombreEspecialidad, mn.nombre ciudad, pf.descripcionPerfil, un.nombreuniversidad, pf.fotoperfil, pf.slug
    FROM  users us
    INNER JOIN pagos pg ON us.id=pg.idUsuario
    INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
    INNER JOIN municipios mn ON pf.id_municipio=mn.id_municipio
    INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
    INNER JOIN universidades un ON pf.id_universidad=un.id_universidad
    WHERE pg.idtipopago=13 AND pf.idespecialidad=$idEspecialidad AND pf.aprobado<>0");
    }

    // consulta para cargar todas los profesionales segun su especialidad y el pago normal
    public function cargarMedicosSinPago($idEspecialidad){
        return DB::select("SELECT CONCAT('Dr.(a)  ',  us.primernombre) AS primernombre, us.primerapellido, CONCAT('Especialista en ',  ep.nombreEspecialidad) AS nombreEspecialidad, pf.slug
        FROM  users us
    INNER JOIN pagos pg ON us.id=pg.idUsuario
    INNER JOIN perfilesprofesionales pf ON us.id=pf.idUser
    INNER JOIN municipios mn ON pf.id_municipio=mn.id_municipio
    INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
    INNER JOIN universidades un ON pf.id_universidad=un.id_universidad
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


