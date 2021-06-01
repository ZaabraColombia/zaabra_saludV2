<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $id_user=auth()->user()->id;/*id usuario logueado*/
        $objuser = $this->cargaDatosUser($id_user);
        $objFormulario1=$this->cargaFormulario1($id_user);



        return view('profesionales.FormularioProfesional',compact(
        'objuser',
        'area',
        'pais',
        'universidades',
        'objFormulario1'
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
 
    
    public function cargaFormulario1($id_user){
    return DB::select("SELECT pf.direccion,  pf.genero, pf.EmpresaActual, 
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
    /*------------ Fin inicio busquedad datos basicos usuario logueado y data resgistrada del proesional-----------------*/




        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */


    /*-------------------------------------Creacion y/o modificacion formulario 1----------------------*/
        protected function create1(Request $request)
        {
            $index = $this->index();
           
            /*id usuario logueado*/
            $id_user=auth()->user()->id;

           /*consulta si existe el profesional*/
           $idexisteperfil = DB::table('perfilesprofesionales')
           ->select('idPerfilProfesional')
           ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
           ->where('perfilesprofesionales.idUser', $id_user)
           ->first();

           /*valido que el profesional no exista para que cree uno nuevo en caso contrario lo modifique */
           if(is_null($idexisteperfil)){
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

                return($index);

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
                    
                    return($index);
                 
            }

        }
/*-------------------------------------Fin Creacion y/o modificacion formulario 1----------------------*/


}
