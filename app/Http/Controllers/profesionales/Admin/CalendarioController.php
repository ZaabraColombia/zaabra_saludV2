<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function daysWeekText;
use function response;
use function view;

class CalendarioController extends Controller
{
    public function index()
    {

    }

    /**
     * @return Application|Factory|View
     */
    public function configuracion()
    {
        $user = Auth::user();
        $config = $user->horario;

        if (empty($config))
        {
            $config = new Horario();
        }

        return view('panelAdministrativoProf.configurar-calendario', compact('config'));
    }

    public function dias(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'duracion' => ['required', 'integer'],
            'descanso' => ['required', 'integer']
        ]);

        if ($validator->failed())
        {
            return response(['error' => $validator->errors()->all()], Response::HTTP_NOT_FOUND);
        }

        //user
        $user = Auth::user();

        //Update date
        $horario = Horario::query()->updateOrCreate([
            'user_id' => $user->id
        ], [
            'duracion' => $request->get('duracion'),
            'descanso' => $request->get('descanso')
        ]);

        return response([
            'message' => 'Configuración de la cita listo'
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Agregar un horario
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function horario_agregar(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'semana.*'    => ['required', Rule::in([0, 1, 2, 3, 4, 5, 6])],
            'hora_inicio'=> ['required', 'date_format:H:i'],
            'hora_final'=> ['required', 'date_format:H:i']
        ]);

        if ($validator->failed())
        {
            return response(['error' => $validator->errors()->all()], Response::HTTP_NOT_FOUND);
        }

        //user
        $user = Auth::user();
        $horario = $user->horario;
        $schedule[] = [
            'id' => Str::random(10),
            'daysOfWeek'    => $request->get('semana'),
            'startTime'     => $request->get('hora_inicio'),
            'endTime'       => $request->get('hora_final'),
        ];

        //add schedule
        if (is_array($horario->horario))
        {
            $horario->horario = array_merge($horario->horario, $schedule);
        } else {
            $horario->horario = $schedule;
        }


        $horario->save();

        //parce days in text
        foreach ($schedule[0]['daysOfWeek'] as $key => $item) $schedule[0]['daysOfWeek'][$key] = daysWeekText($item);

        return response([
            'message' => 'Horario Agregado', 'item' => $schedule[0]
        ], Response::HTTP_ACCEPTED);
    }

    /**
     *  Eliminar un horario
     *
     * @return Application|ResponseFactory|Response
     */
    public function horario_eliminar(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'id'    => ['required', 'integer'],
        ]);

        if ($validator->failed())
        {
            return response(['error' => $validator->errors()->all()], Response::HTTP_NOT_FOUND);
        }

        //user
        $user = Auth::user();
        //schedule
        $schedule = $user->calendar_config->schedule_on;

        //delete schedule
        $key_schedule_delete = array_search($request->id, array_column($schedule, 'id'));
        unset($schedule[$key_schedule_delete]);

        //save
        $user->calendar_config->schedule_on = $schedule;
        $user->calendar_config->save();

        return response([
            'message' => __('calendar.deleted-schedule-confirmation')
        ], Response::HTTP_OK);
    }

    /**
     * Perimte listar las citas libres por día
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function citas_libres(Request $request)
    {
        //Validate date
        $validate = Validator::make($request->all(), [
            'date'  => ['required', 'date_format:Y-m-d']
        ]);
        if ($validate->fails()) {
            return response(['error' =>  $validate->errors()->first('date')], Response::HTTP_NOT_FOUND);
        }

        //User
        $user = Auth::user();

        //Dates day's of Operative
        $datesOperative = $user->medical_dates;

        //validate number week of date
        $weekDay = date('w', strtotime($request->date));

        //create list of dates
        $dateInterval = ($user->calendar_config->date_duration + $user->calendar_config->date_interval) * 60;
        $listDates = array();

        //Search interval schedule in configuration
        foreach ($user->calendar_config->schedule_on as $item)
        {

            if (in_array( $weekDay, $item['daysOfWeek']))
            {
                $startDate = strtotime("$request->date " . $item['startTime']);
                $endDate = strtotime("$request->date " . $item['endTime']);

                //Add posible dates
                for($date = $startDate; ($date + $dateInterval) <= $endDate; $date+= $dateInterval){

                    $startTime = date('Y-m-d H:i', $date);
                    $endTime = date('Y-m-d H:i', $date + $dateInterval );


                    //validate exist or conflict date
                    $valid = true;
                    foreach ($datesOperative as $dateOperative) {
                        if (
                            //Check that start new date is between start operative & end operative
                            (strtotime($dateOperative->start_date) <= strtotime($startTime)
                                && strtotime($dateOperative->end_date) >= strtotime($startTime))
                            or
                            //Check that end new date is between start operative & end operative
                            (strtotime($dateOperative->start_date) <= strtotime($endTime)
                                && strtotime($dateOperative->end_date) >= strtotime($endTime))
                            or
                            //Check that start operative is between start new date & end new date
                            (strtotime($startTime) <= strtotime($dateOperative->start_date)
                                && strtotime($startTime) >= strtotime($dateOperative->start_date))
                            or
                            //Check that end operative is between start new date & end new date
                            (strtotime($startTime) <= strtotime($dateOperative->end_date)
                                && strtotime($startTime) >= strtotime($dateOperative->end_date))
                        )
                        {
                            $valid = false;
                            break;
                        }
                    }

                    if ($valid)
                    {
                        //Add date in list
                        array_push($listDates, [
                            'startTime' => $startTime,
                            'endTime' => $endTime,
                            'nameOperative' => "$user->last_name $user->name"
                        ]);
                    }
                }
            }
        }

        return response(['data' => $listDates], Response::HTTP_OK);
    }
}
