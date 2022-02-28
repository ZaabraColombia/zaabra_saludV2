<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use App\Models\favoritos_especialidades;
use App\Models\favoritos_especialistas;
use App\Models\favoritos_instituciones;
use App\Models\favoritos_servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function auth;
use function redirect;
use function response;
use function view;

class FavoritosController extends Controller
{
    public function index(){
        if (Auth::check()){
            $id_users=auth()->user()->id;
            $objFavorito=$this->cargaFavorito($id_users);
            $objFavoritoServicio=$this->cargaFavotritoServicio($id_users);
            $objFavoritoEspec=$this->cargaFavoritoEspecialista($id_users);
            $objFavoritoInst=$this->cargaFavoritoInstitucion($id_users);

            return view('panelAdministrativo.favoritos',compact(
                'objFavorito',
                'objFavoritoServicio',
                'objFavoritoEspec',
                'objFavoritoInst'
            ));
        }else{
            return redirect()->guest('/login');
        }
    }

    // 1. Funciones para la tarjeta de especialidades favoritas agenda paciente, vista favorito.blade.php
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

    // 2. Funciones para la tarjeta de servicios favoritos agenda paciente, vista favoritos.blade.php
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

    // 3. Funciones para la tarjeta de especialistas favoritos agenda paciente, vista favoritos.blade.php
    public function cargaFavoritoEspecialista($id_users){
        return DB::select(
            "SELECT fes.nombre_favorito_especialista
            FROM favoritos_especialistas fes
            LEFT JOIN users us ON fes.id_users=us.id
            WHERE fes.id_users=$id_users"
        );
    }

    public function create3(Request $request) {

        /*id usuario logueado*/
        $id_users=auth()->user()->id;
        $request->merge([
            'id_users' => "$id_users",
        ]);
        unset($request['_token']);
        $data = $request->all();
        $result = favoritos_especialistas::create($data);
        if($result){
            $arr = array('msg' => 'El especialista ha sido guardado en sus favoritos', 'status' => true);
        }
        return Response()->json($arr);
    }

    // 4. Funciones para la tarjeta de instituciones favoritos agenda paciente, vista favoritos.blade.php
    public function cargaFavoritoInstitucion($id_users){
        return DB::select(
            "SELECT fi.nombre_favorito_institucion
            FROM favoritos_instituciones fi
            LEFT JOIN users us ON fi.id_users = us.id
            WHERE fi.id_users = $id_users"
        );
    }

    public function create4(Request $request) {

        /*id usuario logueado*/
        $id_users=auth()->user()->id;
        $request->merge([
            'id_users' => "$id_users",
        ]);
        unset($request['_token']);
        $data = $request->all();
        $result = favoritos_instituciones::create($data);
        if($result){
            $arr = array('msg' => 'La institucion ha sido guardado en sus favoritos', 'status' => true);
        }
        return Response()->json($arr);
    }
}
