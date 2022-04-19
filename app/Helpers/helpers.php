<?php
//namespace App\Helpers\helpers;

use Carbon\Carbon;

if (!function_exists('daysWeekText'))
{
    function daysWeekText($day): string
    {
        $dayText = '';
        switch ($day)
        {
            case 1:
                $dayText = "Lunes";
                break;
            case 2:
                $dayText = "Martes";
                break;
            case 3:
                $dayText = "Miércoles";
                break;
            case 4:
                $dayText = "Jueves";
                break;
            case 5:
                $dayText = "Viernes";
                break;
            case 6:
                $dayText = "Sabado";
                break;
            case 0:
                $dayText = "Domingo";
                break;
        }

        return $dayText;
    }
}

if (!function_exists('generar_citas'))
{
    /**
     * Esta función permite generar citas posibles desde una fecha inicio
     * a una fecha fin validando las existentes
     *
     * @param int $fecha_inicio
     * @param int $fecha_fin
     * @param int $intervalo
     * @param array $lista_citas
     * @param int|bool $antes_sita
     * @return array
     */
    function generar_citas(int $fecha_inicio,int $fecha_fin, int $intervalo, array $lista_citas,$antes_sita = false)
    {
        //guardar las citas disponibles
        $citas_disponibles = array();

        //recorre todas las citas posibles en segundos
        for($fecha = $fecha_inicio; ($fecha + $intervalo) <= $fecha_fin; $fecha+= $intervalo){

            //convierte la posible cita en fechas
            $hora_inicio    = date('Y-m-d H:i', $fecha);
            $hora_fin       = date('Y-m-d H:i', $fecha + $intervalo );

            //Validar la disponibilidad de las citas
            $flag = true;

            if (!empty($lista_citas)) {
                foreach ($lista_citas as $cita) {
                    if (
                        //Validar si la hora de inicio está entre la hora inicio y fin de la cita existente
                        (strtotime($cita['fecha_inicio']) <= strtotime($hora_inicio)
                            && strtotime($cita['fecha_fin']) >= strtotime($hora_inicio))
                        or
                        //Validar si la hora de fin está entre la hora inicio y fin de la cita existente
                        (strtotime($cita['fecha_inicio']) <= strtotime($hora_fin)
                            && strtotime($cita['fecha_fin']) >= strtotime($hora_fin))
                        or
                        //Validar si la hora inicio existente está entre la hora inicio y fin
                        (strtotime($hora_inicio) <= strtotime($cita['fecha_inicio'])
                            && strtotime($hora_fin) >= strtotime($cita['fecha_inicio']))
                        or
                        //Validar si la hora din existente está entre la hora inicio y fin
                        (strtotime($hora_inicio) <= strtotime($cita['fecha_fin'])
                            && strtotime($hora_fin) >= strtotime($cita['fecha_fin']))
                    )
                    {
                        $flag = false;
                        break;
                    }
                }
            }

            //validar el tiempo antes que se cumpla la cita
            if ($flag and $antes_sita != false)
            {
                $start = new Carbon($hora_inicio);
                $hoy = Carbon::now()->subHours(2);

                if ($hoy->lessThan($start)) $citas_disponibles[] = [
                    'startTime' => $hora_inicio,
                    'endTime' => $hora_fin
                ];
            } else if ($flag)
            {
                //Agregar la disponibilidad
                $citas_disponibles[] = [
                    'startTime' => $hora_inicio,
                    'endTime' => $hora_fin
                ];
            }
        }

        return $citas_disponibles;
    }
}
