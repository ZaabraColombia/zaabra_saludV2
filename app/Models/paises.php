<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paises extends Model
{
    protected $fillable = [
        'id_pais',
        'codigo',
        'nombre'
    ];

    protected $table = 'pais';

    public function departamentos()
    {
        return $this->hasMany(provincia::class, 'id_pais', 'id_pais');
    }
}
