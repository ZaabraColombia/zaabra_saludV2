<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombretipo'
            ]
        ];
    }
}
