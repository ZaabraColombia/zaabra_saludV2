<?php

namespace App\Http\Controllers\newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\newsletters;

class newsletterController extends Controller{

    public function save(Request $request){

       
        unset($request['_token']);
        $data = $request->all();
        $result = newsletters::create($data);
        if($result){ 
            $arr = array('msg' => 'Gracias por suscribirse a nuestro newsletter', 'status' => true);
        }
        return Response()->json($arr);
    }
}
