<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use function Symfony\Component\Translation\t;

class profesionales_instituciones extends Authenticatable implements MustVerifyEmail
{
    use Sluggable;

    protected $fillable = [
        'id_profesional_inst',
        'id_institucion',
        'id_universidad',
        'id_especialidad',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'nombre_completo',
        'tipo_documento_id',
        'numero_documento',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'celular',
        'pais_id',
        'departamento_id',
        'provincia_id',
        'ciudad_id',
        'correo',
        'sitio_web',
        'linkedin',
        'red_social',
        'rethus',
        'numero_profesional',
        'foto_perfil_institucion',
        'cargo',
        'horario',
        'disponibilidad_agenda',
        'sede_id',
        'consultorio',
        'slug',
        'estado',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'correo_verified_at' => 'datetime',
        'horario' => 'array',
        'fecha_nacimiento' => 'datetime',
    ];

    protected $primaryKey = "id_profesional_inst";

    protected $appends = [
        'nombre_completo'
    ];

    /**
     * @return BelongsTo
     */
    public function especialidad_principal(): BelongsTo
    {
        return $this->belongsTo(especialidades::class, 'id_especialidad', 'idEspecialidad');
    }

    /**
     * @return BelongsToMany
     */
    public function especialidades(): BelongsToMany
    {
        return $this->belongsToMany(especialidades::class, 'institucion_profesionales_especialidades',
            'id_institucion_profesional', 'id_especialidad');
    }

    /**
     * @return BelongsTo
     */
    public function universidad(): BelongsTo
    {
        return $this->belongsTo(universidades::class, 'id_universidad', 'id_universidad');
    }

    /**
     * @return BelongsTo
     */
    public function institucion(): BelongsTo
    {
        return $this->belongsTo(instituciones::class, 'id_institucion', 'id');
    }

    /**
     * @return string
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->primer_nombre} {$this->segundo_nombre} {$this->primer_apellido} {$this->segundo_apellido}";
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeNombreCompleto(Builder $query): Builder
    {
        return $query->selectRaw('concat( primer_nombre, " ", segundo_nombre, " ", primer_apellido, " ", segundo_apellido) as nombre_completo');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'profesional_ins_id', 'id_profesional_inst');
    }


    public function getNombreEspecialidadAttribute(): ?string
    {
        if (!empty($this->especialidad_principal)) return $this->especialidad_principal->nombreEspecialidad;
        return null;
    }

    /**
     * @return BelongsTo
     */
    public function tipo_documento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function sede(): BelongsTo
    {
        return $this->belongsTo(sedesinstituciones::class, 'sede_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function servicios(): BelongsToMany
    {
        return $this->belongsToMany(Servicio::class, 'profesionales_ins_has_servicios', 'profesional_id', 'servicio_id');
    }


    public function getConsultorioCompletoAttribute(): string
    {
        return "{$this->sede->direccion} (Consultorio {$this->consultorio}) {$this->sede->ciudad->nombre}";
    }


    /**
     * @return \string[][][]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido']
            ]
        ];
    }

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->correo_verified_at);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'correo_verified_at' => $this->freshTimestamp(),
        ])->save();
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
            return $query->where('nombre_completo', 'like', "%$value%")
                ->orWhere('numero_documento', 'like', "%$value%")
                ->orWhere('direccion', 'like', "%$value%")
                ->orWhere('telefono', 'like', "%$value%")
                ->orWhere('celular', 'like', "%$value%")
                ->orWhere('correo', 'like', "%$value%")
                ->orWhere('numero_profesional', 'like', "%$value%")
                ->orWhere('consultorio', 'like', "%$value%")
                ->orWhere('estado', 'like', "%$value%")
                ->orWhereHas('especialidad_principal', function ($q) use ($value) {
                    return $q->where('nombreEspecialidad', 'like', "%$value%");
                });
        });
    }
}
