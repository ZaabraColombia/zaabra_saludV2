<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UbicacionController extends Controller
{

    protected $url_paises_all   = "https://battuta.medunes.net/api/country/all/?key=";
    protected $url_paises_      = "https://battuta.medunes.net/api/country/search/?country=:pais&key=";
    protected $url_regiones = "https://battuta.medunes.net/api/region/:pais/all/?key=";
    protected $url_ciudades = "https://battuta.medunes.net/api/city/:pais/search/?region=:region&key=";

    public function paises(Request $request)
    {
        $paises = Pais::query()
            ->where('name', 'like', "%$request->pais%")
            ->orWhere('code', 'like', "%$request->pais%")
            ->get();

        return response(['paises' => $paises], Response::HTTP_OK);
    }

    public function regiones(Request $request)
    {

    }

    public function ciudades(Request $request)
    {

    }
}
