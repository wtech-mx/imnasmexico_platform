<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteTicketsCustom extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $totalPagadoFormateado;
    public $fechaSemanaStr;

    public function __construct($datos,$totalPagadoFormateado,$fechaSemanaStr)
    {
        $this->datos = $datos;
        $this->totalPagadoFormateado = $totalPagadoFormateado;
        $this->fechaSemanaStr = $fechaSemanaStr;
    }

    public function build()
    {
        return $this->view('emails.reporte_tickets_vendidos_custom')
                    ->subject('Reporte de ventas');
    }
}
