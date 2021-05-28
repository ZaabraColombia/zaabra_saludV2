<?php

namespace App\Http\Controllers\profesionales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\perfilProfesional;
use App\Models\pais;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\provincia;

class formularioProfesionalController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){

        $pais = pais::all();
    

        $objarea =  (new areaController)->listaArea();
        $objprofesion = (new profesionController)->listaProfesiones();
        $objespecialidad = (new especialidadController)->listaEspecialidades();

        return view('profesionales.FormularioProfesional',compact(
        'objarea',
        'objprofesion',
        'objespecialidad',
        'pais'
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
   

/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function create(array $data)
    {

        $id_user=auth()->user()->id;
    
        $validador = Validator::make($data->all(), [
            'idarea' => ['required', 'numeric', 'max:99999999'],
            'idprofesion' => ['required', 'numeric', 'max:99999999'],
            'idespecialidad' => ['required', 'numeric', 'max:99999999'],
            'idpais' => ['required', 'numeric', 'max:99999999'],
            'id_departamento' => ['required', 'numeric', 'max:99999999'],
            'id_provincia' => ['required', 'numeric', 'max:99999999'],
            'id_municipio' => ['required', 'numeric', 'max:99999999'],
            'direccion' => ['required', 'string', 'max:50'],
            'genero' => ['required', 'numeric', 'max:2'],
            'EmpresaActual' => ['required', 'string', 'max:100'],
            'fotoperfil' => ['required', 'string', 'max:100'],
            'fechanacimiento' => ['required', 'date'],
            'numeroTarjeta' =>  ['required', 'numeric', 'max:99999999'],
            'entidadCertificoTarjeta' => ['required', 'string', 'max:100'],
            'descripcionPerfil' => ['required', 'string', 'max:200'],
            'imglogoempresa' => ['required', 'string', 'max:100'],
            'caracteristicas ' => ['required', 'string', 'max:100'],
            'FechaAprobacion' => ['required', 'date'],
            'aprobado ' => ['required', 'numeric', 'max:2'],
            'aceptoTerminos ' => ['required', 'numeric', 'max:2'],
            'fechaCreacionFormulario' => ['required', 'date'],
        ]);
    }


}
