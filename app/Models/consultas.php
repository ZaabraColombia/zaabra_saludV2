<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultas extends Model
{
    protected $fillable = [
        'id_cita',
        'sintomas',
        'prescripcion_medica',
        'receta_medica',
        'resultados_medicos',
        'doc_examenes'
    ];
}
