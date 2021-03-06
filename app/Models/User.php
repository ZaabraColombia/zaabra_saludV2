<?php

namespace App\Models;

use App\Mail\ResetPasswordEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'primernombre',
        'segundonombre',
        'primerapellido',
        'segundoapellido',
        'nombreinstitucion',
        'tipodocumento',
        'numerodocumento',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'institucion_id',
        'profesional_id',
        'estado'
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
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'nombre_completo'
    ];


//    protected $with = [
//        'roles'
//    ];

    /**
     * @return HasOne
     */
    public function profecional(): HasOne
    {
        return $this->hasOne(perfilesprofesionales::class, 'idUser', 'id');
    }


    /**
     * @return BelongsTo|HasOne
     */
    public function profesional()
    {
        $role = $this->roles()->where('idrol', 5)->first();
        if (!empty($role))
        {
            return $this->belongsTo(perfilesprofesionales::class,'profesional_id', 'idPerfilProfesional');
        }
        return $this->hasOne(perfilesprofesionales::class, 'idUser', 'id');
    }

    /**
     * @return HasOne
     */
    public function paciente(): HasOne
    {
        return $this->hasOne(Paciente::class, 'id_usuario', 'id');
    }

    /**
     * @return HasOne
     */
    public function auxiliar(): HasOne
    {
        return $this->hasOne(Auxiliar::class, 'user_id', 'id');
    }


    public function roles()
    {
        return $this->hasMany(users_roles::class, 'iduser', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPasswordEmail($token, $this));
        //return $this->notify(new ResetPasswordNotification($token));
    }

    public function institucion()
    {
        $role = $this->roles()->where('idrol', 4)->first();
        if (!empty($role))
        {
            return $this->belongsTo(instituciones::class, 'institucion_id', 'id');
        }
        return $this->hasOne(instituciones::class, 'idUser', 'id');
    }

    /**
     * Permite hacer la busqueda de forma publica
     *
     * @return HasOne
     */
    public function institucion_public(): HasOne
    {
        return $this->hasOne(instituciones::class, 'idUser', 'id');
    }

    public function horario()
    {
        return $this->hasOne(Horario::class);
    }


    /**
     * @return string|null
     */
    public function getNombreCompletoAttribute(): ?string
    {
        if (empty($this->primernombre) and empty($this->segundonombre) and
            empty($this->primerapellido) and empty($this->segundoapellido))
            return null;

        return "{$this->primernombre} {$this->segundonombre} {$this->primerapellido} {$this->segundoapellido}";
    }

    /**
     * @return string
     */
    public function getNombresAttribute(): string
    {
        return "{$this->primernombre} {$this->segundonombre}";
    }

    /**
     * @return string
     */
    public function getApellidosAttribute(): string
    {
        return "{$this->primerapellido} {$this->segundoapellido}";
    }

    /**
     * @return BelongsTo
     */
    public function tipo_documento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipodocumento');
    }

    /**
     * Permite ver todos los usuarios de un acceso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accesos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Acceso::class, 'accesos_has_users', 'user_id', 'acceso_id');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActivado(Builder $query): Builder
    {
        return $query->where('estado', '=', true);
    }

    public function getIdentificacionAttribute(): string
    {
        return "{$this->tipo_documento->nombre_corto} " . number_format($this->numerodocumento, 0, ',', '.');
    }

}
