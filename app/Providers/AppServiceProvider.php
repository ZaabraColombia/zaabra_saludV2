<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Conner\Tagging\Providers\TaggingServiceProvider;


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
        //$urlZaabra= "http://localhost:8000/";
        //$GLOBALS["urlZaabra"] = $urlZaabra;

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            //dd($notifiable);
            return (new MailMessage())
                ->subject(__('emails.Confirmar correo electrónico'))
                ->markdown('emails.confirmacion_registro', ['user' => $notifiable, 'url' => $url]);
        });


    }
}
