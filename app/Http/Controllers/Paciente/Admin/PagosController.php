<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use App\Models\PagoCita;
use App\Models\tipoconsultas;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use function view;

class PagosController extends Controller
{

    public function index(){

        $pagos = PagoCita::query()
            ->wherehas('cita', function ($query) {
                $query->where('paciente_id', '=', Auth::user()->paciente->id);
            })
            ->with([
                'cita',
                'cita.tipo_consulta'
            ])
            ->get();

        return view('paciente.admin.pagos', compact('pagos'));
    }

}
