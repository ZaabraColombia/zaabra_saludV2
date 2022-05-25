<?php

namespace App\Http\Controllers\entidades\Admin;
use App\Http\Controllers\Controller;

use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class PanelController extends Controller {

    public function index()
    {
        return view('instituciones.admin.panel');
    }


    public function search(Request $request)
    {
        $rutas = Ruta::query()
            ->select('rutas.*')
            ->orderBy('titulo')
            ->search($request->search)
            ->validar()
            ->institucion()
            ->get();

        $data = $rutas->map(function ($item){
            if ($item->name) $item->ruta = route($item->name);
            return $item;
        });

        return response($data, Response::HTTP_OK);
    }

}

