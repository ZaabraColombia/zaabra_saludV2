<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use App\Models\destacados;
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
            $objFormulario=$this->cargaFormulario($id_user);

            $pais = pais::all();
            $area = areas::all();

            //Llamar la lista de profecion segun la seleccion del area
            if  (!is_null($objFormulario[0]->idarea)) {
                $profesiones = profesiones::where('idArea', '=', $objFormulario[0]->idarea)->get();
                //dd($profesiones);
            }

            //Llamar la lista de profecion segun la seleccion de la profecion
            if  (!is_null($objFormulario[0]->idprofesion)) {
                $especialidades = especialidades::where('idProfesion', '=', $objFormulario[0]->idprofesion)->get();
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
    WHERE pf.idUser=$id_user");
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
    return DB::select("SELECT usi.id_idioma, i.nombreidioma, i.imgidioma
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

    unset($request['_token']);
    // Recorre todos los "nombres" enviados, si no hay ninguno se
    //  crea un array vacío para que no devuelva un error el foreach
    foreach ($request->input('nombreconsulta', []) as $i => $nombreconsulta) {

        if(!empty($request->input('nombreconsulta.'.$i))){
            tipoconsultas::create([
                'idperfil' => $idProProfesi,
                'nombreconsulta' => $request->input('nombreconsulta.'.$i),
                'valorconsulta' => $request->input('valorconsulta.'.$i),
            ]);
        }

    }


return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 3----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 3----------------------*/
public function delete3($id){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }

    $tipoconsultas = tipoconsultas::where('id', $id)->where('idperfil', $idProProfesi);
    $tipoconsultas->delete();

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Eliminacion formulario parte 3----------------------*/

/*-------------------------------------Inicio Creacion y/o modificacion formulario parte 4----------------------*/
public function create4(Request $request){
    /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
    $verificaPerfil = $this->verificaPerfil();

    /*id usuario logueado*/
    $id_user=auth()->user()->id;

    unset($request['_token']);
    unset($request['updated_at']);
    unset($request['created_at']);
    perfilesprofesionales::where('idUser', $id_user)->update($request->all());

    return redirect('FormularioProfesional');
}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 4----------------------*/



/*-------------------------------------Inicio Creacion y/o modificacion formulario parte 5----------------------*/
public function create5(Request $request){

    /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }

    foreach ($request->input('id_universidad', []) as $i => $id_universidad) {

        if(!empty($request->input('id_universidad.'.$i))){
            perfilesprofesionalesuniversidades::create([
                'idPerfilProfesional' => $idProProfesi,
                'id_universidad' => $request->input('id_universidad.'.$i),
                'nombreestudio' => $request->input('nombreestudio.'.$i),
                'fechaestudio' => $request->input('fechaestudio.'.$i),
            ]);
        }
    }

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 5----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 5----------------------*/
public function delete5($id_universidadperfil){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }

    $perfilesprofesionalesuniversidades = perfilesprofesionalesuniversidades::where('id_universidadperfil', $id_universidadperfil)->where('idPerfilProfesional', $idProProfesi);
    $perfilesprofesionalesuniversidades->delete();

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Eliminacion formulario parte 5----------------------*/




/*-------------------------------------Inicio Creacion y/o modificacion formulario parte 6----------------------*/
public function create6(Request $request){

    /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }



    unset($request['_token']);
    // Recorre todos los "nombres" enviados, si no hay ninguno se
    //  crea un array vacío para que no devuelva un error el foreach
    foreach ($request->input('nombreEmpresaExperiencia', []) as $i => $nombreEmpresaExperiencia) {
        experiencias::create([
            'idPerfilProfesional' => $idProProfesi,
            'nombreEmpresaExperiencia'=> $nombreEmpresaExperiencia,
            'descripcionExperiencia' => $request->input('descripcionExperiencia.'.$i),
            'fechaInicioExperiencia' => $request->input('fechaInicioExperiencia.'.$i),
            'fechaFinExperiencia' => $request->input('fechaFinExperiencia.'.$i),
        ]);
    }

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 6----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 6----------------------*/
public function delete6($idexperiencias){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }
    $experiencias = experiencias::where('idexperiencias', $idexperiencias)->where('idPerfilProfesional', $idProProfesi);
    $experiencias->delete();

    return redirect('FormularioProfesional');

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

    unset($request['_token']);
    // Recorre todos los "nombres" enviados, si no hay ninguno se
    //  crea un array vacío para que no devuelva un error el foreach
    foreach ($request->input('id_idioma', []) as $i => $id_idioma) {
        if(!empty($request->input('id_idioma.'.$i))){
            usuario_idiomas::create([
                'idPerfilProfesional' => $idProProfesi,
                'id_idioma' => $request->input('id_idioma.'.$i),
            ]);
        }
    }


return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 8----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 8----------------------*/
public function delete8($id_idioma){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }


    $usuario_idiomas = usuario_idiomas::where('id_idioma', $id_idioma)->where('idPerfilProfesional', $idProProfesi);
    $usuario_idiomas->delete();

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Eliminacion formulario parte 8----------------------*/



/*-------------------------------------Inicio Creacion y/o modificacion formulario parte 9----------------------*/
public function create9(Request $request){

    /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }
        /*id usuario logueado*/
        $id_user=auth()->user()->id;

    unset($request['_token']);

    $carpetaDestino = "img/user/$id_user";
    $imgTratamientoAntes = $request->file('imgTratamientoAntes');
    $imgTratamientodespues = $request->file('imgTratamientodespues');
    for ($i=0; $i < count(request('tituloTrataminetoAntes')); ++$i){
        if(!empty($request->input('tituloTrataminetoAntes.'.$i))){
            tratamientos::create([
            'idPerfilProfesional' => $idProProfesi,
            'imgTratamientoAntes' =>"img/user/$id_user/".$imgTratamientoAntes[$i]->getClientOriginalName(),
            'tituloTrataminetoAntes' => $request->input('tituloTrataminetoAntes')[$i],
            'descripcionTratamientoAntes' => $request->input('descripcionTratamientoAntes')[$i],
            'imgTratamientodespues' =>"img/user/$id_user/".$imgTratamientodespues[$i]->getClientOriginalName(),
            'tituloTrataminetoDespues' => $request->input('tituloTrataminetoDespues')[$i],
            'descripcionTratamientoDespues' => $request->input('descripcionTratamientoDespues')[$i],
           ]);
           $imgTratamientoAntes[$i]->move($carpetaDestino , $imgTratamientoAntes[$i]->getClientOriginalName());
           $imgTratamientodespues[$i]->move($carpetaDestino , $imgTratamientodespues[$i]->getClientOriginalName());
        }
    }



return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 9----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 9----------------------*/
public function delete9($id_tratamiento){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }


    $tratamientos = tratamientos::where('id_tratamiento', $id_tratamiento)->where('idPerfilProfesional', $idProProfesi);
    $tratamientos->delete();

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Eliminacion formulario parte 9----------------------*/


/*-------------------------------------Inicio Creacion y/o modificacion formulario parte 10----------------------*/
    public function create10(Request $request){


    /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }

    /*id usuario logueado*/
    $id_user=auth()->user()->id;

        $carpetaDestino = "img/user/$id_user";
        $imgpremio = $request->file('imgpremio');
        for ($i=0; $i < count(request('nombrepremio')); ++$i){
            if(!empty($request->input('nombrepremio.'.$i))){
                    premios::create([
                    'idPerfilProfesional' => $idProProfesi,
                    'nombrepremio' => $request->input('nombrepremio')[$i],
                    'imgpremio' =>"img/user/$id_user/".$imgpremio[$i]->getClientOriginalName(),
                    'fechapremio' => $request->input('fechapremio')[$i],
                    'descripcionpremio' => $request->input('descripcionpremio')[$i],
                    'nombrepremio' => $request->input('nombrepremio')[$i],
                ]);
                $imgpremio[$i]->move($carpetaDestino , $imgpremio[$i]->getClientOriginalName());
            }
        }

        return redirect('FormularioProfesional');

    }
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 10----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 10----------------------*/
public function delete10($id){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }


    $premios = premios::where('id', $id)->where('idPerfilProfesional', $idProProfesi);
    $premios->delete();

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Eliminacion formulario parte 10----------------------*/


/*-------------------------------------Inicio Creacion y/o modificacion formulario parte 11----------------------*/
public function create11(Request $request){


    /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }

    /*id usuario logueado*/
    $id_user=auth()->user()->id;

        $carpetaDestino = "img/user/$id_user";
        $imgpublicacion = $request->file('imgpublicacion');
        for ($i=0; $i < count(request('nombrepublicacion')); ++$i){
            if(!empty($request->input('descripcion.'.$i))){
                    publicaciones::create([
                    'idPerfilProfesional' => $idProProfesi,
                    'nombrepublicacion' => $request->input('nombrepublicacion')[$i],
                    'imgpublicacion' =>"img/user/$id_user/".$imgpublicacion[$i]->getClientOriginalName(),
                    'descripcion' => $request->input('descripcion')[$i],
                    ]);
                    $imgpublicacion[$i]->move($carpetaDestino , $imgpublicacion[$i]->getClientOriginalName());
            }
        }

        return redirect('FormularioProfesional');

    }
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 11----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 11----------------------*/
public function delete11($id){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }


    $premios = publicaciones::where('id', $id)->where('idPerfilProfesional', $idProProfesi);
    $premios->delete();

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Eliminacion formulario parte 11----------------------*/



