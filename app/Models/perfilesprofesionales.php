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
        'id_universidad',
        'direccion',
        'genero',
        'celular',
        'telefono',
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

    /**
     * The roles that belong to the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
