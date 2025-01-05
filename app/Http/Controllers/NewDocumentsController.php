<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NewDocumentsController extends Controller
{
    public function cedula()
    {
        // Carga la vista y genera el PDF
        $pdf = PDF::loadView('admin.pdf.nuevos.cedula')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        // Establecer tamaño de papel personalizado
        $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Oficio

        // Retornar el PDF generado
        return $pdf->stream('Cedula.pdf');
    }

    public function titulo(){

        $pdf = PDF::loadView('admin.pdf.nuevos.titulo');
        // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

        $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

        return $pdf->stream('titulo.pdf');

    }

    public function diploma(){

        $ancho_cm = 21.5;
        $alto_cm = 34;

        $ancho_puntos = $ancho_cm * 28.35;
        $alto_puntos = $alto_cm * 28.35;

        $pdf = PDF::loadView('admin.pdf.nuevos.diploma');
        $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

        return $pdf->stream('diploma.pdf');
    }

    public function credencial(){

        $ancho_cm = 5.5;
        $alto_cm = 8.5;

        $ancho_puntos = $ancho_cm * 28.35;
        $alto_puntos = $alto_cm * 28.35;

        $pdf = PDF::loadView('admin.pdf.nuevos.credencial');

        $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

        return $pdf->stream('credencial.pdf');

    }

    public function tira(){

        $ancho_cm = 21.5;
        $alto_cm = 34;

        $ancho_puntos = $ancho_cm * 28.35;
        $alto_puntos = $alto_cm * 28.35;

        $pdf = PDF::loadView('admin.pdf.nuevos.tira');
        $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

        return $pdf->stream('tira.pdf');
    }
}
