<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\entidades;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class perfilInstitucionController extends Controller
{
    
  
    
    public function index($id)
    {
        $objinstitucionlandin= $this->cargarInfoInstitucLandin($id);
        $objinstitucionlandinservicios= $this->cargarInfoInstitucLandinServicios($id);
        $objinstitucionlandinprepagada= $this->cargarInfoInstitucLandinPrepagada($id);
        $objinstitucionlandinips= $this->cargarInfoInstitucLandinIps($id);
        $objinstitucionlandineps= $this->cargarInfoInstitucLandinEps($id);
        $objinstitucionlandinpremios= $this->cargarInfoInstitucLandinPremios($id);
        $objinstitucionlandinpublicaci= $this->cargarInfoInstitucLandinPublicaciones($id);
        $objinstitucionlandingaleria= $this->cargarInfoInstitucLandinGaleria($id);
        $objinstitucionlandinvideo= $this->cargarInfoInstitucLandinVideo($id);
        
        return view('instituciones.PerfilInstitucion', compact(
            'objinstitucionlandin',
            'objinstitucionlandinservicios',
            'objinstitucionlandinprepagada',
            'objinstitucionlandinips',
            'objinstitucionlandineps',
            'objinstitucionlandinpremios',
            'objinstitucionlandinpublicaci',
            'objinstitucionlandingaleria',
            'objinstitucionlandinvideo'
        ));

    }

         // consulta para cargar informacion de la landing 
         public function cargarInfoInstitucLandin($id){
        return DB::select("SELECT ints.logo,ints.imagen , us.nombreinstitucion, ints.url, ints.telefonouno, ints.direccion, mn.nombre ciudad, p.nombre pais, ints.quienessomos, ints.propuestavalor, ints.DescripcionGeneralServicios, tpi.nombretipo
        FROM instituciones ints
        INNER JOIN users us ON ints.idUser=us.id
        INNER JOIN municipio mn ON ints.id_municipio=mn.id_municipio
        INNER JOIN pais p ON ints.idPais=p.id_pais
        INNER JOIN tipoinstitucion tpi ON ints.idtipoInstitucion=tpi.id
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

        // consulta para cargar informacion de la landing los servicios 
        public function cargarInfoInstitucLandinServicios($id){
        return DB::select("SELECT sv.tituloServicios, sv.DescripcioServicios, sv.sucursalservicio
        FROM instituciones ints
        INNER JOIN serviciosinstituciones sv ON ints.id=sv.id
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

        // consulta para cargar informacion de la landing convenio prepagada
        public function cargarInfoInstitucLandinPrepagada($id){
        return DB::select("SELECT pr.urlimagen
        FROM instituciones ints
        INNER JOIN institucionprepagada ip ON ints.id=ip.idinstitucion
        INNER JOIN prepagada pr ON ip.id_prepagada=pr.id_prepagada
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

        // consulta para cargar informacion de la landing convenio ips
        public function cargarInfoInstitucLandinIps($id){
        return DB::select("SELECT ip.urlimagen
        FROM instituciones ints
        INNER JOIN intitucionesips ii ON ints.id=ii.idinstitucion
        INNER JOIN ips ip ON ii.idips=ip.id
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

        // consulta para cargar informacion de la landing convenio ips
        public function cargarInfoInstitucLandinEps($id){
        return DB::select("SELECT ep.urlimagen
        FROM instituciones ints
        INNER JOIN intitucioneseps ie ON ints.id=ie.idinstitucion
        INNER JOIN eps ep ON ie.ideps=ep.id
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

        // consulta para cargar informacion de la landing premios
        public function cargarInfoInstitucLandinPremios($id){
        return DB::select("SELECT pr.imgpremio,pr.fechapremio,pr.nombrepremio,pr.descripcionpremio
        FROM instituciones ints
        INNER JOIN premios pr ON ints.id=pr.idinstitucion
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

        // consulta para cargar informacion de la landing publicaciones
        public function cargarInfoInstitucLandinPublicaciones($id){
        return DB::select("SELECT pu.imgpublicacion, pu.nombrepublicacion, pu.descripcion
        FROM instituciones ints
        INNER JOIN publicaciones pu ON ints.id=pu.idInstitucion
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }
        
        // consulta para cargar informacion de la landing galeria
        public function cargarInfoInstitucLandinGaleria($id){
        return DB::select("SELECT ga.imggaleria, ga.nombrefoto, ga.descripcion
        FROM instituciones ints
        INNER JOIN galeria ga ON ints.id=ga.idinstitucion        
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }
        
        // consulta para cargar informacion de la landing videos
        public function cargarInfoInstitucLandinVideo($id){
        return DB::select("SELECT vi.urlvideo, vi.nombrevideo, vi.descripcionvideo
        FROM instituciones ints
        INNER JOIN videos vi ON ints.id=vi.idinstitucion        
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

}
