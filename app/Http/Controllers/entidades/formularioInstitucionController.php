<?php

namespace App\Http\Controllers\entidades;
use App\Http\Controllers\Controller;
use App\Models\Convenios;
use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\instituciones;
use App\Models\tipoinstituciones;
use App\Models\serviciosinstituciones;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

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
        $objServicio        = $this->cargaServicios($id_user);
        $objCertificaciones = $this->cargaCertificaciones($id_user);
        $objSedes           = $this->cargaSedes($id_user);
        $objGaleria         = $this->cargaGaleria($id_user);
        $objVideo           = $this->cargaVideo($id_user);


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

        $is_asociacion = $this->is_asociacion();
        $tipo_documentos = TipoDocumento::query()->get();
        $paises = pais::all();

        return view('instituciones.FormularioInstitucion',compact(
            'tipoinstitucion',
            'objuser',
            'listaPaises',
            'listaDepartamentos',
            'listaProvincias',
            'listaMunicipios',
            'objFormulario',
            'objServicio',
            'objConvenios',
            'objTipoConvenios',
            'objProfesionalesIns',
            'objCertificaciones',
            'objSedes',
            'objGaleria',
            'objVideo',
            'tipo_documentos',
            'is_asociacion',
            'paises'
        ));
    }


    private function is_asociacion()
    {
        return 9 == auth()->user()->institucion->idtipoInstitucion;
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


    /*------------inicio busquedad datos basicos usuario logueado y data resgistrada de la institucion-----------------*/

    public function cargaDatosUser($id_user){
        return DB::select("SELECT us.nombreinstitucion, us.numerodocumento
    FROM users us
    WHERE id=$id_user");
    }

    public function cargaFormulario($id_user){
        return DB::select("SELECT ins.imagen, ins.logo, ins.quienessomos,  ins.DescripcionGeneralServicios, ins.idtipoInstitucion,
    ins.url, ins.fechainicio, ins.telefonouno,  ins.telefono2, ins.direccion, ins.propuestavalor,
    p.id_pais,p.nombre, de.id_departamento, de.nombre,ins.url_maps, ins.slug,
    prv.id_provincia,prv.nombre, mu.id_municipio, mu.nombre, us.tipodocumento, us.numerodocumento
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


    public function  cargaProfeInsti($id_user){
        return DB::select("SELECT pin.id_profesional_inst, pin.primer_nombre,pin.segundo_nombre,pin.primer_apellido,
    pin.segundo_apellido,pin.especialidad_uno,pin.especialidad_dos, pin.foto_perfil_institucion
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  profesionales_instituciones pin ON ins.id= pin.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function  cargaCertificaciones($id_user){
        return DB::select("SELECT cr.id_certificacion, cr.imgcertificado, cr.fechacertificado, cr.titulocertificado, cr.descrpcioncertificado
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  certificaciones cr ON ins.id= cr.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function  cargaSedes($id_user){
        return DB::select("SELECT si.id,si.imgsede,si.nombre,si.direccion,si.horario_sede,si.telefono, si.url_map
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  sedesinstituciones si ON ins.id= si.idInstitucion
    WHERE ins.idUser=$id_user");
    }

    public function  cargaGaleria($id_user){
        return DB::select("SELECT g.id_galeria, g.imggaleria, g.nombrefoto, g.descripcion, g.fechagaleria
    FROM  instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  galerias g ON ins.id = g.idinstitucion
    WHERE ins.idUser=$id_user");
    }

    public function  cargaVideo($id_user){
        return DB::select("SELECT v.id, v.nombrevideo, v.descripcionvideo,
    REPLACE(v.urlvideo, '/watch?v=', '/embed/') AS urlvideo, v.fechavideo
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    INNER JOIN  videos v ON ins.id= v.idinstitucion
    WHERE ins.idUser=$id_user");
    }
    /*------------Fin busquedad datos basicos usuario logueado y data resgistrada de la institucion-----------------*/


    /*-------------------------------------Creacion y/o modificacion formulario parte 1----------------------*/
    protected function create1(Request $request){

        $validation = Validator::make($request->all(), [
            'nombre_institucion'        => ['required'],
            'fecha_inicio_institucion'  => ['required', 'date_format:Y-m-d'],
            'url_institucion'           => ['required', 'url'],
            'tipo_institucion'          => ['required', 'exists:tipoinstituciones,id'],
            'logo_institucion'          => ['image'],
            'imagen_institucion'        => ['image'],
        ], [], [
            'nombre_institucion'        => 'Nombre',
            'fecha_inicio_institucion'  => 'Fecha de inicio',
            'url_institucion'           => 'Pagina web',
            'tipo_institucion'          => 'Tipo de institución',
            'logo_institucion'          => 'Logo de la institución',
            'imagen_institucion'        => 'Imagen de la institución',
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
            'celular'       => ['required', 'min:7', 'max:10'],
            'telefono'      => ['min:7', 'max:10'],
            'direccion'     => ['required'],
            'pais'          => ['required', 'exists:pais,id_pais'],
            'departamento'  => ['required', 'exists:departamentos,id_departamento'],
            'provincia'     => ['required', 'exists:provincias,id_provincia'],
            'tipo_identificacion'   => ['required', 'exists:tipo_documentos,id'],
            'numero_identificacion' => ['required'],
            'municipio'     => ['required', 'exists:municipios,id_municipio'],
        ], [], [
            'celular'       => 'Celular',
            'telefono'      => 'Teléfono',
            'direccion'     => 'Dirección',
            'pais'          => 'Pais',
            'departamento'  => 'Departamento',
            'provincia'     => 'Provincia',
            'tipo_identificacion'   => 'Tipo de identificación',
            'numero_identificacion' => 'Número de identificación',
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

        //Guardar número de identificación
        $user = auth()->user();
        $user->update([
            'tipodocumento'     => $request->tipo_identificacion,
            'numerodocumento'   => $request->numero_identificacion,
        ]);

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



    /*-------------------------------------Llamar a profesional formulario parte 8----------------------*/
    public function get8(Request $request)
    {
        $profesional = profesionales_instituciones::query()
            ->with(['especialidades', 'universidad'])
            ->where('id_profesional_inst', '=', $request->id)
            ->first();

        $profesional->foto_perfil_institucion = asset($profesional->foto_perfil_institucion);
        return response(['profesional' => $profesional], Response::HTTP_OK);
    }
    /*-------------------------------------fin a profesional formulario parte 8----------------------*/
    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 8----------------------*/
    public function create8(Request $request){

        //validar foto si es editar o crear
        $foto_validate = ($request->id_profesional == null) ? ['required', 'image'] : ['image'];
        //dd($request->all());

        $validation = Validator::make($request->all(), [
            //'id_profesional' => ['required'],
            'foto_profecional' => $foto_validate,
            'primer_nombre_profecional'     => ['required'],
            'primer_apellido_profecional'   => ['required'],
            'universidad'   => ['required', 'exists:universidades,id_universidad'],
            'especialidad.*'  => ['required','exists:especialidades,idEspecialidad'],
            'cargo_profesional' => ['max:30'],
        ], [], [
            //'id_profesional' => 'Foto del profesional',
            'foto_profecional' => 'Foto del profesional',
            'primer_nombre_profecional' => 'Primer nombre del profesional',
            'primer_apellido_profecional' => 'Primer apellido del profesional',
            'universidad' => 'Universidad',
            'especialidad.*' => 'Especialidad',
            'cargo_profesional' => 'Cargo',
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
        if ($profesionales >= 3 and !$this->is_asociacion()){
            return response()->json([
                'max_items' => true,
                'mensaje' => 'No puede agregar mas convenios'
            ], Response::HTTP_NOT_FOUND);
        }

        $array = [
            'id_profesional_inst'   => $request->id_profesional,
            'primer_nombre'     => $request->primer_nombre_profecional,
            'segundo_nombre'    => $request->segundo_nombre_profecional,
            'primer_apellido'   => $request->primer_apellido_profecional,
            'segundo_apellido'  => $request->segundo_apellido_profecional,
            'cargo'             => $request->cargo_profesional,
            //'id_institucion'    => $institucion->id,
            'id_universidad'    => $request->universidad,
        ];

        //Crear el profesional
        $profesional = profesionales_instituciones::query()->updateOrCreate(
            ['id_profesional_inst' => $request->id_profesional, 'id_institucion' => $institucion->id],
            $array
        );

//        $profesional->primer_nombre     = $request->primer_nombre_profecional;
//        $profesional->segundo_nombre    = $request->segundo_nombre_profecional;
//        $profesional->primer_apellido   = $request->primer_apellido_profecional;
//        $profesional->segundo_apellido  = $request->segundo_apellido_profecional;
//        $profesional->cargo             = $request->cargo_profesional;
//        $profesional->id_institucion    = $institucion->id;
//        $profesional->id_universidad    = $request->universidad;
        //$profesional->id_especialidad   = $request->especialidad;

        if ($request->id_profesional == null or $request->file('foto_profecional'))
        {
            //eliminar foto si existe
            //$ruta_foto = asset($profesional->foto_perfil_institucion);
            //if (@getimagesize($ruta_foto)) unlink($ruta_foto);

            //dd($ruta_foto);

            $foto = $request->file('foto_profecional');
            $nombre_foto = 'profesional-' . time() . '.' . $foto->guessExtension();

            /*guarda la imagen en carpeta con el id del usuario*/
            $foto->move("img/instituciones/$id_user/profesionales/", $nombre_foto);

            //capturar la fotp
            $profesional->foto_perfil_institucion = "img/instituciones/$id_user/" . $nombre_foto;

            //guardar profesional
            $profesional->save();
        }

        //Agregar especialidades
        $profesional->especialidades()->sync($request->especialidad);

        return response([
            'mensaje'   => 'Se guardo correctamente la información',
            'url'       => route('entidad.delete8', ['id_profesional' => $profesional->id_profesional_inst]),
            'image'     => asset($profesional->foto_perfil_institucion),
            'id'        => $profesional->id_profesional_inst,
            'edited'    => $request->id_profesional != null,
            'url_edit'  => route('entidad.get8', ['id' => $profesional->id_profesional_inst]),
            'max_items' => $profesionales >= 2 and !$this->is_asociacion()// Se le resta 1 porque se agregó 1
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
    public function delete9(Request $request){

        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        /*id de la institucion*/
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $certificacion = certificaciones::where('id_institucion', '=', $institucion->id)
            ->where('id_certificacion', '=', $request->id_certificacion)
            ->select('id_certificacion', 'titulocertificado', 'imgcertificado')
            ->first();

        if (empty($certificacion)){
            return response()->json([
                'mensaje' => 'No se encontro el servicio'
            ], Response::HTTP_NOT_FOUND);
        }

        $nombre = $certificacion->titulocertificado;
        $foto   = $certificacion->imgcertificado;
        $certificacion->delete();

        //eliminar la foto
        if (@getimagesize(public_path() . "/" . $foto)) unlink(public_path() . "/" . $foto);

        return response([
            'mensaje' => 'La certificación ' . $nombre . ' se elimino correctamente'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 9----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 10----------------------*/
    public function create10(Request $request){

        $validation = Validator::make($request->all(), [
            'img_sede'     => ['required', 'image'],
            'nombre_sede'   => ['required'],
            'direccion_sede'=> ['required'],
            'horario_sede'  => ['required'],
            'telefono_sede' => ['required', 'min:7'],
            'pais_id'           => ['required', 'exists:pais,id_pais'],
            'departamento_id'   => ['required', 'exists:departamentos,id_departamento'],
            'provincia_id'      => ['required', 'exists:provincias,id_provincia'],
            'ciudad_id'         => ['required', 'exists:municipios,id_municipio'],
            // 'url_mapa_sede' => ['required', 'url']
        ], [], [
            'img_sede'     => 'Foto de la sede',
            'nombre_sede'   => 'Nombre de la sede',
            'direccion_sede'=> 'Dirección de la sede',
            'horario_sede'  => 'Horario de la sede',
            'telefono_sede' => 'Teléfono de la sede',
            'pais_id'       => 'País',
            'departamento_id' => 'Departamento',
            'provincia_id'  => 'Provincia',
            'ciudad_id'     => 'Ciudad',
            // 'url_mapa_sede' => 'Url de la ubicación de la sede'
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
        $sedes = sedesinstituciones::where('idInstitucion', '=', $institucion->id)->count();
        if ($sedes >= 6){
            return response()->json([
                'max_items' => true,
                'mensaje' => 'No puede agregar mas convenios'
            ], Response::HTTP_NOT_FOUND);
        }

        //Crear el profesional
        $sede   = new sedesinstituciones();
        $sede->nombre       = $request->nombre_sede;
        $sede->direccion    = $request->direccion_sede;
        $sede->horario_sede = $request->horario_sede;
        $sede->telefono     = $request->telefono_sede;
        $sede->url_map      = $request->url_mapa_sede;
        $sede->pais_id      = $request->pais_id;
        $sede->departamento_id  = $request->departamento_id;
        $sede->provincia_id = $request->provincia_id;
        $sede->ciudad_id    = $request->ciudad_id;
        $sede->idInstitucion    = $institucion->id;

        $foto = $request->file('img_sede');
        $nombre_foto = 'sede-' . time() . '.' . $foto->guessExtension();
        /*guarda la imagen en carpeta con el id del usuario*/
        $foto->move("img/instituciones/$id_user", $nombre_foto);

        //capturar la fotp
        $sede->imgsede = "img/instituciones/$id_user/" . $nombre_foto;

        //guardar certificacion
        $sede->save();

        return response([
            'mensaje'   => 'Se guardo correctamente la información',
            'url'       => route('entidad.delete10', ['id' => $sede->id]),
            'image'     => asset($sede->imgsede),
            'max_items' => $sedes >= 5 // Se le resta 1 porque se agregó 1
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 10----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario 10 ----------------------*/
    public function delete10(Request $request){

        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        /*id de la institucion*/
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $sede = sedesinstituciones::where('idInstitucion', '=', $institucion->id)
            ->where('id', '=', $request->id)
            ->select('id', 'imgsede', 'nombre')
            ->first();

        if (empty($sede)){
            return response()->json([
                'mensaje' => 'No se encontro la sede'
            ], Response::HTTP_NOT_FOUND);
        }

        $nombre = $sede->nombre;
        $foto   = $sede->imgsede;
        $sede->delete();

        //eliminar la foto
        if (@getimagesize(public_path() . "/" . $foto)) unlink(public_path() . "/" . $foto);

        return response([
            'mensaje' => 'La sede ' . $nombre . ' se elimino correctamente'
        ], Response::HTTP_OK);

    }
    /*-------------------------------------Fin Eliminacion formulario parte 10----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 11----------------------*/
    public function create11(Request $request){
        $validation = Validator::make($request->all(), [
            'url_map_principal_institucion'       => [/*'required', 'url'*/]
        ], [], [
            'url_map_principal_institucion'       => 'Url de la ubicación principal'
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
        $url_map = instituciones::where('idUser', '=', $id_user)->first(['id', 'url_maps']);

        if (empty($url_map))
        {
            return response([
                'mensaje' => 'No existe la institución'
            ], Response::HTTP_NOT_FOUND);
        }

        // Ubicación de la institución principal por medio de coordenadas
        $coor = array ("lat"=> $request->coordenada_lat, "lon" => $request->get("coordenada_long"));

        // Guardar la ubicación de la sede principal de la institución
        $url_map->url_maps   = json_encode($coor);

        //guardar contacto
        $url_map->save();

        return response([
            'mensaje' => 'Se guardo correctamente la información'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 11----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 12----------------------*/
    public function create12(Request $request){

        $validation = Validator::make($request->all(), [
            'img_galeria_institucion'           => ['required', 'image'],
            'fecha_galeria_institucion'         => ['required', 'date_format:Y-m-d'],
            'nombre_galeria_institucion'        => ['required'],
            'descripcion_galeria_institucion'   => ['required', 'max:160']
        ], [], [
            'img_galeria_institucion'           => 'Foto',
            'fecha_galeria_institucion'         => 'Fecha de la foto',
            'nombre_galeria_institucion'        => 'Nombre de la foto',
            'descripcion_galeria_institucion'   => 'Descripción de la foto'
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
//        $galeria = galerias::where('idInstitucion', '=', $institucion->id)->count();
//        if ($galeria >= 8){
//            return response()->json([
//                'max_items' => true,
//                'mensaje' => 'No puede agregar mas fotos'
//            ], Response::HTTP_NOT_FOUND);
//        }

        //Crear el profesional
        $foto   = new galerias();
        $foto->fechagaleria = $request->fecha_galeria_institucion;
        $foto->nombrefoto   = $request->nombre_galeria_institucion;
        $foto->descripcion  = $request->descripcion_galeria_institucion;
        $foto->idinstitucion = $institucion->id;

        $img = $request->file('img_galeria_institucion');
        $nombre_img = 'sede-' . time() . '.' . $img->guessExtension();
        /*guarda la imagen en carpeta con el id del usuario*/
        $img->move("img/instituciones/$id_user", $nombre_img);

        //capturar la fotp
        $foto->imggaleria = "img/instituciones/$id_user/" . $nombre_img;

        //guardar certificacion
        $foto->save();

        return response([
            'mensaje'   => 'Se guardo correctamente la información',
            'url'       => route('entidad.delete12', ['id' => $foto->id_galeria]),
            'image'     => asset($foto->imggaleria),
            //'max_items' => $galeria >= 7 // Se le resta 1 porque se agregó 1
            'max_items' => false // Se le resta 1 porque se agregó 1
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 12----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 12----------------------*/
    public function delete12(Request $request){
        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        /*id de la institucion*/
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $foto = galerias::where('idinstitucion', '=', $institucion->id)
            ->where('id_galeria', '=', $request->id)
            ->select('id_galeria', 'nombrefoto', 'imggaleria')
            ->first();

        //dd($request->id);

        if (empty($foto)){
            return response()->json([
                'mensaje' => 'No se encontro la foto'
            ], Response::HTTP_NOT_FOUND);
        }

        $nombre = $foto->nombrefoto;
        $img   = $foto->imggaleria;

        $foto->delete();
        //dd($foto->delete());

        //eliminar la foto
        if (@getimagesize(public_path() . "/" . $img)) unlink(public_path() . "/" . $img);

        return response([
            'mensaje' => 'La foto ' . $nombre . ' se elimino correctamente'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 12----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 13----------------------*/
    public function create13(Request $request){

        $validation = Validator::make($request->all(), [
            'url_video_institucion'           => ['required', 'url'],
            'fecha_video_institucion'         => ['required', 'date_format:Y-m-d'],
            'nombre_video_institucion'        => ['required'],
            'descripcion_video_institucion'   => ['required', 'max:160']
        ], [], [
            'url_video_institucion'           => 'Url del video',
            'fecha_video_institucion'         => 'Fecha del video',
            'nombre_video_institucion'        => 'Nombre del video',
            'descripcion_video_institucion'   => 'Descripción del video'
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
//        $videos = videos::where('idinstitucion', '=', $institucion->id)->count();
//        if ($videos >= 4){
//            return response()->json([
//                'max_items' => true,
//                'mensaje' => 'No puede agregar mas fotos'
//            ], Response::HTTP_NOT_FOUND);
//        }

        //Crear el profesional
        $video   = new videos();
        $video->urlvideo           = $request->url_video_institucion;
        $video->fechavideo         = $request->fecha_video_institucion;
        $video->nombrevideo        = $request->nombre_video_institucion;
        $video->descripcionvideo   = $request->descripcion_video_institucion;
        $video->idinstitucion      = $institucion->id;

        //guardar video
        $video->save();

        return response([
            'mensaje'   => 'Se guardo correctamente la información',
            'url'       => route('entidad.delete13', ['id' => $video->id]),
            //'max_items' => $videos >= 3 // Se le resta 1 porque se agregó 1
            'max_items' => false
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 13----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 13----------------------*/
    public function delete13(Request $request){
        /*id usuario logueado*/
        $id_user = auth()->user()->id;
        /*id de la institucion*/
        $institucion = instituciones::where('idUser', '=', $id_user)->select('id')->first();

        //Validar si se llego al maximo de items
        $video = videos::where('idinstitucion', '=', $institucion->id)
            ->where('id', '=', $request->id)
            ->select('id', 'nombrevideo')
            ->first();

        if (empty($video)){
            return response()->json([
                'mensaje' => 'No se encontro el video'
            ], Response::HTTP_NOT_FOUND);
        }

        $nombre = $video->nombrevideo;
        $video->delete();

        return response([
            'mensaje' => 'El video ' . $nombre . ' se elimino correctamente'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 13----------------------*/

    //Guardar la información basica del paciente
    public function password(Request $request)
    {
        //validar el formulario
        $validator = Validator::make($request->all(),[
            'password'          => ['required'],
            'password_new'      => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            $men = $validator->errors()->all();
            $error = array_keys($validator->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Ingrese correctamente la información'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //Revisar si es la clave
        if (!Auth::attempt(['email' => auth()->user()->email, 'password' => $request->password]))
        {
            return response([
                'mensaje' => 'Ingrese correctamente la contraseña'
            ], Response::HTTP_NOT_FOUND);
        }


        //Modificar la contraseña del usuario
        $user           = User::find(auth()->user()->id);
        $user->password = Hash::make($request->password_new);
        $user->save();

        return response()->json([
            'mensaje' => 'Se modifico la contraseña correctamente.'
        ], Response::HTTP_OK);
    }
}
