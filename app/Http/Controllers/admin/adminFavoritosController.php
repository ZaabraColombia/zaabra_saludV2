<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\favoritos_especialidades;
use Auth;

class adminFavoritosController extends Controller
{
    public function index(){
        if (Auth::check()){
            $id_users=auth()->user()->id;
            $objFavorito=$this->cargaFavorito($id_users);

            return view('panelAdministrativo.favoritos',compact(
                'objFavorito'
            ));
        }else{
            return redirect()->guest('/login');
        } 
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

    public function cargaFavorito($id_users){
        return DB::select("SELECT fe.nombre_favorito_especialidad
        FROM favoritos_especialidades fe
        LEFT JOIN users us   ON fe.id_users=us.id
        WHERE fe.id_users=$id_users");
    }


}