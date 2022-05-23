<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\entidades;

use App\Http\Controllers\Controller;
use App\Models\Convenios;
use App\Models\especialidades;
use App\Models\perfilesprofesionales;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\instituciones;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Object_;
use App\Models\profesionales_instituciones;

class perfilInstitucionController extends Controller
{

    public function index($slug)
    {
        //$objinstitucionlandinimgsede = instituciones::where('slug', 'like', $slug)->first();
        $objinstitucionlandin = $this->cargarInfoInstitucLandin($slug);
        if (empty($objinstitucionlandin)) return redirect('/');
        //$objinstitucionlandin = $objinstitucionlandin[0];

        $id = $objinstitucionlandin[0]->id;

        $objinstitucionlandinimgsede = $objinstitucionlandin[0];

        //Convenios
        $objConvenios = Convenios::where('id_institucion', '=', $id)
            ->orderBy('id_tipo_convenio')
            ->leftjoin('tipoinstituciones', 'tipoinstituciones.id', '=', 'convenios.id_tipo_convenio')
            ->get(['convenios.id', 'id_tipo_convenio', 'url_image', 'nombretipo as nombre_convenio']);

        $objinstitucionlandinservicios = $this->cargarInfoInstitucLandinServicios($id);
        //$objinstitucionlandinprepagada= $this->cargarPrepagada($id);
        //$objinstitucionlandinips= $this->cargarIps($id);
        //$objinstitucionlandineps= $this->cargarEps($id);
        $objinstitucionlandinpremios = $this->cargarInfoInstitucLandinPremios($id);
        $objinstitucionlandinpublicaci = $this->cargarInfoInstitucLandinPublicaciones($id);
        $objinstitucionlandingaleria = $this->cargarInfoInstitucLandinGaleria($id);
        $objinstitucionlandinvideo = $this->cargarInfoInstitucLandinVideo($id);
        $objinstitucionlandinSedes = $this->cargarInfoInstitucLandinSedes($id);
        //$objinstitucionlandInstitucion= $this->cargarInfoProfesionalInstitucion($id);

        return view('instituciones.PerfilInstitucion', compact(
            'objinstitucionlandin',
            'objinstitucionlandinservicios',
            'objConvenios',
            //'objinstitucionlandinprepagada',
            //'objinstitucionlandinips',
            //'objinstitucionlandineps',
            'objinstitucionlandinpremios',
            'objinstitucionlandinpublicaci',
            'objinstitucionlandingaleria',
            'objinstitucionlandinvideo',
            'objinstitucionlandinSedes',
            //'objinstitucionlandInstitucion',
            'objinstitucionlandinimgsede'
        ));
    }

