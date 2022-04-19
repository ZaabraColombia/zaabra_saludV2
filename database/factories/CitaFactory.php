<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\profesionales_instituciones;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $profesional = profesionales_instituciones::query()
            ->where('id_institucion', 1)
            ->where('estado', 1)
            ->get()->random();

        $servicio = $profesional->servicios->random();

        $sede = $profesional->sede;

        $user = Paciente::query()
            ->get()->random();

        $fecha[0] = date('Y-m-d h:i:s', strtotime('2022-04-19 ' . random_int(6, 18) . ':' . random_int(0, 60) . ":00"));
        $fecha[1] = date('Y-m-d h:i:s', strtotime($fecha[0] . " +{$servicio->duracion} minutes"));


        return [
            'fecha_inicio' => $fecha[0],
            'fecha_fin' => $fecha[1],
            'estado' => collect(['agendado','completado','cancelado'])->random(),
            'paciente_id' => $user->id,
            'profesional_ins_id' => $profesional->id_profesional_inst,
            'lugar' => $sede->direccion . " - " . $profesional->consultorio,
            'tipo_cita_id' => $servicio->id,
            'especialidad_id' => $servicio->especialidad_id,
            'pais_id' => $sede->pais_id,
            'departamento_id' => $sede->departamento_id,
            'provincia_id' => $sede->provincia_id,
            'ciudad_id' => $sede->ciudad_id
        ];
    }
}
