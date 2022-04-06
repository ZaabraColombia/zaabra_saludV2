<?php

namespace App\Providers;

use App\Models\Convenios;
use App\Models\profesionales_instituciones;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Validar si puede editar el profesional de institución
        Gate::define('update-profesional-institucion', function (User $user, profesionales_instituciones $profesional) {
            return $user->institucion->id === $profesional->id_institucion;
        });

        //Validar si puede editar convenio de institución
        Gate::define('update-convenio-institucion', function (User $user, Convenios $convenio) {
            return $user->institucion->user->id === $convenio->id_user;
        });

        //Validar si puede editar servicio de institución
        Gate::define('update-servicio-institucion', function (User $user, Servicio $servicio) {
            return $user->institucion->id === $servicio->institucion_id;
        });

        //Validar acceso a módulos de institución
        Gate::define('modulos-institucion', function (User $user, $slug) {
            return
                //Valida si es un auxiliar
                $user->roles()->where('idrol', '!=', 4)->count() >= 1 || $user->accesos()
                    ->where('slug', '=', $slug)
                    ->where('tipo', 'like', 'institucion')
                    ->count() >= 1;
        });

    }
}
