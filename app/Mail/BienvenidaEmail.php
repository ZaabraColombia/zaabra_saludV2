<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BienvenidaEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $roles = $this->user->roles;

        switch ($roles[0]->idrol)
        {
            case 2://especialista
                $email = 'bienvenidos_especialista';
                break;
            case 3://Institución
                $email = 'bienvenidos_institucion';
                break;
            default:
                $email = 'bienvenidos_paciente';
                break;
        }


        return $this->view('emails.' . $email, ['user' => $this->user])
            ->subject(__('emails.Bienvenido(a)'));
    }
}
