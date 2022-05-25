<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'titulo',
        'url',
        'name',
        'slug',
        'tipo'
    ];

    public $timestamps = false;

    protected $table = 'rutas';

    /**
     * Permite filtrar por institución
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInstitucion(Builder $query): Builder
    {
        return $query->where('rutas.tipo', 'institucion');
    }

    public function scopeValidar(Builder $query)
    {
        //Los dos auxiliares
        $rol = Auth::user()->roles()->whereIn('idrol', [4, 5])->first();
        if (!empty($rol)) {
            return $query->join('accesos', 'accesos.slug', '=', 'rutas.slug')
                ->join('accesos_has_users', 'accesos_has_users.acceso_id', '=', 'accesos.id')
                ->where('user_id', Auth::user()->id);
        }

        return $query;
    }

    /**
     * permite validar si llego un search
     *
     * @param Builder $query
     * @param $search
     * @return Builder
     */
    public function scopeSearch(Builder $query, $search)
    {
        if ($search) return $query->where('titulo', 'like', "%{$search}%")
            ->orWhere('url', 'like', "%{$search}%");

        return $query;
    }
}
