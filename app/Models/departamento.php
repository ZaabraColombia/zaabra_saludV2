<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departamento extends Model
{
    protected $fillable = [
        'id_departamento',
        'id_pais',
        'nombre'
    ];

    protected $primaryKey = 'id_departamento';

    public function provincias()
    {
        return $this->hasMany(provincia::class, 'id_departamento', 'id_departamento');
    }

    public function pais()
    {
        return $this->belongsTo(pais::class, 'id_pais', 'id_pais');
    }
}
