<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenios extends Model
{
    use HasFactory;

    protected $table = "convenios";

    protected $fillable = [
        'id',
        'id_user',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'tipo_documento_id',
        'numero_documento',
        'dv_documento',
        'sgsss_id',
        'codigo_convenio',
        'tipo_contribuyente_id',
        'actividad_economica_id',
        'forma_pago',
        'tipo_establecimiento',
        'direccion',
        'codigo_postal',
        'pais_id',
        'departamento_id',
        'provincia_id',
        'ciudad_id',
        'telefono',
        'celular',
        'correo',
        'id_institucion',
        'id_tipo_convenio',
        'url_image',
        'estado'
    ];

    protected $primaryKey = "id";

    protected $appends = [
        'nombre_completo',
        'mascara_identificacion',
        'foto'
    ];


    /**
     * Retorna el nombre completo
     *
     * @return string
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->primer_nombre} {$this->segundo_nombre} {$this->primer_apellido} {$this->segundo_apellido}";
    }

    /**
     * Retorna el profesional o institución del convenio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function servicios(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Servicio::class, 'convenios_has_servicios', 'convenio_id', 'servicio_id')
            ->withPivot(['valor_paciente', 'valor_convenio']);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActivado(Builder $query): Builder
    {
        return $query->where('estado', '=', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_identificacion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
    }

    public function sgsss()
    {
        return $this->belongsTo(Sgsss::class, 'sgsss_id', 'id');
    }

    /**
     * Retorna el nombre completo
     *
     * @return string
     */
    public function getMascaraIdentificacionAttribute(): string
    {
        return "{$this->tipo_identificacion->nombre_corto} " . number_format($this->numero_documento, '0', ',', '.');
    }

    /**
     *
     */
    public function getFotoAttribute()
    {
        return asset($this->url_image ?? 'img/menu/avatar.png');
    }
}
