<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class perfilesprofesionales extends Model
{
    use Sluggable;
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
        'slug'
    ];

    protected $primaryKey = 'idPerfilProfesional';

    protected $table = 'perfilesprofesionales';


    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function profecion()
    {
        return $this->belongsTo(profesiones::class, 'idprofesion', 'idProfesion');
    }

    public function especialidad()
    {
        return $this->belongsTo(especialidades::class, 'idespecialidad', 'idEspecialidad');
    }

    public function idiomas()
    {
        return $this->belongsToMany(idiomas::class, 'usuario_idiomas', 'idPerfilProfesional', 'id_idioma')
            ->withTimestamps();
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['user.primernombre', 'user.segundonombre', 'user.primerapellido', 'user.segundoapellido']
            ]
        ];
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'profesional_id', 'idPerfilProfesional');
    }

    public function tipo_consultas()
    {
        return $this->hasMany(tipoconsultas::class, 'idperfil', 'idPerfilProfesional');
    }

    public function universidad()
    {
        return $this->belongsTo(universidades::class, 'id_universidad', 'id_universidad');
    }
}
