<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\contactecnos;
class contactecnosController extends Controller
{
    public function index()
    {
        /*varifica si existe un sesion iniciada y en caso de
        que asi sea consulta, verifica que usuario es y realiza la
        consulta de los datos del mismo, en caso contrario mustra el formulario con campos vacios*/
        if (!Auth::guest()){
            $id_user=auth()->user()->id;/*id usuario logueado*/
            $objuser = $this->cargaDatosUser($id_user);
            return view('contacto',compact(
                'objuser'
            ));
        }else{
            return view('contacto');
        }
    }

    /*consulta infromacion del usuario logueado*/
    public function cargaDatosUser($id_user){
    return DB::select("SELECT us.primernombre, us.segundonombre, us.primerapellido, us.segundoapellido, us.nombreinstitucion, us.email
    FROM users us
    WHERE id=$id_user");
    }

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


   public function save(Request $request){
     
        if (!Auth::guest()){
            $id_user=auth()->user()->id;/*id usuario logueado*/

            /*anexo iduser y img logoempresa  al request*/
            $request->merge([
                'id_user' => "$id_user", 
                ]);

            $data = $request->all();
            $result = contactecnos::create($data);
                if($result){ 
                    $arr = array('msg' => 'Gracias por comunicarse con nosotros, pronto recibirá un correo', 'status' => true);
                }
        }else{
            $data = $request->all();
            $result = contactecnos::create($data);
            if($result){ 
                $arr = array('msg' => 'Gracias por comunicarse con nosotros, pronto recibirá un correo', 'status' => true);
            }
        }

        return Response()->json($arr);

    }

}