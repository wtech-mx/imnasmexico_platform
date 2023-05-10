<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use App\Models\CajaDia;
use Session;
use DB;

class CajaController extends Controller
{
    public function index()
    {
        $fechaActual = date('Y-m-d');
        $diaActual = date('d');

        $caja = Caja::where('fecha', '=', $fechaActual)
        ->first();

        if($caja == null){
            $caja=0;
        }else{
            $caja=$caja->ingresos;
        }

        $pago = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)
        ->where('pagos.forma_pago', '=', 'Efectivo')
        ->where('notas.anular', '=', NULL)
        ->get();

        $pago_suma = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)
        ->where('pagos.forma_pago', '=', 'Efectivo')
        ->where('notas.anular', '=', NULL)
        ->select(DB::raw('SUM(pagos.pago) as total'))
        ->first();

        $pago_pedidos = NotasPedidos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Efectivo')->get();
        $pago_pedidos_suma = NotasPedidos::where('fecha', '=', $fechaActual)
        ->where('metodo_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(total) as total'))
        ->first();

        $pago_paquete = PaquetesPago::where('fecha', '=', $fechaActual)->where('forma_pago', '=', 'Efectivo')->get();
        $pago_paquete_suma = PaquetesPago::where('fecha', '=', $fechaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(pago) as total'))
        ->first();

        $caja_dia = CajaDia::where('fecha', '=', $fechaActual)->get();
        $caja_dia_suma = CajaDia::where('fecha', '=', $fechaActual)
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $notas_paquetes = NotasPaquetes::get();

        return view('caja.index', compact('caja', 'pago', 'pago_suma', 'caja_dia', 'caja_dia_suma','pago_pedidos', 'pago_pedidos_suma', 'diaActual', 'notas_paquetes', 'caja', 'pago_paquete', 'pago_paquete_suma'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'egresos' => 'required',
            'concepto' => 'required'
        ]);

        $fechaActual = date('Y-m-d');
        $caja = new CajaDia;
        $caja->egresos = $request->get('egresos');
        $caja->concepto = $request->get('concepto');
        $caja->fecha = $fechaActual;
        $caja->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('caja.index')
            ->with('success', 'caja created successfully.');
    }

    public function caja_inicial(Request $request){
        $fechaActual = date('Y-m-d');
        $caja = new Caja;
        $caja->ingresos = $request->get('ingresos');
        $caja->fecha = $fechaActual;
        $caja->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('caja.index')
            ->with('success', 'caja created successfully.');
    }

    public function imprimir_caja(){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        //  =============== C A J A  F I N A L ===============================
        $caja_final = Caja::where('fecha', '=', $diaActual)
        ->first();
        if($caja_final == null){
            $caja_final2=0;
        }else{
            $caja_final2=$caja_final->ingresos;
        }

        $pago_suma = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $diaActual)
        ->where('pagos.forma_pago', '=', 'Efectivo')
        ->where('notas.anular', '=', NULL)
        ->select(DB::raw('SUM(pagos.pago) as total'))
        ->first();

        $pago_pedidos_suma = NotasPedidos::where('fecha', '=', $diaActual)
        ->where('metodo_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(total) as total'))
        ->first();

        $pago_paquete_suma = PaquetesPago::where('fecha', '=', $diaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->select(DB::raw('SUM(pago) as total'))
        ->first();

        $caja_dia_suma = CajaDia::where('fecha', '=', $diaActual)
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $total_ing = 0;
        $total_ing =  $pago_suma->total +  $pago_pedidos_suma->total + $pago_paquete_suma->total + $caja_final->ingresos;

        $total_egresos = 0;
        $total_egresos = $total_ing - $caja_dia_suma->total;

        $nota = Caja::find($caja_final->id);
        $nota->ingresos = $total_ing;
        $nota->egresos = $caja_dia_suma->total;
        $nota->total = $total_egresos;
        $nota->update();

        $caja = CajaDia::where(DB::raw('fecha'), '=', $diaActual)->get();

        $servicios = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where(DB::raw('pagos.fecha'), '=', $diaActual)
        ->where('pagos.forma_pago', '=', 'Efectivo')
        ->where('notas.anular', '=', NULL)
        ->get();

        $productos = NotasPedidos::where(DB::raw('fecha'), '=', $diaActual)
        ->where('metodo_pago', '=', 'Efectivo')
        ->get();

        $paquetes = PaquetesPago::where(DB::raw('fecha'), '=', $diaActual)
        ->where('forma_pago', '=', 'Efectivo')
        ->get();

        $caja_dia_suma = CajaDia::where('fecha', '=', $diaActual)
        ->select(DB::raw('SUM(egresos) as total'))
        ->first();

        $notas_paquetes = NotasPaquetes::get();

        $notas_propinas = NotasPropinas::get();

        $pdf = \PDF::loadView('caja.pdf', compact('paquetes','pago_paquete_suma','today', 'caja_final2', 'caja', 'servicios', 'productos', 'caja_dia_suma', 'pago_pedidos_suma', 'pago_suma', 'notas_paquetes', 'notas_propinas', 'caja_final'));
        // return $pdf->stream();
        return $pdf->download('Reporte Caja '.$today.'.pdf');
    }


    public function imprimir_corte()
    {
        $fechaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $total_servicios_trans = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)->where('pagos.forma_pago', '=', 'Transferencia')->where('notas.anular', '=', NULL)->get();
        $total_servicios_mercado = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)->where('pagos.forma_pago', '=', 'Mercado Pago')->where('notas.anular', '=', NULL)->get();
        $total_servicios_tarjeta = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)->where('pagos.forma_pago', '=', 'Tarjeta')->where('notas.anular', '=', NULL)->get();

        $total_producto_trans = NotasPedidos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Transferencia')->get();
        $total_producto_mercado = NotasPedidos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Mercado Pago')->get();
        $total_producto_tarjeta = NotasPedidos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Tarjeta')->get();

        $total_paquetes_trans = PaquetesPago::where('fecha', '=', $fechaActual)->where('forma_pago', '=', 'Transferencia')->get();
        $total_paquetes_mercado = PaquetesPago::where('fecha', '=', $fechaActual)->where('forma_pago', '=', 'Mercado Pago')->get();
        $total_paquetes_tarjeta = PaquetesPago::where('fecha', '=', $fechaActual)->where('forma_pago', '=', 'Tarjeta')->get();

        $servicios_trans = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)
        ->where('pagos.forma_pago', '=', 'Transferencia')
        ->where('notas.anular', '=', NULL)
        ->select(DB::raw('SUM(pagos.pago) as total'), DB::raw('count(*) as filas'))
        ->first();

        $productos_trans = NotasPedidos::where('fecha', '=', $fechaActual)
        ->where('metodo_pago', '=', 'Transferencia')
        ->select(DB::raw('SUM(total) as total'), DB::raw('count(*) as filas'))
        ->first();

        $paquete_trans = PaquetesPago::where('fecha', '=', $fechaActual)
        ->where('forma_pago', '=', 'Transferencia')
        ->select(DB::raw('SUM(pago) as total'), DB::raw('count(*) as filas'))
        ->first();

        $suma_pago_trans = $servicios_trans->total + $productos_trans->total + $paquete_trans->total;
        $suma_filas_trans = $servicios_trans->filas + $productos_trans->filas + $paquete_trans->filas;

        $servicios_mercado = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)
        ->where('pagos.forma_pago', '=', 'Mercado Pago')
        ->where('notas.anular', '=', NULL)
        ->select(DB::raw('SUM(pagos.pago) as total'), DB::raw('count(*) as filas'))
        ->first();

        $productos_mercado = NotasPedidos::where('fecha', '=', $fechaActual)
        ->where('metodo_pago', '=', 'Mercado Pago')
        ->select(DB::raw('SUM(total) as total'), DB::raw('count(*) as filas'))
        ->first();

        $paquete_mercado = PaquetesPago::where('fecha', '=', $fechaActual)
        ->where('forma_pago', '=', 'Mercado Pago')
        ->select(DB::raw('SUM(pago) as total'), DB::raw('count(*) as filas'))
        ->first();

        $suma_pago_mercado = $servicios_mercado->total + $productos_mercado->total + $paquete_mercado->total;
        $suma_filas_mercado = $servicios_mercado->filas + $productos_mercado->filas + $paquete_mercado->filas;

        $servicios_tarjeta = Pagos::join('notas', 'pagos.id_nota', '=', 'notas.id')
        ->where('pagos.fecha', '=', $fechaActual)
        ->where('pagos.forma_pago', '=', 'Tarjeta')
        ->where('notas.anular', '=', NULL)
        ->select(DB::raw('SUM(pagos.pago) as total'), DB::raw('count(*) as filas'))
        ->first();

        $productos_tarjeta = NotasPedidos::where('fecha', '=', $fechaActual)
        ->where('metodo_pago', '=', 'Tarjeta')
        ->select(DB::raw('SUM(total) as total'), DB::raw('count(*) as filas'))
        ->first();

        $paquete_tarjeta = PaquetesPago::where('fecha', '=', $fechaActual)
        ->where('forma_pago', '=', 'Tarjeta')
        ->select(DB::raw('SUM(pago) as total'), DB::raw('count(*) as filas'))
        ->first();

        $suma_pago_tarjeta = $servicios_tarjeta->total + $productos_tarjeta->total + $paquete_tarjeta->total;
        $suma_filas_tarjeta = $servicios_tarjeta->filas + $productos_tarjeta->filas + $paquete_tarjeta->filas;

        $notas_propinas = NotasPropinas::get();

        $pdf = \PDF::loadView('caja.pdf_corte', compact('suma_pago_trans', 'suma_filas_trans', 'suma_pago_mercado', 'suma_filas_mercado', 'suma_pago_tarjeta', 'suma_filas_tarjeta',
        'today', 'total_servicios_trans', 'total_servicios_mercado', 'total_servicios_tarjeta', 'total_producto_trans', 'total_producto_mercado', 'total_producto_tarjeta',
        'notas_propinas', 'total_paquetes_trans', 'total_paquetes_mercado', 'total_paquetes_tarjeta'));
       // return $pdf->stream();
        return $pdf->download('Corte '.$today.'.pdf');
    }
}