/*-------------------------------------Inicio Creacion y/o modificacion formulario parte 12----------------------*/
public function create12(Request $request){


    /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }

    /*id usuario logueado*/
    $id_user=auth()->user()->id;

        $carpetaDestino = "img/user/$id_user";
        $imggaleria = $request->file('imggaleria');
        for ($i=0; $i < count(request('nombrefoto')); ++$i){
            if(!empty($request->input('nombrefoto.'.$i))){
                    galerias::create([
                    'idPerfilProfesional' => $idProProfesi,
                    'nombrefoto' => $request->input('nombrefoto')[$i],
                    'imggaleria' =>"img/user/$id_user/".$imggaleria[$i]->getClientOriginalName(),
                    'descripcion' => $request->input('descripcion')[$i],
                    ]);
                    $imggaleria[$i]->move($carpetaDestino , $imggaleria[$i]->getClientOriginalName());
            }
        }

        return redirect('FormularioProfesional');

    }
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 12----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 12----------------------*/
public function delete12($id_galeria){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }


    $galeria = galerias::where('id_galeria', $id_galeria)->where('idPerfilProfesional', $idProProfesi);
    $galeria->delete();

    return redirect('FormularioProfesional');

}
/*-------------------------------------Fin Eliminacion formulario parte 12----------------------*/



/*-------------------------------------Inicio Creacion y/o modificacion formulario parte 13----------------------*/
public function create13(Request $request){


    /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }

    /*id usuario logueado*/
    $id_user=auth()->user()->id;


        for ($i=0; $i < count(request('nombrevideo')); ++$i){
            if(!empty($request->input('nombrevideo.'.$i))){
                    videos::create([
                    'idPerfilProfesional' => $idProProfesi,
                    'nombrevideo' => $request->input('nombrevideo')[$i],
                    'descripcionvideo' => $request->input('descripcionvideo')[$i],
                    'urlvideo' => $request->input('urlvideo')[$i],
                    'fechavideo' => $request->input('fechavideo')[$i],
                  ]);
            }
        }

        return redirect('FormularioProfesional');

    }
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 13----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 13----------------------*/
public function delete13($id){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }


    $videos = videos::where('id', $id)->where('idPerfilProfesional', $idProProfesi);
    $videos->delete();

    return redirect('FormularioProfesional');

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
