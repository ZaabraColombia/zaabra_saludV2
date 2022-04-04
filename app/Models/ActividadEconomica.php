<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadEconomica extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre'
    ];

    protected $table = 'actividades_economicas';
}
