<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class perfilprofesionalController extends Controller
{
    
    
    public function index($idPerfilProfesional)
    {
        $objprofesionallanding= $this->cargarInfoPrfesionalLanding($idPerfilProfesional);
        $objprofesionallandingconsultas= $this->cargarInfoPrfesionalLandingconsultas($idPerfilProfesional);
        $objprofesionallandingexperto= $this->cargarInfoPrfesionalLandingexperto($idPerfilProfesional);
        $objprofesionallandingestudios= $this->cargarInfoPrfesionalLandingestudios($idPerfilProfesional);
        $objprofesionallandingexperi= $this->cargarInfoPrfesionalLandingexperien($idPerfilProfesional);
        $objprofesionallandingasocia= $this->cargarInfoPrfesionalLandingasocia($idPerfilProfesional);
        $objprofesionallandingidioma= $this->cargarInfoPrfesionalLandingidioma($idPerfilProfesional);

        return view('profesionales.PerfilProfesional', compact(
            'objprofesionallanding',
            'objprofesionallandingconsultas',
            'objprofesionallandingexperto',
            'objprofesionallandingestudios',
            'objprofesionallandingexperi',
            'objprofesionallandingasocia',
            'objprofesionallandingidioma'
        ));

    }

         // consulta para cargar todas los profesionales segun su area profesion y especialidad
         public function cargarInfoPrfesionalLanding($idPerfilProfesional){
            return DB::select("SELECT  pf.fotoperfil, us.primernombre, us.primerapellido, ep.nombreEspecialidad, pf.numeroTarjeta, pf.direccion, un.nombreuniversidad, pf.descripcionPerfil
            FROM perfilesprofesionales pf
            INNER JOIN users us ON pf.idUser=us.id
            INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
            INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
            INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
            WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional LIMIT 1");
        }

        // consulta para cargar todas las tipos de consulta medicas
        public function cargarInfoPrfesionalLandingconsultas($idPerfilProfesional){
        return DB::select("SELECT  tc.nombreconsulta, tc.valorconsulta
        FROM perfilesprofesionales pf
        INNER JOIN tipoconsulta tc ON pf.idPerfilProfesional=tc.idperfil
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista experto en
        public function cargarInfoPrfesionalLandingexperto($idPerfilProfesional){
        return DB::select("SELECT  ex.nombreExpertoEn, ex.descripcionExpertoEn
        FROM perfilesprofesionales pf
        INNER JOIN expertoen ex ON pf.idPerfilProfesional=ex.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista estudios
        public function cargarInfoPrfesionalLandingestudios($idPerfilProfesional){
        return DB::select("SELECT  pu.nombreestudio, un.nombreuniversidad, pu.fechaestudio
        FROM perfilesprofesionales pf
        INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
        INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista estudios
        public function cargarInfoPrfesionalLandingexperien($idPerfilProfesional){
        return DB::select("SELECT  expr.nombreEmpresaExperiencia,  expr.descripcionExperiencia, expr.fechaInicioExperiencia, expr.fechaFinExperiencia, expr.imgexperiencia
        FROM perfilesprofesionales pf
        INNER JOIN experiencias expr ON pf.idPerfilProfesional=expr.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

       // consulta para cargar lista asociaciones
       public function cargarInfoPrfesionalLandingasocia($idPerfilProfesional){
        return DB::select("SELECT asci.imgasociacion
        FROM perfilesprofesionales pf
        INNER JOIN asociaciones asci ON pf.idPerfilProfesional=asci.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista idiomas
       public function cargarInfoPrfesionalLandingidioma($idPerfilProfesional){
        return DB::select("SELECT asci.imgasociacion
        FROM perfilesprofesionales pf
        INNER JOIN asociaciones asci ON pf.idPerfilProfesional=asci.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }


}
