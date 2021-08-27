<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class experiencias extends Model
{
    protected $fillable = [
        'idexperiencias',
        'idPerfilProfesional',
        'nombreEmpresaExperiencia',
        'descripcionExperiencia',
        'fechaInicioExperiencia',
        'fechaFinExperiencia',
        'imgexperiencia',
        'contador',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'idexperiencias';
}
