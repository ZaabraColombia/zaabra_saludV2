<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class idiomas extends Model
{
    protected $fillable = [
        'id_idioma',
        'nombreidioma',
        'imgidioma'
    ];

    protected $primaryKey = 'id_idioma';

    public function profesionales()
    {
        return $this->belongsToMany(perfilesprofesionales::class, 'usuario_idiomas', 'id_idioma', 'idPerfilProfesional')
            ->withTimestamps();
    }
}
