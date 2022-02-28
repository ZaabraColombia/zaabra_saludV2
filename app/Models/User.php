<?php

namespace App\Models;

use App\Mail\ResetPasswordEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    /**
     * Get the profecional associated with the user.
     */
    public function profecional()
    {
        return $this->hasOne(perfilesprofesionales::class, 'idUser', 'id');
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'id_usuario', 'id');
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
        return $this->hasOne(instituciones::class, 'idUser', 'id');

    }

    public function horario()
    {
        return $this->hasOne(Horario::class);
    }
}