    // consulta para cargar informacion de la landing
    public function cargarInfoInstitucLandin($slug)
    {
        return DB::select("SELECT ints.id, ints.logo,ints.imagen , us.nombreinstitucion, ints.url, ints.telefonouno, ints.direccion, mn.nombre ciudad,
                            p.nombre pais, ints.quienessomos, ints.propuestavalor, ints.DescripcionGeneralServicios, tpi.nombretipo, ints.slug, ints.idtipoInstitucion, ints.url_maps
    FROM instituciones ints
    INNER JOIN users us ON ints.idUser=us.id
    INNER JOIN municipios mn ON ints.id_municipio=mn.id_municipio
    INNER JOIN pais p ON ints.idPais=p.id_pais
    INNER JOIN tipoinstituciones tpi ON ints.idtipoInstitucion=tpi.id
    WHERE ints.aprobado<>0 AND ints.slug like '$slug'");
    }

    // consulta para cargar informacion de la landing los servicios
    public function cargarInfoInstitucLandinServicios($id)
    {
        return DB::select("SELECT sv.tituloServicios, sv.DescripcioServicios, sv.sucursalservicio
    FROM instituciones ints
    INNER JOIN serviciosinstituciones sv ON ints.id=sv.id
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }

    // consulta para cargar informacion de la landing convenio prepagada
    public function cargarPrepagada($id)
    {
        return DB::select("SELECT pr.urlimagen
    FROM instituciones ints
    INNER JOIN prepagadas pr ON ints.id=pr.id_institucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }

    // consulta para cargar informacion de la landing convenio ips
    public function cargarIps($id)
    {
        return DB::select("SELECT ip.urlimagen
    FROM instituciones ints
    INNER JOIN ips ip ON ints.id=ip .id_institucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }

    // consulta para cargar informacion de la landing convenio ips
    public function cargarEps($id)
    {
        return DB::select("SELECT ep.urlimagen
    FROM instituciones ints
    INNER JOIN eps ep ON ints.id=ep.id_institucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }

    // consulta para cargar informacion de la landing premios
    public function cargarInfoInstitucLandinPremios($id)
    {
        return DB::select("SELECT cer.imgcertificado,cer.fechacertificado,cer.titulocertificado,cer.descrpcioncertificado
    FROM  instituciones ints
    INNER JOIN certificaciones cer ON ints.id = cer.id_institucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }

    // consulta para cargar informacion de la landing publicaciones
    public function cargarInfoInstitucLandinPublicaciones($id)
    {
        return DB::select("SELECT pu.imgpublicacion, pu.nombrepublicacion, pu.descripcion
    FROM instituciones ints
    INNER JOIN publicaciones pu ON ints.id=pu.idInstitucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }

    // consulta para cargar informacion de la landing galeria
    public function cargarInfoInstitucLandinGaleria($id)
    {
        return DB::select("SELECT ga.imggaleria, ga.nombrefoto, ga.descripcion
    FROM instituciones ints
    INNER JOIN galerias ga ON ints.id=ga.idinstitucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }

    // consulta para cargar informacion de la landing videos
    public function cargarInfoInstitucLandinVideo($id)
    {
        return DB::select("SELECT  vi.nombrevideo, vi.descripcionvideo,
        REPLACE(vi.urlvideo, 'watch?v=', 'embed/') AS urlvideo
    FROM instituciones ints
    INNER JOIN videos vi ON ints.id=vi.idinstitucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }

    // consulta para cargar informacion de la landing sedes
    public function cargarInfoInstitucLandinSedes($id)
    {
        return DB::select("SELECT s.imgsede, s.nombre, s.direccion, s.horario_sede, s.telefono
    FROM instituciones ints
    INNER JOIN sedesinstituciones s ON ints.id=s.idInstitucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }


    // consulta para cargar profesionales institucion
    public function cargarInfoProfesionalInstitucion($id)
    {
        return DB::select("SELECT pins.primer_nombre, pins.segundo_nombre, pins.primer_apellido, pins.segundo_apellido,
    pins.especialidad_uno, pins.especialidad_dos, pins.foto_perfil_institucion
    FROM instituciones ints
    INNER JOIN profesionales_instituciones pins ON ints.id=pins.id_institucion
    WHERE ints.aprobado<>0 AND ints.id=$id");
    }


    // Función para cargar la vista de institución profesionales
    public function profesionales(Request $request)
    {

        $objinstitucionlandin = $this->cargarInfoInstitucLandin($request->slug);
        if (empty($objinstitucionlandin)) return redirect('/');

        $profesionales = profesionales_instituciones::query()
            ->with([
                'especialidad_principal',
                'especialidades',
                'universidad'
            ])
            ->where('id_institucion', '=', $objinstitucionlandin[0]->id)
            //->where('estado', 1)
            ->get();

        //Sacar las especialidades
        $ids = $profesionales->pluck('id_profesional_inst')->toArray();
        $especialidades = especialidades::query()
            ->whereHas('total_ins_profesionales', function ($query) use ($ids) {
                return $query->whereIn('id_profesional_inst', $ids);
            })
            ->orWhereHas('ins_profesionales', function ($query) use ($ids) {
                return $query->whereIn('id_profesional_inst', $ids);
            })
            ->get();

        $institucion = $this->cargarInfoInstitucion($request->slug);

        return view('instituciones.profesionales-institucion', compact('profesionales',
            'especialidades', 'institucion'
        ));
    }

    //Cargar servicios de un profesional
    public function servicios(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'profesional' => ['required', 'integer'],
        ], [], [
            'profesional' => 'Profesional'
        ]);

        if ($validate->fails())
            return response([
                'message' => [
                    'title' => 'Error!',
                    'text' => "<ul><li>" . collect($validate->errors()->all())->implode('</li><li>') . "</li></ul>"
                ]
            ], Response::HTTP_NOT_FOUND);

        $profesional = profesionales_instituciones::query()
            ->select(['id_profesional_inst', 'id_especialidad', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'slug', 'foto_perfil_institucion'])
            ->with(['servicios:id,nombre,valor,agendamiento_virtual', 'especialidad_principal'])
            ->where('id_profesional_inst', $request->profesional)
            ->where('estado', 1)
            ->first();

        if (empty($profesional))
            return response([
                'message' => [
                    'title' => 'Error!',
                    'text' => "El profesional no existe"
                ]
            ], Response::HTTP_NOT_FOUND);

        $data = [
            'nombre' => $profesional->nombre_completo,
            'especialidad' => $profesional->especialidad_principal->nombreEspecialidad,
            'foto' => asset($profesional->foto_perfil_institucion ?? 'img/menu/avatar.png'),
            'servicios' => $profesional->servicios->map(function ($item) use ($profesional){
                return [
                    'url' => route('paciente.asignar-cita-institucion-profesional', ['profesional' => $profesional->slug, 'servicio' => $item->id]),
                    'nombre' => $item->nombre,
                    'virtual' => $item->agendamiento_virtual,
                    'valor' => "$" . number_format($item->valor, 0, ',', '.'),
                    'id' => $item->id
                ];
            })
        ];

        return response($data, Response::HTTP_OK);
    }


    // consulta para cargar informacion de la landing
    public function cargarInfoInstitucion($slug)
    {
        return DB::select("SELECT ints.id, ints.logo,ints.imagen , us.nombreinstitucion, ints.slug, ints.idtipoInstitucion, ints.telefonouno
        FROM instituciones ints
        INNER JOIN users us ON ints.idUser=us.id
        WHERE ints.aprobado<>0 AND ints.slug like '$slug'");
    }

    // consulta para cargar banner principal de la vista institción profesionales
    public function cargarBannerPrincipalInstitucionProfesionales()
    {
        $consultaBannerInstitucionProfesionales = DB::table('ventabanners')
            ->select()
            ->where('aprobado', '<>', 0)
            ->where('idtipobanner', '=', 13)
            ->get();
        return $consultaBannerInstitucionProfesionales;
    }

}
