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

            $objFormulario = $this->cargaFormulario($id_user);
            $objFormulario = $objFormulario[0];


            $pais = pais::all();
            $area = areas::all();

            //Llamar la lista de profecion segun la seleccion del area
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

            $objuser = $this->cargaDatosUser($id_user);
            $objContadorConsultas=$this->contadorConsultas($id_user);
            $objConsultas=$this->cargaConsultas($id_user);
            $objContadorEducacion=$this->contadorEducacion($id_user);
            $objEducacion=$this->cargaEducacion($id_user);
            $objExperiencia=$this->cargaExperiencia($id_user);
            $objContadorExperiencia=$this->contadorExperiencia($id_user);
            $objAsociaciones=$this->cargaAsociaciones($id_user);
            $objContadorAsociaciones=$this->contadorAsociaciones($id_user);
            $objIdiomas=$this->cargaIdiomas($id_user);
            $objContadorIdiomas=$this->contadorIdiomas($id_user);
            $objTratamiento=$this->cargaTratamiento($id_user);
            $objContadorTratamiento=$this->contadorTratamiento($id_user);
            $objPremios=$this->cargaPremios($id_user);
            $objContadorPremios=$this->contadorPremios($id_user);
            $Publicaciones=$this->cargaPublicaciones($id_user);
            $objContadorPublicaciones=$this->contadorPublicaciones($id_user);
            $objGaleria=$this->cargaGaleria($id_user);
            $objContadorGaleria=$this->contadorGaleria($id_user);
            $objVideo=$this->cargaVideo($id_user);
            $objContadorVideo=$this->contadorVideo($id_user);


            return view('profesionales.FormularioProfesional',compact(
                'objuser',
                'area',
                'profesiones',
                'especialidades',
                'pais',
                'idiomas',
                'universidades',
                'objFormulario',
                'objContadorConsultas',
                'objConsultas',
                'objContadorEducacion',
                'objEducacion',
                'objExperiencia',
                'objContadorExperiencia',
                'objAsociaciones',
                'objContadorAsociaciones',
                'objIdiomas',
                'objContadorIdiomas',
                'objTratamiento',
                'objContadorTratamiento',
                'objPremios',
                'objContadorPremios',
                'Publicaciones',
                'objContadorPublicaciones',
                'objGaleria',
                'objContadorGaleria',
                'objVideo',
                'objContadorVideo',
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



    public function contadorConsultas($id_user){
        /*cuenta los los valores ingresados*/
        $contadorConsultas = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(tipoconsultas.idperfil) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('tipoconsultas', 'perfilesprofesionales.idPerfilProfesional', '=', 'tipoconsultas.idperfil')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorConsultas;
    }

    public function cargaConsultas($id_user){
        return DB::select("	SELECT tc.id, tc.nombreconsulta, tc.valorconsulta
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  tipoconsultas tc ON pf.idPerfilProfesional= tc.idperfil
    WHERE pf.idUser=$id_user");
    }


    public function contadorEducacion($id_user){
        /*cuenta los los valores ingresados*/
        $contadorConsultas = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(perfilesprofesionalesuniversidades.idPerfilProfesional) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('perfilesprofesionalesuniversidades', 'perfilesprofesionales.idPerfilProfesional', '=', 'perfilesprofesionalesuniversidades.idPerfilProfesional')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorConsultas;
    }

    public function cargaEducacion($id_user){
        return DB::select("SELECT pu.id_universidadperfil, u.nombreuniversidad, pu.fechaestudio,pu.nombreestudio
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional= pu.idPerfilProfesional
    LEFT JOIN  universidades u ON pu.id_universidad= u.id_universidad
    WHERE pf.idUser=$id_user");
    }

    public function contadorExperiencia($id_user){
        /*cuenta los los valores ingresados*/
        $contadorexperinecia = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(experiencias.nombreEmpresaExperiencia) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('experiencias', 'perfilesprofesionales.idPerfilProfesional', '=', 'experiencias.idPerfilProfesional')
            ->where('id', '=',$id_user)
            ->first();
        return $contadorexperinecia;
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

    public function contadorAsociaciones($id_user){
        /*cuenta los los valores ingresados*/
        $contadorasociacion = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(asociaciones.imgasociacion) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('asociaciones', 'perfilesprofesionales.idPerfilProfesional', '=', 'asociaciones.idPerfilProfesional')
            ->where('id', '=',$id_user)
            ->first();
        return $contadorasociacion;
    }

    public function  cargaIdiomas($id_user){
        return DB::select("SELECT usi.idUsuarioIdiomas, usi.id_idioma, i.nombreidioma, i.imgidioma
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  usuario_idiomas usi ON pf.idPerfilProfesional= usi.idPerfilProfesional
    LEFT JOIN  idiomas i ON usi.id_idioma= i.id_idioma
    WHERE pf.idUser=$id_user");
    }

    public function contadorIdiomas($id_user){
        /*cuenta los los valores ingresados*/
        $contadoridiomas = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(usuario_idiomas.idPerfilProfesional) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('usuario_idiomas', 'perfilesprofesionales.idPerfilProfesional', '=', 'usuario_idiomas.idPerfilProfesional')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadoridiomas;
    }

    public function  cargaTratamiento($id_user){
        return DB::select("SELECT tr.id_tratamiento, tr.imgTratamientoAntes, tr.tituloTrataminetoAntes, tr.descripcionTratamientoAntes, tr.imgTratamientodespues, tr.tituloTrataminetoDespues, tr.descripcionTratamientoDespues
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  tratamientos tr ON pf.idPerfilProfesional= tr.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function contadorTratamiento($id_user){
        /*cuenta los los valores ingresados*/
        $contadortratamiento = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(tratamientos.idPerfilProfesional) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('tratamientos', 'perfilesprofesionales.idPerfilProfesional', '=', 'tratamientos.idPerfilProfesional')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadortratamiento;
    }

    public function  cargaPremios($id_user){
        return DB::select("SELECT pr.id, pr.imgpremio, pr.nombrepremio, pr.descripcionpremio, pr.fechapremio
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  premios pr ON pf.idPerfilProfesional= pr.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function contadorPremios($id_user){
        /*cuenta los los valores ingresados*/
        $contadorpremios = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(premios.idPerfilProfesional) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('premios', 'perfilesprofesionales.idPerfilProfesional', '=', 'premios.idPerfilProfesional')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorpremios;
    }
    public function  cargaPublicaciones($id_user){
        return DB::select("SELECT pb.id, pb.nombrepublicacion, pb.descripcion, pb.imgpublicacion
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  publicaciones pb ON pf.idPerfilProfesional= pb.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function contadorPublicaciones($id_user){
        /*cuenta los los valores ingresados*/
        $contadorpublicaciones = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(publicaciones.idPerfilProfesional) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('publicaciones', 'perfilesprofesionales.idPerfilProfesional', '=', 'publicaciones.idPerfilProfesional')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorpublicaciones;
    }

    public function  cargaGaleria($id_user){
        return DB::select("SELECT g.id_galeria, g.imggaleria, g.nombrefoto, g.descripcion
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  galerias g ON pf.idPerfilProfesional= g.idPerfilProfesional
    WHERE pf.idUser=$id_user");
    }

    public function contadorGaleria($id_user){
        /*cuenta los los valores ingresados*/
        $contadorpublicaciones = DB::table('perfilesprofesionales')
            ->select(DB::raw('COUNT(galerias.idPerfilProfesional) as cantidad'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('galerias', 'perfilesprofesionales.idPerfilProfesional', '=', 'galerias.idPerfilProfesional')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorpublicaciones;
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
     * @return \Illuminate\Contracts\Validation\Validator
     */


    /*-------------------------------------Creacion y/o modificacion formulario parte 1----------------------*/
    protected function create1(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        /*id usuario logueado*/
        $id_user=auth()->user()->id;
        //Modificar nombres del usuario\
        $user = User::find($id_user);

        $user->primernombre = $request->primernombre;
        $user->segundonombre = $request->segundonombre;
        $user->primerapellido = $request->primerapellido;
        $user->segundoapellido = $request->segundoapellido;

        $user->save();

        /*valido que el profesional no exista para que cree uno nuevo en caso contrario lo modifique */
        if(is_null($verificaPerfil)){

            /*captura el nombre del logo*/
            $nombrelogo=$request->logo->getClientOriginalName();

            /*crea una nueva carpeta con el id del perfil nuevo*/
            $path = public_path().'img/user/' . $id_user;
            if (!File::exists($path)) {
                File::makeDirectory($path,  0777, true);
            }

            /*guarda la imagen en carpeta con el id del usuario*/
            $image = $request->file('logo');
            $image->move("img/user/$id_user", $image->getClientOriginalName());

            /*anexo iduser y img logoempresa  al request*/
            $request->merge([
                'idUser' => "$id_user",
                'fotoperfil' => "img/user/$id_user/$nombrelogo"
            ]);
            //dump($request->all());
            $dataPerfilesprofesionales = request()->all();

            unset($dataPerfilesprofesionales['primernombre']);
            unset($dataPerfilesprofesionales['segundonombre']);
            unset($dataPerfilesprofesionales['primerapellido']);
            unset($dataPerfilesprofesionales['segundoapellido']);
            perfilesprofesionales::create($request->all());

            return redirect('FormularioProfesional');

        }else{

            if(!empty($request->file())){
                /*captura el nombre del logo*/
                $nombrelogo=$request->logo->getClientOriginalName();

                /*guarda la imagen en carpeta con el id del usuario*/
                $image = $request->file('logo');
                $image->move("img/user/$id_user", $image->getClientOriginalName());

                /*anexo iduser y img logoempresa  al request*/
                $request->merge([
                    'idUser' => "$id_user",
                    'fotoperfil' => "img/user/$id_user/$nombrelogo"
                ]);
            }

            $dataPerfilesprofesionales = request()->all();
            unset($dataPerfilesprofesionales['_token']);
            unset($dataPerfilesprofesionales['logo']);
            unset($dataPerfilesprofesionales['primernombre']);
            unset($dataPerfilesprofesionales['segundonombre']);
            unset($dataPerfilesprofesionales['primerapellido']);
            unset($dataPerfilesprofesionales['segundoapellido']);

            //die(request);

            perfilesprofesionales::where('idUser', $id_user)->update($dataPerfilesprofesionales);


            return redirect('FormularioProfesional');

        }
        return redirect('FormularioProfesional');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 1----------------------*/






    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 2----------------------*/
    protected function create2(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);

        perfilesprofesionales::where('idUser', $id_user)->update($request->all());

        return redirect('FormularioProfesional');
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


        //validar el formulario
        $validator = Validator::make($request->all(),[
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
        $universidad->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono la universidad "' . $universidad->universidad->nombreuniversidad . '"',
            'items_max' => $count >= 3,
            'id' => $universidad->id_universidadperfil,
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

        $universidad->delete();

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

        //validar el formulario
        $validator = Validator::make($request->all(),[
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
        $experiencia->save();
        //agrgar 1 suma uno
        $count++;

        return response()->json([
            'mensaje' => 'Se adiciono la experiencia de "' . $request->nombre_empresa . '"',
            'items_max' => $count >= 4,
            'id' => $experiencia->idexperiencias,
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
        $experiencia->delete();

        return response()->json(['mensaje' => 'El item "' . $nombre . '" se elimino correctamente'], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Eliminacion formulario parte 6----------------------*/




    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 7----------------------*/
    public function create7(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);

        if ($request->hasFile('imgasociacion')) {
            $carpetaDestino = "img/user/$id_user";
            $imagenes = $request->file('imgasociacion');

            foreach ($imagenes as $imagen) {
                $nombreFoto = $imagen->getClientOriginalName();
                $imagen->move($carpetaDestino , $nombreFoto);
                $nombreFotoCompleta="img/user/$id_user/$nombreFoto";
                asociaciones::create([
                    'idPerfilProfesional' => $idProProfesi,
                    'imgasociacion'  => $nombreFotoCompleta
                ]);
            }
        }

        return redirect('FormularioProfesional');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 7----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 7----------------------*/
    public function delete7($idAsociaciones){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idProProfesi=$verificaPerfil;
        }

        $asociaciones = asociaciones::where('idAsociaciones', $idAsociaciones)->where('idPerfilProfesional', $idProProfesi);
        $asociaciones->delete();

        return redirect('FormularioProfesional');

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
                'mensaje' => 'seleccione correctamente la información del idioma'
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
