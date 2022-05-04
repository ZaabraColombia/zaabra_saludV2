<?php

namespace App\Http\Controllers\entidades\Admin;
use App\Http\Controllers\Controller;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CitasController extends Controller
{
    public function index() {

        Gate::authorize('accesos-institucion','ver-citas');

        return view('instituciones.admin.citas');
    }


    public function lista_citas(Request $request)
    {
        $query = Cita::query()
            ->with([
                'especialidad',
                'paciente:id,id_usuario,celular',
                'paciente.user:id,primernombre,segundonombre,primerapellido,segundoapellido,numerodocumento',
                'profesional_ins:id_profesional_inst,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido'
            ]);

        return datatables()->eloquent($query)->toJson();
    }
}
