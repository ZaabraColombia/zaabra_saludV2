<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\especialidades;
use App\Models\profesionales_instituciones;
use App\Models\Servicio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CalendarioController extends Controller
{
    public function iniciar_control()
    {
        $institucion = Auth::user()->institucion->id;

        //Profesionales
        $profesionales = profesionales_instituciones::query()
            ->select('id_profesional_inst', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
            //->nombreCompleto()
            ->where('estado', 1)
            ->where('id_institucion', $institucion)
            ->get();

        //Servicios
        $servicios = Servicio::query()
            ->select(['id', 'nombre'])
            ->where('institucion_id', $institucion)
            ->where('estado', 1)
            ->get();

        //Especialidades
        $especialidades = especialidades::query()
            ->where('estado', 1)
            ->whereHas('servicios', function (Builder $query) use ($institucion){
                $query->where('servicios.institucion_id', $institucion)
                    ->where('servicios.estado', 1);
            })
            ->get();

        return view('instituciones.admin.calendario.filtro', compact('profesionales',
            'servicios', 'especialidades'));
    }


    public function buscar(Request $request)
    {
        $request->validate([
            'id'    => ['required'],
            'tipo'  => ['required', Rule::in(['profesional', 'servicio', 'especialidad'])]
        ]);

        $institucion = Auth::user()->institucion->id;
        $id = $request->get('id');

        $profesionales = array();

        switch ($request->get('tipo'))
        {
            case 'profesional':
                $profesionales[] = profesionales_instituciones::query()
                    ->select('id_profesional_inst as id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                    ->nombreCompleto()
                    ->where('id_profesional_inst', $id)
                    ->where('estado', 1)
                    ->where('id_institucion', $institucion)
                    ->first()->toArray();
                break;
            case 'servicio':
                $profesionales = profesionales_instituciones::query()
                    ->select('id_profesional_inst as id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                    ->nombreCompleto()
                    ->whereHas('servicios', function (Builder $query) use ($institucion, $id) {
                        $query->where('institucion_id', $institucion)
                            ->where('servicios.id', $id);
                    })
                    ->where('estado', 1)
                    ->where('id_institucion', $institucion)
                    ->get()->toArray();
                break;
            case 'especialidad':
                $profesionales = profesionales_instituciones::query()
                    ->select('id_profesional_inst as id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                    ->nombreCompleto()
                    ->whereHas('servicios', function (Builder $query) use ($institucion, $id) {
                        $query->where('institucion_id', $institucion)
                            ->where('servicios.especialidad_id', $id);
                    })
                    ->where('estado', 1)
                    ->where('id_institucion', $institucion)
                    ->get()->toArray();
                break;
        }

        return response([
            'items' => $profesionales
        ], Response::HTTP_OK);
    }


    public function citas(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'fecha' => ['required', 'date'],
            'lista-profesionales' => ['required'],
            'lista-profesionales.*.id' => [
                //'required',
                Rule::exists('profesionales_instituciones', 'id_profesional_inst')->where(function ($query) {
                    $query->where('id_institucion', Auth::user()->institucion->id)
                        ->where('estado', 1);
                })
            ],
        ], [
            //'lista-profesionales.*.id.required' => 'Asegúrese que los profesionales eaten agregados de forma correcta',
            'lista-profesionales.*.id.exists'   => 'Asegúrese que el profesional estén agregados de forma correcta',
        ]);





    }
}
