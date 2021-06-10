<?php

namespace App\Http\Controllers\entidades;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use App\Models\instituciones;
use App\Models\serviciosinstituciones;
use App\Models\intitucioneseps;
use App\Models\intitucionesips;
use App\Models\profesionales_instituciones;
use App\Models\certificaciones;
use App\Models\sedesinstituciones;
use App\Models\pais;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\provincia;
use App\Models\galerias;
use File;


class formularioInstitucionController extends Controller{

        public function index(){
            $pais = pais::all();
            $id_user=auth()->user()->id;/*id usuario logueado*/
            $objuser = $this->cargaDatosUser($id_user);
            $objFormulario=$this->cargaFormulario($id_user);

        

            return view('instituciones.FormularioInstitucion',compact(
            'objuser',
            'pais',
            'objFormulario'
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
    return DB::select("SELECT ins.imagen, ins.logo, ins.quienessomos,  ins.DescripcionGeneralServicios,
    ins.url, ins.fechainicio, ins.telefonouno,  ins.telefono2, ins.direccion, ins.propuestavalor,
    p.id_pais,p.nombre, de.id_departamento, de.nombre,
    prv.id_provincia,prv.nombre, mu.id_municipio, mu.nombre
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  pais p ON ins.idpais=p.id_pais
    LEFT JOIN  departamentos de ON ins.id_departamento= de.id_departamento
    LEFT JOIN  provincias prv ON ins.id_provincia= prv.id_provincia
    LEFT JOIN  municipios mu ON ins.id_municipio= mu.id_municipio
    WHERE ins.idUser=$id_user");
    }
/*------------Fin busquedad datos basicos usuario logueado y data resgistrada de la institucion-----------------*/
    

/*-------------------------------------Creacion y/o modificacion formulario parte 1----------------------*/
    protected function create1(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

         /*valido que el profesional no exista para que cree uno nuevo en caso contrario lo modifique */
         if(is_null($verificaPerfil)){
              
            /*captura el nombre de la imagen*/
            $nombreimagen=$request->imagenInstitucion->getClientOriginalName();
            /*captura el nombre del logo*/
            $nombrelogo=$request->logoInstitucion->getClientOriginalName();

            /*crea una nueva carpeta con el id del perfil nuevo*/
            $path = public_path().'img/instituciones/' . $id_user;
            File::makeDirectory($path,  0777, true);

            /*guarda la imagen en carpeta con el id del usuario*/
            $imagen = $request->file('imagenInstitucion');
            $imagen->move("img/instituciones/$id_user", $imagen->getClientOriginalName());
            $logo = $request->file('logoInstitucion');
            $logo->move("img/instituciones/$id_user", $logo->getClientOriginalName());

        
       
            /*anexo iduser y img logoempresa  al request*/
            $request->merge([
            'idUser' => "$id_user", 
            'imagen' => "img/instituciones/$id_user/$nombreimagen",
            'logo' => "img/instituciones/$id_user/$nombrelogo"
                ]);

            instituciones::create($request->all());
           
            return redirect('FormularioInstitucion'); 

         }else{
             
        
            /*captura el nombre de la imagen*/
            $nombreimagen=$request->imagenInstitucion->getClientOriginalName();
            /*captura el nombre del logo*/
            $nombrelogo=$request->logoInstitucion->getClientOriginalName();


            /*guarda la imagen en carpeta con el id del usuario*/
            $imagen = $request->file('imagenInstitucion');
            $imagen->move("img/instituciones/$id_user", $imagen->getClientOriginalName());
            $logo = $request->file('logoInstitucion');
            $logo->move("img/instituciones/$id_user", $logo->getClientOriginalName());


            /*anexo iduser y img logoempresa  al request*/
            $request->merge([
            'idUser' => "$id_user", 
            'imagen' => "img/instituciones/$id_user/$nombreimagen",
            'logo' => "img/instituciones/$id_user/$nombrelogo"
                ]);

                $dataInstitucion = request()->all();
                unset($dataInstitucion['_token']);
                unset($dataInstitucion['logoInstitucion']);
                unset($dataInstitucion['imagenInstitucion']);
              

                instituciones::where('idUser', $id_user)->update($dataInstitucion);

            return redirect('FormularioInstitucion'); 
         }
        return redirect('FormularioInstitucion'); 
    }
/*-------------------------------------Fin Creacion y/o modificacion formulario parte 1----------------------*/




}
