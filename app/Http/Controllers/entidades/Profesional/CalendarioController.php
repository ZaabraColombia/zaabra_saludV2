<?php

namespace App\Http\Controllers\entidades\Profesional;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\especialidades;
use App\Models\profesionales_instituciones;
use App\Models\Servicio;
use App\Models\TipoServicio;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
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
                    'show' => route('institucion.profesional.calendario.ver-cita', ['cita' => $date->id_cita])
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

    /**
     * Permite buscar una cita
     *
     * @param $cita
     * @return Application|ResponseFactory|Response
     */
    public function ver_cita($cita)
    {
        $cita = Cita::query()
            ->with([
                'paciente',
                'paciente.user',
                'paciente.user.tipo_documento',
                'especialidad',
                'servicio',
                'servicio.cups',
                'servicio.tipo_servicio'
            ])
            ->whereHas('profesional_ins', function (Builder $query) {
                return $query->where('id_institucion', Auth::user()->institucion->id);
            })
            ->where('id_cita', $cita)
            ->first();

        if (empty($cita))
            return response([
                'title'     => 'Error',
                'message'   => 'No se encuentra la cita'
            ], Response::HTTP_NOT_FOUND);

        $item = [
            'estado'        => $cita->estado,
            'fecha_inicio'  => $cita->fecha_inicio->format('d-m / Y H:s a'),
            'fecha_fin'     => $cita->fecha_fin->format('d-m / Y H:s a'),
            'comentario'    => $cita->comentaio,
        ];

        if ($cita->estado != 'reservado')
            $item = array_merge($item, [
                'finalizar'     => route('institucion.profesional.calendario.finalizar-cita', ['cita' => $cita->id_cita]),
                'paciente'      => $cita->paciente->user->nombre_completo,
                'identificacion'  => $cita->paciente->user->identificacion,
                'celular'       => str_replace(',', ' - ', $cita->paciente->celular),
                'atencion'      => $cita->servicio->tipo_atencion,
                'especialidad'  => $cita->especialidad->nombreEspecialidad,
                'servicio'      => $cita->servicio->nombre,
                'tipo_servicio' => $cita->servicio->tipo_servicio->nombre,
                'cups'          => "{$cita->servicio->cups->code} - {$cita->servicio->cups->description}",
                'fecha'         => $cita->fecha,
                'hora'          => $cita->hora,
                'foto'          => asset($cita->paciente->foto ?? 'img/menu/avatar.png'),
            ]);

        return response([
            'item' => $item
        ], Response::HTTP_OK);
    }
}
