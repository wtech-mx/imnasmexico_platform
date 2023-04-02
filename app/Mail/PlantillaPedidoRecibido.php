<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlantillaPedidoRecibido extends Mailable
{
    use Queueable, SerializesModels;

    public $orden_ticket;

    public function __construct($orden_ticket)
    {
        $this->orden_ticket = $orden_ticket;
    }

    public function build()
    {
        return $this->view('emails.pedido_resibido_user')
                    ->subject('Correo de bienvenida');
    }
}
