<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdersTickets;
use App\Models\Orders;
use Carbon\Carbon;

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

    public function index_semana(){
        $fechaActual = date('Y-m-d');
        $fechaInicioSemana = date('Y-m-d', strtotime('monday this week', strtotime($fechaActual)));
        $fechaFinSemana = date('Y-m-d', strtotime('sunday this week', strtotime($fechaActual)));

            $orders = Orders::where('fecha', [$fechaInicioSemana, $fechaFinSemana])
            ->where('estatus', '1')
            ->orderBy('id','DESC')
            ->get();

            $totalPagado = $orders->sum('pago');
            $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

            $cursosComprados = Orders::where('fecha', [$fechaInicioSemana, $fechaFinSemana])
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

        return view('admin.reportes.semana', compact('orders', 'totalPagadoFormateado', 'cursosComprados'));
    }

    public function index_mes(){
        $fechaActual = Carbon::now();
        // Obtenemos el primer día del mes actual
        $fechaInicioMes = $fechaActual->startOfMonth()->toDateString();
        // Obtenemos el último día del mes actual
        $fechaFinMes = $fechaActual->endOfMonth()->toDateString();

            $orders = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
            ->where('estatus', '1')
            ->orderBy('id','DESC')
            ->get();

            $totalPagado = $orders->sum('pago');
            $totalPagadoFormateado = number_format($totalPagado, 2, '.', ',');

            $cursosComprados = Orders::whereBetween('fecha', [$fechaInicioMes, $fechaFinMes])
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

        return view('admin.reportes.mes', compact('orders', 'totalPagadoFormateado', 'cursosComprados'));
    }
}
