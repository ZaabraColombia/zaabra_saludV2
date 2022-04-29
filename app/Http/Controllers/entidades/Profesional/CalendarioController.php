<?php

namespace App\Http\Controllers\entidades\Profesional;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    public function index()
    {
        return view('instituciones.profesionales.calendario.calendario');
    }

    /**
     * Permite listar todas las citas
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function ver_citas(Request $request)
    {
        $dates = Cita::query()
            ->where('profesional_ins_id', '=', Auth::user()->id_profesional_inst)
            ->whereNotIn('estado', ['cancelado', 'completado'])
            ->with(['paciente', 'paciente.user', 'pago'])
            ->get();

        $data = array();
        foreach ($dates as $date) {
            if ($date->estado == 'reservado')
            {
                $data[] = [
                    'id'    => $date->id_cita,
                    'start' => $date->fecha_inicio,
                    'end'   => $date->fecha_fin,
                    'backgroundColor' => '#F37725',
                    'textColor' => 'black',
                    'borderColor' => 'black',
                    //'display' => 'background',
                    'display' => 'block',
                    'title' => 'Bloqueado',
                ];
            } else {

                //validar background
                switch ($date->pago->tipo)
                {
                    case 'presencial':
                        //Color cita pago
                        $background = '#D6FFFB';
                        $color = '#323232';
                        break;
                    case 'virtual':
                        //Si esta aprobado es pagado, si no es pagado se establece como no pagado
                        $background = ($date->pago->aprobado) ? '#1B85D7':'#019F86';
                        $color = '#FFFFFF';
                        break;
                    default:
                        $background = null;
                        $color = null;
                        break;
                }

                $data[] = [
                    'id'    => $date->id_cita,
                    'start' => $date->fecha_inicio,
                    'end'   => $date->fecha_fin,
                    'backgroundColor' => $background,
                    'textColor' => $color,
                    'borderColor' => '#696969',
                    'display' => 'block',
                    'title' => $date->paciente->user->nombre_completo,
                    'show' => route('institucion.profesional.calendario.ver-cita', ['cita' => $date->id_cita])
                ];

            }
        }

        return response($data, Response::HTTP_OK);
    }
}
