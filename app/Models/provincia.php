<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provincia extends Model
{
    protected $fillable = [
        'id_provincia',
        'id_departamento',
        'nombre'
    ];

    protected $primaryKey = "id_provincia";

    public function municipios()
    {
        return $this->hasMany(municipio::class, 'id_provincia', 'id_provincia');
    }

    public function departamento()
    {
        return $this->belongsTo(departamento::class, 'id_departamento', 'id_departamento');
    }
}
