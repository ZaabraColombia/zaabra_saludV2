<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provincia extends Model
{
    protected $fillable = [
        'id_provincia',
        'id_departamento',
        'nombre'
    ];
}
