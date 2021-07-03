<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expedientes extends Model
{
    protected $fillable = [
        'id_cita',
        'peso',
        'altura',
        'presion_arterial',
        'revision_pulmunar',
        'revision_corazon',
        'revision_columna',
        'observaciones'
    ];
}
