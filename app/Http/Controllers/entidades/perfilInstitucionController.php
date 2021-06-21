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
        $objinstitucionlandinprepagada= $this->cargarPrepagada($id);
        $objinstitucionlandinips= $this->cargarIps($id);
        $objinstitucionlandineps= $this->cargarEps($id);
        $objinstitucionlandinpremios= $this->cargarInfoInstitucLandinPremios($id);
        $objinstitucionlandinpublicaci= $this->cargarInfoInstitucLandinPublicaciones($id);
        $objinstitucionlandingaleria= $this->cargarInfoInstitucLandinGaleria($id);
        $objinstitucionlandinvideo= $this->cargarInfoInstitucLandinVideo($id);
        $objinstitucionlandinSedes= $this->cargarInfoInstitucLandinSedes($id);
        
        return view('instituciones.PerfilInstitucion', compact(
            'objinstitucionlandin',
            'objinstitucionlandinservicios',
            'objinstitucionlandinprepagada',
            'objinstitucionlandinips',
            'objinstitucionlandineps',
            'objinstitucionlandinpremios',
            'objinstitucionlandinpublicaci',
            'objinstitucionlandingaleria',
            'objinstitucionlandinvideo',
            'objinstitucionlandinSedes'
        ));
    }

         // consulta para cargar informacion de la landing 
         public function cargarInfoInstitucLandin($id){
        return DB::select("SELECT ints.logo,ints.imagen , us.nombreinstitucion, ints.url, ints.telefonouno, ints.direccion, mn.nombre ciudad, p.nombre pais, ints.quienessomos, ints.propuestavalor, ints.DescripcionGeneralServicios, tpi.nombretipo
        FROM instituciones ints
        INNER JOIN users us ON ints.idUser=us.id
        INNER JOIN municipios mn ON ints.id_municipio=mn.id_municipio
        INNER JOIN pais p ON ints.idPais=p.id_pais
        INNER JOIN tipoinstituciones tpi ON ints.idtipoInstitucion=tpi.id
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
        public function cargarPrepagada($id){
        return DB::select("SELECT pr.urlimagen
        FROM instituciones ints
        INNER JOIN prepagadas pr ON ints.id=pr.id_institucion
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

        // consulta para cargar informacion de la landing convenio ips
        public function cargarIps($id){
        return DB::select("SELECT ip.urlimagen
        FROM instituciones ints
        INNER JOIN ips ip ON ints.id=ip .id_institucion
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }

        // consulta para cargar informacion de la landing convenio ips
        public function cargarEps($id){
        return DB::select("SELECT ep.urlimagen
        FROM instituciones ints
        INNER JOIN eps ep ON ints.id=ep.id_institucion
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
        INNER JOIN galerias ga ON ints.id=ga.idinstitucion        
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }
        
        // consulta para cargar informacion de la landing videos
        public function cargarInfoInstitucLandinVideo($id){
        return DB::select("SELECT vi.urlvideo, vi.nombrevideo, vi.descripcionvideo
        FROM instituciones ints
        INNER JOIN videos vi ON ints.id=vi.idinstitucion        
        WHERE ints.aprobado<>0 AND ints.id=$id");
        }
        // consulta para cargar informacion de la landing sedes
        public function cargarInfoInstitucLandinSedes($id){
            return DB::select("SELECT s.imgsede, s.nombre, s.direccion, s.horario_sede, s.telefono
            FROM instituciones ints
            INNER JOIN sedesinstituciones s ON ints.id=s.idInstitucion        
            WHERE ints.aprobado<>0 AND ints.id=$id");
        }

}
