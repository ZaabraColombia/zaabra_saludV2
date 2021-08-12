<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\favoritos_especialidades;
use App\Models\favoritos_servicios;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

class adminFavoritosController extends Controller
{
    public function index(){
        if (Auth::check()){
            $id_users=auth()->user()->id;
            $objFavorito=$this->cargaFavorito($id_users);
            $objFavoritoServicio=$this->cargaFavotritoServicio($id_users);

            return view('panelAdministrativo.favoritos',compact(
                'objFavorito',
                'objFavoritoServicio'
            ));
        }else{
            return redirect()->guest('/login');
        } 
    }

    
    public function cargaFavorito($id_users){
        return DB::select("SELECT fe.nombre_favorito_especialidad
        FROM favoritos_especialidades fe
        LEFT JOIN users us   ON fe.id_users=us.id
        WHERE fe.id_users=$id_users");
    }
    
    public function  create(Request $request) {
        /*id usuario logueado*/
        $id_users=auth()->user()->id; 
        $request->merge([
            'id_users' => "$id_users", 
        ]);
        unset($request['_token']);
        $data = $request->all();
        $result = favoritos_especialidades::create($data);
        if($result){ 
            $arr = array('msg' => 'La especialidad ha sido guardad en sus favoritos', 'status' => true);
        }
        return Response()->json($arr);  
    }


    public function cargaFavotritoServicio($id_users){
        return DB::select("SELECT fs.nombre_favorito_servicio
        FROM favoritos_servicios fs
        LEFT JOIN users us   ON fs.id_users=us.id
        WHERE fs.id_users=$id_users");
    }

    public function create2(Request $request) {
       
        /*id usuario logueado*/
        $id_users=auth()->user()->id; 
        $request->merge([
            'id_users' => "$id_users", 
        ]);
        unset($request['_token']);
        $data = $request->all();
        $result = favoritos_servicios::create($data);
        if($result){ 
            $arr = array('msg' => 'El servicio ha sido guardado en sus favoritos', 'status' => true);
        }
        return Response()->json($arr);  
    }

}