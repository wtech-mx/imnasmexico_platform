<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdersTickets;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteTicketsVendidos;
use App\Mail\ReporteTicketsVendidosSemana;
use App\Mail\ReporteTicketsVendidosMes;
use App\Mail\ReporteTicketsCustom;

use DateTime;

use App\Models\WebPage;

class ReportesController extends Controller
{
    public function index_dia(){

        $fechaHoraActual = date('Y-m-d');
        $orders = Orders::where('fecha', $fechaHoraActual)
        ->where('estatus', '1')
        ->orderBy('id','DESC')
        ->get();

        $totalPagado = $orders->sum('pago');
        $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

        $cursosComprados = Orders::where('fecha', $fechaHoraActual)
        ->where('estatus', '1')
        ->with('OrdersTickets.CursosTickets')
        ->get()
        ->pluck('OrdersTickets')
        ->flatten()
        ->groupBy('CursosTickets.nombre')
        ->map(function ($tickets, $nombreCurso) {
            return [
                'nombre' => $nombreCurso,
                'total' => $tickets->count()
            ];
        })
        ->values();


        return view('admin.reportes.dia', compact('orders', 'totalPagadoFormateado', 'cursosComprados'));
    }

    public function reporte_email_dia(){
        $webpage = WebPage::first();

        $fechaHoraActual = date('Y-m-d');
        $orders = Orders::where('fecha', $fechaHoraActual)
        ->where('estatus', '1')
        ->orderBy('id','DESC')
        ->get();

        $totalPagado = $orders->sum('pago');
        $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

        $datos = Orders::where('fecha', $fechaHoraActual)
        ->where('estatus', '1')
        ->with('OrdersTickets.CursosTickets')
        ->get()
        ->pluck('OrdersTickets')
        ->flatten()
        ->groupBy('CursosTickets.nombre')
        ->map(function ($tickets, $nombreCurso,) {
            return [
                'nombre' => $nombreCurso,
                'total' => $tickets->count()
            ];
        })
        ->values();

        Mail::to($webpage->email_admin)
        ->bcc($webpage->email_admin_two, 'Destinatario dev 2')
        ->send(new ReporteTicketsVendidos($datos,$totalPagadoFormateado));

        return redirect()->back()->with('success', 'Webpage actualizada');

    }

    public function index_semana(){
        $fechaActual = date('Y-m-d');
        $fechaInicioSemana = date('Y-m-d', strtotime('monday this week', strtotime($fechaActual)));
        $fechaFinSemana = date('Y-m-d', strtotime('sunday this week', strtotime($fechaActual)));

            $orders = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->where('pago', '>','0')
            ->orderBy('fecha','DESC')
            ->get();

            $totalPagado = $orders->sum('pago');
            $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

            $cursosComprados = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->with('OrdersTickets.CursosTickets')
            ->get()
            ->pluck('OrdersTickets')
            ->flatten()
            ->groupBy('CursosTickets.nombre')
            ->map(function ($tickets, $nombreCurso) {
                return [
                    'nombre' => $nombreCurso,
                    'total' => $tickets->count()
                ];
            })
            ->values();

        return view('admin.reportes.semana', compact('orders', 'orders', 'cursosComprados'));
    }

    public function reporte_email_semanal(){
        $webpage = WebPage::first();

        $fechaActual = date('Y-m-d');
        $fechaInicioSemana = date('Y-m-d', strtotime('monday this week', strtotime($fechaActual)));
        $fechaFinSemana = date('Y-m-d', strtotime('sunday this week', strtotime($fechaActual)));

        $fecha = $fechaInicioSemana;
        $fecha_timestamp = strtotime($fecha);
        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);

        $fecha_fin = $fechaFinSemana;
        $fecha_timestamp = strtotime($fecha_fin);
        $fecha_formateadafin = date('d \d\e F \d\e\l Y', $fecha_timestamp);
        $fecha_semanal = $fecha_formateada.' al '.$fecha_formateadafin;

            $orders = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->where('pago', '>','0')
            ->orderBy('fecha','DESC')
            ->get();

            $totalPagado = $orders->sum('pago');
            $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

            $datos = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->with('OrdersTickets.CursosTickets')
            ->get()
            ->pluck('OrdersTickets')
            ->flatten()
            ->groupBy('CursosTickets.nombre')
            ->map(function ($tickets, $nombreCurso) {
                return [
                    'nombre' => $nombreCurso,
                    'total' => $tickets->count()
                ];
            })
            ->values();

        Mail::to($webpage->email_admin)
        ->bcc($webpage->email_admin_two, 'Destinatario dev 2')
        ->send(new ReporteTicketsVendidosSemana($datos,$totalPagadoFormateado,$fecha_semanal));

