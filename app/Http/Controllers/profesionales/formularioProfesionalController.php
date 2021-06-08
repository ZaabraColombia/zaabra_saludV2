<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
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
use File;


class formularioProfesionalController extends Controller
{

            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(){
        $pais = pais::all();
        $area = areas::all();
        $universidades = universidades::all();
        $idiomas = idiomas::all();
        $id_user=auth()->user()->id;/*id usuario logueado*/
        $objuser = $this->cargaDatosUser($id_user);
        $objFormulario=$this->cargaFormulario($id_user);
        $objFormulario1=$this->cargaFormulario1($id_user);
        $objContadorConsultas=$this->contadorConsultas($id_user);
        $objConsultas=$this->cargaConsultas($id_user);
        $objExperiencia=$this->cargaExperiencia($id_user);
        $objContadorExperiencia=$this->contadorExperiencia($id_user);
        $objAsociaciones=$this->cargaAsociaciones($id_user);
        $objContadorAsociaciones=$this->contadorAsociaciones($id_user);
        $objIdiomas=$this->cargaIdiomas($id_user);
        $objContadorIdiomas=$this->contadorIdiomas($id_user);
    

        return view('profesionales.FormularioProfesional',compact(
        'objuser',
        'area',
        'pais',
        'idiomas',
        'universidades',
        'objFormulario',
        'objFormulario1',
        'objContadorConsultas',
        'objConsultas',
        'objExperiencia',
        'objContadorExperiencia',
        'objAsociaciones',
        'objContadorAsociaciones',
        'objIdiomas',
        'objContadorIdiomas'
        ));
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
    pf.imglogoempresa, pf.fechanacimiento, pf.numeroTarjeta, pf.entidadCertificoTarjeta,
    pf.descripcionPerfil,ar.idarea, ar.nombreArea ,pr.idprofesion, pr.nombreProfesion, 
    ep.idEspecialidad,  ep.nombreEspecialidad, p.id_pais,p.nombre, de.id_departamento, de.nombre,
    prv.id_provincia,prv.nombre, mu.id_municipio, mu.nombre
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  areas ar ON pf.idarea= ar.idArea
    LEFT JOIN  profesiones pr ON pf.idprofesion= pr.idProfesion
    LEFT JOIN  especialidades ep ON pf.idespecialidad= ep.idEspecialidad
    LEFT JOIN  pais p ON pf.idpais=p.id_pais
    LEFT JOIN  departamentos de ON pf.id_departamento= de.id_departamento
    LEFT JOIN  provincias prv ON pf.id_provincia= prv.id_provincia
    LEFT JOIN  municipios mu ON pf.id_municipio= mu.id_municipio
    WHERE pf.idUser=$id_user");
    }

