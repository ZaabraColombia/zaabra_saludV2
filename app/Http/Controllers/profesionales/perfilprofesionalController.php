<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\users_roles;

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
        $objprofesionallandingtratam= $this->cargarInfoPrfesionalLandingtratam($idPerfilProfesional);
        $objprofesionallandingpremio= $this->cargarInfoPrfesionalLandingpremio($idPerfilProfesional);
        $objprofesionallandingpublic= $this->cargarInfoPrfesionalLandingpublic($idPerfilProfesional);
        $objprofesionallandinggaler= $this->cargarInfoPrfesionalLandinggaler($idPerfilProfesional);
        $objprofesionallandingvideo= $this->cargarInfoPrfesionalLandingvideo($idPerfilProfesional);
        $objTipoUsu= $this->verificaTipousuarioComnetario();
        $objprofesionalComentario= $this->cargarInfoPrfesionalComentario($idPerfilProfesional);
        
 

        return view('profesionales.PerfilProfesional', compact(
            'objprofesionallanding',
            'objprofesionallandingconsultas',
            'objprofesionallandingexperto',
            'objprofesionallandingestudios',
            'objprofesionallandingexperi',
            'objprofesionallandingasocia',
            'objprofesionallandingidioma',
            'objprofesionallandingtratam',
            'objprofesionallandingpremio',
            'objprofesionallandingpublic',
            'objprofesionallandinggaler',
            'objprofesionallandingvideo',
            'objTipoUsu',
            'objprofesionalComentario'
        ));

    }

         // consulta para cargar todas los profesionales segun su area profesion y especialidad
        public function cargarInfoPrfesionalLanding($idPerfilProfesional){
            return DB::select("SELECT pf.idPerfilProfesional, pf.fotoperfil, us.primernombre, us.primerapellido, ep.nombreEspecialidad, pf.numeroTarjeta, pf.direccion, un.nombreuniversidad, pf.descripcionPerfil, mn.nombre
            FROM perfilesprofesionales pf
            INNER JOIN users us ON pf.idUser=us.id
            INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
            INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
            INNER JOIN universidades un ON pu.id_universidad=un.id_universidad
            INNER JOIN municipios mn ON mn.id_municipio=pf.id_municipio
            WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional LIMIT 1");
        }

        // consulta para cargar todas las tipos de consulta medicas
        public function cargarInfoPrfesionalLandingconsultas($idPerfilProfesional){
        return DB::select("SELECT  tc.nombreconsulta, tc.valorconsulta
        FROM perfilesprofesionales pf
        INNER JOIN tipoconsultas tc ON pf.idPerfilProfesional=tc.idperfil
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
        return DB::select("SELECT  pu.nombreestudio, un.nombreuniversidad, pu.fechaestudio,un.logouniversidad
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
        return DB::select("SELECT id.nombreidioma, id.imgidioma
        FROM perfilesprofesionales pf
        INNER JOIN usuario_idiomas idip ON pf.idPerfilProfesional=idip.idPerfilProfesional
        INNER JOIN idiomas id ON idip.id_idioma=id.id_idioma
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista tratamientos
        public function cargarInfoPrfesionalLandingtratam($idPerfilProfesional){
        return DB::select("SELECT tr.imgTratamientoAntes, tr.tituloTrataminetoAntes, tr.descripcionTratamientoAntes, tr.imgTratamientodespues, tr.tituloTrataminetoDespues, tr.descripcionTratamientoDespues
        FROM perfilesprofesionales pf
        INNER JOIN tratamientos tr ON pf.idPerfilProfesional=tr.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista premios
        public function cargarInfoPrfesionalLandingpremio($idPerfilProfesional){
        return DB::select("SELECT  pr.imgpremio, pr.fechapremio,pr.nombrepremio, pr.descripcionpremio
        FROM perfilesprofesionales pf
        INNER JOIN premios pr ON pf.idPerfilProfesional=pr.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista publicaciones
        public function cargarInfoPrfesionalLandingpublic($idPerfilProfesional){
        return DB::select("SELECT  pb.imgpublicacion, pb.nombrepublicacion, pb.descripcion
        FROM perfilesprofesionales pf
        INNER JOIN publicaciones pb ON pf.idPerfilProfesional=pb.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista publicaciones
        public function cargarInfoPrfesionalLandinggaler($idPerfilProfesional){
        return DB::select("SELECT  gl.imggaleria, gl.nombrefoto, gl.descripcion
        FROM perfilesprofesionales pf
        INNER JOIN galerias gl ON pf.idPerfilProfesional=gl.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }

        // consulta para cargar lista publicaciones
        public function cargarInfoPrfesionalLandingvideo($idPerfilProfesional){
        return DB::select("SELECT  vd.urlvideo, vd.nombrevideo, vd.descripcionvideo
        FROM perfilesprofesionales pf
        INNER JOIN videos vd ON pf.idPerfilProfesional=vd.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }


        // consulta para cargar lista publicaciones
        public function verificaTipousuarioComnetario(){
            if (!Auth::guest()){
                $id_user=auth()->user()->id;/*id usuario logueado*/

                return DB::select("SELECT ur.idrol
                FROM users us
                INNER JOIN users_roles ur on us.id=ur.iduser
                WHERE us.id=$id_user");
                
            }
        }

        // consulta comentarios
        public function cargarInfoPrfesionalComentario($idPerfilProfesional){
        return DB::select("SELECT  vd.urlvideo, vd.nombrevideo, vd.descripcionvideo
        FROM perfilesprofesionales pf
        INNER JOIN videos vd ON pf.idPerfilProfesional=vd.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }


}
