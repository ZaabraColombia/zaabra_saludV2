<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class instituciones extends Model
{

    use Sluggable;

    protected $fillable = [
        'id',
        'idUser',
        'idPais',
        'id_departamento',
        'id_provincia',
        'id_municipio',
        'idtipoInstitucion',
        'imagen',
        'logo',
        'razonSocial',
        'quienessomos',
        'DescripcionGeneralServicios',
        'url',
        'fechainicio',
        'telefonouno',
        'telefono2',
        'direccion',
        'propuestavalor',
        'slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'user.nombreinstitucion'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }


    /**
     * @return BelongsTo
     */
    public function pais(): BelongsTo
    {
        return $this->belongsTo(pais::class, 'idPais', 'id_pais');
    }
    /**
     * @return BelongsTo
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(departamento::class, 'id_departamento', 'id_departamento');
    }
    /**
     * @return BelongsTo
     */
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(provincia::class, 'id_provincia', 'id_provincia');
    }
    /**
     * @return BelongsTo
     */
    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(municipio::class, 'id_municipio', 'id_municipio');
    }
}
