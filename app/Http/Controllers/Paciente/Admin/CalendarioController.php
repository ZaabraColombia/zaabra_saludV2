<?php

namespace App\Http\Controllers\Paciente\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Pagos\CitaOpenPay;
use App\Models\Antiguedad;
use App\Models\Cita;
use App\Models\PagoCita;
use App\Models\perfilesprofesionales;
use App\Models\tipoconsultas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function view;

class CalendarioController extends Controller{


    public function index(Request $request){

        if (isset($request->id))
        {
            $profesional    = $this->profesional($request->id);
            $profesional    = $profesional[0];
            $consultas      = tipoconsultas::where('idperfil', '=', $request->id)->get();
            $calificacion   = $this->calificacion($request->id);

            if (!empty($profesional)) {
                return view('panelAdministrativoPac.calendario.asignar-cita', compact(
                    'profesional',
                    'consultas',
                    'calificacion'
                ));
            }else{
                return view('panelAdministrativoPac.calendario.asignar-cita', ['error' => 'El perfil no existe']);
            }
        }

        return view('panelAdministrativoPac.calendario.asignar-cita');
    }

    public function asignar_cita_profesional(perfilesprofesionales $profesional)
    {
        $horario = $profesional->user->horario;

        //Valida si la configuración del calendario está realizada
        if (!isset($horario) or empty($horario->duracion) or empty($horario->descanso))
            return redirect()->route('PerfilProfesional', ['slug' => $profesional->slug])
                ->with('warning', 'El doctor no tiene agenda disponible');

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

        return view('paciente.admin.calendario.asignar-cita-profesional',
            compact('profesional', 'weekDisabled', 'antiguedad'));
    }

