<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\users_roles;
use App\Models\perfilesprofesionales;
use App\Models\universidades;
use SEO;

class perfilprofesionalController extends Controller
{

    public function index($slug){

        $objprofesionallanding= $this->cargarInfoPrfesionalLanding($slug);
        $idPerfilProfesional = $objprofesionallanding[0]->idPerfilProfesional;

        foreach ($objprofesionallanding as $items){
        SEO::setTitle($items->primernombre.' '. $items->primerapellido. ' | Especialista en cardiología');
        }
        SEO::setDescription('En Zaabra Salud, más de 100 especialidades a su alcance. Busque, encuentre y reserve su cita, así de fácil');
        SEO::setCanonical('https://zaabrasalud.co/');

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
        $objprofesionalComentario= $this->cargarInfoPrfesionalComentario($idPerfilProfesional);
        $objTipoUser= $this->cargarTipoUser();

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
            'objprofesionalComentario',
            'objTipoUser'
        ));

    }

         // consulta para cargar todas los profesionales segun su area profesion y especialidad
        public function cargarInfoPrfesionalLanding($slug){
        return DB::select("SELECT pf.idPerfilProfesional, pf.fotoperfil, CONCAT('Dr.(a) ',  us.primernombre) AS primernombre, us.segundonombre, us.primerapellido, us.segundoapellido, ep.nombreEspecialidad, pf.numeroTarjeta, pf.direccion, un.nombreuniversidad, pf.descripcionPerfil, mn.nombre
        FROM perfilesprofesionales pf
        INNER JOIN users us ON pf.idUser=us.id
        INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
        INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
        INNER JOIN universidades un ON pf.id_universidad=un.id_universidad
        INNER JOIN municipios mn ON mn.id_municipio=pf.id_municipio
        WHERE pf.aprobado<>0 AND pf.slug like '$slug' LIMIT 1");
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
        return DB::select("SELECT  vd.nombrevideo, vd.descripcionvideo,
        REPLACE(vd.urlvideo, 'watch?v=', 'embed/') AS urlvideo
        FROM perfilesprofesionales pf
        INNER JOIN videos vd ON pf.idPerfilProfesional=vd.idPerfilProfesional
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional=$idPerfilProfesional");
        }


        // consulta comentarios
        public function cargarInfoPrfesionalComentario($idPerfilProfesional){
        return DB::select("SELECT us.primernombre, us.primerapellido, c.comentario,c.calificacion,
        (SELECT (ROUND(SUM(c.calificacion) / COUNT(c.calificacion)))
        FROM comentarios c
        INNER JOIN perfilesprofesionales p ON c.idperfil=p.idPerfilProfesional
        WHERE p.idPerfilProfesional=$idPerfilProfesional) AS calificacionRedondeada
        FROM  users_roles ur
        LEFT JOIN users us  ON ur.iduser=us.id
        LEFT JOIN perfilesprofesionales pf  ON us.id=pf.idUser
        LEFT JOIN comentarios c ON ur.iduser=c.idusuariorol
        WHERE c.comentario<>'' AND c.idperfil=$idPerfilProfesional");
        }


       public function cargarTipoUser(){
           if(Auth::user()){
            $id_user=auth()->user()->id;
            return DB::select("SELECT ur.idrol
            FROM users us
            INNER JOIN users_roles ur on us.id=ur.iduser
            WHERE us.id =$id_user");
           }

       }


}
