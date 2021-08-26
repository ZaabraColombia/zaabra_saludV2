<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especialidades extends Model
{
    protected $fillable = [
        'idEspecialidad',
        'nombreEspecialidad',
        'idProfesion',
        'estado',
        'urlimagen',
        'orden'
    ];

    public function perfiles_profesionales()
    {
        return $this->hasMany(perfilesprofesionales::class, 'idespecialidad', 'idEspecialidad');
    }
}
