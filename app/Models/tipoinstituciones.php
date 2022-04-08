<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoinstituciones extends Model
{
    use Sluggable;

    protected $fillable = [
        'id',
        'nombretipo',
        'descripcioninstitucion',
        'urlimagen',
        'estado',
        'slug'
    ];

    public $timestamps = false;

    /**
     * retorna los tipo activado
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActivado(Builder $query): Builder
    {
        return $query->where('estado', 1);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombretipo'
            ]
        ];
    }
}
