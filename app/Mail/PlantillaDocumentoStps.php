<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlantillaDocumentoStps extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;

    public function __construct($pdfContent, $datos)
    {
        $this->pdfContent = $pdfContent;
        $this->datos = $datos;
    }

    public function build()
    {
        return $this->view('emails.documento_stps')
            ->attachData($this->pdfContent, 'diploma_stps.pdf', [
                'mime' => 'application/pdf',
            ])->subject('Envio de Diploma STPS');
    }
}
