<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use App\Models\especialidades;
use App\Models\PagoCita;
use App\Models\perfilesprofesionales;
use App\Models\profesionales_instituciones;
use App\Models\tipoconsultas;
use App\Models\universidades;
use App\Models\User;
use http\QueryString;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use function view;

class ProfesionalesController extends Controller
{

    public function index2(){

        $union = perfilesprofesionales::query()
            ->select('direccion', 'EmpresaActual as institucion')
            ->addSelect([
                'nombre' => User::query()
                    ->selectRaw('concat(primernombre, " ",segundonombre, " ",primerapellido, " ",segundoapellido) as nombre')
                    ->whereColumn('id', '=', 'perfilesprofesionales.idUser')
                    ->latest()
                    ->take(1),
                'especialidad' => especialidades::query()
                    ->select('nombreEspecialidad as especialidad')
                    ->whereColumn('idEspecialidad', '=', 'perfilesprofesionales.idespecialidad')
                    ->latest()
                    ->take(1),
                'universidad' => universidades::query()
                    ->select('nombreuniversidad as universidad')
                    ->whereColumn('id_universidad', '=', 'perfilesprofesionales.id_universidad')
                    ->latest()
                    ->take(1),
            ])
            ->whereHas('citas', function ($query) {
                $query->where('paciente_id', '=', Auth::user()->paciente->id);
            });

        $profesionales = profesionales_instituciones::query()
            ->selectRaw('concat(primer_nombre, " ",segundo_nombre, " ",primer_apellido, " ",segundo_apellido) as nombre')
            ->addSelect([
                'especialidad' => especialidades::query()
                    ->select('nombreEspecialidad as especialidad')
                    ->join('institucion_profesionales_especialidades as pt', 'roles.id', '=', 'pt.role_id')
                    ->latest()
                    ->take(1),
                'universidad' => universidades::query()
                    ->select('nombreuniversidad as universidad')
                    ->whereColumn('id_universidad', '=', 'perfilesprofesionales.id_universidad')
                    ->latest()
                    ->take(1),
            ])
            ->union($union)
            ->get();

        return view('paciente.admin.profesionales', compact('profesionales'));
    }


    public function index(){

        $profesionales = perfilesprofesionales::query()
            ->whereHas('citas', function ($query) {
                $query->where('paciente_id', '=', Auth::user()->paciente->id);
            })
            ->with([
                'user',
                'especialidad',
                'universidad',
            ])
            ->get();

        $profesionales_ins = profesionales_instituciones::query()
            ->whereHas('citas', function ($query) {
                $query->where('paciente_id', '=', Auth::user()->paciente->id);
            })
            ->with([
                'institucion',
                'universidad',
                'especialidades',
            ])
            ->get();

        return view('paciente.admin.profesionales', compact('profesionales', 'profesionales_ins'));
    }

}
