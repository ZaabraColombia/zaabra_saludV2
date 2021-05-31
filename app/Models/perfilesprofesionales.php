<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfilesprofesionales extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser', 
        'idarea', 
        'idprofesion', 
        'idespecialidad', 
        'idpais',
        'id_departamento', 
        'id_provincia', 
        'id_municipio', 
        'direccion',  
        'genero', 
        'EmpresaActual', 
        'fotoperfil', 
        'fechanacimiento', 
        'numeroTarjeta', 
        'entidadCertificoTarjeta',  
        'descripcionPerfil ',
        'imglogoempresa', 
        'caracteristicas',  
        'FechaAprobacion', 
        'aprobado', 
        'aceptoTerminos', 
        'fechaCreacionFormulario',  
        'created_at', 
        'updated_at',
    ];
}
