<?php

namespace App\Providers;

use App\Models\profesionales_instituciones;
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
    }
}
