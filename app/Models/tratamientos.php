<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tratamientos extends Model
{
    protected $fillable = [
        'id_tratamiento',
        'idPerfilProfesional',
        'imgTratamientoAntes',
        'tituloTrataminetoAntes',
        'descripcionTratamientoAntes',
        'imgTratamientodespues',
        'tituloTrataminetoDespues',
        'descripcionTratamientoDespues',
    ];
}
