<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrdersTickets;
use App\Models\Orders;
use App\Models\PagosFuera;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteTicketsVendidos;
use App\Mail\ReporteTicketsVendidosSemana;
use App\Mail\ReporteTicketsVendidosMes;
use App\Mail\ReporteTicketsCustom;
use Barryvdh\DomPDF\Facade\Pdf;

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

            $orders_mp = Orders::where('fecha', $fechaHoraActual)
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Mercado Pago')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_stripe = Orders::where('fecha', $fechaHoraActual)
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','STRIPE')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_nota = Orders::where('fecha', $fechaHoraActual)
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Nota')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_ext = Orders::where('fecha', $fechaHoraActual)
            ->where('estatus', '1')
            ->where('pago', '>','0')
            ->whereNotIn('forma_pago', ['Mercado Pago', 'STRIPE', 'Nota'])
            ->orderBy('fecha', 'DESC')
            ->get();

            $totalPagadoMP = 0;
            $totalPagadoST = 0;
            $totalPagadoExt = 0;
            $totalPagadoNota = 0;

            foreach ($orders_mp as $order_mp) {
                $totalPagadoMP += $order_mp->pago;
            }
            foreach ($orders_stripe as $order_stripe) {
                $totalPagadoST += $order_stripe->pago;
            }
            foreach ($orders_ext as $order_ext) {
                $totalPagadoExt += $order_ext->pago;
            }
            foreach ($orders_nota as $order_nota) {
                $totalPagadoNota += $order_nota->pago;
            }


        return view('admin.reportes.dia', compact('orders', 'totalPagadoFormateado', 'cursosComprados','totalPagadoMP','totalPagadoST','totalPagadoExt','totalPagadoNota'));
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

            $orders_mp = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Mercado Pago')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_stripe = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','STRIPE')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_nota = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Nota')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_ext = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Externo')
                ->orderBy('fecha','DESC')
            ->get();

            $totalPagadoMP = 0;
            $totalPagadoST = 0;
            $totalPagadoExt = 0;
            $totalPagadoNota = 0;

            foreach ($orders_mp as $order_mp) {
                $totalPagadoMP += $order_mp->pago;
            }
            foreach ($orders_stripe as $order_stripe) {
                $totalPagadoST += $order_stripe->pago;
            }
            foreach ($orders_ext as $order_ext) {
                $totalPagadoExt += $order_ext->pago;
            }
            foreach ($orders_nota as $order_nota) {
                $totalPagadoNota += $order_nota->pago;
            }

        return view('admin.reportes.semana', compact('orders', 'orders', 'cursosComprados','totalPagadoMP','totalPagadoST','totalPagadoExt','totalPagadoNota'));
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

            $orders_mp = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Mercado Pago')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_stripe = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','STRIPE')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_nota = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Nota')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_ext = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Externo')
                ->orderBy('fecha','DESC')
            ->get();

            $totalPagadoMP = 0;
            $totalPagadoST = 0;
            $totalPagadoExt = 0;
            $totalPagadoNota = 0;

            foreach ($orders_mp as $order_mp) {
                $totalPagadoMP += $order_mp->pago;
            }
            foreach ($orders_stripe as $order_stripe) {
                $totalPagadoST += $order_stripe->pago;
            }
            foreach ($orders_ext as $order_ext) {
                $totalPagadoExt += $order_ext->pago;
            }
            foreach ($orders_nota as $order_nota) {
                $totalPagadoNota += $order_nota->pago;
            }

        return view('admin.reportes.mes', compact('orders', 'totalPagadoFormateado', 'cursosComprados','totalPagadoMP','totalPagadoST','totalPagadoExt','totalPagadoNota'));
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

    public function index_cursos(request $request){

        $usuarios = User::where('cliente','=',NULL)->where('visibilidad','=',NULL)->orderby('name','asc')->get();

        return view('admin.reportes.cursos',compact('usuarios'));
    }


    public function store_calculando_custom(request $request){

        $fechaInicioSemana = $request->get('fecha_inicio');
        $fechaFinSemana = $request->get('fecha_fin');

            $orders = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_mp = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Mercado Pago')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_stripe = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','STRIPE')
                ->orderBy('fecha','DESC')
            ->get();

            $orders_ext = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->where('pago', '>','0')
            ->whereNotIn('forma_pago', ['Mercado Pago', 'STRIPE', 'Nota'])
            ->orderBy('fecha', 'DESC')
            ->get();


            $orders_nota = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
                ->where('estatus', '1')
                ->where('pago', '>','0')
                ->where('forma_pago', '=','Nota')
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
            $output4 = "";
            $output5 = "";
            $grafica = "";

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
                $totalPagadoMP = 0;
                $totalPagadoST = 0;
                $totalPagadoExt = 0;
                $totalPagadoNota = 0;

                foreach ($orders as $order) {
                    $totalPagado += $order->pago;
                }
                foreach ($orders_mp as $order_mp) {
                    $totalPagadoMP += $order_mp->pago;
                }
                foreach ($orders_stripe as $order_stripe) {
                    $totalPagadoST += $order_stripe->pago;
                }
                foreach ($orders_ext as $order_ext) {
                    $totalPagadoExt += $order_ext->pago;
                }
                foreach ($orders_nota as $order_nota) {
                    $totalPagadoNota += $order_nota->pago;
                }

                $totalPagadoFormatted = number_format($totalPagado, 2, '.', ',');
                $totalPagadoFormattedMP = number_format($totalPagadoMP, 2, '.', ',');
                $totalPagadoFormattedST = number_format($totalPagadoST, 2, '.', ',');
                $totalPagadoFormattedEX = number_format($totalPagadoExt, 2, '.', ',');
                $totalPagadoFormattedNota = number_format($totalPagadoNota, 2, '.', ',');

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
                    $grafica = '<div class="d-flex justify-content-evenly"><h6>MP:<div class="grafica_syle" style="background: #2152ff;">-</div></br>$'.$totalPagadoFormattedMP.'</h6><h6>Stripe:<div class="grafica_syle" style="background: #3A416F;">-</div></br>$'.$totalPagadoFormattedST.'</h6><h6>Externo:<div class="grafica_syle" style="background: #f53939;">-</div></br>$'.$totalPagadoFormattedEX.'</h6><h6>Notas:<div class="grafica_syle" style="background: #17c1e8;">-</div></br>$'.$totalPagadoFormattedNota.'</h6></div><div class="card-body p-3"><div class="chart"><canvas id="doughnut-chart" class="chart-canvas" height="300"></canvas></div></div>';
                    $script = '
                    <script>var ctx3 = document.getElementById("doughnut-chart").getContext("2d");

                    new Chart(ctx3, {
                      type: "doughnut",
                      data: {
                        labels: ["Mercado Pago", "Stipe", "Externo", "Nota"],
                        datasets: [{
                          label: "Projects",
                          weight: 9,
                          cutout: 60,
                          tension: 0.9,
                          pointRadius: 2,
                          borderWidth: 2,
                          backgroundColor: ["#2152ff", "#3A416F", "#f53939", "#17c1e8"],
                          data: ['.$totalPagadoMP.', '.$totalPagadoST.', '.$totalPagadoExt.', '.$totalPagadoNota.'],
                          fill: false
                        }],
                      },
                      options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                          legend: {
                            display: false,
                          }
                        },
                        interaction: {
                          intersect: false,
                          mode: "index",
                        },
                        scales: {
                          y: {
                            grid: {
                              drawBorder: false,
                              display: false,
                              drawOnChartArea: false,
                              drawTicks: false,
                            },
                            ticks: {
                              display: false
                            }
                          },
                          x: {
                            grid: {
                              drawBorder: false,
                              display: false,
                              drawOnChartArea: false,
                              drawTicks: false,
                            },
                            ticks: {
                              display: false,
                            }
                          },
                        },
                      },
                    });</script>';
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
                    'grafica' => $grafica,
                    'script' => $script,
                    'resultados' => $output,
                    'resultados2' => $output5
                ]);
        }
    }

    public function store_cursos_custom(Request $request)
    {
        $fechaInicioSemana = $request->get('fecha_inicio');
        $fechaFinSemana = $request->get('fecha_fin');
        $usuarioId = $request->get('usuario');
        $generarPdf = $request->get('generar_pdf');  // Obtener la opción de generar PDF

        $orders = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->where('pago', '>', '0')
            ->where('id_externo', '!=', '0') // Excluye registros con id_externo igual a 0
            ->where('id_externo', '!=', NULL) // Excluye registros con id_externo igual a NULL
            ->orderBy('fecha', 'DESC')
            ->get();

        // Obtener el id_externo relacionado con el usuario
        if ($usuarioId) {
            $pagosFuera = PagosFuera::where('usuario', $usuarioId)->get();
            $idsExternos = $pagosFuera->pluck('id')->toArray(); // Obtener los ids correspondientes
            // Filtrar las órdenes para que coincidan con los id_externo de pagos_fuera
            $orders = $orders->whereIn('id_externo', $idsExternos);
        }

        $orders_mp = $orders->where('forma_pago', 'Mercado Pago');
        $orders_stripe = $orders->where('forma_pago', 'STRIPE');
        $orders_ext = $orders->whereNotIn('forma_pago', ['Mercado Pago', 'STRIPE', 'Nota']);
        $orders_inbursa = $orders->where('forma_pago','transferencia inbursa');
        $orders_bbva = $orders->where('forma_pago','transferencia bancomer');
        $orders_Efectivo = $orders->where('forma_pago','Efectivo');
        $orders_Tarjeta = $orders->where('forma_pago','Tarjeta');
        $orders_oxxo_inbursa = $orders->where('forma_pago','oxxo inbursa');

        $orders_nota = $orders->where('forma_pago', 'Nota');

        $totalPagado = $orders->sum('pago');
        $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

        $cursosComprados = Orders::whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])
        ->where('estatus', '1')
        ->where('forma_pago', '!=', 'Clase Gratis')
        ->with('OrdersTickets.CursosTickets') // Mueve este método antes de get()
        ->get()
        ->pluck('OrdersTickets')
        ->flatten()
        ->groupBy('CursosTickets.nombre')
        ->map(function ($tickets, $nombreCurso) {
            return [
                'nombre' => $nombreCurso,
                'total' => $tickets->count(),
            ];
        })
        ->values();


        if ($request->ajax()) {
            $outputSummary = view('admin.reportes.total_summary', compact('totalPagadoFormateado', 'fechaInicioSemana', 'fechaFinSemana'))->render();
            $outputOrders = view('admin.reportes.orders_table', compact('orders'))->render();
            $outputCourses = view('admin.reportes.courses_table', compact('cursosComprados'))->render();

            // Si se solicita generar el PDF, lo hacemos aquí
            if ($generarPdf) {
                $grafica = $this->generateChart($orders_mp, $orders_stripe, $orders_ext, $orders_inbursa, $orders_bbva, $orders_Efectivo, $orders_nota, $orders_oxxo_inbursa, $orders_Tarjeta, $orders);
                $fechaGeneracion = now()->format('j M \\d\\e\\l Y \\a \\l\\a\\s H:i:s'); // Fecha y hora formateadas

                $pdf = \PDF::loadView('admin.reportes.reporte_pdf', [
                    'outputOrders' => $outputOrders,
                    'outputCourses' => $outputCourses,
                    'outputSummary' => $outputSummary,
                    'fechaInicioSemana' => $fechaInicioSemana,
                    'fechaFinSemana' => $fechaFinSemana,
                    'totalPagadoFormateado' => $totalPagadoFormateado,
                    'cursosComprados' => $cursosComprados,
                    'orders' => $orders,
                    'orders_mp' => $orders_mp,
                    'orders_stripe' => $orders_stripe,
                    'orders_ext' => $orders_ext,
                    'orders_inbursa' => $orders_inbursa,
                    'orders_bbva' => $orders_bbva,
                    'orders_Efectivo' => $orders_Efectivo,
                    'orders_nota' => $orders_nota,
                    'orders_oxxo_inbursa' => $orders_oxxo_inbursa,
                    'orders_Tarjeta' => $orders_Tarjeta,
                    'vendedor' => $usuarioId,
                    'grafica' => $grafica, // Pasamos el gráfico base64
                    'fechaGeneracion' => $fechaGeneracion // Pasa la fecha al PDF
                ]);

                // Generar contenido del PDF
                // $filePath = 'reportes/reporte_' . now()->format('Ymd_His') . '.pdf';
                // \Storage::disk('public')->put($filePath, $pdf->output()); // Usar `output()` en Barryvdh

                $filePath = public_path('reportes/reporte_' . now()->format('Ymd_His') . '.pdf');
                file_put_contents($filePath, $pdf->output());

                return response()->json([
                    'pdf_url' => \Storage::url($filePath) // URL del PDF generado
                ]);
            }


            return response()->json([
                'grafica' => $this->generateChart($orders_mp, $orders_stripe, $orders_ext,$orders_inbursa,$orders_bbva,$orders_Efectivo, $orders_nota,$orders_oxxo_inbursa,$orders_Tarjeta,$orders),
                'resultados' => $outputOrders,
                'outputSummary' => $outputSummary,
                'resultados3' => $outputCourses
            ]);
        }
    }


    private function generateChart($orders_mp, $orders_stripe, $orders_ext,$orders_inbursa,$orders_bbva,$orders_Efectivo, $orders_nota,$orders_oxxo_inbursa,$orders_Tarjeta)
    {
        $data = [
            'MP' => $orders_mp->sum('pago'),
            'Stripe' => $orders_stripe->sum('pago'),
            'TransInbursa' => $orders_inbursa->sum('pago'),
            'Trans BBVA' => $orders_bbva->sum('pago'),
            'Pago Efectivo' => $orders_Efectivo->sum('pago'),
            'Pago Tarjeta' => $orders_Tarjeta->sum('pago'),
            'OXXO Inbursa' => $orders_oxxo_inbursa->sum('pago'),
            'Nota' => $orders_nota->sum('pago'),
        ];

        $colors = ['#2152ff', '#3A416F', '#f53939', '#17c1e8', '#fb6340', '#5e72e4', '#2dce89', '#11cdef', '#fbb140'];

        return view('admin.reportes.chart', compact('data', 'colors'))->render();
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