    public function antiguedad_profesional(Request $request, perfilesprofesionales $profesional)
    {
        //Validar antiguedad
        $validate = Validator::make($request->all(), [
            'antiguedad'  => ['required', 'boolean']
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //validar si es primera vez la cita del doctor y paciente
        $antiguedad = Antiguedad::query()
            ->firstOrNew([
                'paciente_id' => Auth::user()->paciente->id,
                'profesional_id' => $profesional->idPerfilProfesional,
            ]);

        //Es verdadero si es nuevo, pero es falso si es antiguo, se invierte en el guardado
        $antiguedad->confirmacion = !$request->get('antiguedad');
        $antiguedad->save();

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Guardado correctamente'
            ]
        ], Response::HTTP_OK);
    }

    public function dias_libre_profesional(Request $request, perfilesprofesionales $profesional)
    {
        //Validate date
        $validate = Validator::make($request->all(), [
            'date'  => ['required', 'date_format:Y-m-d']
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //Citas médicas
        $datesOperatives = $profesional->citas()->whereNotIn('estado', ['cancelado'])->get();

        //Horario
        $horario = $profesional->user->horario;


        //Validar el número del dia de la semana
        $diaSemana = date('w', strtotime($request->date));

        //crear intervalos
        $intervaloCita = ($horario->duracion + $horario->descanso) * 60;
        //Crear las citas libres
        $listDates = array();

        //Buscar los dias disponibles
        foreach ($horario->horario as $item)
        {

            if (in_array( $diaSemana, $item['daysOfWeek']))
            {
                $startDate = strtotime("$request->date " . $item['startTime']);
                $endDate = strtotime("$request->date " . $item['endTime']);

                //generar posibles citas
                for($date = $startDate; ($date + $intervaloCita) <= $endDate; $date+= $intervaloCita){

                    $startTime = date('Y-m-d H:i', $date);
                    $endTime = date('Y-m-d H:i', $date + $intervaloCita );


                    //Validar la disponibilidad de las citas
                    $valid = true;
                    if (!empty($datesOperatives)) {
                        foreach ($datesOperatives as $dateOperative) {
                            if (
                                //Validar si la hora de inicio está entre la hora inicio y fin de la cita existente
                                (strtotime($dateOperative->fecha_inicio) <= strtotime($startTime)
                                    && strtotime($dateOperative->fecha_fin) >= strtotime($startTime))
                                or
                                //Validar si la hora de fin está entre la hora inicio y fin de la cita existente
                                (strtotime($dateOperative->fecha_inicio) <= strtotime($endTime)
                                    && strtotime($dateOperative->fecha_fin) >= strtotime($endTime))
                                or
                                //Validar si la hora inicio existente está entre la hora inicio y fin
                                (strtotime($startTime) <= strtotime($dateOperative->fecha_inicio)
                                    && strtotime($startTime) >= strtotime($dateOperative->fecha_inicio))
                                or
                                //Validar si la hora din existente está entre la hora inicio y fin
                                (strtotime($startTime) <= strtotime($dateOperative->fecha_fin)
                                    && strtotime($startTime) >= strtotime($dateOperative->fecha_fin))
                            )
                            {
                                $valid = false;
                                break;
                            }
                        }
                    }

                    //validar que no se pueda agendar 2 horas antes de llegar a la cita
                    $hoy = Carbon::now()->subHours(2);
                    $start = new Carbon($startTime);

                    if ($valid and $hoy->lessThan($start))
                    {
                        //Agregar la disponibilidad
                        $listDates[] = [
                            'startTime' => $startTime,
                            'endTime' => $endTime
                        ];
                    }
                }
            }
        }

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => 'Fechas disponibles'
            ],
            'data' => $listDates
        ], Response::HTTP_OK);
    }

    public function finalizar_cita_profesional(Request $request, perfilesprofesionales $profesional)
    {
        $request->merge(['disponibilidad' => json_decode($request->get('hora'), true)]);

        $request->validate([
            'disponibilidad'    => ['required'],
            'disponibilidad.*'  => ['required', 'date_format:Y-m-d H:i'],
            'tipo_cita'         => ['required'],
            'modalidad'         => ['required', Rule::in(['pse', 'tarjeta credito', 'presencial'])],
        ]);

        $all = $request->all();

        //Validar la disponibilidad de la cita
        $date_count = Cita::query()->where('profesional_id', '=', $profesional->idPerfilProfesional)
            ->where(function ($query) use ($all){
                $query->whereRaw('(fecha_inicio >= "' . date('Y-m-d H:i:s', strtotime($all['disponibilidad']['start'])) .
                    '" and fecha_inicio < "' . date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])) . '")')
                    ->orWhereRaw('(fecha_fin > "' . date('Y-m-d H:i:s', strtotime($all['disponibilidad']['start'])) .
                        '" and fecha_fin <= "' . date('Y-m-d H:i:s', strtotime($all['disponibilidad']['end'])) . '")')
                    ->orWhereRaw('(fecha_inicio <= "' . date('Y-m-d H:i:s', strtotime($all['disponibilidad']['start'])) .
                        '" and fecha_fin > "' . date('Y-m-d H:i:s', strtotime($all['disponibilidad']['start'])) . '")')
                    ->orWhereRaw('(fecha_inicio < "' . date('Y-m-d H:i:s', strtotime($all['disponibilidad']['end'])) .
                        '" and fecha_fin >= "' . date('Y-m-d H:i:s', strtotime($all['disponibilidad']['end'])) . '")');
            })
            ->whereNotIn('estado', ['cancelado'])
            ->count();

        if ($date_count > 0)
        {
            return redirect()
                ->back()
                ->withErrors(['cita' => 'Cita no disponible']);
        }

        $user = Auth::user();

        //crear cita
        $query = [
            'fecha_inicio'  => date('Y-m-d H:i', strtotime($all['disponibilidad']['start'])),
            'fecha_fin'     => date('Y-m-d H:i', strtotime($all['disponibilidad']['end'])),
            'estado'        => 'agendado',
            'lugar'         => $profesional->direccion,
            'tipo_cita_id'  => $all['tipo_cita'],
            //'money'         => $all['money'],
            'profesional_id'=> $profesional->idPerfilProfesional,
            'paciente_id'   => $user->paciente->id,
        ];

        $date = Cita::query()->create($query);

        $fechaPago = Carbon::now();
        $consulta = tipoconsultas::query()
            ->where('id', '=', $all['tipo_cita'])
            ->first(['valorconsulta']);

        //Crear pago
        $pago = PagoCita::query()->create([
            'fecha'     => $fechaPago,
            'vencimiento' => $fechaPago->add(8, 'days'),
            'valor'     => $consulta->valorconsulta,
            'aprobado'  => 0,
            'tipo'      => $all['modalidad'],
            'cita_id'   => $date->id_cita,
        ]);

        return redirect()
            ->route('paciente.citas')
            ->with('success', "Cita asignada con {$profesional->user->nombre_completo}");
    }


    public function profesional($id){
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
    public function calificacion($idPerfilProfesional){
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
