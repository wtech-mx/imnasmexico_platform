<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Carbon\Carbon;

class PedidosWooController extends Controller
{
    public function index(Request $request)
    {
        // Obtener las fechas de inicio y fin del mes actual
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

        // Traer las órdenes del mes actual utilizando las fechas como parámetros
        $orders = WooCommerce::all('orders', [
            'after' => $startOfMonth . 'T00:00:00',  // Inicio del mes
            'before' => $endOfMonth . 'T23:59:59',   // Fin del mes
            'per_page' => 100,                       // Limitar a 100 órdenes
        ]);



        // Retornar la vista con los pedidos
        return view('admin.notas_productos.index_woo', compact('orders'));
    }
}
