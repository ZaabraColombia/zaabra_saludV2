<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class municipio extends Model
{
    protected $fillable = [
        'id_municipio',
        'id_provincia',
        'codigo_dane',
        'nombre'
    ];
}
