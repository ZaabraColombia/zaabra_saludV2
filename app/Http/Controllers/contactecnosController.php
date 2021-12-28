<?php

namespace App\Http\Controllers;

use App\Mail\ContactoEmail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\contactecnos;
use Illuminate\Support\Facades\Mail;

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

    /* Función solo para verificar que perfil existe y esta se utiliza en las demás */
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
    /*- Fin función solo para verificar que perfil existe y esta se utiliza en los demás métodos -*/


    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function save(Request $request){

        $contact = $request->all();

        Mail::to('servicioalcliente@zaabrasalud.co')->send(new ContactoEmail($contact));

        return response(['msg' => 'Gracias por comunicarse con nosotros, pronto recibirá un correo'], Response::HTTP_OK);
    }

}
