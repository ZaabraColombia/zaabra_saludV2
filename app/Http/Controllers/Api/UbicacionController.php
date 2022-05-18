<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ciudad;
use App\Models\Pais;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class UbicacionController extends Controller
{

    protected $url_paises_all;
    protected $url_paises;
    protected $url_regiones;
    protected $url_ciudades;

    public function __construct()
    {
        $this->url_paises_all = "https://battuta.medunes.net/api/country/all/?key=" . env('API_BATTUTA');
        $this->url_paises = "https://battuta.medunes.net/api/country/search/?country=:pais&key=" . env('API_BATTUTA');
        $this->url_regiones = "https://battuta.medunes.net/api/region/:pais/all/?key=" . env('API_BATTUTA');
        $this->url_ciudades = "https://battuta.medunes.net/api/city/:pais/search/?region=:region&key=" . env('API_BATTUTA');
    }


    /**
     * Permite captar países
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function paises(Request $request)
    {
        $request->validate([
            'pais' => ['nullable', 'string','min:2']
        ]);

        $query = Pais::query();

        if (!empty($request->pais)) $query->where('nombre', 'like', "%$request->pais%");
        if (!empty($request->pais)) $query->orWhere('code', 'like', "%$request->pais%");

        $paises = $query->get();

        if ($paises->isEmpty()) {
            if (!empty($request->pais)) {
                $response = Http::get(str_replace(':pais', $request->pais, $this->url_paises));
            } else {
                $response = Http::get($this->url_paises_all);
            }

            $data = collect($response->object())->map(function ($item) {
                return ['code' => $item->code, 'nombre' => $item->name];
            });

            Pais::query()->upsert(
                $data->toArray(),
                ['code']
            );

            $paises = $data;
        }

        return response($paises->toArray(), Response::HTTP_OK);
    }

    /**
     * Permite captar regiones
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function regiones(Request $request)
    {
        $request->validate([
            'pais'  => ['required', 'string','size:2'],
        ]);

        $regiones = Region::query()->where('pais_code', $request->pais)->get();

        if ($regiones->isEmpty()) {

            $response = Http::get(str_replace(':pais', $request->pais, $this->url_regiones));

            $pais = $request->pais;

            $data = collect($response->object())->map(function ($item) use ($pais){
                return ['nombre' => $item->region, 'pais_code' => $pais];
            });

            Region::query()->upsert(
                $data->toArray(),
                ['nombre']
            );

            $regiones = Region::query()->where('pais_code', $request->pais)->get();
        }

        return response($regiones->toArray(), Response::HTTP_OK);
    }

    public function ciudades(Request $request)
    {
        $request->validate([
            'pais'  => ['required', 'string','size:2'],
            'region'=> ['required', 'integer']
        ]);

        $ciudades = Ciudad::query()->where('region_id', $request->region)->get();

        if ($ciudades->isEmpty()) {
            $region = Region::query()->find($request->region);

            if (!empty($region))
            {
                $response = Http::get(str_replace([':pais', ':region'], [$request->pais, $region->nombre], $this->url_ciudades));

                $data = collect($response->object())->map(function ($item) use ($region){
                    return [
                        'nombre' => $item->city,
                        'latitud' => $item->latitude,
                        'longitud' => $item->longitude,
                        'region_id' => $region->id
                    ];
                });

                Ciudad::query()->upsert(
                    $data->toArray(),
                    ['nombre', 'region_id']
                );
                $ciudades = Ciudad::query()->where('region_id', $request->region)->get();
            }

        }

        return response($ciudades->toArray(), Response::HTTP_OK);
    }
}
