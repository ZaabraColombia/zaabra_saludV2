<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionCitaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Guarda la configuración de la cita
     *
     * @var
     */
    private $cita;

    /**
     * Guarda si es una confirmación de una institución o profesional
     *
     * @var
     */
    private $tipo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cita, $tipo)
    {
        $this->cita = $cita;
        $this->tipo = $tipo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ( $this->tipo == 'profesional') return $this->view('emails.confiramcion_cita_profesional', ['cita' => $this->cita])
            ->subject('Confirmación de cita');
        if ( $this->tipo == 'institucion') return $this->view('emails.confiramcion_cita_institucion', ['cita' => $this->cita])
            ->subject('Confirmación de cita');
        return null;
    }
}
