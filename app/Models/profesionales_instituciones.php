<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profesionales_instituciones extends Model
{
    protected $fillable = [
        'id_profesional_inst',
        'id_institucion',
        'id_universidad',
        'id_especialidad',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'foto_perfil_institucion'
    ];

    protected $primaryKey = "id_profesional_inst";
}