    public function cargaFormulario1($id_user){
    return DB::select("SELECT un.nombreuniversidad, un.id_universidad
    FROM perfilesprofesionales pf
    INNER JOIN users us   ON pf.idUser=us.id
    LEFT JOIN  perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional= pu.idPerfilProfesional
    LEFT JOIN  universidades un ON pu.id_universidad= un.id_universidad
    WHERE pf.idUser=$id_user LIMIT 1");
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

        
    /*------------ Fin inicio busquedad datos basicos usuario logueado y data resgistrada del proesional-----------------*/


  /*------------ Funcion solo para verificar que perfil existe y esta se utiiliza en las demas-----------------*/
         protected function verificaPerfil(){
                  /*id usuario logueado*/
                  $id_user=auth()->user()->id;

                  /*consulta si existe el profesional*/
                  $idexisteperfil = DB::table('perfilesprofesionales')
                  ->select('idPerfilProfesional')
                  ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
                  ->where('perfilesprofesionales.idUser', $id_user)
                  ->first();
                  return $idexisteperfil;
                  
        }
   /*------------Fin  Funcion solo para verificar que perfil existe y esta se utiiliza en los demas metodos-----------------*/

        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */


    /*-------------------------------------Creacion y/o modificacion formulario parte 1----------------------*/
        protected function create1(Request $request)
        {


            /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
            $verificaPerfil = $this->verificaPerfil();

            /*id usuario logueado*/
            $id_user=auth()->user()->id;

 

           /*valido que el profesional no exista para que cree uno nuevo en caso contrario lo modifique */
           if(is_null($verificaPerfil)){
              
                    /*captura el nombre del logo*/
                    $nombrelogo=$request->logo->getClientOriginalName();

                    /*crea una nueva carpeta con el id del perfil nuevo*/
                    $path = public_path().'img/user/' . $id_user;
                    File::makeDirectory($path,  0777, true);

                    /*guarda la imagen en carpeta con el id del usuario*/
                    $image = $request->file('logo');
                    $image->move("img/user/$id_user", $image->getClientOriginalName());
                
                    /*anexo iduser y img logoempresa  al request*/
                    $request->merge([
                        'idUser' => "$id_user", 
                        'imglogoempresa' => "img/user/$id_user/$nombrelogo"
                    ]);
                
                    perfilesprofesionales::create($request->all());

                   /*consulta el perfil registrado para despues guardarlo en la tabla de perfilesprofesionalesuniversidades*/
                    $idPerfilProfesional = DB::table('perfilesprofesionales')
                    ->select('idPerfilProfesional')
                    ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
                    ->where('perfilesprofesionales.idUser', $id_user)
                    ->first();

                    foreach($idPerfilProfesional as $idPerfilProfesional){
                        $idProProfesi=$idPerfilProfesional;
                    }

                    /*anexo iduser y img logoempresa  al request*/
                    $request->merge([
                        'idPerfilProfesional' => "$idProProfesi"
                        ]);  
                    perfilesprofesionalesuniversidades::create($request->all());

                    return redirect('FormularioProfesional'); 

            }else{

                 
                    /*captura el nombre del logo*/
                    $nombrelogo=$request->logo->getClientOriginalName();
                
                    /*guarda la imagen en carpeta con el id del usuario*/
                    $image = $request->file('logo');
                    $image->move("img/user/$id_user", $image->getClientOriginalName());

                    /*anexo iduser y img logoempresa  al request*/
                    $request->merge([
                    'idUser' => "$id_user", 
                    'imglogoempresa' => "img/user/$id_user/$nombrelogo"
                    ]);
            


                    $dataPerfilesprofesionales = request()->all();
                    unset($dataPerfilesprofesionales['_token']);
                    unset($dataPerfilesprofesionales['id_universidad']);
                    unset($dataPerfilesprofesionales['logo']);
                   
           
                    perfilesprofesionales::where('idUser', $id_user)->update($dataPerfilesprofesionales);

                    /*consulta el perfil registrado para despues guardarlo en la tabla de perfilesprofesionalesuniversidades*/
                    $idPerfilProfesional = DB::table('perfilesprofesionales')
                    ->select('idPerfilProfesional')
                    ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
                    ->where('perfilesprofesionales.idUser', $id_user)
                    ->first();

                    foreach($idPerfilProfesional as $idPerfilProfesional){
                        $idProProfesi=$idPerfilProfesional;
                    }

                    /*anexo el id del profesional*/
                    $request->merge([
                        'idPerfilProfesional' => "$idProProfesi"
                        ]);  

                    $perfilesprofesionalesuniversidades = request()->all();
                    unset($perfilesprofesionalesuniversidades['_token']);
                    unset($perfilesprofesionalesuniversidades['fechanacimiento']);
                    unset($perfilesprofesionalesuniversidades['numeroTarjeta']);
                    unset($perfilesprofesionalesuniversidades['imglogoempresa']);
                    unset($perfilesprofesionalesuniversidades['idarea']);
                    unset($perfilesprofesionalesuniversidades['idprofesion']);
                    unset($perfilesprofesionalesuniversidades['idespecialidad']);
                    unset($perfilesprofesionalesuniversidades['idUser']);
                    unset($perfilesprofesionalesuniversidades['logo']);

                    perfilesprofesionalesuniversidades::where('idPerfilProfesional', $idProProfesi)->update($perfilesprofesionalesuniversidades);
                    
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
        tipoconsultas::create([
            'idperfil' => $idProProfesi,
            'nombreconsulta' => $request->input('nombreconsulta.'.$i),
            'valorconsulta' => $request->input('valorconsulta.'.$i),
        ]);
    }


return redirect('FormularioProfesional'); 

}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 3----------------------*/


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
        perfilesprofesionalesuniversidades::create([
            'idPerfilProfesional' => $idProProfesi,
            'id_universidad' => $request->input('id_universidad.'.$i),
            'nombreestudio' => $request->input('nombreestudio.'.$i),
        ]);
    }

    return redirect('FormularioProfesional'); 

}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 5----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 5----------------------*/
public function delete5($idexperiencias){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }

    $experiencias = experiencias::where('idexperiencias', $idexperiencias)->where('idPerfilProfesional', $idProProfesi);
    $experiencias->delete();

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
        usuario_idiomas::create([
            'idPerfilProfesional' => $idProProfesi,
            'id_idioma' => $request->input('id_idioma.'.$i),
        ]);
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

    if ($request->hasFile('imgTratamientoAntes')) {
        $carpetaDestino = "img/user/$id_user";
        $imagenesantes = $request->file('imgTratamientoAntes');
        $imagendespues = $request->file('imgTratamientodespues');

        foreach ($imagenesantes as $imagen) {
            $nombreFotoAntes = $imagen->getClientOriginalName();
            $imagen->move($carpetaDestino , $nombreFotoAntes); 
            $nombreFotoCompletaAntes="img/user/$id_user/$nombreFotoAntes";
        }
    }


    
    /*
    imgasociacion
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
    }*/


return redirect('FormularioProfesional'); 

}
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 9----------------------*/
/*-------------------------------------Inicio Eliminacion  formulario parte 9----------------------*/
public function delete9($id_idioma){


    $verificaPerfil = $this->verificaPerfil();

    foreach($verificaPerfil as $verificaPerfil){
        $idProProfesi=$verificaPerfil;
    }


    $usuario_idiomas = usuario_idiomas::where('id_idioma', $id_idioma)->where('idPerfilProfesional', $idProProfesi);
    $usuario_idiomas->delete();

    return redirect('FormularioProfesional'); 

}
/*-------------------------------------Fin Eliminacion formulario parte 9----------------------*/
}
