<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

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
        return $this->belongsTo(Paciente::class, 'id_usuario', 'id');
    }

    public function roles()
    {
        return $this->hasMany(users_roles::class, 'iduser', 'id');
    }
}
