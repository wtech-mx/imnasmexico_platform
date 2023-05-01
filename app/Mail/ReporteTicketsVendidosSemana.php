<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteTicketsVendidosSemana extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $totalPagadoFormateado;
    public $fecha_semanal;

    public function __construct($datos,$totalPagadoFormateado,$fecha_semanal)
    {
        $this->datos = $datos;
        $this->totalPagadoFormateado = $totalPagadoFormateado;
        $this->fecha_semanal = $fecha_semanal;
    }

    public function build()
    {
        return $this->view('emails.reporte_tickets_vendidos_semana')
                    ->subject('Reporte de tickets Vendido x Semana');
    }
}
