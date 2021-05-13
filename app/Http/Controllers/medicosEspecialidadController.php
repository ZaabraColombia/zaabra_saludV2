<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class medicosEspecialidadController extends Controller
{
    

    public function index($idEspecialidad)
    {
        $objcarruselprofesionalespremiun= $this->cargarCarruselProfesionalesPremiun();
        $objmedicospagonormal  = $this->cargarMedicosPagoNormal($idEspecialidad);
        $objmedicossinpago  = $this->cargarMedicosSinPago($idEspecialidad);
        $objcarruselPublicidadprofesionales = $this->cargarCarruselProfesionales();

        dd($objcarruselprofesionalespremiun);
        return view('Profesionales', compact(
            'objcarruselprofesionalespremiun',
            'objmedicospagonormal',
            'objmedicossinpago',
            'objcarruselPublicidadprofesionales',
        ));

    }

         // consulta para cargar todas los profesionales segun su profesion 
         public function cargarCarruselProfesionalesPremiun($idProfesion){
            return DB::select('SELECT es.urlimagen, es.nombreEspecialidad, es.idEspecialidad
            FROM profesiones pr
            INNER JOIN  especialidades es ON pr.idProfesion = es.idProfesion
            WHERE  es.estado <>0  AND es.idProfesion=?', [$idProfesion]);
        }

}
