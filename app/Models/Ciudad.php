<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'latitud',
        'longitud',
        'region_id'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $table = 'ciudades';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regiones(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}
