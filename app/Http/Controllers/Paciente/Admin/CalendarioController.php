<?php

namespace App\Http\Controllers\Paciente\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pagos\CitaOpenPay;
use App\Mail\ConfirmacionCitaEmail;
use App\Models\Antiguedad;
use App\Models\Cita;
use App\Models\Horario;
use App\Models\instituciones;
use App\Models\PagoCita;
use App\Models\perfilesprofesionales;
use App\Models\profesionales_instituciones;
use App\Models\Servicio;
use App\Models\tipoconsultas;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function view;

class CalendarioController extends Controller
{


    public function index(Request $request)
    {

        if (isset($request->id)) {
            $profesional = $this->profesional($request->id);
            $profesional = $profesional[0];
            $consultas = tipoconsultas::where('idperfil', '=', $request->id)->get();
            $calificacion = $this->calificacion($request->id);

            if (!empty($profesional)) {
                return view('panelAdministrativoPac.calendario.asignar-cita', compact(
                    'profesional',
                    'consultas',
                    'calificacion'
                ));
            } else {
                return view('panelAdministrativoPac.calendario.asignar-cita', ['error' => 'El perfil no existe']);
            }
        }

        return view('panelAdministrativoPac.calendario.asignar-cita');
    }

    public function asignar_cita_profesional(perfilesprofesionales $profesional)
    {
        //$horario = $profesional->user->horario;
        $horario = Horario::query()
            ->where('user_id', $profesional->idUser)
            ->first();

        $servicios = Servicio::query()
            ->where('profesional_id', $profesional->idPerfilProfesional)
            ->where('agendamiento_virtual', 1)
            ->with(['convenios_lista'])
            ->get();

        //Validar si la configuraci??n del calendario est?? realizada
        if (!isset($horario) or empty($horario->horario) or empty($horario->dias_agenda) or $servicios->isEmpty())
            return redirect()->route('PerfilProfesional', ['slug' => $profesional->slug])
                ->with('warning-paciente', 'El doctor no tiene agenda disponible');

        //Atrae los dias de la semana que NO labora
        $weekNotBusiness = array();
        foreach (array_column($profesional->user->horario->horario, 'daysOfWeek') as $item)
            $weekNotBusiness = array_merge($weekNotBusiness, $item);
        $weekNotBusiness = array_unique($weekNotBusiness);

        $weekDisabled = array_values(array_diff(array(0, 1, 2, 3, 4, 5, 6), $weekNotBusiness));

        //validar si es primera vez la cita del doctor y paciente
        $antiguedad = Antiguedad::query()
            ->where('paciente_id', '=', Auth::user()->paciente->id)
            ->where('profesional_id', '=', $profesional->idPerfilProfesional)
            ->first();

        $count_citas = Cita::query()
            ->where('paciente_id', Auth::user()->paciente->id)
            ->where('profesional_id', '=', $profesional->idPerfilProfesional)
            ->whereHas('pago', function ($query) {
                return $query->where('aprobado', 1);
            })
            ->count();

        $activar_presencial = ($count_citas > 0 or $antiguedad->confirmacion);

        return view('paciente.admin.calendario.asignar-cita-profesional',
            compact('profesional', 'weekDisabled', 'antiguedad', 'activar_presencial', 'servicios'));
    }

