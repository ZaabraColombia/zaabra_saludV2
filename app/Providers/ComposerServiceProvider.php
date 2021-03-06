<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
       view::composer(['*'], 'App\Http\ViewComposers\HeaderComposer');
       view::composer(['*'], 'App\Http\ViewComposers\FormularioComposer');
       view::composer(['*'], 'App\Http\ViewComposers\ListaPermisosComposer');
    }
}


