<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use App\Models\destacados;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use App\Models\perfilesprofesionales;
use App\Models\pais;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\provincia;
use App\Models\areas;
use App\Models\profesiones;
use App\Models\especialidades;
use App\Models\User;
use App\Models\universidades;
use App\Models\perfilesprofesionalesuniversidades;
use App\Models\tipoconsultas;
use App\Models\experiencias;
use App\Models\asociaciones;
use App\Models\usuario_idiomas;
use App\Models\idiomas;
use App\Models\tratamientos;
use App\Models\premios;
use App\Models\publicaciones;
use App\Models\galerias;
use App\Models\videos;
use File;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class formularioProfesionalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(){

        if (Auth::check()){
            $id_user=auth()->user()->id;/*id usuario logueado*/

            //Crear el registro de perfil profesional si no existe
            $pro = perfilesprofesionales::where('idUser', '=', $id_user)->select('idPerfilProfesional')->first();
            if (empty($pro))
            {
                $pro = new perfilesprofesionales(['idUser' => $id_user]);
                $pro->save();
            }

            /*crea una nueva carpeta con el id del perfil nuevo*/
            $path = public_path().'img/user/' . $id_user;
            if (!File::exists($path)) {
                File::makeDirectory($path,  0777, true);
            }

            $objFormulario = $this->cargaFormulario($id_user);
            $objFormulario = $objFormulario[0];

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

            //Lista de areas
            $area = areas::all();

            //Llamar la lista de profesion según la seleccion del area
            if  (!is_null($objFormulario->idarea)) {
                $profesiones = profesiones::where('idArea', '=', $objFormulario->idarea)->get();
                //dd($profesiones);
            }

            //Llamar la lista de profecion segun la seleccion de la profecion
            if  (!is_null($objFormulario->idprofesion)) {
                $especialidades = especialidades::where('idProfesion', '=', $objFormulario->idprofesion)->get();
            }

            //resetera si no existe lista
            if (!isset($profesiones)) $profesiones = null;
            if (!isset($especialidades)) $especialidades = null;

            //Contar los destacables
            $id_profesional = auth()->user()->profecional->idPerfilProfesional;
            $destacables_count = destacados::where('idPerfilProfesional', '=', $id_profesional)->count();
            $destacables = destacados::where('idPerfilProfesional', '=', $id_profesional)->get();

            $universidades = universidades::all();
            $idiomas = idiomas::all();

            //Ojetos para la vista
            $objuser            = $this->cargaDatosUser($id_user);
            $objConsultas       = $this->cargaConsultas($id_user);
            $objEducacion       = $this->cargaEducacion($id_user);
            $objExperiencia     = $this->cargaExperiencia($id_user);
            $objAsociaciones    = $this->cargaAsociaciones($id_user);
            $objIdiomas         = $this->cargaIdiomas($id_user);
            $objTratamiento     = $this->cargaTratamiento($id_user);
            $objPremios         = $this->cargaPremios($id_user);
            $Publicaciones      = $this->cargaPublicaciones($id_user);
            $objGaleria         = $this->cargaGaleria($id_user);
            $objVideo           = $this->cargaVideo($id_user);


            return view('profesionales.FormularioProfesional',compact(
                'objuser',
                'area',
                'profesiones',
                'especialidades',
                'listaPaises',
                'listaDepartamentos',
                'listaProvincias',
                'listaMunicipios',
                'idiomas',
                'universidades',
                'objFormulario',
                'objConsultas',
                'objEducacion',
                'objExperiencia',
                'objAsociaciones',
                'objIdiomas',
                'objTratamiento',
                'objPremios',
                'Publicaciones',
                'objGaleria',
                'objVideo',
                'destacables_count',
                'destacables'
            ));

        }else{
            return redirect()->guest('/login');
        }
    }



    /*------------------------------------- inicio json busqueda area. profesion y especialidad----------------------*/

    public function getprofesion(Request $request){
        $profesion = profesiones::where("idArea",$request->idArea)->get();
        return response()->json($profesion);
    }
    public function getespecialidad(Request $request){
        $especialidad = especialidades::where("idProfesion",$request->idProfesion)->get();
        return response()->json($especialidad);
    }
    /*------------------------------------- fin json busqueda area. profesion y especialidad----------------------*/



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


    /*------------------------------------- Inicio búsqueda auto completado universidad----------------------*/

    public function buscar_universidad(Request $request)
    {
        //validar el formulario
        $validator = Validator::make($request->all(),[
            'searchTerm' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la búsqueda'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $universidades = universidades::where('nombreuniversidad','like','%' . $request->searchTerm . '%')
            ->select('id_universidad as id', 'nombreuniversidad as text')
            ->orderBy('nombreuniversidad','ASC')
            ->get();

        return response()->json($universidades);
    }
    /*------------------------------------- Fin búsqueda auto completado universidad----------------------*/




    /*------------inicio busquedad datos basicos usuario logueado y data resgistrada del proesional-----------------*/

    public function cargaDatosUser($id_user){
        return DB::select("SELECT us.primernombre, us.segundonombre, us.primerapellido, us.segundoapellido
        FROM users us
        WHERE id=$id_user");
    }


    public function cargaFormulario($id_user){
        return DB::select("SELECT pf.direccion,  pf.genero, pf.EmpresaActual, pf.celular, pf.telefono,
    pf.fotoperfil, pf.fechanacimiento, pf.numeroTarjeta, pf.entidadCertificoTarjeta,
    pf.descripcionPerfil,ar.idarea, ar.nombreArea ,pr.idprofesion, pr.nombreProfesion,
    ep.idEspecialidad,  ep.nombreEspecialidad, p.id_pais, p.nombre nombrePais, de.id_departamento, de.nombre nombreDepartamento,
    prv.id_provincia, prv.nombre nombreProvincia, mu.id_municipio, mu.nombre nombreMunicipio, u.id_universidad ,u.nombreuniversidad
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  areas ar ON pf.idarea= ar.idArea
    LEFT JOIN  profesiones pr ON pf.idprofesion= pr.idProfesion
    LEFT JOIN  especialidades ep ON pf.idespecialidad= ep.idEspecialidad
    LEFT JOIN  pais p ON pf.idpais=p.id_pais
    LEFT JOIN  departamentos de ON pf.id_departamento= de.id_departamento
    LEFT JOIN  provincias prv ON pf.id_provincia= prv.id_provincia
    LEFT JOIN  municipios mu ON pf.id_municipio= mu.id_municipio
    LEFT JOIN  universidades u ON pf.id_universidad= u.id_universidad
    WHERE us.id=$id_user");
    }

    public function cargaConsultas($id_user){
        return DB::select("	SELECT tc.id, tc.nombreconsulta, tc.valorconsulta
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  tipoconsultas tc ON pf.idPerfilProfesional= tc.idperfil
    WHERE pf.idUser=$id_user");
    }

    public function cargaEducacion($id_user){
        return DB::select("SELECT pu.id_universidadperfil, u.nombreuniversidad, pu.fechaestudio,pu.nombreestudio
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional= pu.idPerfilProfesional
    LEFT JOIN  universidades u ON pu.id_universidad= u.id_universidad
    WHERE pf.idUser=$id_user");
    }

    public function cargaExperiencia($id_user){
        return DB::select("SELECT ex.idexperiencias, ex.nombreEmpresaExperiencia, ex.descripcionExperiencia,
     ex.fechaInicioExperiencia, ex.fechaFinExperiencia
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  experiencias ex ON pf.idPerfilProfesional= ex.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }


    public function cargaAsociaciones($id_user){
        return DB::select("SELECT aso.idAsociaciones, aso.imgasociacion
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  asociaciones aso ON pf.idPerfilProfesional= aso.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function  cargaIdiomas($id_user){
        return DB::select("SELECT usi.idUsuarioIdiomas, usi.id_idioma, i.nombreidioma, i.imgidioma
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  usuario_idiomas usi ON pf.idPerfilProfesional= usi.idPerfilProfesional
    LEFT JOIN  idiomas i ON usi.id_idioma= i.id_idioma
    WHERE pf.idUser=$id_user");
    }

    public function  cargaTratamiento($id_user){
        return DB::select("SELECT tr.id_tratamiento, tr.imgTratamientoAntes, tr.tituloTrataminetoAntes, tr.descripcionTratamientoAntes, tr.imgTratamientodespues, tr.tituloTrataminetoDespues, tr.descripcionTratamientoDespues
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  tratamientos tr ON pf.idPerfilProfesional= tr.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function  cargaPremios($id_user){
        return DB::select("SELECT pr.id, pr.imgpremio, pr.nombrepremio, pr.descripcionpremio, pr.fechapremio
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  premios pr ON pf.idPerfilProfesional= pr.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function  cargaPublicaciones($id_user){
        return DB::select("SELECT pb.id, pb.nombrepublicacion, pb.descripcion, pb.imgpublicacion
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  publicaciones pb ON pf.idPerfilProfesional= pb.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function  cargaGaleria($id_user){
        return DB::select("SELECT g.id_galeria, g.imggaleria, g.nombrefoto, g.descripcion
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  galerias g ON pf.idPerfilProfesional= g.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function cargaVideo($id_user){
        return DB::select("SELECT v.id, v.nombrevideo, v.descripcionvideo,
     REPLACE(v.urlvideo, '/watch?v=', '/embed/') AS urlvideo, v.fechavideo
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  videos v ON pf.idPerfilProfesional= v.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function contadorVideo($id_user){
        /*cuenta los los valores ingresados*/
        $contadorpublicaciones = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(videos.idPerfilProfesional) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('videos', 'perfilesprofesionales.idPerfilProfesional', '=', 'videos.idPerfilProfesional')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorpublicaciones;
    }

    /*------------ Fin inicio busquedad datos basicos usuario logueado y data resgistrada del proesional-----------------*/


    /*------------ Funcion solo para verificar que perfil existe y esta se utiiliza en las demas-----------------*/
    protected function verificaPerfil(){

        if (Auth::check()){
            /*id usuario logueado*/
            $id_user=auth()->user()->id;

            /*consulta si existe el profesional*/
            $idexisteperfil = DB::table('perfilesprofesionales')
                ->select('idPerfilProfesional')
                ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
                ->where('perfilesprofesionales.idUser', $id_user)
                ->first();
            return $idexisteperfil;
        }else{
            return redirect()->guest('/login');
        }

    }
    /*------------Fin  Funcion solo para verificar que perfil existe y esta se utiiliza en los demas metodos-----------------*/

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Http\JsonResponse
     */


    /*-------------------------------------Creacion y/o modificacion formulario parte 1----------------------*/
    protected function create1(Request $request){


        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'primernombre'      => ['required'],
            'segundonombre'     => ['required'],
            'primerapellido'    => ['required'],
            'segundoapellido'   => ['required'],
            'fechanacimiento'   => ['required', 'date_format:Y-m-d'],
            'idarea'            => ['required', 'exists:areas,idArea'],
            'idprofesion'       => ['required', 'exists:profesiones,idProfesion'],
            'idespecialidad'    => ['required', 'exists:especialidades,idEspecialidad'],
            'id_universidad'    => ['required', 'exists:universidades,id_universidad'],
            'numeroTarjeta'     => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*valido que el profesional no exista para que cree uno nuevo en caso contrario lo modifique */
        if( is_null($verificaPerfil)){
            return response()->json([
                'mensaje' => 'El perfil presenta problemas, comuníquese con soporte técnico '
            ], Response::HTTP_NOT_FOUND);
        }

        //Modificar la información del usuario
        /*id usuario conectado*/
        $id_user=auth()->user()->id;
        //Modificar nombres del usuario\
        $user = User::find($id_user);

        $user->primernombre = $request->primernombre;
        $user->segundonombre = $request->segundonombre;
        $user->primerapellido = $request->primerapellido;
        $user->segundoapellido = $request->segundoapellido;

        $user->save();

        //Información del perfil profesional
        $perfil = perfilesprofesionales::where('idPerfilProfesional', '=', $idProProfesi)->first();

        $perfil->fechanacimiento    = $request->fechanacimiento;
        $perfil->idarea             = $request->idarea;
        $perfil->idprofesion        = $request->idprofesion;
        $perfil->idespecialidad     = $request->idespecialidad;
        $perfil->id_universidad     = $request->id_universidad;
        $perfil->numeroTarjeta      = $request->numeroTarjeta;

        //Validar si llega la imagen
        if(!empty($request->file('logo')))
        {
            $foto_perfil = $request->file('logo');

            /*captura el nombre del logo*/
            $nombre_foto = $id_user . '-' .  time() . '.' . $foto_perfil->guessExtension();

            /*guarda la imagen en carpeta con el id del usuario*/
            $foto_perfil->move("img/user/$id_user", $nombre_foto);

            //capturar la fotp
            $perfil->fotoperfil = "img/user/$id_user/" . $nombre_foto;
        }

        $perfil->save();

        return response()->json([
            'mensaje' => 'Se modifico el perfil correctamente.'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 1----------------------*/






    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 2----------------------*/
    protected function create2(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'celular'           => ['required', 'size:10'],
            'telefono'          => ['required', 'size:7'],
            'direccion'         => ['required'],
            'idpais'            => ['required', 'exists:pais,id_pais'],
            'id_departamento'   => ['required', 'exists:departamentos,id_departamento'],
            'id_provincia'      => ['required', 'exists:provincias,id_provincia'],
            'id_municipio'      => ['required', 'exists:municipios,id_municipio'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //Información del perfil profesional
        $perfil = perfilesprofesionales::where('idPerfilProfesional', '=', $idProProfesi)->first();

        $perfil->celular            = $request->celular;
        $perfil->telefono           = $request->telefono;
        $perfil->direccion          = $request->direccion;
        $perfil->idpais             = $request->idpais;
        $perfil->id_departamento    = $request->id_departamento;
        $perfil->id_provincia       = $request->id_provincia;
        $perfil->id_municipio       = $request->id_municipio;

        $perfil->save();

        return response()->json([
            'mensaje' => 'Se modifico el perfil correctamente.'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 2----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 3----------------------*/
    public function create3(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'tipo_consulta' => ['required', Rule::in(['Presencial', 'Virtual', 'Control médico'])],
            'valor_consulta' => ['required', 'integer', 'min:0', 'max:150000'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'mensaje' => 'Ingrese correctamente la información'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo
        $count = tipoconsultas::where('idperfil', '=', $idProProfesi)->count();

        if ( $count >= 3 ) {
            return response()->json(['mensaje' => 'Ingreso el maximo de items', 'items_max' => true], Response::HTTP_NOT_FOUND);
        }

        //Crear el objeto
        $tipo_consulta = new tipoconsultas();

        //asignar los datos
        $tipo_consulta->nombreconsulta = $request->tipo_consulta;
        $tipo_consulta->valorconsulta = $request->valor_consulta;
        $tipo_consulta->idperfil = $idProProfesi;
        $tipo_consulta->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono el tipo de consulta ' . $request->tipo_consulta,
            'items_max' => $count >= 3,
            'id' => $tipo_consulta->id
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 3----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 3----------------------*/
    public function delete3(Request $request){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }


        $tipo_consulta = tipoconsultas::where('id', $request->id)->where('idperfil', $idProProfesi)->first();

        //validar si se tiene permiso para el registro
        if (empty($tipo_consulta))
        {
            return response()->json(['mensaje' => 'No se encontro el item'], Response::HTTP_NOT_FOUND);
        }

        $nombre = $tipo_consulta->nombreconsulta;
        $tipo_consulta->delete();

        return response()->json(['mensaje' => 'El item ' . $nombre . ' se elimino correctamente'], Response::HTTP_OK);

    }
    /*-------------------------------------Fin Eliminacion formulario parte 3----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 4----------------------*/
    public function create4(Request $request){
        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi = $verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'descripcion_perfil' => ['required', 'max:270'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'mensaje' => 'Ingrese correctamente la información'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //actualizar perfil
        perfilesprofesionales::where('idPerfilProfesional', $idProProfesi)->update(['descripcionPerfil' => $request->descripcion_perfil]);

        return response()->json(['mensaje' => 'Se actualizo el perfil profesional'], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 4----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 5----------------------*/
    public function create5(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'logo_universidad' => ['required', 'image'],
            'universidad_estudio' => ['required', 'exists:universidades,id_universidad'],
            'fecha_estudio' => ['required', 'date_format:Y-m-d'],
            'disciplina_estudio' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información de la universidad'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = perfilesprofesionalesuniversidades::where('idPerfilProfesional', '=', $idProProfesi)->count();

        if ( $count >= 3 ) {
            return response()->json([
                'mensaje' => 'Ingreso el maximo de items',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }

        //Se valida si la universidad ya esta registrada
        /*$val = perfilesprofesionalesuniversidades::where('idPerfilProfesional', '=', $idProProfesi)
            ->where('id_universidadperfil', '=', $request->universidad_estudio)
            ->select()
            ->count();
        if ($val >= 1) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'La universidad ya esta ingresada'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }*/

        //Crear el objeto
        $universidad = new perfilesprofesionalesuniversidades();

        //asignar los datos
        $universidad->id_universidad = $request->universidad_estudio;
        $universidad->nombreestudio = $request->disciplina_estudio;
        $universidad->fechaestudio = $request->fecha_estudio;
        $universidad->idPerfilProfesional = $idProProfesi;

        //manejo de imagen
        $carpetaDestino = "img/user/$id_user";
        $imgUniversidad = $request->file('logo_universidad');

        $universidad->logo_universidad = $carpetaDestino . "/" . "universidad-" . time() . "." . $imgUniversidad->guessExtension();

        $imgUniversidad->move($carpetaDestino , $universidad->logo_universidad);

        $universidad->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono la universidad "' . $universidad->universidad->nombreuniversidad . '"',
            'items_max' => $count >= 3,
            'id' => $universidad->id_universidadperfil,
            'logo' => asset($universidad->logo_universidad),
            'universidad' => $universidad->universidad->nombreuniversidad
        ], Response::HTTP_OK);

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 5----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 5----------------------*/
    public function delete5(Request $request){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el id
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:perfilesprofesionalesuniversidades,id_universidadperfil']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'No se pudo eliminar correctamente'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $universidad = perfilesprofesionalesuniversidades::where('id_universidadperfil', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();

        //validar si se tiene permiso para el registro
        if (empty($universidad))
        {
            return response()->json(['mensaje' => 'No se encontro el item'], Response::HTTP_NOT_FOUND);
        }

        $nombre = $universidad->universidad->nombreuniversidad;
        $imgUniversidad = $universidad->logo_universidad;
        $universidad->delete();

        //eliminar imagenes
        if (@getimagesize(public_path() . "/" . $imgUniversidad)) unlink(public_path() . "/" . $imgUniversidad);

        return response()->json(['mensaje' => 'El item ' . $nombre . ' se elimino correctamente'], Response::HTTP_OK);

    }
    /*-------------------------------------Fin Eliminacion formulario parte 5----------------------*/




    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 6----------------------*/
    public function create6(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'logo_experiencia' => ['required', 'image'],
            'nombre_empresa' => ['required'],
            'descripcion_experiencia' => ['required'],
            'inicio_experiencia' => ['required', 'date_format:Y-m-d'],
            'fin_experiencia' => ['required', 'date_format:Y-m-d'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información de la empresa'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = experiencias::where('idPerfilProfesional', '=', $idProProfesi)->count();

        if ( $count >= 4 ) {
            return response()->json([
                'mensaje' => 'Ingreso el maximo de items',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }

        //Crear el objeto
        $experiencia = new experiencias();

        //asignar los datos
        $experiencia->nombreEmpresaExperiencia = $request->nombre_empresa;
        $experiencia->descripcionExperiencia = $request->descripcion_experiencia;
        $experiencia->fechaInicioExperiencia = $request->inicio_experiencia;
        $experiencia->fechaFinExperiencia = $request->fin_experiencia;
        $experiencia->idPerfilProfesional = $idProProfesi;

        //manejo de imagen
        $carpetaDestino = "img/user/$id_user";
        $imgExperiencia = $request->file('logo_experiencia');

        $experiencia->imgexperiencia = $carpetaDestino . "/" . "experiencia-" . time() . "." . $imgExperiencia->guessExtension();

        $imgExperiencia->move($carpetaDestino , $experiencia->imgexperiencia);

        $experiencia->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono la experiencia de "' . $request->nombre_empresa . '"',
            'items_max' => $count >= 4,
            'id' => $experiencia->idexperiencias,
            'logo' => asset($experiencia->imgexperiencia),
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 6----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 6----------------------*/
    public function delete6(Request $request){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        $experiencia = experiencias::where('idexperiencias', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();

        //validar si se tiene permiso para el registro
        if (empty($experiencia))
        {
            return response()->json(['mensaje' => 'No se encontro el item'], Response::HTTP_NOT_FOUND);
        }

        //Eliminar experiencia
        $nombre = $experiencia->nombreEmpresaExperiencia;
        $imgExperiencia = $experiencia->imgexperiencia;
        $experiencia->delete();

        //eliminar imagenes
        if (@getimagesize(public_path() . "/" . $imgExperiencia)) unlink(public_path() . "/" . $imgExperiencia);

        return response()->json(['mensaje' => 'El item "' . $nombre . '" se elimino correctamente'], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 6----------------------*/




    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 7----------------------*/
    public function create7(Request $request){

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'imagenAsociacion' => ['required', 'image']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la imagen de la asociación'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = asociaciones::where('idPerfilProfesional', '=', $idProProfesi)->count();
        //$count = auth()->user()->profecional->idiomas;

        if ( $count >= 3 ) {
            return response()->json([
                'mensaje' => 'Ingreso el maximo de asociaciones',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }


        //Crear el objeto
        $asociacion = new asociaciones();

        //manejo de imagen
        $carpetaDestino = "img/user/$id_user";
        $imgAsociacion = $request->file('imagenAsociacion');

        $asociacion->idPerfilProfesional = $idProProfesi;
        $asociacion->imgasociacion = $carpetaDestino . "/" . "asociacion-" . time() . "." . $imgAsociacion->guessExtension();

        $imgAsociacion->move($carpetaDestino , $asociacion->imgasociacion);

        $asociacion->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono el tratamiento',
            'items_max' => $count >= 3,
            'imagen' => asset($asociacion->imgasociacion),
            'id' => $asociacion->idAsociaciones,
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 7----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 7----------------------*/
    public function delete7(Request $request){
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:asociaciones,idAsociaciones']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'seleccione correctamente la asociación'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $asociacion = asociaciones::where('idAsociaciones', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();


        //validar si se tiene permiso para el registro
        if (empty($asociacion))
        {
            return response()->json(['mensaje' => 'No se encontro la asociación'], Response::HTTP_NOT_FOUND);
        }

        //imagenes
        $imgAsociacion = $asociacion->imgasociacion;
        $asociacion->delete();

        //eliminar imagenes
        if (@getimagesize(public_path() . "/" . $imgAsociacion)) unlink(public_path() . "/" . $imgAsociacion);

        return response()->json(['mensaje' => 'La Asociacion se elimino correctamente'], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 7----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 8----------------------*/
    public function create8(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'idioma' => ['required', 'exists:idiomas,id_idioma']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'seleccione correctamente la información del idioma'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = usuario_idiomas::where('idPerfilProfesional', '=', $idProProfesi)->count();
        //$count = auth()->user()->profecional->idiomas;

        if ( $count >= 3 ) {
            return response()->json([
                'error' => ['idioma' => ''],
                'mensaje' => 'Ingreso el maximo de idiomas',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }

        //Se valida si el idioma ya esta registrada
        $val = usuario_idiomas::where('idPerfilProfesional', '=', $idProProfesi)
            ->where('id_idioma', '=', $request->idioma)
            ->count();
        if ($val >= 1) {
            return response()->json([
                'error' => ['idioma' => ''],
                'mensaje' => 'El idioma ya esta ingresado'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        //Crear el objeto
        $idioma = new usuario_idiomas();

        //asignar los datos
        $idioma->id_idioma = $request->idioma;
        $idioma->idPerfilProfesional = $idProProfesi;
        $idioma->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono el idioma "' . $idioma->idioma->nombreidioma . '"',
            'items_max' => $count >= 3,
            'idioma' => $idioma->idioma->nombreidioma,
            'image' => asset($idioma->idioma->imgidioma),
            'id' => $idioma->idUsuarioIdiomas,
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 8----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 8----------------------*/
    public function delete8(Request $request){

        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:usuario_idiomas,idUsuarioIdiomas']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'seleccione correctamente la información del idioma'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $usuario_idioma = usuario_idiomas::where('idUsuarioIdiomas', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();


        //validar si se tiene permiso para el registro
        if (empty($usuario_idioma))
        {
            return response()->json(['mensaje' => 'No se encontro el idioma'], Response::HTTP_NOT_FOUND);
        }

        //Eliminar experiencia
        $nombre = $usuario_idioma->idioma->nombreidioma;
        //dd($usuario_idioma);
        $usuario_idioma->delete();

        return response()->json(['mensaje' => 'El idioma "' . $nombre . '" se elimino correctamente'], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 8----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 9----------------------*/
    public function create9(Request $request){

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'imgTratamientoAntes' => ['required', 'image'],
            'tituloTrataminetoAntes' => ['required'],
            'descripcionTratamientoAntes' => ['required', 'max:160'],
            'imgTratamientodespues' => ['required', 'image'],
            'tituloTrataminetoDespues' => ['required'],
            'descripcionTratamientoDespues' => ['required', 'max:160'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información del tratamiento'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = tratamientos::where('idPerfilProfesional', '=', $idProProfesi)->count();
        //$count = auth()->user()->profecional->idiomas;

        if ( $count >= 2 ) {
            return response()->json([
                'mensaje' => 'Ingreso el maximo de tratamientos',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }


        //Crear el objeto
        $tratamineto = new tratamientos();

        //asignar los datos
        $tratamineto->idPerfilProfesional = $idProProfesi;
        $tratamineto->tituloTrataminetoAntes = $request->tituloTrataminetoAntes;
        $tratamineto->descripcionTratamientoAntes = $request->descripcionTratamientoAntes;
        $tratamineto->tituloTrataminetoDespues = $request->tituloTrataminetoDespues;
        $tratamineto->descripcionTratamientoDespues = $request->descripcionTratamientoDespues;

        //manejo de imagen
        $carpetaDestino = "img/user/$id_user";
        $imgTratamientoAntes = $request->file('imgTratamientoAntes');
        $imgTratamientodespues = $request->file('imgTratamientodespues');

        $tratamineto->imgTratamientoAntes = $carpetaDestino . "/" . "antes-" . time() . "." . $imgTratamientoAntes->guessExtension();
        $tratamineto->imgTratamientodespues = $carpetaDestino . "/" . "despues-" . time() . "." . $imgTratamientodespues->guessExtension();

        $imgTratamientoAntes->move($carpetaDestino , $tratamineto->imgTratamientoAntes);
        $imgTratamientodespues->move($carpetaDestino , $tratamineto->imgTratamientodespues);

        $tratamineto->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono el tratamiento',
            'items_max' => $count >= 2,
            'imagen_antes' => asset($tratamineto->imgTratamientoAntes),
            'imagen_despues' => asset($tratamineto->imgTratamientodespues),
            'id' => $tratamineto->id_tratamiento,
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 9----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 9----------------------*/
    public function delete9(Request $request){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:tratamientos,id_tratamiento']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'seleccione correctamente la información del tratamiento'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $tratamineto = tratamientos::where('id_tratamiento', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();


        //validar si se tiene permiso para el registro
        if (empty($tratamineto))
        {
            return response()->json(['mensaje' => 'No se encontro el idioma'], Response::HTTP_NOT_FOUND);
        }
        //imagenes
        $imgTratamientoAntes = $tratamineto->imgTratamientoAntes;
        $imgTratamientodespues = $tratamineto->imgTratamientodespues;

        $tratamineto->delete();

        //eliminar imagenes
        if (@getimagesize(public_path() . "/" . $imgTratamientoAntes)) unlink(public_path() . "/" . $imgTratamientoAntes);
        if (@getimagesize(public_path() . "/" . $imgTratamientodespues)) unlink(public_path() . "/" . $imgTratamientodespues);

        return response()->json(['mensaje' => 'El tratamiento se elimino correctamente'], Response::HTTP_OK);

    }
    /*-------------------------------------Fin Eliminacion formulario parte 9----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 10----------------------*/
    public function create10(Request $request){


        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'imgPremio' => ['required', 'image'],
            'fechaPremio' => ['required', 'date_format:Y-m-d'],
            'nombrePremio' => ['required'],
            'descripcionPremio' => ['required', 'max:160']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información del premio'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = premios::where('idPerfilProfesional', '=', $idProProfesi)->count();
        //$count = auth()->user()->profecional->idiomas;

        if ( $count >= 4 ) {
            return response()->json([
                'mensaje' => 'Ingreso el maximo de tratamientos',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }


        //Crear el objeto
        $premio = new premios();

        //asignar los datos
        $premio->idPerfilProfesional = $idProProfesi;
        $premio->fechapremio = $request->fechaPremio;
        $premio->nombrepremio = $request->nombrePremio;
        $premio->descripcionpremio = $request->descripcionPremio;

        //manejo de imagen
        $carpetaDestino = "img/user/$id_user";
        $imgPremio = $request->file('imgPremio');

        $premio->imgpremio = $carpetaDestino . "/" . "premio-" . time() . "." . $imgPremio->guessExtension();

        $imgPremio->move($carpetaDestino , $premio->imgpremio);

        $premio->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono el tratamiento',
            'items_max' => $count >= 4,
            'imagen' => asset($premio->imgpremio),
            'id' => $premio->id,
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 10----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 10----------------------*/
    public function delete10(Request $request){

        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:premios,id']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'seleccione correctamente el premio'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $premio = premios::where('id', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();


        //validar si se tiene permiso para el registro
        if (empty($premio))
        {
            return response()->json(['mensaje' => 'No se encontro el idioma'], Response::HTTP_NOT_FOUND);
        }
        //imagenes
        $imgPremio = $premio->imgTratamientoAntes;
        $nombre = $premio->nombrepremio;
        $premio->delete();

        //eliminar imagenes
        if (@getimagesize(public_path() . "/" . $imgPremio)) unlink(public_path() . "/" . $imgPremio);

        return response()->json(['mensaje' => 'El premio "' . $nombre . '" se elimino correctamente'], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 10----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 11----------------------*/
    public function create11(Request $request){


        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'imagePublicacion' => ['required', 'image'],
            'nombrePublicacion' => ['required'],
            'descripcionPublicacion' => ['required', 'max:160']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información de la publicación'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = publicaciones::where('idPerfilProfesional', '=', $idProProfesi)->count();
        //$count = auth()->user()->profecional->idiomas;

        if ( $count >= 4 ) {
            return response()->json([
                'mensaje' => 'Ingreso el maximo de publicaciones',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }


        //Crear el objeto
        $publicacion = new publicaciones();

        //asignar los datos
        $publicacion->idPerfilProfesional = $idProProfesi;
        $publicacion->nombrepublicacion = $request->fechaPremio;
        $publicacion->descripcion = $request->descripcionPremio;

        //manejo de imagen
        $carpetaDestino = "img/user/$id_user";
        $imgPublicacion = $request->file('imagePublicacion');

        $publicacion->imgpublicacion = $carpetaDestino . "/" . "publicacion-" . time() . "." . $imgPublicacion->guessExtension();

        $imgPublicacion->move($carpetaDestino , $publicacion->imgpublicacion);

        $publicacion->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono el tratamiento',
            'items_max' => $count >= 4,
            'imagen' => asset($publicacion->imgpublicacion),
            'id' => $publicacion->id,
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 11----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 11----------------------*/
    public function delete11(Request $request){

        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:publicaciones,id']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'seleccione correctamente la publicación'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $publicacion = publicaciones::where('id', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();


        //validar si se tiene permiso para el registro
        if (empty($publicacion))
        {
            return response()->json(['mensaje' => 'No se encontro el idioma'], Response::HTTP_NOT_FOUND);
        }
        //imagenes
        $imgPublicacion = $publicacion->imgpublicacion;
        $nombre = $publicacion->nombrepublicacion;
        $publicacion->delete();

        //eliminar imagenes
        if (@getimagesize(public_path() . "/" . $imgPublicacion)) unlink(public_path() . "/" . $imgPublicacion);

        return response()->json(['mensaje' => 'La publicación "' . $nombre . '" se elimino correctamente'], Response::HTTP_OK);

    }
    /*-------------------------------------Fin Eliminacion formulario parte 11----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 12----------------------*/
    public function create12(Request $request){


        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'imgFoto' => ['required', 'image'],
            'fechaFoto' => ['required', 'date_format:Y-m-d'],
            'nombreFoto' => ['required'],
            'descripcionFoto' => ['required', 'max:160']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información de la foto'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = galerias::where('idPerfilProfesional', '=', $idProProfesi)->count();

        if ( $count >= 8 ) {
            return response()->json([
                'mensaje' => 'Ingreso el maximo de fotos',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }


        //Crear el objeto
        $foto = new galerias();

        //asignar los datos
        $foto->idPerfilProfesional = $idProProfesi;
        $foto->fechagaleria = $request->fechaFoto;
        $foto->nombrefoto = $request->nombreFoto;
        $foto->descripcion = $request->descripcionFoto;

        //manejo de imagen
        $carpetaDestino = "img/user/$id_user";
        $imgFoto = $request->file('imgFoto');

        $foto->imggaleria = $carpetaDestino . "/" . "foto-" . time() . "." . $imgFoto->guessExtension();

        $imgFoto->move($carpetaDestino , $foto->imggaleria);

        $foto->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono el tratamiento',
            'items_max' => $count >= 8,
            'imagen' => asset($foto->imggaleria),
            'id' => $foto->id_galeria,
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 12----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 12----------------------*/
    public function delete12(Request $request){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'id' => ['required', 'exists:galerias,id_galeria']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'seleccione correctamente la foto'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $foto = galerias::where('id_galeria', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();


        //validar si se tiene permiso para el registro
        if (empty($foto))
        {
            return response()->json(['mensaje' => 'No se encontro el idioma'], Response::HTTP_NOT_FOUND);
        }
        //imagenes
        $imgFoto = $foto->imggaleria;
        $nombre = $foto->nombrefoto;
        $foto->delete();

        //eliminar imagenes
        if (@getimagesize(public_path() . "/" . $imgFoto)) unlink(public_path() . "/" . $imgFoto);

        return response()->json(['mensaje' => 'La foto "' . $nombre . '" se elimino correctamente'], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 12----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 13----------------------*/
    public function create13(Request $request){


        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        //validar el formulario
        $validator = Validator::make($request->all(),[
            'urlVideo' => ['required', 'url'],
            'fechaVideo' => ['required', 'date_format:Y-m-d'],
            'nombreVideo' => ['required'],
            'descripcionVideo' => ['required', 'max:160'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información del video'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //validar el valor maximo de items
        $count = videos::where('idPerfilProfesional', '=', $idProProfesi)->count();

        if ( $count >= 4 ) {
            return response()->json([
                'mensaje' => 'Ingreso el maximo de items',
                'items_max' => true
            ], Response::HTTP_NOT_FOUND);
        }

        //Crear el objeto
        $video = new videos();

        //asignar los datos
        $video->urlvideo = $request->urlVideo;
        $video->fechavideo = $request->fechaVideo;
        $video->nombrevideo = $request->nombreVideo;
        $video->descripcionvideo = $request->descripcionVideo;
        $video->idPerfilProfesional = $idProProfesi;
        $video->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono el video de "' . $request->nombreVideo . '"',
            'items_max' => $count >= 4,
            'id' => $video->id,
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 13----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 13----------------------*/
    public function delete13(Request $request){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        $video = videos::where('id', $request->id)
            ->where('idPerfilProfesional', $idProProfesi)
            ->first();

        //validar si se tiene permiso para el registro
        if (empty($video))
        {
            return response()->json(['mensaje' => 'No se encontro el video'], Response::HTTP_NOT_FOUND);
        }

        //Eliminar experiencia
        $nombre = $video->nombrevideo;
        $video->delete();

        return response()->json(['mensaje' => 'El video "' . $nombre . '" se elimino correctamente'], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 13----------------------*/

    /*-------------------------------------Inicio Add Destacale formulario parte 14----------------------*/
    public function addDestacable(Request $request)
    {
        $id_profesional = auth()->user()->profecional->idPerfilProfesional;
        $destacables_count = destacados::where('idPerfilProfesional', '=', $id_profesional)->count();

        if ($destacables_count >= 9) {
            return response(['mensaje' => 'No puede agregar mas temas', 'status' => false]);
        }
        $destacable = new destacados();
        $destacable->nombreExpertoEn = $request->destacado_nombre;
        $destacable->idPerfilProfesional = $id_profesional;

        $destacable->save();

        return response(['mensaje' => 'El Tema "' . $request->destacado_nombre . '" ha sido creado', 'status' => true, 'nombre' => $request->destacado_nombre, 'count' => $destacables_count + 1]);


    }
    /*-------------------------------------Fin Add Destacale formulario parte 14----------------------*/
    /*-------------------------------------Inicio delete Destacale formulario parte 14----------------------*/
    public function deleteDestacable(Request $request)
    {
        $id_profesional = auth()->user()->profecional->idPerfilProfesional;
        $destacable = destacados::where('idPerfilProfesional', '=', $id_profesional)->where('id_experto_en', '=', $request->id)->first();

        if (!empty($destacable))
        {
            //dd($destacable);
            $nombre = $destacable->nombreExpertoEn;
            $destacable->delete();
            return response(['mensaje' => 'El Tema "' . $nombre . '" ha sido eliminado', 'status' => true]);
        }

        return response(['mensaje' => 'El Tema no se pudo eliminar', 'status' => false]);
    }
    /*-------------------------------------Fin delete Destacale formulario parte 14----------------------*/
}
