<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\PagoCita;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagosController extends Controller
{
    public function index()
    {
        $pagos = PagoCita::query()
            ->with([
                'cita' => function ($query) {
                    $query->where('profesional_id', '=', Auth::user()->profecional->idPerfilProfesional);
                },
                'cita.paciente',
                'cita.paciente.user'
            ])
            ->get();

        return view('profesionales.admin.pagos', compact('pagos'));
    }
}
