<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videos extends Model
{
    protected $fillable = [
        'id',
        'idPerfilProfesional',
        'idinstitucion',
        'nombrevideo',
        'descripcionvideo',
        'urlvideo',
        'fechavideo'
    ];

    protected $primaryKey = "id";
}
