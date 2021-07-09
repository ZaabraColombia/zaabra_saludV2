<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patologias extends Model
{
    protected $fillable = [
        'id_cita',
        'alergias',
        'Enfermedades_hereditariasr',
        'cirugias',
        'actividad_fisica',
        'fuma',
        'cantidad_fuma',
        'toma',
        'cantidad_toma'
    ];
}
