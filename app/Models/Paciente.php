<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $table = "pacientes";

    protected $fillable = [
        'id',
        'telefono',
        'celular',
        'direccion',
        'eps',
        'foto',
        'id_municipio',
        'id_usuario'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function municipio()
    {
        return $this->hasOne(municipio::class, 'id_municipio', 'id_municipio');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'paciente_id', 'id');
    }

    /**
     * Permite buscar en profesionales
     *
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearch(Builder $query, $value)
    {
        if (empty($value)) return $query;

        return $query->where(function ($query) use ($value) {
            return $query->where('telefono', 'like', "%$value%")
                ->orWhere('celular', 'like', "%$value%")
                ->orWhere('direccion', 'like', "%$value%")
                ->orWhere('eps', 'like', "%$value%")
                ->orWhereHas('user', function ($q) use ($value) {
                    return $q->where('nombre_completo', 'like', "%$value%");
                });
        });
    }
}
