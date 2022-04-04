<?php

namespace App\Http\Controllers\buscador;

use App\Http\Controllers\Controller;
use App\Models\ActividadEconomica;
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
        $items =Sgsss::query()
            ->where('id', 'like', "%{$request->term}%")
            ->orWhere('nombre', 'like', "%{$request->term}%")
            ->get(['id', 'nombre as text']);

        return response([
            'items' => $items
        ], Response::HTTP_OK);
    }

    /**
     * Permite buscar en actividades económicas
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function actividad_economica(Request $request)
    {
        $items = ActividadEconomica::query()
            ->where('id', 'like', "%{$request->term}%")
            ->orWhere('nombre', 'like', "%{$request->term}%")
            ->get(['id', 'nombre as text']);

        return response([
            'items' => $items
        ], Response::HTTP_OK);
    }
}
