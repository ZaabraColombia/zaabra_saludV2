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

        return view('profesionales.FormularioProfesional',compact(
        'objuser',
        'area',
        'pais',
        'universidades'
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




/*-------------------------------------inicio busquedad datos basicos usuario logueado----------------------*/

    public function cargaDatosUser($id_user){
    return DB::select("SELECT us.primernombre, us.segundonombre, us.primerapellido, us.segundoapellido
    FROM users us
    WHERE id=$id_user");
}
/*-------------------------------------fin busquedad datos basicos usuario logueado----------------------*/





/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function create(Request $request)
    {

      
        /*id usuario logueado*/
        $id_user=auth()->user()->id;
        /*captura el nombre del logo*/
        $nombrelogo=$request->logo->getClientOriginalName();

        /*crea una nueva carpeta con el id del usuario*/
        $path = public_path().'img/user/' . $id_user;
        File::makeDirectory($path,  0777, true);

        /*guarda la imagen en carpeta con el id del usuario*/
        $image = $request->file('logo');
        $image->move("img/user/$id_user", $image->getClientOriginalName());
      
        /*guarda la informacion en la base de datos*/
        $infoProf = new perfilesprofesionales;
        $infoProf->idUser = $id_user;
        $infoProf->idarea = $request->idArea ;
        $infoProf->idprofesion = $request->profesion ;
        $infoProf->idespecialidad = $request->especialidad ;
        $infoProf->fechanacimiento = $request->fecha ;
        $infoProf->numeroTarjeta = $request->tarjeta ;
        $infoProf->imglogoempresa = "img/user/$id_user/$nombrelogo";
        $infoProf->save();
    }


}
