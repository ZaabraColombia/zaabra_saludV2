<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario_idiomas extends Model
{
    protected $fillable = [
        'idUsuarioIdiomas',
        'idPerfilProfesional',
        'id_idioma',
        'updated_at',
        'created_at'
    ];

    public function idioma()
    {
        return $this->belongsTo(idiomas::class, 'id_idioma', 'id_idioma');
    }

}
