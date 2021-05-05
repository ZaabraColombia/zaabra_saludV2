<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         $urlZaabra= "http://localhost:8000/";
        //$urlZaabra = 'https://zaabrasalud.co/';
        //$urlZaabra= "http://portal-test.zaabra.local/";
 
        $GLOBALS["urlZaabra"] = $urlZaabra;
 

    }
}
