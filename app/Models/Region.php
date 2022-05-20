<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'pais_code'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $table = 'regiones';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ciudades(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ciudad::class, 'region_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pais(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pais::class, 'pais_code', 'code');
    }
}
