<?php
//namespace App\Helpers\helpers;

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
