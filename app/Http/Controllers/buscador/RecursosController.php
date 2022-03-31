<?php

namespace App\Http\Controllers\buscador;

use App\Http\Controllers\Controller;
use App\Models\Sgsss;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecursosController extends Controller
{

    /**
     * Permite realizar búsqueda de Sgsss
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function sgsss(Request $request)
    {
        return response([
            'items' => Sgsss::query()->where('nombre', 'like', "%{$request->term}%")->get()
        ], Response::HTTP_OK);
    }
}
