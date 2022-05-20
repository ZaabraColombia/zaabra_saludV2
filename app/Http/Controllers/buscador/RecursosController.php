<?php

namespace App\Http\Controllers\buscador;

use App\Http\Controllers\Controller;
use App\Models\ActividadEconomica;
use App\Models\Convenios;
use App\Models\profesionales_instituciones;
use App\Models\Servicio;
use App\Models\Sgsss;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
        $items = Sgsss::query()
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

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function servicios_convenio(Request $request)
    {
        $request->validate([
            'servicio' => ['required', 'exists:servicios,id'],
            'institucion' => ['required', 'exists:instituciones,id'],
        ]);

        $servicio = Servicio::query()
            ->with(['convenios_lista' => function ($query) {
                $query
                    ->select('convenios.id', 'convenios.primer_nombre', 'convenios.segundo_nombre',
                        'convenios.primer_apellido', 'convenios.segundo_apellido', 'convenios.tipo_documento_id',
                        'convenios.numero_documento');

            }])
            ->where('id', $request->get('servicio'))
            ->where('institucion_id', $request->get('institucion'))
            ->first();

        $lista = $servicio->convenios_lista->map(function ($item) {
            return [
                'nombre_completo' => $item->nombre_completo,
                'valor' => "$" . number_format($item->pivot->valor_paciente, 0, ',', '.'),
                'id' => $item->id
            ];
        });

        return response(['items' => $lista], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function servicios_convenio_profesional(Request $request)
    {
        $request->validate([
            'servicio' => ['required', 'exists:servicios,id'],
            'profesional' => ['required', 'exists:perfilesprofesionales,idPerfilProfesional'],
        ]);

        $servicio = Servicio::query()
            ->with(['convenios_lista' => function ($query) {
                $query
                    ->select('convenios.id', 'convenios.primer_nombre', 'convenios.segundo_nombre',
                        'convenios.primer_apellido', 'convenios.segundo_apellido', 'convenios.tipo_documento_id',
                        'convenios.numero_documento');

            }])
            ->where('id', $request->get('servicio'))
            ->where('institucion_id', $request->get('institucion'))
            ->first();

        $lista = $servicio->convenios_lista->map(function ($item) {
            return [
                'nombre_completo' => $item->nombre_completo,
                'valor' => "$" . number_format($item->pivot->valor_paciente, 0, ',', '.'),
                'id' => $item->id
            ];
        });

        return response(['items' => $lista], Response::HTTP_OK);
    }

    public function calendario_disponible(Request $request)
    {
        $request->validate([
            'profesional' => [
                'required',
                Rule::exists('profesionales_instituciones', 'id_profesional_inst')
                    ->where('id_institucion', Auth::user()->institucion->id)
            ]
        ]);

        $profesional = profesionales_instituciones::query()
            ->where('id_profesional_inst', $request->profesional)
            ->where('id_institucion', Auth::user()->institucion->id)
            ->first();

        $agenda['disponibilidad'] = $profesional->disponibilidad_agenda;
        $agenda['consultorio'] = $profesional->consultorio;

        $servicios = $profesional->servicios;
        $horario = $profesional->horario;

        if (empty($horario) or empty($servicios) or empty($agenda['disponibilidad']) or empty($agenda['consultorio']))
            return response([
                'message' => [
                    'title' => 'Agenda no disponible',
                    'text' => "Profesional {$profesional->nombre_completo} no tiene la agenda disponible"
                ]
            ], Response::HTTP_NOT_FOUND);

        //Atrae los dias de la semana que NO labora
        $weekNotBusiness = array();
        foreach (array_column($horario, 'daysOfWeek') as $item)
            $weekNotBusiness = array_merge($weekNotBusiness, $item);

        $agenda['weekNotBusiness'] = array_unique($weekNotBusiness);
        //$agenda['weekNotBusiness'] = [0, 1, 2];

        $lista = $profesional->servicios->map(function ($item) {
            return ['id' => $item->id, 'nombre' => $item->nombre, 'valor' => $item->valor];
        });

        return response(['servicios' => $lista, 'agenda' => $agenda], Response::HTTP_OK);
    }

    /**
     * Busca los profesionales de una institución
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function profesionales_institucion(Request $request)
    {
        $term = $request->searchTerm;
        $service = $request->service;

        $profesionales = profesionales_instituciones::query()
            ->select('id_profesional_inst as id', 'nombre_completo as text', 'sede_id')
            ->selectRaw('concat(nombre_completo, " ") as consultorio_completo')
            ->where('id_institucion', Auth::user()->institucion->id)
            ->with([
                'sede',
                'sede.ciudad',
            ])
            ->where(function ($query) use ($term) {
                return $query->where('numero_documento', 'like', "%{$term}%")
                    ->orWhere('primer_nombre', 'like', '%' . $term . '%')
                    ->orWhere('segundo_nombre', 'like', '%' . $term . '%')
                    ->orWhere('primer_apellido', 'like', '%' . $term . '%')
                    ->orWhere('segundo_apellido', 'like', '%' . $term . '%')
                    ->orWhere('nombre_completo', 'like', '%' . $term . '%');
            });

        if (!empty($service))
            $profesionales->whereHas('servicios', function ($query) use ($service) {
                return $query->where('servicios.id', $service);
            });

        $result = $profesionales
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->text,
                    'consultorio_completo' => $item->consultorio_completo
                ];
            });;


        return response($result, Response::HTTP_OK);
    }
}
