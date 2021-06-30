<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asociaciones extends Model
{
    protected $fillable = [
        'idAsociaciones',
        'idPerfilProfesional',
        'imgasociacion'
    ];
}
