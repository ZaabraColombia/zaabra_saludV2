<?php

namespace App\Http\Controllers\buscador;

use App\Http\Controllers\Controller;
use App\Models\ActividadEconomica;
use App\Models\Servicio;
use App\Models\Sgsss;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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

    public function servicios_convenio(Request $request)
    {
        $request->validate([
            'servicio'      => ['required', 'exists:servicios,id'],
            'institucion'   => ['required', 'exists:instituciones,id'],
        ]);

        $servicio = Servicio::query()
            ->with(['convenios_lista' => function($query){
                $query->select('convenios.id', 'convenios.primer_nombre', 'convenios.segundo_nombre', 'convenios.primer_apellido', 'convenios.segundo_apellido');
            }])
            ->where('id', $request->get('servicio'))
            ->where('institucion_id', $request->get('institucion'))
            ->first();

        return response(['items' => $servicio->convenios_lista], Response::HTTP_OK);
    }
}
