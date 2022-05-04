<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sgsss extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'regimen'
    ];

    protected $table = 'sgsss';

}
