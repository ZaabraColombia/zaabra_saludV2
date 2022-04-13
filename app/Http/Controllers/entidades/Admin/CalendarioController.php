<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\especialidades;
use App\Models\profesionales_instituciones;
use App\Models\Servicio;
use App\Models\TipoServicio;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $lista = array_column($request->get('lista-profesionales'), 'id');

        return view('instituciones.admin.calendario.citas', compact('lista'));
    }

    public function lista_citas(Request $request)
    {

        //dd($request->get('ids'));
        $query = Cita::query()
            ->select('*')
            ->selectRaw('fecha_inicio as fecha ')
            ->selectRaw('fecha_fin as hora ')
            ->addSelect(['profesional' => DB::table('profesionales_instituciones')
                ->selectRaw('concat( primer_nombre, " ", segundo_nombre, " ", primer_apellido, " ", segundo_apellido) as profesional')
                ->whereColumn('id_profesional_inst', 'citas.profesional_ins_id')->take(1)
            ])
            ->addSelect([
                'paciente' => User::query()->selectRaw()
            ])
//            ->addSelect(['identificacion' => DB::table('users')
//                ->selectRaw('numerodocumento as identificacion')
//                ->join('pacientes', 'pacientes.id_usuario', '=', 'user.id')
//                ->whereColumn('pacientes.id', 'citas.paciente_id')
//                ->take(1)
//            ])
            ->whereIn('profesional_ins_id', $request->get('ids'));

        return datatables($query)->toJson();
    }
}
