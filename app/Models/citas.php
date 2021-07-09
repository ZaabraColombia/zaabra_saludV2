<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class citas extends Model
{
    protected $fillable = [
        'titulo',
        'estado_cita',
        'inicio_cita',
        'fin_cita',
        'idPerfilProfesional',
        'idInstitucion',
        'id_user'
    ];
}
