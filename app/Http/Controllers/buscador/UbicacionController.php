<?php

namespace App\Http\Controllers\buscador;

use App\Http\Controllers\Controller;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\paises;
use App\Models\provincia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UbicacionController extends Controller
{
    public function departamentos(paises $pais){

        $departamento = departamento::query()
            ->where("id_pais",$pais->id_pais)
            ->get(['id_departamento as id', 'nombre as text']);

        return response([
            'items' => $departamento
        ], Response::HTTP_OK);
    }

    public function provincias(departamento $departamento){

        $provincia = provincia::query()
            ->where("id_departamento", $departamento->id_departamento)
            ->get(['id_provincia as id', 'nombre as text']);

        return response([
            'items' => $provincia
        ], Response::HTTP_OK);
    }

    public function ciudades(provincia $provincia){

        $municipio = municipio::query()
            ->where("id_provincia", $provincia->id_provincia)
            ->get(['id_municipio as id', 'nombre as text']);

        return response([
            'items' => $municipio
        ], Response::HTTP_OK);
    }
}
