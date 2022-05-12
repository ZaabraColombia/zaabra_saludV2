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
    function generar_citas(int $fecha_inicio,int $fecha_fin, int $intervalo, array $lista_citas,$antes_sita = false): array
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
                            && strtotime($cita['fecha_fin']) > strtotime($hora_inicio))
                        or
                        //Validar si la hora de fin está entre la hora inicio y fin de la cita existente
                        (strtotime($cita['fecha_inicio']) < strtotime($hora_fin)
                            && strtotime($cita['fecha_fin']) >= strtotime($hora_fin))
                        or
                        //Validar si la hora inicio existente está entre la hora inicio y fin
                        (strtotime($hora_inicio) <= strtotime($cita['fecha_inicio'])
                            && strtotime($hora_fin) > strtotime($cita['fecha_inicio']))
                        or
                        //Validar si la hora din existente está entre la hora inicio y fin
                        (strtotime($hora_inicio) < strtotime($cita['fecha_fin'])
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

if (!function_exists('color_inverse'))
{
    function color_inverse($color): string
    {
        $color = str_replace('#', '', $color);
        if (strlen($color) != 6){ return '000000'; }
        $rgb = '';
        for ($x=0;$x<3;$x++){
            $c = 255 - hexdec(substr($color,(2*$x),2));
            $c = ($c < 0) ? 0 : dechex($c);
            $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
        }
        return '#'.$rgb;
    }
}

if (!function_exists('color_contrast'))
{
    function color_contrast($hexColor): string
    {

        // hexColor RGB
        $R1 = hexdec(substr($hexColor, 1, 2));
        $G1 = hexdec(substr($hexColor, 3, 2));
        $B1 = hexdec(substr($hexColor, 5, 2));

        // Negro RGB
        $blackColor = "#000000";
        $R2BlackColor = hexdec(substr($blackColor, 1, 2));
        $G2BlackColor = hexdec(substr($blackColor, 3, 2));
        $B2BlackColor = hexdec(substr($blackColor, 5, 2));

        // Calculo de relación de contraste
        $L1 = 0.2126 * pow($R1 / 255, 2.2) +
            0.7152 * pow($G1 / 255, 2.2) +
            0.0722 * pow($B1 / 255, 2.2);

        $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
            0.7152 * pow($G2BlackColor / 255, 2.2) +
            0.0722 * pow($B2BlackColor / 255, 2.2);

        $contrastRatio = 0;
        if ($L1 > $L2) {
            $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
        } else {
            $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
        }

        //Si el contraste es superior a 5, devuelve el color negro.
        if ($contrastRatio > 5) {
            return '#000000';
        } else {
            // Si no, devuelve el color blanco.
            return '#FFFFFF';
        }
    }
}

if (!function_exists('eliminar_tildes'))
{
    function eliminar_tildes($cadena){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        //$cadena = utf8_encode($cadena);

        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        //$cadena = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $cadena);

        return $cadena;
    }
}
