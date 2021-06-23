<?php

namespace App\Http\Controllers\comentarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\comentarios;

class comentariosController extends Controller
{
    public function save(Request $request){

       
        unset($request['_token']);
        $data = $request->all();
        $result = comentarios::create($data);
        if($result){ 
            $arr = array('msg' => 'Gracias por su comentario, su opinión es muy importante para nosotros.', 'status' => true);
        }
        return Response()->json($arr);
    }
}


