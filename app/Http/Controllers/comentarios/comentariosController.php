<?php

namespace App\Http\Controllers\comentarios;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\comentarios;
use App\Models\User;
use App\Models\users_roles;


class comentariosController extends Controller{


    public function save(Request $request){

        if (!Auth::guest()){
            $id_user=auth()->user()->id;/*id usuario logueado*/

            $idUserRol = DB::table('users')
            ->select('users_roles.iduser')
            ->join('users_roles', 'users.id', '=', 'users_roles.iduser')
            ->where('users.id', '=',$id_user)
            ->first();

            foreach($idUserRol as $idUserRol){
                $id=$idUserRol;
            }

            /*anexo iduser y img logoempresa  al request*/
            $request->merge([
                'idusuariorol' => "$id", 
            ]);

            $data = $request->all();
            $result = comentarios::create($data);
            if($result){ 
                $arr = array('msg' => 'Gracias por su comentario, su opinión es muy importante para nosotros.', 'status' => true);
            }
            return Response()->json($arr);
        }
        
    }

}




