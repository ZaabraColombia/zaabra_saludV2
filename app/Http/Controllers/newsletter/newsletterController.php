<?php

namespace App\Http\Controllers\newsletter;
use App\Http\Controllers\Controller;
use App\Mail\NewLetterEmail;
use Illuminate\Http\Request;
use App\Models\newsletters;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class newsletterController extends Controller{

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo_newsletter' => ['required', 'unique:newsletters,correo_newsletter']
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $result = new newsletters($request->all());
        $result->save();

        if(empty($result)){
            return response([
                'mensaje' => 'No se pudo subscribir'
            ], Response::HTTP_NOT_FOUND);
        }

        Mail::to($request->correo_newsletter)->send(new NewLetterEmail());
        return response([
            'mensaje' => 'Gracias por suscribirse a nuestro newsletter'
        ], Response::HTTP_OK);
    }
}