    public function antiguedad_profesional(Request $request, perfilesprofesionales $profesional)
    {
        //Validar antiguedad
        $validate = Validator::make($request->all(), [
            'antiguedad' => ['required', 'boolean']
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text' => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //validar si es primera vez la cita del doctor y paciente
        $antiguedad = Antiguedad::query()
            ->firstOrNew([
                'paciente_id' => Auth::user()->paciente->id,
                'profesional_id' => $profesional->idPerfilProfesional,
            ]);

        //Es verdadero si es antiguo, pero es falso si es nuevo
        $antiguedad->confirmacion = $request->get('antiguedad');
        $antiguedad->save();

        return response([
            'message' => [
                'title' => 'Hecho',
                'text' => 'Guardado correctamente'
            ]
        ], Response::HTTP_OK);
    }

    public function dias_libre_profesional(Request $request, perfilesprofesionales $profesional)
    {
        //Validate date
        $validate = Validator::make($request->all(), [
            'date' => ['required', 'date_format:Y-m-d'],
            'servicio' => ['required', 'integer']
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text' => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        $servicio = Servicio::query()
            ->where('id', $request->servicio)
            ->where('estado', 1)
            ->where('agendamiento_virtual', 1)
            ->where('profesional_id', $profesional->idPerfilProfesional)
            ->first();

        if (empty($servicio))
            return response([
                'message' => [
                    'title' => 'Error!',
                    'text' => 'EL servicio no existe.'
                ]
            ], Response::HTTP_NOT_FOUND);


        //Citas m??dicas
        $datesOperatives = $profesional->citas()
            ->select(['id_cita', 'fecha_inicio', 'fecha_fin'])
            ->whereNotIn('estado', ['cancelado', 'completado'])
            ->whereDate('fecha_inicio', $request->date)
            ->get()
            ->toArray();

        //Horario
        $horario = $profesional->user->horario;

        //Validar el n??mero del dia de la semana
        $diaSemana = date('w', strtotime($request->date));

        //crear intervalos
        $intervaloCita = ($servicio->duracion + $servicio->descanso) * 60;
        //Crear las citas libres
        $listDates = array();

        //Buscar los dias disponibles
        foreach ($horario->horario as $item) {
            if (in_array($diaSemana, $item['daysOfWeek'])) {
                $startDate = strtotime("$request->date " . $item['startTime']);
                $endDate = strtotime("$request->date " . $item['endTime']);

                //generar posibles citas
                $listDates = array_merge($listDates, generar_citas($startDate, $endDate, $intervaloCita, $datesOperatives));
            }
        }

        return response([
            'message' => [
                'title' => 'Hecho',
                'text' => 'Fechas disponibles'
            ],
            'data' => $listDates
        ], Response::HTTP_OK);
    }

    public function finalizar_cita_profesional(Request $request, perfilesprofesionales $profesional)
    {

        $request->merge(['disponibilidad' => json_decode($request->get('hora'), true)]);

        $request->validate([
            'disponibilidad' => ['required'],
            'disponibilidad.*' => [
                'required',
                'date_format:Y-m-d H:i',
                'before_or_equal:' . date('Y-m-d H:i', strtotime(date('Y-m-d') . " 23:59 +{$profesional->user->horario->dias_agenda} days"))
            ],
            'tipo_servicio' => [
                'required',
                Rule::exists('servicios', 'id')->where(function ($query) use ($profesional) {
                    return $query->where('profesional_id', $profesional->idPerfilProfesional)
                        ->where('agendamiento_virtual', 1);
                })
            ],
            'convenio' => [
                'required_if:check-convenio,1',
                Rule::exists('convenios', 'id')->where(function ($query) use ($profesional) {
                    return $query->where('id_user', $profesional->idUser);
                })
            ],
            'modalidad' => ['required', Rule::in(['virtual', 'presencial'])],
        ], [], [
            'disponibilidad.start' => 'Hora inicio',
            'disponibilidad.end' => 'Hora fin',
            'tipo_servicio' => 'Servicio',
        ]);

        $all = $request->all();

        //Buscar servicio
        $servicio = Servicio::query()
            ->with(['convenios_lista' => function ($query) use ($all) {
                if (isset($all['tipo_servicio']) and isset($all['convenio'])) return $query
                    ->where('convenios.id', $all['convenio'])
                    ->first();
                return $query->first();
            }])
            ->find($all['tipo_servicio']);


        //Validar el l??mite de agenda * servicio* usuario
        $citas = Cita::query()
            ->where('paciente_id', Auth::user()->paciente->id)
            ->where('estado', 'like', 'agendado')
            ->where('tipo_cita_id', $request->servicio)
            ->count();
        //dd(Auth::user()->paciente->id);
        if ($citas >= $servicio->citas_activas) {
            return redirect()
                ->back()
                ->withErrors(['cita' => 'Ya tiene citas agendadas con el servicios de la instituci??n']);;
        }

        //Validar el l??mite de agenda * servicio * usuario
        $citas = Cita::query()
            ->where('paciente_id', Auth::user()->id)
            ->where('estado', 'like', 'agendado')
            ->where('tipo_cita_id', $request->servicio)
            ->count();
        if ($citas > 0) return response([
            'message' => ['title' => 'Error', 'text' => 'Ya tiene citas agendadas con el servicios de la instituci??n']
        ], Response::HTTP_NOT_FOUND);


        //Validar la disponibilidad de la cita
        $date_count = Cita::query()->where('profesional_id', '=', $profesional->idPerfilProfesional)
            ->validar($all['disponibilidad']['start'], $all['disponibilidad']['end'])
            ->whereNotIn('estado', ['cancelado'])
            ->count();

        if ($date_count > 0) {
            return redirect()
                ->back()
                ->withErrors(['cita' => 'Cita no disponible']);
        }

        $user = Auth::user();

        //crear cita
        $date = Cita::query()->create([
            'fecha_inicio' => date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])),
            'fecha_fin' => date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])),
            'estado' => 'agendado',
            'lugar' => $profesional->direccion,
            'pais_id' => $profesional->idpais,
            'departamento_id' => $profesional->id_departamento,
            'provincia_id' => $profesional->id_provincia,
            'ciudad_id' => $profesional->id_municipio,
            'tipo_cita_id' => $all['tipo_servicio'],
            //'money'         => $all['money'],
            'profesional_id' => $profesional->idPerfilProfesional,
            'paciente_id' => $user->paciente->id,
            'especialidad_id' => $servicio->especialidad_id,
            'convenio_id' => $request->convenio,
        ]);

        $fechaPago = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])));
        $vencimiento = $fechaPago->subHours(3);

        //Crear pago
        $pago = PagoCita::query()->create([
            'fecha' => date('Y-m-d H:i'),
            'vencimiento' => $vencimiento,
            'valor' => (isset($all['tipo_servicio']) and isset($all['convenio'])) ? $servicio->convenios_lista[0]->pivot->valor_paciente : $servicio->valor,
            'valor_convenio' => (isset($all['tipo_servicio']) and isset($all['convenio'])) ? $servicio->convenios_lista[0]->pivot->valor_convenio : 0,
            'aprobado' => 0,
            'tipo' => $all['modalidad'],
            'cita_id' => $date->id_cita,
        ]);


        //Enviar notificaci??n de confirmaci??n de cita
        Mail::to($user->email)->send(new ConfirmacionCitaEmail($date, 'profesional'));

        if ($all['modalidad'] == 'virtual')
            return redirect()
                ->route('profesional.detalle-pago-cita', ['pago_cita' => $pago->id])
                ->with('success', "Cita asignada con {$profesional->user->nombre_completo}");

        return redirect()
            ->route('paciente.citas')
            ->with('success', "Cita asignada con {$profesional->user->nombre_completo}");

    }

    public function asignar_cita_institucion(profesionales_instituciones $profesional)
    {
        $horario = $profesional->horario;
        $servicios = $profesional->servicios()
            ->where('agendamiento_virtual', 1)
            ->get();

        $disponibilidad = $profesional->disponibilidad_agenda;
        $consultorio = $profesional->consultorio;

        if (empty($horario) or empty($servicios) or empty($disponibilidad) or empty($consultorio))
            return redirect()->back()->with('error-agenda', [
                'nombre' => $profesional->nombre_completo,
                'especialidad' => $profesional->especialidad_principal->nombreEspecialidad ?? ''
            ]);

        //Atrae los dias de la semana que NO labora
        $weekNotBusiness = array();
        foreach (array_column($horario, 'daysOfWeek') as $item)
            $weekNotBusiness = array_merge($weekNotBusiness, $item);
        $weekNotBusiness = array_unique($weekNotBusiness);

        $weekDisabled = array_values(array_diff(array(0, 1, 2, 3, 4, 5, 6), $weekNotBusiness));

        //validar si es primera vez la cita de la instituci??n y paciente
        $antiguedad = Antiguedad::query()
            ->where('paciente_id', '=', Auth::user()->paciente->id)
            ->where('institucion_id', '=', $profesional->id_institucion)
            ->first();

        $count_citas = Cita::query()
            ->where('paciente_id', Auth::user()->paciente->id)
            ->whereHas('profesional_ins', function ($query) use ($profesional) {
                return $query->where('id_institucion', '=', $profesional->id_institucion);
            })
            ->whereHas('pago', function ($query) {
                return $query->where('aprobado', 1);
            })
            ->count();

        $activar_presencial = ($count_citas > 0 or $antiguedad->confirmacion);

        return view('paciente.admin.calendario.asignar-cita-profesional-institucion', compact('profesional',
            'weekDisabled', 'servicios', 'disponibilidad', 'consultorio', 'antiguedad', 'activar_presencial'));
    }

    public function dias_libre_institucion_profesional(Request $request, profesionales_instituciones $profesional)
    {
        //Validate date
        $validate = Validator::make($request->all(), [
            'date' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:' . date('Y-m-d', strtotime(date('Y-m-d') . "+{$profesional->disponibilidad_agenda} days"))
            ],
            'servicio' => [
                'required',
                Rule::exists('servicios', 'id')->where(function ($query) use ($profesional) {
                    return $query->where('institucion_id', $profesional->institucion->id)
                        ->where('agendamiento_virtual', 1);
                })
            ]
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text' => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //Servicio
        $servicio = Servicio::find($request->servicio);

        //Validar el l??mite de agenda * servicio* usuario
//        $citas = Cita::query()
//            ->where('paciente_id', Auth::user()->paciente->id)
//            ->where('estado', 'like', 'agendado')
//            ->where('tipo_cita_id', $request->servicio)
//            ->count();
//
//        if ($citas >= $servicio->citas_activas) {
//            return response([
//                'message' => [
//                    'title' => 'Error',
//                    'text'  => 'Ya tiene citas agendadas con el servicios de la instituci??n'
//                ]
//            ], Response::HTTP_NOT_FOUND);
//        }

        //Citas m??dicas
        $datesOperatives = $profesional->citas()
            ->select(['id_cita', 'fecha_inicio', 'fecha_fin'])
            ->whereNotIn('estado', ['cancelado', 'completado'])
            ->get()
            ->toArray();

        //Horario
        $horario = $profesional->horario;

        //Validar el n??mero del dia de la semana
        $diaSemana = date('w', strtotime($request->date));

        //crear intervalos
        $intervaloCita = ($servicio->duracion + $servicio->descanso) * 60;

        //Crear las citas libres
        $listDates = array();

        //Buscar los dias disponibles
        foreach ($horario as $item) {

            if (in_array($diaSemana, $item['daysOfWeek'])) {
                $startDate = strtotime("$request->date " . $item['startTime']);
                $endDate = strtotime("$request->date " . $item['endTime']);

                //generar posibles citas
                $listDates = generar_citas($startDate, $endDate, $intervaloCita, $datesOperatives, 2);

            }
        }

        return response([
            'message' => [
                'title' => 'Hecho',
                'text' => 'Fechas disponibles'
            ],
            'data' => $listDates
        ], Response::HTTP_OK);
    }

    public function finalizar_cita_institucion_profesional(Request $request, profesionales_instituciones $profesional)
    {
        $request->merge(['disponibilidad' => json_decode($request->get('hora'), true)]);

        //dd($profesional->institucion->user->id);
        $request->validate([
            'disponibilidad' => ['required'],
            'disponibilidad.*' => [
                'required',
                'date_format:Y-m-d H:i',
                'before_or_equal:' . date('Y-m-d H:i', strtotime(date('Y-m-d') . " 23:59 +{$profesional->disponibilidad_agenda} days"))
            ],
            'tipo_servicio' => [
                'required',
                Rule::exists('servicios', 'id')->where(function ($query) use ($profesional) {
                    return $query->where('institucion_id', $profesional->institucion->id)
                        ->where('agendamiento_virtual', 1);
                })
            ],
            'convenio' => [
                'required_if:check-convenio,1',
                Rule::exists('convenios', 'id')->where(function ($query) use ($profesional) {
                    return $query->where('id_user', $profesional->institucion->user->id);
                })
            ],
            'modalidad' => ['required', Rule::in(['virtual', 'presencial'])],
        ], [], [
            'disponibilidad.start' => 'Hora inicio',
            'disponibilidad.end' => 'Hora fin',
            'tipo_servicio' => 'Servicio',
        ]);

        $all = $request->all();

        //Buscar servicio
        $servicio = Servicio::query()
            ->with(['convenios_lista' => function ($query) use ($all) {
                if (isset($all['tipo_servicio']) and isset($all['convenio'])) return $query
                    ->where('convenios.id', $all['convenio'])
                    ->first();
                return $query->first();
            }])
            ->find($all['tipo_servicio']);


        //Validar el l??mite de agenda * servicio* usuario
        $citas = Cita::query()
            ->where('paciente_id', Auth::user()->paciente->id)
            ->where('estado', 'like', 'agendado')
            ->where('tipo_cita_id', $request->servicio)
            ->count();
        //dd(Auth::user()->paciente->id);
        if ($citas >= $servicio->citas_activas) {
            return redirect()
                ->back()
                ->withErrors(['cita' => 'Ya tiene citas agendadas con el servicios de la instituci??n']);;
        }

        //Validar el l??mite de agenda * servicio * usuario
        $citas = Cita::query()
            ->where('paciente_id', Auth::user()->id)
            ->where('estado', 'like', 'agendado')
            ->where('tipo_cita_id', $request->servicio)
            ->count();
        if ($citas > 0) return response([
            'message' => ['title' => 'Error', 'text' => 'Ya tiene citas agendadas con el servicios de la instituci??n']
        ], Response::HTTP_NOT_FOUND);


        //Validar la disponibilidad de la cita
        $date_count = Cita::query()->where('profesional_id', '=', $profesional->idPerfilProfesional)
            ->validar($all['disponibilidad']['start'], $all['disponibilidad']['end'])
            ->whereNotIn('estado', ['cancelado'])
            ->count();

        if ($date_count > 0) {
            return redirect()
                ->back()
                ->withErrors(['cita' => 'Cita no disponible']);
        }

        $user = Auth::user();

        //crear cita
        $date = Cita::query()->create([
            'fecha_inicio' => date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])),
            'fecha_fin' => date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])),
            'estado' => 'agendado',
            'lugar' => ($profesional->sede->direccion ?? $profesional->institucion->direccion) . " - Consultorio " . ($profesional->consultorio),
            'pais_id' => $profesional->sede->pais_id ?? $profesional->institucion->idPais,
            'departamento_id' => $profesional->sede->departamento_id ?? $profesional->institucion->id_departamento,
            'provincia_id' => $profesional->sede->provincia_id ?? $profesional->institucion->id_provincia,
            'ciudad_id' => $profesional->sede->ciudad_id ?? $profesional->institucion->id_municipio,
            'tipo_cita_id' => $all['tipo_servicio'],
            //'money'         => $all['money'],
            'profesional_ins_id' => $profesional->id_profesional_inst,
            'paciente_id' => $user->paciente->id,
            'especialidad_id' => $servicio->especialidad_id,
            'convenio_id' => $request->convenio,
        ]);

        $fechaPago = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])));
        $vencimiento = $fechaPago->subHours(3);

        //Crear pago
        $pago = PagoCita::query()->create([
           'fecha' => date('Y-m-d H:i'),
            'vencimiento' => $vencimiento,
            'valor' => (isset($all['tipo_servicio']) and isset($all['convenio'])) ? $servicio->convenios_lista[0]->pivot->valor_paciente : $servicio->valor,
            'valor_convenio' => (isset($all['tipo_servicio']) and isset($all['convenio'])) ? $servicio->convenios_lista[0]->pivot->valor_convenio : 0,
            'aprobado' => 0,
            'tipo' => $all['modalidad'],
            'cita_id' => $date->id_cita,
        ]);

        //Enviar notificaci??n de confirmaci??n de cita
        Mail::to($user->email)->send(new ConfirmacionCitaEmail($date, 'institucion'));


        if ($all['modalidad'] == 'virtual')
            return redirect()
                ->route('institucion.detalle-pago-cita', ['pago_cita' => $pago->id])
                ->with('success', "Cita asignada con {$profesional->nombre_completo}");

        return redirect()
            ->route('paciente.citas')
            ->with('success', "Cita asignada con {$profesional->nombre_completo}");
    }

    public function antiguedad_institucion(Request $request, instituciones $institucion)
    {
        //Validar antig??edad
        $validate = Validator::make($request->all(), [
            'antiguedad' => ['required', 'boolean']
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text' => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //validar si es primera vez la cita del doctor y paciente
        $antiguedad = Antiguedad::query()
            ->firstOrNew([
                'paciente_id' => Auth::user()->paciente->id,
                'institucion_id' => $institucion->id,
            ]);

        //Es verdadero si es antiguo, pero es falso si es nuevo,
        $antiguedad->confirmacion = $request->get('antiguedad');
        $antiguedad->save();

        return response([
            'message' => [
                'title' => 'Hecho',
                'text' => 'Guardado correctamente'
            ]
        ], Response::HTTP_OK);
    }

    public function profesional($id)
    {
        return DB::select("SELECT pf.idPerfilProfesional, pf.fotoperfil, CONCAT('Dr.(a) ',  us.primernombre) AS primernombre, us.segundonombre, us.primerapellido, us.segundoapellido, ep.nombreEspecialidad, pf.numeroTarjeta, pf.direccion, un.nombreuniversidad, pf.descripcionPerfil, mn.nombre
        FROM perfilesprofesionales pf
        INNER JOIN users us ON pf.idUser=us.id
        INNER JOIN especialidades ep ON pf.idespecialidad=ep.idEspecialidad
        INNER JOIN perfilesprofesionalesuniversidades pu ON pf.idPerfilProfesional=pu.idPerfilProfesional
        INNER JOIN universidades un ON pf.id_universidad=un.id_universidad
        INNER JOIN municipios mn ON mn.id_municipio=pf.id_municipio
        WHERE pf.aprobado<>0 AND pf.idPerfilProfesional = '$id' LIMIT 1");
    }

    // consulta comentarios
    public function calificacion($idPerfilProfesional)
    {
        return DB::select("SELECT us.primernombre, us.primerapellido, c.comentario,c.calificacion,
        (SELECT (ROUND(SUM(c.calificacion) / COUNT(c.calificacion)))
        FROM comentarios c
        INNER JOIN perfilesprofesionales p ON c.idperfil=p.idPerfilProfesional
        WHERE p.idPerfilProfesional=$idPerfilProfesional) AS calificacionRedondeada
        FROM  users_roles ur
        LEFT JOIN users us  ON ur.iduser=us.id
        LEFT JOIN perfilesprofesionales pf  ON us.id=pf.idUser
        LEFT JOIN comentarios c ON ur.iduser=c.idusuariorol
        WHERE c.comentario<>'' AND c.idperfil=$idPerfilProfesional");
    }
}
