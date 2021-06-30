<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pais extends Model
{
    protected $fillable = [
        'id_pais',
        'codigo',
        'nombre'
    ];
}