        return redirect()->back()->with('success', 'Webpage actualizada');

    }

    public function index_mes(){
        $fechaActual = Carbon::now();
        // Obtenemos el primer día del mes actual
        $fechaInicioMes = $fechaActual->startOfMonth()->toDateString();
        // Obtenemos el último día del mes actual
        $fechaFinMes = $fechaActual->endOfMonth()->toDateString();

            $orders = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
            ->where('estatus', '1')
            ->where('pago', '>','0')
            ->orderBy('id','DESC')
            ->get();

            $totalPagado = $orders->sum('pago');
            $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

            $cursosComprados = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
            ->with('OrdersTickets.CursosTickets')
            ->where('estatus', '1')
            ->get()
            ->pluck('OrdersTickets')
            ->flatten()
            ->groupBy('CursosTickets.nombre')
            ->map(function ($tickets, $nombreCurso) {
                return [
                    'nombre' => $nombreCurso,
                    'total' => $tickets->count()
                ];
            })
            ->values();

        return view('admin.reportes.mes', compact('orders', 'totalPagadoFormateado', 'cursosComprados'));
    }

    public function reporte_email_mes(){
        $webpage = WebPage::first();

        $fechaActual = Carbon::now();
        // Obtenemos el primer día del mes actual
        $fechaInicioMes = $fechaActual->startOfMonth()->toDateString();
        // Obtenemos el último día del mes actual
        $fechaFinMes = $fechaActual->endOfMonth()->toDateString();


        $fecha_mes = $fechaInicioMes;
        $mes_date = date('F', strtotime($fecha_mes));

            $orders = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
            ->where('estatus', '1')
            ->where('pago', '>','0')
            ->orderBy('id','DESC')
            ->get();

            $totalPagado = $orders->sum('pago');
            $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

            $datos = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
            ->with('OrdersTickets.CursosTickets')
            ->where('estatus', '1')
            ->get()
            ->pluck('OrdersTickets')
            ->flatten()
            ->groupBy('CursosTickets.nombre')
            ->map(function ($tickets, $nombreCurso) {
                return [
                    'nombre' => $nombreCurso,
                    'total' => $tickets->count()
                ];
            })
            ->values();

        Mail::to($webpage->email_admin)
        ->bcc($webpage->email_admin_two, 'Destinatario dev 2')
        ->send(new ReporteTicketsVendidosMes($datos,$totalPagadoFormateado,$mes_date));

        return redirect()->back()->with('success', 'Webpage actualizada');
    }

    public function index_custom(request $request){
        return view('admin.reportes.custom');
    }

    public function store_calculando_custom(request $request){

        $fechaInicioSemana = $request->get('fecha_inicio');
        $fechaFinSemana = $request->get('fecha_fin');

            $orders = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->where('pago', '>','0')
            ->orderBy('fecha','DESC')
            ->get();

            $totalPagado = $orders->sum('pago');
            $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

            $cursosComprados = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->with('OrdersTickets.CursosTickets')
            ->get()
            ->pluck('OrdersTickets')
            ->flatten()
            ->groupBy('CursosTickets.nombre')
            ->map(function ($tickets, $nombreCurso) {
                return [
                    'nombre' => $nombreCurso,
                    'total' => $tickets->count()
                ];
            })
            ->values();

            $output = "";
            $output2 = "";
            $output3 = "";
            $output4 = "";
            $output5 = "";

            if($request->ajax()){

                if ($orders) {

                foreach ($orders as $order) {
                    $output2 .=
                        '<tr>'.
                        '<td>'.$order->id.'</td>'.
                        '<td>'.$order->User->name.'</td>'.
                        '<td>'.$order->fecha.'</td>'.
                        '<td>'.$order->pago.'</td>'.
                        '<td>'.$order->forma_pago.'</td>'.
                        '<td>';
                        if ($order->estatus == '1') {
                            $output2 .= 'Completado';
                        } else {
                            $output2 .= 'En espera';
                        }
                        $output2 .= '</td>'.
                        '<td>'.
                        '<a class="btn btn-sm btn-success"   href="'.route('pagos.edit_pago',$order->id).'">'.
                        '<i class="fa fa-fw fa-edit">'.
                        '</i>'.
                        '</a>'.
                        '</td>'.
                        '</tr>';
                }

                $totalPagado = 0;
                foreach ($orders as $order) {
                    $totalPagado += $order->pago;
                }
                $totalPagadoFormatted = number_format($totalPagado, 2, '.', ',');
                $output5 .=
                    '<h4 class="text-center mb-3">Total</h4>'.
                    '<h5 class="text-center">'.
                    '$ '.$totalPagadoFormatted.
                    '</h5>'.
                    '<div class="d-flex justify-content-center mt-3">'.
                    '<form method="POST" action="'.route('reporte_custom.store').'" enctype="multipart/form-data" role="form">'.
                    '<input type="hidden" id="fecha_inicio" name="fecha_inicio" value="'.$fechaInicioSemana.'">'.
                    '<input type="hidden" id="fecha_fin" name="fecha_fin" value="'.$fechaFinSemana.'">'.
                    '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                    '<button type="submit" class="btn close-modal"> Enviar Reporte</button>'.
                    '</form>'.
                    '</div>';

            }

            if ($cursosComprados) {
                foreach ($cursosComprados as $curso) {
                    $output4 .=
                        '<tr>'.
                        '<td>'.$curso['nombre'].'</td>'.
                        '<td>'.$curso['total'] .' personas </td>'.
                        '</tr>';
                }
            }

            $output =
            '<div class="container-fluid mt-4">'.
            '<div class="row">'.
                '<div class="col-sm-12">'.
                    '<div class="card">'.

                        '<div class="d-flex justify-content-center mt-5">'.
                            '<ul class="nav nav-tabs" id="myTab" role="tablist">'.
                                '<li class="nav-item" role="presentation">'.
                                  '<button class="nav-link active" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets-tab-pane" type="button" role="tab" aria-controls="tickets-tab-pane" aria-selected="true">'.
                                    'Tickets'.
                                  '</button>'.
                                '</li>'.
                                '<li class="nav-item" role="presentation">'.
                                  '<button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">'.
                                    'Ordenes'.
                                  '</button>'.
                            '</ul>'.
                        '</div>'.

                        '<div class="tab-content" id="myTabContent">'.
                            '<div class="tab-pane fade show active" id="tickets-tab-pane" role="tabpanel" aria-labelledby="tickets-tab" tabindex="0">'.
                                '<div class="card-header">'.
                                    '<div class="d-flex justify-content-between">'.
                                        '<h3 class="mb-3">Tickets vendidos</h3>'.
                                    '</div>'.
                                '</div>'.

                                '<div class="card-body">'.
                                    '<table class="table table-flush" id="datatable-search">'.
                                        '<thead class="text-center">'.
                                            '<tr class="tr_checkout">'.
                                            '<th >Nombre</th>'.
                                            '<th >Personas</th>'.
                                            '</tr>'.
                                        '</thead>'.
                                        '<tbody>'.
                                        $output4 .
                                        '</tbody>'.
                                    '</table>'.
                                '</div>'.

                            '</div>'.

                            '<div class="tab-pane fade" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">'.

                               ' <div class="card-header">'.
                                    '<div class="d-flex justify-content-between">'.
                                        '<h3 class="mb-3">Ordenes de la Semana</h3>'.
                                    '</div>'.
                                '</div>'.
                                    '<div class="card-body">'.
                                        '<div class="table-responsive">'.
                                            '<table class="table table-flush" id="datatable-search2">'.
                                                '<thead class="text-center">'.
                                                    '<tr class="tr_checkout">'.
                                                      '<th >Num. Pedido</th>'.
                                                      '<th >Cliente</th>'.
                                                      '<th >Fecha de Compra</th>'.
                                                      '<th >Total</th>'.
                                                      '<th>Forma de Pago</th>'.
                                                      '<th>Estado</th>'.
                                                      '<th>Acciones</th>'.
                                                    '</tr>'.
                                                  '</thead>'.
                                                '<tbody>'.
                                                $output2 .
                                                '</tbody>'.
                                            '</table>'.
                                        '</div>'.
                                    '</div>'.
                            '</div>'.
                          '</div>'.
                    '</div>'.
                '</div>'.
            '</div>'.
        '</div>';

                // return response()->json($output);
                return response()->json([
                    'resultados' => $output,
                    'resultados2' => $output5
                ]);
        }
    }

    public function reporte_email_custom(request $request){
            $webpage = WebPage::first();

            $fechaInicioSemana = $request->get('fecha_inicio');
            $fechaFinSemana = $request->get('fecha_fin');

            $fechaInicioObj = new DateTime(date('Y-m-d', strtotime($fechaInicioSemana)));
            $fechaFinObj = new DateTime(date('Y-m-d', strtotime($fechaFinSemana)));

            $fechaInicioStr = $fechaInicioObj->format('d \d\e F \d\e\l Y');
            $fechaFinStr = $fechaFinObj->format('d \d\e F \d\e\l Y');

            $fechaSemanaStr = $fechaInicioStr . ' al ' . $fechaFinStr;

            $orders = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->where('pago', '>','0')
            ->orderBy('fecha','DESC')
            ->get();

            $totalPagado = $orders->sum('pago');
            $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

            $datos = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->with('OrdersTickets.CursosTickets')
            ->get()
            ->pluck('OrdersTickets')
            ->flatten()
            ->groupBy('CursosTickets.nombre')
            ->map(function ($tickets, $nombreCurso) {
                return [
                    'nombre' => $nombreCurso,
                    'total' => $tickets->count()
                ];
            })
            ->values();

        Mail::to($webpage->email_admin)
        ->bcc($webpage->email_admin_two, 'Destinatario dev 2')
        ->send(new ReporteTicketsCustom($datos,$totalPagadoFormateado,$fechaSemanaStr));

        return redirect()->back()->with('success', 'Webpage actualizada');
    }

}
