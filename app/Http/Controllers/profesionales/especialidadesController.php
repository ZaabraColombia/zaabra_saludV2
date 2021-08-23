<?php
namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SEO;

class especialidadesController extends Controller
{
    public function index($nombreProfesion)
    {
       
        SEO::setTitle('Especialidades Médicas');
        SEO::setDescription('En Zaabra Salud, más de 100 especialidades a su alcance. Busque, encuentre y reserve su cita, así de fácil');
        SEO::setCanonical('https://zaabrasalud.co/');

        //esta varible se llena con los datos recolectados en cada una de las consultas y entregan los datos
        //en la vista galeria 
        $objnombreProfesion = $this->nombreEspecilalidad($nombreProfesion);
        $idprofesion=$objnombreProfesion->idProfesion;
        $objbannersprincipalEspecialidades = $this->cargarBannerPrincipalEspecialidades();
        $objEspecialidades = $this->cargarEspecialidades($idprofesion);
        $objbannerssecundarioEspecialidades = $this->cargarBannerSecundarioEspecialidades();
        $objcarruselespecialidades = $this->cargarCarruselEspecialidades();
        return view('profesionales.Especialidades-Medicas', compact(
        'objnombreProfesion',
        'objbannersprincipalEspecialidades',
        'objEspecialidades',
        'objbannerssecundarioEspecialidades',
        'objcarruselespecialidades'
        ));
    }
    /*Carga nombre  profesion*/
    public function nombreEspecilalidad($nombreProfesion){
        $nombreProfesion = DB::table('profesiones')
        ->selectRaw('profesiones.nombreProfesion, profesiones.idProfesion')
        ->where('profesiones.nombreProfesion', 'like','%'.$nombreProfesion.'%')
        ->distinct()
        ->first();
        return $nombreProfesion;
        } 
    // consulta para cargar banner principal 
    public function cargarBannerPrincipalEspecialidades(){
        $consultaBannerEspecialidades = DB::table('ventabanners')
        ->select('rutaImagenVenta')
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 7)
        ->get();
        return $consultaBannerEspecialidades;
    }
     // consulta para cargar todas las Especialidades disponibles y que esten activas
     public function cargarEspecialidades($idprofesion){
        return DB::select("SELECT es.urlimagen, es.nombreEspecialidad, es.idEspecialidad
        FROM profesiones pr
        INNER JOIN  especialidades es ON pr.idProfesion = es.idProfesion 
        WHERE  es.estado <>0  AND es.idProfesion=$idprofesion ORDER BY es.orden  + 0 ASC ");
    }
    // consulta para cargar banner secundario especialidades
    public function cargarBannerSecundarioEspecialidades(){
        $consultaBannerSecundarioEspecialidades = DB::table('ventabanners')
        ->select('rutaImagenVenta')
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 8)
        ->get();
        return $consultaBannerSecundarioEspecialidades;
    }
    // consulta para cargar carrusel profesiones 
    public function cargarCarruselEspecialidades(){
        $consultaCarruselEspecialidades = DB::table('ventabanners')
        ->select('rutaImagenVenta')
        ->where('aprobado', '<>', 0)
        ->where('idtipobanner', '=', 9)
        ->get();
        return $consultaCarruselEspecialidades;
    }
}