<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactecnos extends Model
{
    protected $fillable = [
        'id_user',
        'primernombre',
        'segundonombre',
        'primerapellido',
        'nombreinstitucion',
        'email',
        'asunto',
    ];
}
