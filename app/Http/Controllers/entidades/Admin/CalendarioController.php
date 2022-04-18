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
        $fecha = $request->fecha;

        return view('instituciones.admin.calendario.citas', compact('lista', 'fecha'));
    }

    public function lista_citas_2(Request $request)
    {

        //dd($request->get('ids'));
        $query = Cita::query()
            ->select('id_cita', 'fecha_inicio', 'fecha_fin', 'lugar', 'estado')
            ->selectRaw('DATE_FORMAT(fecha_inicio, "%H:%i") as hora')
            ->addSelect([
                'profesional' => DB::table('profesionales_instituciones')
                    ->selectRaw('concat( primer_nombre, " ", segundo_nombre, " ", primer_apellido, " ", segundo_apellido) as profesional')
                    ->whereColumn('id_profesional_inst', 'citas.profesional_ins_id')->take(1),
                'paciente' => User::query()
                    ->selectRaw('concat( primernombre, " ", segundonombre, " ", primerapellido, " ", segundoapellido) as paciente')
                    ->whereHas('paciente', function ($query){
                        return $query->whereColumn('citas.paciente_id', 'pacientes.id');
                    })
                    ->take(1),
                'identificacion' => User::query()
                    ->select('numerodocumento as identificacion')
                    ->whereHas('paciente', function ($query){
                        return $query->whereColumn('citas.paciente_id', 'pacientes.id');
                    })
                    ->take(1),
            ])
            ->whereIn('profesional_ins_id', $request->get('ids'));

        //dd($query->get()->toJson());

        return datatables()->eloquent($query)->toJson();
    }

    public function lista_citas(Request $request)
    {
        $query = Cita::query()
            ->with([
                'paciente:id,id_usuario,celular',
                'paciente.user:id,primernombre,segundonombre,primerapellido,segundoapellido,numerodocumento',
                'profesional_ins:id_profesional_inst,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido'
            ])
            //->where(DB::raw("DATE_FORMAT(fecha_inicio, '%Y-%c-%e') = '{$request->fecha}'"))
            ->whereIn('profesional_ins_id', $request->get('ids'));

        //dd($query->get()->toJson());

        return datatables()->eloquent($query)->toJson();
    }
}
