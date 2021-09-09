<?php

namespace App\Http\Controllers\entidades;
use App\Http\Controllers\Controller;
use App\Models\Convenios;
use App\Models\destacados;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use App\Models\instituciones;
use App\Models\tipoinstituciones;
use App\Models\serviciosinstituciones;
use App\Models\eps;
use App\Models\ips;
use App\Models\prepagadas;
use App\Models\intitucioneseps;
use App\Models\intitucionesips;
use App\Models\institucionprepagada;
use App\Models\profesionales_instituciones;
use App\Models\certificaciones;
use App\Models\sedesinstituciones;
use App\Models\pais;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\provincia;
use App\Models\galerias;
use App\Models\videos;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class formularioInstitucionController extends Controller{

    public function index(){

        $id_user=auth()->user()->id;/*id usuario logueado*/

        //Crear el registro de perfil profesional si no existe
        $ins = instituciones::where('idUser', '=', $id_user)->select('id')->first();
        if (empty($ins))
        {
            $ins = new instituciones(['idUser' => $id_user]);
            $ins->save();
        }

        /*crea una nueva carpeta con el id del perfil nuevo*/
        $path = public_path().'img/instituciones/' . $id_user;
        if (!File::exists($path)) {
            File::makeDirectory($path,  0777, true);
        }

        $tipoinstitucion = tipoinstituciones::all();

        $objFormulario      = $this->cargaFormulario($id_user);
        $objFormulario      = $objFormulario[0];
        $objuser            = $this->cargaDatosUser($id_user);
        $objuser            = $objuser[0];

        $objConvenios       = Convenios::where('id_institucion', '=', $ins->id)
            ->select('convenios.id', 'convenios.url_image', 'nombretipo as nombre_tipo_convenio')
            ->join('tipoinstituciones', 'tipoinstituciones.id', '=', 'convenios.id_tipo_convenio')
            ->get();
        $objTipoConvenios   = tipoinstituciones::all();

        $objProfesionalesIns    = profesionales_instituciones::where('id_institucion', '=', $ins->id)
            ->select('profesionales_instituciones.id_profesional_inst',
                'profesionales_instituciones.foto_perfil_institucion',
                'profesionales_instituciones.primer_nombre',
                'profesionales_instituciones.segundo_nombre',
                'profesionales_instituciones.segundo_nombre',
                'profesionales_instituciones.segundo_apellido',
                'especialidades.nombreEspecialidad as nombre_especialidad',
                'universidades.nombreuniversidad as nombre_universidad')
            ->leftjoin('especialidades', 'especialidades.idEspecialidad', '=', 'profesionales_instituciones.id_especialidad')
            ->leftjoin('universidades', 'universidades.id_universidad', '=', 'profesionales_instituciones.id_universidad')
            ->get();

        $objServicio=$this->cargaServicios($id_user);
        $objContadorServicio=$this->contadorServicios($id_user);



        $objCertificaciones=$this->cargaCertificaciones($id_user);
        $objContadorCertificaciones=$this->contadorCertificaciones($id_user);
        $objSedes=$this->cargaSedes($id_user);
        $objContadorSedes=$this->contadorSedes($id_user);
        $objGaleria=$this->cargaGaleria($id_user);
        $objContadorGaleria=$this->contadorGaleria($id_user);
        $objVideo=$this->cargaVideo($id_user);
        $objContadorVideo=$this->contadorVideo($id_user);

        //Lista de paises
        $listaPaises = pais::all();

        //llamar la lista de departamentos según el pais
        if (!is_null($objFormulario->id_pais)) {
            $listaDepartamentos = departamento::where("id_pais", $objFormulario->id_pais)->get();
        }else{
            $listaDepartamentos = array();
        }
        //llamar la lista de provincias según el departamento
        if (!is_null($objFormulario->id_departamento)) {
            $listaProvincias = provincia::where("id_departamento", $objFormulario->id_departamento)->get();
        }else{
            $listaProvincias = array();
        }
        //llamar la lista de municipios según la provincia
        if (!is_null($objFormulario->id_provincia)) {
            $listaMunicipios = municipio::where("id_provincia", $objFormulario->id_provincia)->get();
        }else{
            $listaMunicipios = array();
        }


        return view('instituciones.FormularioInstitucion',compact(
            'tipoinstitucion',
            'objuser',
            'listaPaises',
            'listaDepartamentos',
            'listaProvincias',
            'listaMunicipios',
            'objFormulario',
            'objServicio',
            'objContadorServicio',
            'objConvenios',
            'objTipoConvenios',
            'objProfesionalesIns',
            'objCertificaciones',
            'objContadorCertificaciones',
            'objSedes',
            'objContadorSedes',
            'objGaleria',
            'objContadorGaleria',
            'objVideo',
            'objContadorVideo'
        ));
    }

    /*------------------------------------- inicio json busqueda departamento, provincia, ciudad----------------------*/
    public function getDepartamento(Request $request){

        $departamento = departamento::where("id_pais",$request->id_pais)->get();
        return response()->json($departamento);
    }
    public function getProvincia(Request $request){
        $provincia = provincia::where("id_departamento",$request->id_departamento)->get();
        return response()->json($provincia);
    }
    public function getCiudad(Request $request){
        $municipio = municipio::where("id_provincia",$request->id_provincia)->get();
        return response()->json($municipio);
    }
    /*------------------------------------- fin json busqueda departamento, provincia, ciudad----------------------*/


    /*------------ Funcion solo para verificar que institucion existe y esta se utiiliza en las demas-----------------*/
    protected function verificaPerfil(){
        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        /*consulta si existe el profesional*/
        $idexisteinstitu = DB::table('instituciones')
            ->select('instituciones.id')
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->where('instituciones.idUser', $id_user)
            ->first();
        return $idexisteinstitu;

    }
    /*------------Fin  Funcion solo para verificar que institucion existe y esta se utiiliza en los demas metodos-----------------*/

    /*------------inicio busquedad datos basicos usuario logueado y data resgistrada de la institucion-----------------*/

    public function cargaDatosUser($id_user){
        return DB::select("SELECT us.nombreinstitucion, us.numerodocumento
    FROM users us
    WHERE id=$id_user");
    }

    public function cargaFormulario($id_user){
        return DB::select("SELECT ins.imagen, ins.logo, ins.quienessomos,  ins.DescripcionGeneralServicios, ins.idtipoInstitucion,
    ins.url, ins.fechainicio, ins.telefonouno,  ins.telefono2, ins.direccion, ins.propuestavalor,
    p.id_pais,p.nombre, de.id_departamento, de.nombre,ins.url_maps,
    prv.id_provincia,prv.nombre, mu.id_municipio, mu.nombre
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  pais p ON ins.idpais=p.id_pais
    LEFT JOIN  departamentos de ON ins.id_departamento= de.id_departamento
    LEFT JOIN  provincias prv ON ins.id_provincia= prv.id_provincia
    LEFT JOIN  municipios mu ON ins.id_municipio= mu.id_municipio
    LEFT JOIN  tipoinstituciones ti ON ins.idtipoInstitucion= ti.id
    WHERE ins.idUser=$id_user");
    }


    public function  cargaServicios($id_user){
        return DB::select("SELECT st.id_servicio, st.tituloServicios, st.DescripcioServicios, st.sucursalservicio
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  serviciosinstituciones st ON ins.id= st.id
    WHERE ins.idUser=$id_user");
    }

    public function contadorServicios($id_user){
        /*cuenta los los valores ingresados*/
        $contadorservicio = DB::table('instituciones')
            ->select(DB::raw('COUNT(serviciosinstituciones.id) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('serviciosinstituciones', 'instituciones.id', '=', 'serviciosinstituciones.id')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorservicio;
    }

    public function  cargaEps($id_user){
        return DB::select("SELECT e.id, e.urlimagen
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  eps e ON ins.id= e.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorEps($id_user){
        /*cuenta los los valores ingresados*/
        $contadoreps = DB::table('instituciones')
            ->select(DB::raw('COUNT(eps.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('eps', 'instituciones.id', '=', 'eps.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadoreps;
    }


    public function  cargaIps($id_user){
        return DB::select("SELECT i.id ,i.urlimagen
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  ips i ON ins.id= i.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorIps($id_user){
        /*cuenta los los valores ingresados*/
        $contadorips = DB::table('instituciones')
            ->select(DB::raw('COUNT(ips.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('ips', 'instituciones.id', '=', 'ips.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorips;
    }

    public function  cargaPrepa($id_user){
        return DB::select("SELECT p.id_prepagada ,p.urlimagen
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  prepagadas p ON ins.id= p.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorPrepa($id_user){
        /*cuenta los los valores ingresados*/
        $contadorprepa = DB::table('instituciones')
            ->select(DB::raw('COUNT(prepagadas.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('prepagadas', 'instituciones.id', '=', 'prepagadas.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorprepa;
    }
    public function  cargaProfeInsti($id_user){
        return DB::select("SELECT pin.id_profesional_inst, pin.primer_nombre,pin.segundo_nombre,pin.primer_apellido,
    pin.segundo_apellido,pin.especialidad_uno,pin.especialidad_dos, pin.foto_perfil_institucion
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  profesionales_instituciones pin ON ins.id= pin.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorProfeInsti($id_user){
        /*cuenta los los valores ingresados*/
        $contadorProfeInsti = DB::table('instituciones')
            ->select(DB::raw('COUNT(profesionales_instituciones.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('profesionales_instituciones', 'instituciones.id', '=', 'profesionales_instituciones.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorProfeInsti;
    }

    public function  cargaCertificaciones($id_user){
        return DB::select("SELECT cr.id_certificacion, cr.imgcertificado, cr.fechacertificado, cr.titulocertificado, cr.descrpcioncertificado
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  certificaciones cr ON ins.id= cr.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorCertificaciones($id_user){
        /*cuenta los los valores ingresados*/
        $contadorCerificaciones = DB::table('instituciones')
            ->select(DB::raw('COUNT(certificaciones.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('certificaciones', 'instituciones.id', '=', 'certificaciones.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorCerificaciones;
    }

    public function  cargaSedes($id_user){
        return DB::select("SELECT si.id,si.imgsede,si.nombre,si.direccion,si.horario_sede,si.telefono
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  sedesinstituciones si ON ins.id= si.idInstitucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorSedes($id_user){
        /*cuenta los los valores ingresados*/
        $contadorSedes = DB::table('instituciones')
            ->select(DB::raw('COUNT(sedesinstituciones.idInstitucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('sedesinstituciones', 'instituciones.id', '=', 'sedesinstituciones.idInstitucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorSedes;
    }

    public function  cargaGaleria($id_user){
        return DB::select("SELECT g.id_galeria, g.imggaleria, g.nombrefoto, g.descripcion
    FROM  instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  galerias g ON ins.id = g.idinstitucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorGaleria($id_user){
        /*cuenta los los valores ingresados*/
        $contadorGaleria = DB::table('instituciones')
            ->select(DB::raw('COUNT(galerias.idinstitucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('galerias', 'instituciones.id', '=', 'galerias.idInstitucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorGaleria;
    }

    public function  cargaVideo($id_user){
        return DB::select("SELECT v.id, v.nombrevideo, v.descripcionvideo,
    REPLACE(v.urlvideo, '/watch?v=', '/embed/') AS urlvideo, v.fechavideo
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    INNER JOIN  videos v ON ins.id= v.idinstitucion
    WHERE ins.idUser=$id_user");
    }


    public function contadorVideo($id_user){
        /*cuenta los los valores ingresados*/
        $contadorvideos = DB::table('instituciones')
            ->select(DB::raw('COUNT(videos.idinstitucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('videos', 'instituciones.id', '=', 'videos.idinstitucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorvideos;
    }
    /*------------Fin busquedad datos basicos usuario logueado y data resgistrada de la institucion-----------------*/


    /*-------------------------------------Creacion y/o modificacion formulario parte 1----------------------*/
    protected function create1(Request $request){

        $validation = Validator::make($request->all(), [
            'nombre_institucion' => ['required'],
            'fecha_inicio_institucion' => ['required', 'date_format:Y-m-d'],
            'url_institucion' => ['required', 'url'],
            'tipo_institucion' => ['required', 'exists:tipoinstituciones,id'],
            'logo_institucion' => ['image'],
            'imagen_institucion' => ['image'],
        ], [], [
            'nombre_institucion' => 'Nombre',
            'fecha_inicio_institucion' => 'Fecha de inicio',
            'url_institucion' => 'Pagina web',
            'tipo_institucion' => 'Tipo de institución',
            'logo_institucion' => 'Logo de la institución',
            'imagen_institucion' => 'Imagen de la institución',
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;

        //Agregar campos
        $user = User::where('id', '=', $id_user)->first();
        $basico = instituciones::where('idUser', '=', $id_user)->first();

        if (empty($basico))
        {
            return response([
                'mensaje' => 'No existe la institución'
            ], Response::HTTP_NOT_FOUND);
        }

        //guardar el nombre
        $user->nombreinstitucion = $request->nombre_institucion;
        $user->save();

        //guardar la inforacion basica
        $basico->fechainicio = $request->fecha_inicio_institucion;
        $basico->url = $request->url_institucion;
        $basico->idtipoInstitucion = $request->tipo_institucion;

        if(!empty($request->file('logo_institucion')))
        {
            $logo = $request->file('logo_institucion');
            //dd($logo);
            /*captura el nombre del logo*/
            $nombre_logo = $logo->getClientOriginalName();

            /*guarda la imagen en carpeta con el id del usuario*/
            $logo->move("img/instituciones/$id_user", $nombre_logo);

            //capturar la fotp
            $basico->logo = "img/instituciones/$id_user/" . $nombre_logo;
        }

        if(!empty($request->file('imagen_institucion')))
        {
            $imagen = $request->file('imagen_institucion');

            /*captura el nombre del logo*/
            $nombre_imagen = $imagen->getClientOriginalName();

            /*guarda la imagen en carpeta con el id del usuario*/
            $imagen->move("img/instituciones/$id_user", $nombre_imagen);

            //capturar la fotp
            $basico->imagen = "img/instituciones/$id_user/" . $nombre_imagen;
        }

        //guardar basico
        $basico->save();

        return response([
            'mensaje' => 'Se guardo correctamente la información'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 1----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 2----------------------*/
    protected function create2(Request $request){

        $validation = Validator::make($request->all(), [
            'celular'       => ['required', 'size:10'],
            'telefono'      => ['required', 'size:7'],
            'direccion'     => ['required'],
            'pais'          => ['required', 'exists:pais,id_pais'],
            'departamento'  => ['required', 'exists:departamentos,id_departamento'],
            'provincia'     => ['required', 'exists:provincias,id_provincia'],
            'municipio'     => ['required', 'exists:municipios,id_municipio'],
        ], [], [
            'celular'       => 'Celular',
            'telefono'      => 'Teléfono',
            'direccion'     => 'Dirección',
            'pais'          => 'Pais',
            'departamento'  => 'Departamento',
            'provincia'     => 'Provincia',
            'municipio'     => 'Municipio',
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;

        //Agregar campos
        $conacto = instituciones::where('idUser', '=', $id_user)->first();

        if (empty($conacto))
        {
            return response([
                'mensaje' => 'No existe la institución'
            ], Response::HTTP_NOT_FOUND);
        }

        //guardar la información contacto
        $conacto->telefonouno       = $request->celular;
        $conacto->telefono2         = $request->telefono;
        $conacto->direccion         = $request->direccion;
        $conacto->idPais            = $request->pais;
        $conacto->id_departamento   = $request->departamento;
        $conacto->id_provincia      = $request->provincia;
        $conacto->id_municipio      = $request->municipio;

        //guardar contacto
        $conacto->save();

        return response([
            'mensaje' => 'Se guardo correctamente la información'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 2----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 3----------------------*/
    public function create3(Request $request){

        $validation = Validator::make($request->all(), [
            'descripcion_perfil'       => ['required', 'max:270']
        ], [], [
            'descripcion_perfil'       => 'Servicios profesionales'
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;

        //Agregar campos
        $descripcion = instituciones::where('idUser', '=', $id_user)->first();

        if (empty($descripcion))
        {
            return response([
                'mensaje' => 'No existe la institución'
            ], Response::HTTP_NOT_FOUND);
        }

        //guardar la información contacto
        $descripcion->DescripcionGeneralServicios   = $request->descripcion_perfil;

        //guardar contacto
        $descripcion->save();

        return response([
            'mensaje' => 'Se guardo correctamente la información'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 3----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 4----------------------*/
    public function create4(Request $request){

        $validation = Validator::make($request->all(), [
            'titulo_servicio'       => ['required'],
            'descripcion_servicio'  => ['required', 'max:270'],
            'sucursal_servicio.*'     => ['required'],
        ], [], [
            'titulo_servicio'       => 'Titulo del servicio',
            'descripcion_servicio'  => 'Descripción del servicio',
            'sucursal_servicio.*'     => 'Sedes en la que está el servicio',
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            foreach ($error as $k => $e) $error[$k] = str_replace('.', '-', $e);

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        /*id de la institucion*/
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $servicios = serviciosinstituciones::where('id', '=', $institucion->id)->count();
        if ($servicios >= 6){
            return response()->json([
                'max_items' => true,
                'mensaje' => 'No puede agregar mas servicios'
            ], Response::HTTP_NOT_FOUND);
        }

        //Agregar campos
        $servicio = new serviciosinstituciones();

        //guardar la información del servicio
        $servicio->tituloServicios      = $request->titulo_servicio;
        $servicio->DescripcioServicios  = $request->descripcion_servicio;
        $servicio->sucursalservicio     = implode(', ', $request->sucursal_servicio);
        $servicio->id                   = $institucion->id;

        //guardar contacto
        $servicio->save();

        return response([
            'mensaje'   => 'Se guardo correctamente la información',
            'url'       => route('entidad.delete4', ['id_servicio' => $servicio->id_servicio]),
            'max_items' => $servicios >= 5 // se resta 1 por el nuevo creado
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 4----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 4----------------------*/
    public function delete4(Request $request){
        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        /*id de la institucion*/
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $servicio = serviciosinstituciones::where('id', '=', $institucion->id)
            ->where('id_servicio', '=', $request->id_servicio)
            ->select('id_servicio', 'tituloServicios')
            ->first();

        if (empty($servicio)){
            return response()->json([
                'mensaje' => 'No se encontro el servicio'
            ], Response::HTTP_NOT_FOUND);
        }

        $nombre = $servicio->tituloServicios;
        $servicio->delete();

        return response([
            'mensaje' => 'El servicio ' . $nombre . ' se elimino correctamente'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 4----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 5----------------------*/
    public function create5(Request $request){
        $validation = Validator::make($request->all(), [
            'descripcion_quienes_somos'       => ['required', 'max:500']
        ], [], [
            'descripcion_quienes_somos'       => 'Quienes somos'
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;

        //Agregar campos
        $descripcion = instituciones::where('idUser', '=', $id_user)->first();

        if (empty($descripcion))
        {
            return response([
                'mensaje' => 'No existe la institución'
            ], Response::HTTP_NOT_FOUND);
        }

        //guardar la información quienes somos
        $descripcion->quienessomos   = $request->descripcion_quienes_somos;

        //guardar contacto
        $descripcion->save();

        return response([
            'mensaje' => 'Se guardo correctamente la información'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 5----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 6----------------------*/
    public function create6(Request $request){

        $validation = Validator::make($request->all(), [
            'propuesta_valor'       => ['required', 'max:300']
        ], [], [
            'propuesta_valor'       => 'Quienes somos'
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;

        //Agregar campos
        $descripcion = instituciones::where('idUser', '=', $id_user)->first();

        if (empty($descripcion))
        {
            return response([
                'mensaje' => 'No existe la institución'
            ], Response::HTTP_NOT_FOUND);
        }

        //guardar la información quienes somos
        $descripcion->propuestavalor   = $request->propuesta_valor;

        //guardar contacto
        $descripcion->save();

        return response([
            'mensaje' => 'Se guardo correctamente la información'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 6----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 7----------------------*/
    public function create7(Request $request){

        $validation = Validator::make($request->all(), [
            'tipo_convenio' => ['required', 'exists:tipoinstituciones,id'],
            'logo_convenio' => ['required', 'image']
        ], [], [
            'tipo_convenio' => 'Tipo de convenio',
            'logo_convenio' => 'Logo del convenio'
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $convenios = Convenios::where('id_institucion', '=', $institucion->id)->count();
        if ($convenios >= 9){
            return response()->json([
                'max_items' => true,
                'mensaje' => 'No puede agregar mas convenios'
            ], Response::HTTP_NOT_FOUND);
        }

        //Crear el convenio
        $convenio = new Convenios();
        $convenio->id_tipo_convenio = $request->tipo_convenio;
        $convenio->id_institucion   = $institucion->id;

        $logo = $request->file('logo_convenio');
        $nombre_logo = 'convenio-' . time() . '.' . $logo->guessExtension();

        /*guarda la imagen en carpeta con el id del usuario*/
        $logo->move("img/instituciones/$id_user", $nombre_logo);

        //capturar la fotp
        $convenio->url_image = "img/instituciones/$id_user/" . $nombre_logo;

        //guardar basico
        $convenio->save();

        return response([
            'mensaje'   => 'Se guardo correctamente la información',
            'url'       => route('entidad.delete7', ['id_convenio' => $convenio->id]),
            'image'     => asset($convenio->url_image),
            'max_items' => $convenios >= 8 // Se le resta 1 porque se agregó 1
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 7----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 7----------------------*/

    public function delete7(Request $request){
        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        /*id de la institucion*/
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si eta vacio
        $convenio = Convenios::where('id_institucion', '=', $institucion->id)
            ->where('id', '=', $request->id_convenio)
            ->select('id', 'url_image')
            ->first();

        if (empty($convenio)){
            return response()->json([
                'mensaje' => 'No se encontro el servicio'
            ], Response::HTTP_NOT_FOUND);
        }

        $logo = $convenio->url_image;
        $convenio->delete();

        //eliminar la foto
        if (@getimagesize(public_path() . "/" . $logo)) unlink(public_path() . "/" . $logo);

        return response([
            'mensaje' => 'El convenio se elimino correctamente'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 7 donde se unifica eps ips y prepagada----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 8----------------------*/
    public function create8(Request $request){

        $validation = Validator::make($request->all(), [
            'foto_profecional' => ['required', 'image'],
            'primer_nombre_profecional' => ['required'],
            'primer_apellido_profecional' => ['required'],
            'universidad' => ['required', 'exists:universidades,id_universidad'],
            'especialidad' => ['required', 'exists:especialidades,idEspecialidad'],
        ], [], [
            'foto_profecional' => 'Foto del profesional',
            'primer_nombre_profecional' => 'Primer nombre del profesional',
            'primer_apellido_profecional' => 'Primer apellido del profesional',
            'universidad' => 'Universidad',
            'especialidad' => 'Especialidad'
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $profesionales = profesionales_instituciones::where('id_institucion', '=', $institucion->id)->count();
        if ($profesionales >= 3){
            return response()->json([
                'max_items' => true,
                'mensaje' => 'No puede agregar mas convenios'
            ], Response::HTTP_NOT_FOUND);
        }

        //Crear el profesional
        $profesional = new profesionales_instituciones();
        $profesional->primer_nombre     = $request->primer_nombre_profecional;
        $profesional->segundo_nombre    = $request->segundo_nombre_profecional;
        $profesional->primer_apellido   = $request->primer_apellido_profecional;
        $profesional->segundo_apellido  = $request->segundo_apellido_profecional;
        $profesional->id_institucion    = $institucion->id;

        $foto = $request->file('foto_profecional');
        $nombre_foto = 'profesional-' . time() . '.' . $foto->guessExtension();

        /*guarda la imagen en carpeta con el id del usuario*/
        $foto->move("img/instituciones/$id_user", $nombre_foto);

        //capturar la fotp
        $profesional->foto_perfil_institucion = "img/instituciones/$id_user/" . $nombre_foto;

        //guardar profesional
        $profesional->save();

        return response([
            'mensaje'   => 'Se guardo correctamente la información',
            'url'       => route('entidad.delete8', ['id_profesional' => $profesional->id_profesional_inst]),
            'image'     => asset($profesional->foto_perfil_institucion),
            'max_items' => $profesionales >= 2 // Se le resta 1 porque se agregó 1
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 8----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario 8 ----------------------*/
    public function delete8(Request $request){

        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        /*id de la institucion*/
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $profesional = profesionales_instituciones::where('id_institucion', '=', $institucion->id)
            ->where('id_profesional_inst', '=', $request->id_profesional)
            ->select('id_profesional_inst', 'primer_nombre', 'primer_apellido', 'foto_perfil_institucion')
            ->first();

        if (empty($profesional)){
            return response()->json([
                'mensaje' => 'No se encontro el servicio'
            ], Response::HTTP_NOT_FOUND);
        }

        $nombre = $profesional->primer_nombre . ' ' . $profesional->primer_apellido;
        $foto   = $profesional->foto_perfil_institucion;
        $profesional->delete();

        //eliminar la foto
        if (@getimagesize(public_path() . "/" . $foto)) unlink(public_path() . "/" . $foto);

        return response([
            'mensaje' => 'El profesional ' . $nombre . ' se elimino correctamente'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 8----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 9----------------------*/
    public function create9(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image_certificado' => ['required', 'image'],
            'fecha_certificado' => ['required', 'date_format:Y-m-d'],
            'titulo_certificado' => ['required'],
            'descripcion_certificacion' => ['required', 'max:160']
        ], [], [
            'image_certificado' => 'Imagen del certificado',
            'fecha_certificado' => 'Fecha del certificado',
            'titulo_certificado' => 'Titulo del certificado',
            'descripcion_certificacion' => 'Descripción del certificado'
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $certificaciones = certificaciones::where('id_institucion', '=', $institucion->id)->count();
        if ($certificaciones >= 4){
            return response()->json([
                'max_items' => true,
                'mensaje' => 'No puede agregar mas convenios'
            ], Response::HTTP_NOT_FOUND);
        }

        //Crear el profesional
        $certificaion = new certificaciones();
        $certificaion->fechacertificado         = $request->fecha_certificado;
        $certificaion->titulocertificado        = $request->titulo_certificado;
        $certificaion->descrpcioncertificado    = $request->descripcion_certificacion;
        $certificaion->id_institucion           = $institucion->id;

        $image = $request->file('image_certificado');
        $nombre_image = 'certificado-' . time() . '.' . $image->guessExtension();

        /*guarda la imagen en carpeta con el id del usuario*/
        $image->move("img/instituciones/$id_user", $nombre_image);

        //capturar la fotp
        $certificaion->imgcertificado = "img/instituciones/$id_user/" . $nombre_image;

        //guardar certificacion
        $certificaion->save();

        return response([
            'mensaje'   => 'Se guardo correctamente la información',
            'url'       => route('entidad.delete9', ['id_certificacion' => $certificaion->id_certificacion]),
            'image'     => asset($certificaion->imgcertificado),
            'max_items' => $certificaciones >= 3 // Se le resta 1 porque se agregó 1
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 9----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario 9 ----------------------*/
    public function delete9($id_certificacion){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $certificaciones = certificaciones::where('id_certificacion', $id_certificacion)->where('id_institucion', $idInstitucion);
        $certificaciones->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 9----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 10----------------------*/
    public function create10(Request $request){

        foreach ($request->input('nombre', []) as $i => $tituloServicios) {
            if(!empty($request->input('nombre')[$i])){
                $request->validate([
                    'imgsede.' . $i => ['required', 'image'],
                    'nombre.' . $i => ['required'],
                    'direccion.' . $i => ['required'],
                    'horario_sede.' . $i => ['required'],
                    'telefono.' . $i => ['required']
                ]);
            }
        }

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        unset($request['_token']);
        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        $carpetaDestino = "img/instituciones/$id_user";
        $imgsede = $request->file('imgsede');

        for ($i=0; $i < count(request('nombre')); ++$i){

            if(!empty($request->input('nombre')[$i])){
                sedesinstituciones::create([
                    'idInstitucion' => $idInstitucion,
                    'imgsede' =>"img/instituciones/$id_user/".$imgsede[$i]->getClientOriginalName(),
                    'nombre' => $request->input('nombre')[$i],
                    'direccion' => $request->input('direccion')[$i],
                    'horario_sede' => $request->input('horario_sede')[$i],
                    'telefono' => $request->input('telefono')[$i],
                ]);
                $imgsede[$i]->move($carpetaDestino , $imgsede[$i]->getClientOriginalName());
            }
        }

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 10----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario 10 ----------------------*/
    public function delete10($id){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $sedesinstituciones = sedesinstituciones::where('id', $id)->where('idInstitucion', $idInstitucion);
        $sedesinstituciones->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 10----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 11----------------------*/
    public function create11(Request $request){


        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);
        unset($request['updated_at']);
        unset($request['created_at']);
        instituciones::where('idUser', $id_user)->update($request->all());

        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 11----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 12----------------------*/
    public function create12(Request $request){

        foreach ($request->input('nombrefoto', []) as $i => $tituloServicios) {
            if(!empty($request->input('nombrefoto')[$i])){
                $request->validate([
                    'imggaleria.' . $i => ['required', 'image'],
                    'nombrefoto.' . $i => ['required'],
                    'descripcion.' . $i => ['required'],
                    'fechagaleria.' . $i => ['required'],
                ]);
            }
        }

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        $carpetaDestino = "img/instituciones/$id_user";
        $imggaleria = $request->file('imggaleria');
        for ($i=0; $i < count(request('nombrefoto')); ++$i){
            if(!empty($request->input('nombrefoto.'.$i))){
                galerias::create([
                    'idinstitucion' => $idInstitucion,
                    'nombrefoto' => $request->input('nombrefoto')[$i],
                    'fechagaleria' => $request->input('fechagaleria')[$i],
                    'imggaleria' =>"img/instituciones/$id_user/".$imggaleria[$i]->getClientOriginalName(),
                    'descripcion' => $request->input('descripcion')[$i],
                ]);
                $imggaleria[$i]->move($carpetaDestino , $imggaleria[$i]->getClientOriginalName());
            }
        }

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 12----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 12----------------------*/
    public function delete12($id_galeria){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $galeria = galerias::where('id_galeria', $id_galeria)->where('idinstitucion', $idInstitucion);
        $galeria->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 12----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 13----------------------*/
    public function create13(Request $request){

        foreach ($request->input('nombrevideo', []) as $i => $v) {
            if(!empty($request->input('nombrevideo')[$i])){
                $request->validate([
                    'nombrevideo.' . $i => ['required'],
                    'descripcionvideo.' . $i => ['required'],
                    'urlvideo.' . $i => ['required'],
                    'fechavideo.' . $i => ['required'],
                ]);
            }
        }


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }



        for ($i=0; $i < count(request('nombrevideo')); ++$i){
            if(!empty($request->input('nombrevideo.'.$i))){
                videos::create([
                    'idinstitucion' => $idInstitucion,
                    'nombrevideo' => $request->input('nombrevideo')[$i],
                    'descripcionvideo' => $request->input('descripcionvideo')[$i],
                    'urlvideo' => $request->input('urlvideo')[$i],
                    'fechavideo' => $request->input('fechavideo')[$i],
                ]);
            }
        }

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 13----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 13----------------------*/
    public function delete13($id){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $videos = videos::where('id', $id)->where('idinstitucion', $idInstitucion);
        $videos->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 13----------------------*/
}
