<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteTicketsVendidos extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $totalPagadoFormateado;

    public function __construct($datos,$totalPagadoFormateado)
    {
        $this->datos = $datos;
        $this->totalPagadoFormateado = $totalPagadoFormateado;
    }

    public function build()
    {
        return $this->view('emails.reporte_tickets_vendidos')
                    ->subject('Reporte de tickets Vendido x Dia');
    }
}
