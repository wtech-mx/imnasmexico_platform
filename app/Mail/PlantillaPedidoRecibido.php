<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlantillaPedidoRecibido extends Mailable
{
    use Queueable, SerializesModels;

    public $orden_ticket;
    public $id_order;
    public $user;
    public $pago;
    public $forma_pago;

    public function __construct($orden_ticket, $user, $id_order, $pago, $forma_pago)
    {
        $this->orden_ticket = $orden_ticket;
        $this->id_order = $id_order;
        $this->user = $user;
        $this->pago = $pago;
        $this->forma_pago = $forma_pago;
    }

    public function build()
    {
        return $this->view('emails.pedido_resibido_user')
                    ->subject('Compra Recibida');
    }
}
