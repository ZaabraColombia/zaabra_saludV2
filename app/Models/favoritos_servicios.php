<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favoritos_servicios extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre_favorito_servicio',
        'id_users',
        'updated_at',
        'created_at'
    ];
}
