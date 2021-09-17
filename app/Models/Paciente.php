<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $table = "pacientes";

    protected $fillable = [
        'id',
        'telefono',
        'celular',
        'direccion',
        'eps',
        'foto',
        'id_municipio',
        'id_usuario'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_usuario');
    }

    public function municipio()
    {
        return $this->hasOne(municipio::class, 'id_municipio', 'id_municipio');
    }
}
