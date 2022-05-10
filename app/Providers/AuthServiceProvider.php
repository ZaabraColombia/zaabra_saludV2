<?php

namespace App\Providers;

use App\Models\Contacto;
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

        //Validar si puede editar al usuario de institución
        Gate::define('update-usuario-institucion', function (User $adminUser, User $user) {
            return $adminUser->institucion->id === $user->institucion_id;
        });

        //Validar acceso a módulos de institución
        Gate::define('accesos-institucion', function (User $user, $slug) {
            //Valida si es un auxilia
            return $user->roles()->where('idrol', '!=', 4)->count() >= 1 || $user->accesos()
                    ->where('slug', '=', $slug)
                    ->where('tipo', 'like', 'institucion')
                    ->count() >= 1;
        });

        //Validar acceso a módulos de profesional
        Gate::define('accesos-profesional', function (User $user, $slug) {
            //Valida si es un auxiliar
            $array = (is_array($slug)) ? $slug:[$slug];
            return $user->roles()->where('idrol', '!=', 5)->count() >= 1 || $user->accesos()
                    ->whereIn('slug', $array)
                    ->where('tipo', 'like', 'profesional')
                    ->count() >= 1;
        });

        //Validar si puede editar contactos de profesional
        Gate::define('update-contactos-profesional', function (User $user, Contacto $contacto) {
            return $user->profesional->idUser === $contacto->user_id;
        });

        //Validar si puede editar convenio de profesional
        Gate::define('update-convenio-profesional', function (User $user, Convenios $convenio) {
            return $user->profesional->idUser === $convenio->id_user;
        });

        //Validar si puede editar servicio de profesional
        Gate::define('update-servicio-profesional', function (User $user, Servicio $servicio) {
            return $user->profesional->idPerfilProfesional === $servicio->profesional_id;
        });

        //Validar si puede editar al usuario de profesional
        Gate::define('update-usuario-profesional', function (User $adminUser, User $user) {
            return $adminUser->profesional->idPerfilProfesional === $user->profesional_id;
        });

    }
}
