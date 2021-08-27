<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfilesprofesionalesuniversidades extends Model
{
    protected $fillable = [
        'id_universidadperfil',
        'id_universidad',
        'idPerfilProfesional',
        'nombreestudio',
        'fechaestudio',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'id_universidadperfil';


    public function universidad()
    {
        return $this->belongsTo(universidades::class, 'id_universidad', 'id_universidad');
    }
}
