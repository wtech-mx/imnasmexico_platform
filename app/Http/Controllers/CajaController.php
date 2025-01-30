<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use App\Models\CajaDia;
use App\Models\NotasPagos;
use App\Models\NotasProductos;
use Session;
use DB;

class CajaController extends Controller
{
    public function index(){
        $fechaActual = date('Y-m-d');
        $notas_pagos = NotasPagos::whereDate('updated_at', today())->where('metodo_pago', '=', 'Efectivo')->get();
        $total_notas_pagos = $notas_pagos->sum('monto');

        $caja_dia = CajaDia::where('fecha', '=', $fechaActual)->get();

        $caja_egresos = CajaDia::where('fecha', '=', $fechaActual)->where('tipo', '=', 'Egreso')->get();
        $total_egresos = $caja_egresos->sum('egresos');

        $caja_ingreso = CajaDia::where('fecha', '=', $fechaActual)->where('tipo', '=', 'Ingreso')->get();
        $total_ingreso = $caja_ingreso->sum('egresos');

        $caja = Caja::where('fecha', '=', $fechaActual)->first();

        if($caja == null){
            $caja=0;
        }else{
            $caja=$caja->monto_inicial;
        }

        $notas_producto = NotasProductos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Efectivo')->get();
        $total_producto_pagos = $notas_producto->sum('monto');

        $notas_producto2 = NotasProductos::where('fecha', '=', $fechaActual)->where('metodo_pago2', '=', 'Efectivo')->get();
        $total_producto_pagos2 = $notas_producto2->sum('monto2');

        $total_pagos = $caja + $total_notas_pagos + $total_producto_pagos + $total_producto_pagos2 + $total_ingreso;

        return view('admin.caja.index', compact('fechaActual', 'notas_pagos', 'total_pagos', 'notas_producto', 'caja_egresos', 'total_egresos', 'caja', 'caja_ingreso', 'total_ingreso', 'caja_dia'));
    }

    public function store(request $request){
        $fechaActual = date('Y-m-d');

        $caja_egresos = new CajaDia;
        $caja_egresos->egresos = $request->get('egresos');
        $caja_egresos->concepto = $request->get('concepto');
        $caja_egresos->tipo = $request->get('tipo');
        $caja_egresos->fecha = $fechaActual;
        $caja_egresos->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function caja_inicial(Request $request){
        $fechaActual = date('Y-m-d');

        $caja = new Caja;
        $caja->monto_inicial = $request->get('monto_inicial');
        $caja->fecha = $fechaActual;
        $caja->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function imprimir_corte()
    {
        $fechaActual = date('Y-m-d');
        $today =  date('d-m-Y');
        $notas_cursos_efectivo = NotasPagos::whereDate('updated_at', today())->where('metodo_pago', '=', 'Efectivo')->get();
        $notas_producto_efectivo = NotasProductos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Efectivo')->get();

        $notas_cursos_trans = NotasPagos::whereDate('updated_at', today())->where('metodo_pago', '=', 'Transferencia')->get();
        $notas_producto_trans = NotasProductos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Transferencia')->get();

        $notas_cursos_tarjeta = NotasPagos::whereDate('updated_at', today())->where('metodo_pago', '=', 'Tarjeta')->get();
        $notas_producto_tarjeta = NotasProductos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Tarjeta Credito/debito')->get();

        $caja_dia = CajaDia::where('fecha', '=', $fechaActual)->get();

        $caja_egresos = CajaDia::where('fecha', '=', $fechaActual)->where('tipo', '=', 'Egreso')->get();
        $total_egresos = $caja_egresos->sum('egresos');

        $caja_ingreso = CajaDia::where('fecha', '=', $fechaActual)->where('tipo', '=', 'Ingreso')->get();
        $total_ingreso = $caja_ingreso->sum('egresos');

        $caja = Caja::where('fecha', '=', $fechaActual)->first();

        if($caja == null){
            $caja_monto=0;
        }else{
            $caja_monto=$caja->monto_inicial;
        }

        //S U M A  E F E C T I V O
        $total_pagos_efectivo = $notas_cursos_efectivo->sum('monto') + $notas_producto_efectivo->sum('total') + $total_ingreso;
        $count_cursos_efectivo = $notas_cursos_efectivo->count() + $notas_producto_efectivo->count();
        //S U M A  T R A N S F E R E N C I A
        $total_pagos_trans = $notas_cursos_trans->sum('monto')  + $notas_producto_trans->sum('total');
        $count_cursos_trans = $notas_cursos_trans->count() + $notas_producto_trans->count();
        //S U M A  T A R J E T A
        $total_pagos_tarjeta = $notas_cursos_tarjeta->sum('monto') + $notas_producto_tarjeta->sum('total');
        $count_cursos_tarjeta = $notas_cursos_tarjeta->count() + $notas_producto_tarjeta->count();

        $total_pagos = $caja_monto + $total_pagos_efectivo;

        $pdf = \PDF::loadView('admin.caja.pdf_corte', compact('fechaActual', 'notas_cursos_efectivo', 'total_pagos_efectivo', 'count_cursos_efectivo',
        'notas_cursos_trans', 'total_pagos_trans', 'count_cursos_trans',
        'notas_cursos_tarjeta', 'total_pagos_tarjeta', 'count_cursos_tarjeta',
        'notas_producto_efectivo', 'notas_producto_trans', 'notas_producto_tarjeta',
        'caja_egresos', 'total_egresos', 'total_pagos','caja', 'today', 'caja_dia'));
        return $pdf->stream();
       // return $pdf->download('Corte '.$today.'.pdf');
    }
}
