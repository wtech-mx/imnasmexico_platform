<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteTicketsVendidosMes extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $totalPagadoFormateado;
    public $mes_date;

    public function __construct($datos,$totalPagadoFormateado,$mes_date)
    {
        $this->datos = $datos;
        $this->totalPagadoFormateado = $totalPagadoFormateado;
        $this->mes_date = $mes_date;
    }

    public function build()
    {
        return $this->view('emails.reporte_tickets_vendidos_mes')
                    ->subject('Reporte de tickets Vendido x Mes');
    }
}
