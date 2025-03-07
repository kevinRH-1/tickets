<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class notificacionCorreo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $viewName;
    public $reporte;
    public $mensaje;
    public $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($viewName, $reporte, $mensaje, $usuario)
    {
        $this->viewName = $viewName;
        $this->reporte = $reporte;
        $this->mensaje = $mensaje;
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->viewName)
                    ->with($this->reporte)
                    ->with($this->mensaje)
                    ->with($this->usuario);
    }
}
