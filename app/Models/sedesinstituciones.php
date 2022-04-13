<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class sedesinstituciones extends Model
{
    //use \Conner\Tagging\Taggable;

    protected $fillable = [
        'idInstitucion',
        'imgsede',
        'nombre',
        'direccion',
        'horario_sede',
        'telefono',
        'url_map',
        'pais_id',
        'departamento_id',
        'provincia_id',
        'ciudad_id',
    ];

    protected $primaryKey = "id";

    /**
     * @return BelongsTo
     */
    public function pais(): BelongsTo
    {
        return $this->belongsTo(pais::class, 'pais_id', 'id_pais');
    }
    /**
     * @return BelongsTo
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(departamento::class, 'departamento_id', 'id_departamento');
    }
    /**
     * @return BelongsTo
     */
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(provincia::class, 'provincia_id', 'id_provincia');
    }
    /**
     * @return BelongsTo
     */
    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(municipio::class, 'ciudad_id', 'id_municipio');
    }
}
