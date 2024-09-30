<?php

namespace App\Http\Controllers;

use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use Carbon\Carbon;
use Automattic\WooCommerce\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReporteVentasController extends Controller
{
    public function index(Request $request){
        $woocommerce = new Client(
            'https://imnasmexico.com/new/', // URL de la tienda principal
            'ck_9e19b038c973d3fdf0dcafe8c0352c78a16cad3f', // Consumer Key de la tienda principal
            'cs_762a289843cea2a92751f757f351d3522147997b', // Consumer Secret de la tienda principal
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        // Crear instancia del cliente Automattic\WooCommerce\Client para la tienda secundaria
        $woocommerceCosmika = new Client(
            'https://cosmicaskin.com', // URL de la tienda secundaria
            'ck_ad48c46c5cc1e9efd9b03e4a8cb981e52a149586', // Consumer Key de la tienda secundaria
            'cs_2e6ba2691ca30408d31173f1b8e61e5b67e4f3ff', // Consumer Secret de la tienda secundaria
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        $cot_nas = NotasProductos::orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion')
        ->whereBetween('fecha', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        $cot_cosmi = NotasProductosCosmica::orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion')
        ->whereBetween('fecha', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        $venta_nas = NotasProductos::orderBy('id','DESC')->where('tipo_nota', '=', 'Venta Presencial')
        ->whereBetween('fecha', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d\TH:i:s');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d\TH:i:s');

        // Hacer la solicitud para obtener solo los pedidos de esta semana
        $orders_nas = $woocommerce->get('orders', [
            'per_page' => 100,
            'after' => $startOfWeek,  // Fecha de inicio de la semana
            'before' => $endOfWeek,   // Fecha de fin de la semana
        ]);

        $orders_cosmi = $woocommerceCosmika->get('orders', [
            'per_page' => 100,
            'after' => $startOfWeek,  // Fecha de inicio de la semana
            'before' => $endOfWeek,   // Fecha de fin de la semana
        ]);


        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $api_pedidosParadisus = Http::get('https://paradisus.mx/api/enviar-notas-pedidos');

        }else{
            $api_pedidosParadisus = Http::get('http://paradisus.test/api/enviar-notas-pedidos');
        }

        // Convertir la respuesta a un array
        $ApiParadisusArray = $api_pedidosParadisus->json();

        // Filtrar los datos con estatus "Aprobada" y limitar a los últimos 100
        $ApiFiltradaCollectAprobado = collect($ApiParadisusArray['data'])
            ->whereBetween('fecha', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sortByDesc('id')
            ->values()
            ->all();

        return view('admin.reporte_ventas.index', compact('cot_nas', 'cot_cosmi', 'orders_nas', 'orders_cosmi', 'venta_nas', 'ApiFiltradaCollectAprobado'));
    }

    public function buscador(Request $request){

        $woocommerce = new Client(
            'https://imnasmexico.com/new/', // URL de la tienda principal
            'ck_9e19b038c973d3fdf0dcafe8c0352c78a16cad3f', // Consumer Key de la tienda principal
            'cs_762a289843cea2a92751f757f351d3522147997b', // Consumer Secret de la tienda principal
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        // Crear instancia del cliente Automattic\WooCommerce\Client para la tienda secundaria
        $woocommerceCosmika = new Client(
            'https://cosmicaskin.com', // URL de la tienda secundaria
            'ck_ad48c46c5cc1e9efd9b03e4a8cb981e52a149586', // Consumer Key de la tienda secundaria
            'cs_2e6ba2691ca30408d31173f1b8e61e5b67e4f3ff', // Consumer Secret de la tienda secundaria
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        $cot_nas = NotasProductos::orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion')
        ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])->get();

        $cot_cosmi = NotasProductosCosmica::orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion')
        ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])->get();

        $venta_nas = NotasProductos::orderBy('id','DESC')->where('tipo_nota', '=', 'Venta Presencial')
        ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])->get();

        $startOfWeek = Carbon::parse($request->fecha_inicio)->startOfDay()->format('Y-m-d\TH:i:s');
        $endOfWeek = Carbon::parse($request->fecha_fin)->endOfDay()->format('Y-m-d\TH:i:s');

        // Hacer la solicitud para obtener solo los pedidos de esta semana
        $orders_nas = $woocommerce->get('orders', [
            'per_page' => 100,
            'after' => $startOfWeek,  // Fecha de inicio de la semana
            'before' => $endOfWeek,   // Fecha de fin de la semana
        ]);

        $orders_cosmi = $woocommerceCosmika->get('orders', [
            'per_page' => 100,
            'after' => $startOfWeek,  // Fecha de inicio de la semana
            'before' => $endOfWeek,   // Fecha de fin de la semana
        ]);


        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $api_pedidosParadisus = Http::get('https://paradisus.mx/api/enviar-notas-pedidos');

        }else{
            $api_pedidosParadisus = Http::get('http://paradisus.test/api/enviar-notas-pedidos');
        }

        // Convertir la respuesta a un array
        $ApiParadisusArray = $api_pedidosParadisus->json();

        // Filtrar los datos con estatus "Aprobada" y limitar a los últimos 100
        $ApiFiltradaCollectAprobado = collect($ApiParadisusArray['data'])
            ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
            ->sortByDesc('id')
            ->values()
            ->all();

        return view('admin.reporte_ventas.index', compact('cot_nas', 'cot_cosmi', 'orders_nas', 'orders_cosmi', 'venta_nas', 'ApiFiltradaCollectAprobado'));
    }
}
