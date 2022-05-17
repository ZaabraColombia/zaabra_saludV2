<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nombre'
    ];

    public $timestamps = false;

    protected $table = 'paises';

    protected $primaryKey = 'code';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regiones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Region::class, 'pais_code', 'code');
    }
}
