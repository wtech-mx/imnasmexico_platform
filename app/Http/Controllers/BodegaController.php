<?php

namespace App\Http\Controllers;

use App\Models\HistorialVendidos;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\OrderOnlineCosmica;
use App\Models\OrderOnlineNas;
use App\Models\ProductosNotasCosmica;
use App\Models\ProductosNotasId;
use App\Models\Products;
use Illuminate\Http\Request;

use Codexshaper\WooCommerce\Facades\WooCommerce;
use Automattic\WooCommerce\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;


class BodegaController extends Controller
{
    public function index_preparacion(Request $request) {
        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');
        // Crear instancia del cliente Automattic\WooCommerce\Client para la tienda principal
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

        // Obtener los pedidos de ambas tiendas con el estado "guia_cargada"
        $orders_tienda_principal = $woocommerce->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica = $woocommerceCosmika->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        // Convertir las órdenes en un solo array combinando las de ambas tiendas
        $orders_tienda_principal = array_merge($orders_tienda_principal);
        // dd($orders_tienda_principal);

        $orders_tienda_cosmica = array_merge($orders_tienda_cosmica);

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
            ->where('estatus', 'Aprobada')
            ->sortByDesc('id')
            ->values()
            ->all();

        // Otras consultas de la base de datos
        $notas_preparacion = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();

        $notas_presencial_preparacion = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Aprobada')->get();

        $notas_presencial_cancelada = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Cancelar')->get();
        $notas_presencial_enviados = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Enviado')
        ->whereBetween('fecha_aprobada', [$primerDiaDelMes, $ultimoDiaDelMes])->get();

        $notas_cosmica_preparacion = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();

        $cantidad_preparacion = count($notas_preparacion) + count($notas_presencial_preparacion) + count($notas_cosmica_preparacion) + count($ApiFiltradaCollectAprobado) + count($orders_tienda_principal) + count($orders_tienda_cosmica);
        // Pasar las órdenes y notas a la vista
        return view('admin.bodega.index', compact(
            'notas_presencial_preparacion',
            'notas_preparacion',
            'notas_cosmica_preparacion',
            'orders_tienda_principal',
            'orders_tienda_cosmica',
            'cantidad_preparacion',
            'ApiFiltradaCollectAprobado'));
    }

    public function generateOrderWooNasPDF($id)
    {
        // Crear instancia del cliente WooCommerce
        $woocommerce = new Client(
            'https://imnasmexico.com/new/',
            'ck_9e19b038c973d3fdf0dcafe8c0352c78a16cad3f',
            'cs_762a289843cea2a92751f757f351d3522147997b',
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        // Obtener el pedido por ID
        $order = $woocommerce->get("orders/{$id}");

        // Generar el PDF usando una vista
        $pdf = PDF::loadView('admin.bodega.pdf.woo_nas', compact('order'));

        // Descargar el archivo PDF
        return $pdf->download("Order_NAS_Woo_{$id}.pdf");
    }

    public function generateOrderWooCosmicaPDF($id)
    {
        // Crear instancia del cliente WooCommerce
        $woocommerce = new Client(
            'https://cosmicaskin.com', // URL de la tienda secundaria
            'ck_ad48c46c5cc1e9efd9b03e4a8cb981e52a149586', // Consumer Key de la tienda secundaria
            'cs_2e6ba2691ca30408d31173f1b8e61e5b67e4f3ff', // Consumer Secret de la tienda secundaria
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        // Obtener el pedido por ID
        $order = $woocommerce->get("orders/{$id}");

        // Generar el PDF usando una vista
        $pdf = PDF::loadView('admin.bodega.pdf.woo_cosmica', compact('order'));

        // Descargar el archivo PDF
        return $pdf->download("Order_Cosmica_Woo_{$id}.pdf");
    }

    public function index_preparados(Request $request) {
        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');
        // Crear instancia del cliente Automattic\WooCommerce\Client para la tienda principal
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

        // Obtener los pedidos de ambas tiendas con el estado "guia_cargada"
        $orders_tienda_principal = $woocommerce->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        $orders_tienda_principal_preparados = $woocommerce->get('orders', [
            'status' => 'preparados',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica = $woocommerceCosmika->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica_preparados = $woocommerceCosmika->get('orders', [
            'status' => 'preparados',
            'per_page' => 100,
        ]);

        // Convertir las órdenes en un solo array combinando las de ambas tiendas
        $orders_tienda_principal = array_merge($orders_tienda_principal);
        // dd($orders_tienda_principal);

        $orders_tienda_cosmica = array_merge($orders_tienda_cosmica);

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
            ->where('estatus', 'Aprobada')
            ->sortByDesc('id')
            ->values()
            ->all();

        $ApiFiltradaCollectPreparado = collect($ApiParadisusArray['data'])
            ->where('estatus', 'Preparado')
            ->sortByDesc('id')
            ->values()
            ->all();


        // Otras consultas de la base de datos
        $notas_preparacion = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_preparado = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();

        $notas_presencial_preparacion = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Aprobada')->get();
        $notas_presencial_preparado = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Preparado')
        // ->whereBetween('fecha_aprobada', [$primerDiaDelMes, $ultimoDiaDelMes])->get();
        ->get();

        $notas_cosmica_preparacion = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_cosmica_preparado = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();

        $cantidad_preparacion = count($notas_preparacion) + count($notas_presencial_preparacion) + count($notas_cosmica_preparacion) + count($ApiFiltradaCollectAprobado) + count($orders_tienda_principal) + count($orders_tienda_cosmica);
        // Pasar las órdenes y notas a la vista
        return view('admin.bodega.index_preparados', compact(
            'ApiFiltradaCollectPreparado',
            'orders_tienda_cosmica_preparados',
            'orders_tienda_principal_preparados',
            'notas_cosmica_preparado',
            'notas_preparado',
            'notas_presencial_preparado',
            'cantidad_preparacion'
        ));
    }

    public function index_enviados(Request $request) {
        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');
        // Crear instancia del cliente Automattic\WooCommerce\Client para la tienda principal
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

        // Obtener los pedidos de ambas tiendas con el estado "guia_cargada"
        $orders_tienda_principal = $woocommerce->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        $orders_tienda_principal_preparados = $woocommerce->get('orders', [
            'status' => 'preparados',
            'per_page' => 100,
        ]);

        $orders_tienda_principal_enviados = $woocommerce->get('orders', [
            'status' => 'enviados',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica = $woocommerceCosmika->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica_preparados = $woocommerceCosmika->get('orders', [
            'status' => 'preparados',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica_enviados = $woocommerceCosmika->get('orders', [
            'status' => 'enviados',
            'per_page' => 100,
        ]);

        // Convertir las órdenes en un solo array combinando las de ambas tiendas
        $orders_tienda_principal = array_merge($orders_tienda_principal);
        // dd($orders_tienda_principal);

        $orders_tienda_cosmica = array_merge($orders_tienda_cosmica);

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
            ->where('estatus', 'Aprobada')
            ->sortByDesc('id')
            ->values()
            ->all();

        $ApiFiltradaCollectPreparado = collect($ApiParadisusArray['data'])
            ->where('estatus', 'Preparado')
            ->sortByDesc('id')
            ->values()
            ->all();

        $ApiFiltradaCollectEnviado = collect($ApiParadisusArray['data'])
            ->where('estatus', 'Enviado')
            ->sortByDesc('id')
            ->values()
            ->all();

        // Otras consultas de la base de datos
        $notas_preparacion = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_preparado = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();
        $notas_enviados = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Enviado')->get();

        $notas_presencial_preparacion = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Aprobada')->get();
        $notas_presencial_preparado = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Preparado')
        // ->whereBetween('fecha_aprobada', [$primerDiaDelMes, $ultimoDiaDelMes])->get();
        ->get();
        $notas_presencial_cancelada = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Cancelar')->get();
        $notas_presencial_enviados = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Enviado')
        ->whereBetween('fecha_aprobada', [$primerDiaDelMes, $ultimoDiaDelMes])->get();

        $notas_cosmica_preparacion = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_cosmica_preparado = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();
        $notas_cosmica_enviados = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Enviado')->get();

        $cantidad_preparacion = count($notas_preparacion) + count($notas_presencial_preparacion) + count($notas_cosmica_preparacion) + count($ApiFiltradaCollectAprobado) + count($orders_tienda_principal) + count($orders_tienda_cosmica);
        // Pasar las órdenes y notas a la vista
        return view('admin.bodega.index_enviados', compact(
            'orders_tienda_cosmica_enviados',
            'orders_tienda_principal_enviados',
            'notas_cosmica_enviados',
            'notas_enviados',
            'cantidad_preparacion',
        ));
    }

    public function index_entregados(Request $request) {
        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');
        // Crear instancia del cliente Automattic\WooCommerce\Client para la tienda principal
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

        // Obtener los pedidos de ambas tiendas con el estado "guia_cargada"
        $orders_tienda_principal = $woocommerce->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        $orders_tienda_principal_preparados = $woocommerce->get('orders', [
            'status' => 'preparados',
            'per_page' => 100,
        ]);

        $orders_tienda_principal_enviados = $woocommerce->get('orders', [
            'status' => 'enviados',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica = $woocommerceCosmika->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica_preparados = $woocommerceCosmika->get('orders', [
            'status' => 'preparados',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica_enviados = $woocommerceCosmika->get('orders', [
            'status' => 'enviados',
            'per_page' => 100,
        ]);

        // Convertir las órdenes en un solo array combinando las de ambas tiendas
        $orders_tienda_principal = array_merge($orders_tienda_principal);
        // dd($orders_tienda_principal);

        $orders_tienda_cosmica = array_merge($orders_tienda_cosmica);

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
            ->where('estatus', 'Aprobada')
            ->sortByDesc('id')
            ->values()
            ->all();

        $ApiFiltradaCollectEnviado = collect($ApiParadisusArray['data'])
            ->where('estatus', 'Enviado')
            ->sortByDesc('id')
            ->values()
            ->all();

        // Otras consultas de la base de datos
        $notas_preparacion = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();

        $notas_presencial_preparacion = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Aprobada')->get();
        // ->whereBetween('fecha_aprobada', [$primerDiaDelMes, $ultimoDiaDelMes])->get();
        $notas_presencial_enviados = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Enviado')
        ->whereBetween('fecha_aprobada', [$primerDiaDelMes, $ultimoDiaDelMes])->get();

        $notas_cosmica_preparacion = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_cosmica_enviados = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Enviado')->get();

        $cantidad_preparacion = count($notas_preparacion) + count($notas_presencial_preparacion) + count($notas_cosmica_preparacion) + count($ApiFiltradaCollectAprobado) + count($orders_tienda_principal) + count($orders_tienda_cosmica);
        // Pasar las órdenes y notas a la vista
        return view('admin.bodega.index_entregados', compact(
            'notas_presencial_enviados',
            'ApiFiltradaCollectEnviado',
            'cantidad_preparacion'
        ));
    }

    public function index_canceladas(Request $request) {
        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');
        // Crear instancia del cliente Automattic\WooCommerce\Client para la tienda principal
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

        // Obtener los pedidos de ambas tiendas con el estado "guia_cargada"
        $orders_tienda_principal = $woocommerce->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        $orders_tienda_cosmica = $woocommerceCosmika->get('orders', [
            'status' => 'guia_cargada',
            'per_page' => 100,
        ]);

        // Convertir las órdenes en un solo array combinando las de ambas tiendas
        $orders_tienda_principal = array_merge($orders_tienda_principal);
        // dd($orders_tienda_principal);

        $orders_tienda_cosmica = array_merge($orders_tienda_cosmica);

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
            ->where('estatus', 'Aprobada')
            ->sortByDesc('id')
            ->values()
            ->all();

        // Otras consultas de la base de datos
        $notas_preparacion = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();

        $notas_presencial_preparacion = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Aprobada')->get();

        $notas_presencial_cancelada = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Cancelar')->get();

        $notas_cosmica_preparacion = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();

        $cantidad_preparacion = count($notas_preparacion) + count($notas_presencial_preparacion) + count($notas_cosmica_preparacion) + count($ApiFiltradaCollectAprobado) + count($orders_tienda_principal) + count($orders_tienda_cosmica);
        // Pasar las órdenes y notas a la vista
        return view('admin.bodega.index_cancelados', compact(
            'notas_presencial_cancelada',
            'cantidad_preparacion'
        ));
    }

    public function update_guia_woo(Request $request, $id)
    {

        $dominio =  $request->get('dominio');

        if($dominio == 'cosmicaskin.com'){

            // Crear instancia del cliente Automattic\WooCommerce\Client para la segunda tienda (Cosmika)
            $woocommerceNas = new Client(
                'https://cosmicaskin.com', // URL de la tienda secundaria
                'ck_ad48c46c5cc1e9efd9b03e4a8cb981e52a149586', // Consumer Key de la tienda secundaria
                'cs_2e6ba2691ca30408d31173f1b8e61e5b67e4f3ff', // Consumer Secret de la tienda secundaria
                [
                    'wp_api' => true,
                    'version' => 'wc/v3',
                ]
            );

            $order_online_cosmica = OrderOnlineCosmica::where('id_nota', $id)
            ->get();
        }else{
            // Crear instancia del cliente Automattic\WooCommerce\Client para la segunda tienda (Cosmika)
            $woocommerceNas = new Client(
                'https://imnasmexico.com/new', // URL de la tienda secundaria
                'ck_9e19b038c973d3fdf0dcafe8c0352c78a16cad3f', // Consumer Key de la tienda secundaria
                'cs_762a289843cea2a92751f757f351d3522147997b', // Consumer Secret de la tienda secundaria
                [
                    'wp_api' => true,
                    'version' => 'wc/v3',
                ]
            );

            $order_online_cosmica = OrderOnlineNas::where('id_nota', $id)
            ->get();
        }

        $updatedOrder = $woocommerceNas->put("orders/{$id}", [
            'status' => $request->get('status'),
        ]);

        // $updatedOrderMeta = $woocommerceNas->put("orders/{$id}", [
        //     'meta_data' => [
        //         [
        //             'key' => $request->get('key'),
        //             'value' => date("Y-m-d H:i:s"),
        //         ],
        //     ],
        // ]);

        // Verificar si la actualización fue exitosa
        if ($updatedOrder) {
            // Obtener la orden desde WooCommerce
            $order = $woocommerceNas->get("orders/$id");
            // 2. Recorrer los productos en la orden (line_items)
            foreach ($order_online_cosmica as $item) {
                $productName = trim($item->nombre); // Concepto es el nombre del producto, eliminamos espacios y tabuladores

                $quantity = $item->cantidad; // Cantidad vendida en WooCommerce

                // 3. Buscar el producto en la tabla interna
                $productoInterno = Products::where('nombre', $productName)->first();

                $producto_historial = new HistorialVendidos;
                $producto_historial->id_producto = $productoInterno->id;
                $producto_historial->stock_viejo = $productoInterno->stock;
                $producto_historial->cantidad_restado = $quantity;
                $producto_historial->stock_actual = $productoInterno->stock - $quantity;
                $producto_historial->id_nas_online = $id;
                $producto_historial->save();

                if ($productoInterno) {
                    // 4. Realizar la resta del stock
                    $nuevoStock = $productoInterno->stock - $quantity;
                    // 5. Actualizar el stock en la base de datos
                    $productoInterno->update(['stock' => $nuevoStock]);
                }
            }

            return redirect()->back()->with('success', 'Actuazlaido exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el estado de la orden.');
        }
    }

    public function actualizarPedidoParadisus(Request $request, $id)
    {
        // Obtener el dominio para seleccionar la URL adecuada
        $dominio = $request->getHost();

        // Obtener el pedido de la API de Paradisus
        if ($dominio == 'plataforma.imnasmexico.com') {
            $api_pedidosParadisus = Http::get('https://paradisus.mx/api/enviar-notas-pedidos');
        } else {
            $api_pedidosParadisus = Http::get('http://paradisus.test/api/enviar-notas-pedidos');
        }

        // Verificar si la respuesta es exitosa
        if ($api_pedidosParadisus->successful()) {
            $pedidos = $api_pedidosParadisus->json();

            // Buscar el pedido específico por ID
            $pedido = collect($pedidos['data'])->firstWhere('id', $id);

            if (!$pedido) {
                return back()->with('error', 'El pedido no fue encontrado en la API de Paradisus.');
            }

            // Verificar si el estado es "Preparado" para descontar el stock
            if ($request->input('estatus_cotizacion') == 'Preparado') {
                $datosActualizados = [
                    'estatus' => $request->input('estatus_cotizacion'),
                    'preparado_hora_y_guia' => date("Y-m-d H:i:s"), // Tomamos el nuevo estatus del form
                ];

                foreach ($pedido['pedidos'] as $campo) {
                    $productName = trim($campo['concepto']); // Concepto es el nombre del producto, eliminamos espacios y tabuladores
                    $quantity = $campo['cantidad'];
                    $product_first = Products::where('nombre', $productName)->first();
                    if ($product_first && $quantity > 0) {
                        $producto_historial = new HistorialVendidos;
                        $producto_historial->id_producto = $product_first->id;
                        $producto_historial->stock_viejo = $product_first->stock;
                        $producto_historial->cantidad_restado = $quantity;
                        $producto_historial->stock_actual = $product_first->stock - $quantity;
                        $producto_historial->id_paradisus = $id;
                        $producto_historial->save();

                        $product_first->stock -= $quantity;
                        $product_first->save();
                    } else {

                        return back()->with('error', "El producto '{$productName}' no se encontró en el inventario interno.");
                    }
                }

            } elseif ($request->input('estatus_cotizacion') == 'Enviado') {
                $datosActualizados = [
                    'estatus' => $request->input('estatus_cotizacion'),
                    'enviado_hora_y_guia' => date("Y-m-d H:i:s"), // Tomamos el nuevo estatus del form
                ];
            }

            // Actualizar el pedido en la API de Paradisus
            if ($dominio == 'plataforma.imnasmexico.com') {
                $respuesta = Http::patch('https://paradisus.mx/api/actualizar-notas-pedidos/' . $id, $datosActualizados);
            } else {
                $respuesta = Http::patch('http://paradisus.test/api/actualizar-notas-pedidos/' . $id, $datosActualizados);
            }

            // Manejar la respuesta de la API
            if ($respuesta->successful()) {
                return redirect()->route('index_preparacion.bodega')
                ->with('success', 'Creado exitosamente.');
            } else {
                return back()->with('error', 'No se pudo actualizar el pedido en Paradisus.');
            }
        } else {
            return back()->with('error', 'No se pudo obtener los pedidos de la API de Paradisus.');
        }
    }

    public function preparacion_scaner(Request $request, $id){

        $nota_scaner = NotasProductos::where('id', '=', $id)->first();
        $productos_scaner = ProductosNotasId::where('id_notas_productos', '=', $id)
        ->get()
        ->map(function ($producto) {
            $producto->escaneados = $producto->escaneados ?? 0; // Asegúrate de incluir el valor actual
            return $producto;
        });

        $allChecked = $productos_scaner->every(function ($producto) {
            return $producto->estatus === 1;
        });

        return view('admin.bodega.scaner.show', compact('nota_scaner', 'productos_scaner', 'allChecked'));
    }

    public function checkProduct(Request $request){

        $sku_scaner = $request->input('sku');
        $sku = trim($sku_scaner);
        $idNotaProducto = $request->input('id_notas_productos');

        // Busca el producto en la tabla `Products`
        $product = Products::where('sku', $sku)->first();

        if ($product) {
            // Verifica y actualiza el registro correcto en `productos_notas`
            $notaProducto = ProductosNotasId::where('id_notas_productos', $idNotaProducto)
            ->where('producto', $product->nombre)
            ->first();

            if ($notaProducto) {
                if ($notaProducto->escaneados < $notaProducto->cantidad) {
                    $notaProducto->escaneados = intval($notaProducto->escaneados) + 1; // Convierte escaneados a entero y suma 1
                    if (intval($notaProducto->escaneados) === intval($notaProducto->cantidad)) { // Convierte cantidad a entero para comparar
                        $notaProducto->estatus = 1; // Marca como completo
                    }
                        $notaProducto->save();
                    return response()->json(['status' => 'success', 'escaneados' => $notaProducto->escaneados]);
                } else {

                    return response()->json(['status' => 'error', 'message' => 'Cantidad ya alcanzada']);
                }
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado o no corresponde a la nota']);
    }

    public function preparacion_scaner_cosmica(Request $request, $id){

        $nota_scaner = NotasProductosCosmica::where('id', '=', $id)->first();
        $productos_scaner = ProductosNotasCosmica::where('id_notas_productos', '=', $id)->get();
        $allChecked = $productos_scaner->every(function ($producto) {
            return $producto->estatus === 1;
        });

        return view('admin.bodega.scaner.show_cosmica', compact('nota_scaner', 'productos_scaner', 'allChecked'));
    }

    public function checkProduct_cosmica(Request $request){
        $sku_scaner = $request->input('sku');
        $sku = trim($sku_scaner);
        $idNotaProducto = $request->input('id_notas_productos');

        // Busca el producto en la tabla `Products`
        $product = Products::where('sku', $sku)->first();

        if ($product) {
            // Verifica y actualiza el registro correcto en `productos_notas`
            $notaProducto = ProductosNotasCosmica::where('id_notas_productos', $idNotaProducto)
                ->where('producto', $product->nombre)
                ->first();

            if ($notaProducto) {
                if ($notaProducto->escaneados < $notaProducto->cantidad) {
                    $notaProducto->escaneados = intval($notaProducto->escaneados) + 1; // Convierte escaneados a entero y suma 1
                    if (intval($notaProducto->escaneados) === intval($notaProducto->cantidad)) { // Convierte cantidad a entero para comparar
                        $notaProducto->estatus = 1; // Marca como completo
                    }
                        $notaProducto->save();
                    return response()->json(['status' => 'success', 'escaneados' => $notaProducto->escaneados]);
                } else {

                    return response()->json(['status' => 'error', 'message' => 'Cantidad ya alcanzada']);
                }
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado o no corresponde a la nota']);
    }

    public function preparacion_scaner_paradisus(Request $request, $id){
        $dominio = $request->getHost();

        // Llama a la API para obtener los pedidos
        if ($dominio == 'plataforma.imnasmexico.com') {
            $api_pedidosParadisus = Http::get('https://paradisus.mx/api/enviar-notas-pedidos');
        } else {
            $api_pedidosParadisus = Http::get('http://paradisus.test/api/enviar-notas-pedidos');
        }

        // Convertir la respuesta a un array
        $ApiParadisusArray = $api_pedidosParadisus->json();

        // Filtrar la nota por ID
        $ApiFiltradaCollectAprobado = collect($ApiParadisusArray['data'])->where('id', $id)->first();

        // Obtener los productos (pedidos) de la nota
        $productos_scaner = $ApiFiltradaCollectAprobado['pedidos'] ?? [];

        // Verificar si todos los productos tienen el estatus correcto
        $allChecked = collect($productos_scaner)->every(function ($producto) {
            return $producto['estatus'] == 1;
        });

        return view('admin.bodega.scaner.show_paradisus', compact('ApiFiltradaCollectAprobado', 'productos_scaner', 'allChecked'));
    }

    public function checkProduct_paradisus(Request $request)
    {
        $sku = $request->input('sku');
        $idNota = $request->input('id_nota');

        // Aquí deberías recorrer los productos de la nota que ya obtuviste en el método anterior
        $dominio = $request->getHost();
        $api_pedidosParadisus = $dominio == 'plataforma.imnasmexico.com'
            ? Http::get('https://paradisus.mx/api/enviar-notas-pedidos')
            : Http::get('http://paradisus.test/api/enviar-notas-pedidos');

        // Convertir la respuesta a un array
        $ApiParadisusArray = $api_pedidosParadisus->json();

        // Buscar la nota y los productos
        $ApiFiltradaCollectAprobado = collect($ApiParadisusArray['data'])->where('id', $idNota)->first();

        if ($ApiFiltradaCollectAprobado) {

            // Obtener el producto dentro de la nota usando el SKU
            $product = Products::where('sku', $sku)->first();
            $producto = collect($ApiFiltradaCollectAprobado['pedidos'])->where('concepto', $product->nombre)->first();
            $producto_id = $producto['id'];
            if ($producto) {

                if ($dominio == 'plataforma.imnasmexico.com') {
                    $respuesta = Http::patch('https://paradisus.mx/api/actualizar-producto/' . $producto_id);
                } else {
                    $respuesta = Http::patch('http://paradisus.test/api/actualizar-producto/' . $producto_id);
                }

                if ($respuesta->successful()) {
                    return response()->json(['status' => 'success', 'message' => 'Producto escaneado'], 200);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Producto no encontrado en la nota'], 404);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'Producto no encontrado en la nota'], 404);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado o no corresponde a la nota']);
    }

    public function preparacion_scaner_nas(Request $request, $id)
    {
        $woocommerce = new Client(
            'https://imnasmexico.com/new/', // URL de la tienda principal
            'ck_9e19b038c973d3fdf0dcafe8c0352c78a16cad3f', // Consumer Key de la tienda principal
            'cs_762a289843cea2a92751f757f351d3522147997b', // Consumer Secret de la tienda principal
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        // Obtener un pedido específico usando el ID
        $order = $woocommerce->get('orders/' . $id);

        $order_online_nas = OrderOnlineNas::where('id_nota', $id)->get();

        return view('admin.bodega.scaner.show_nas', compact('order', 'order_online_nas'));
    }

    public function checkProduct_nas(Request $request)
    {

        $sku_scaner = $request->input('sku');
        $sku = trim($sku_scaner);
        $idNotaProducto = $request->input('id_nota');

        // Busca el producto en la tabla `Products`
        $product = Products::where('sku', $sku)->first();

        if ($product) {
            // Verifica y actualiza el registro correcto en `productos_notas`
            $notaProducto = OrderOnlineNas::where('id_nota', $idNotaProducto)
                ->where('nombre', $product->nombre)
                ->first();

            if ($notaProducto) {
                if ($notaProducto->escaneados < $notaProducto->cantidad) {
                    $notaProducto->escaneados = intval($notaProducto->escaneados) + 1; // Convierte escaneados a entero y suma 1
                    if (intval($notaProducto->escaneados) === intval($notaProducto->cantidad)) { // Convierte cantidad a entero para comparar
                        $notaProducto->estatus = 1; // Marca como completo
                    }
                        $notaProducto->save();
                    return response()->json(['status' => 'success', 'escaneados' => $notaProducto->escaneados]);
                } else {

                    return response()->json(['status' => 'error', 'message' => 'Cantidad ya alcanzada']);
                }
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado o no corresponde a la nota']);
    }

    public function preparacion_scaner_online_cosmica(Request $request, $id)
    {
        $woocommerceCosmika = new Client(
            'https://cosmicaskin.com',
            'ck_ad48c46c5cc1e9efd9b03e4a8cb981e52a149586',
            'cs_2e6ba2691ca30408d31173f1b8e61e5b67e4f3ff',
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        $order = $woocommerceCosmika->get('orders/' . $id);

        $order_online_cosmica = OrderOnlineCosmica::where('id_nota', $id)
            ->get()
            ->each(function ($item) {
                $item->nombre = trim($item->nombre);
            });

        return view('admin.bodega.scaner.show_online_cosmica', compact('order', 'order_online_cosmica'));
    }

    public function checkProduct_online_cosmica(Request $request)
    {

        $sku_scaner = $request->input('sku');
        $sku = trim($sku_scaner);
        $idNotaProducto = $request->input('id_nota');

        // Busca el producto en la tabla `Products`
        $product = Products::where('sku', $sku)->first();

        if ($product) {
            // Verifica y actualiza el registro correcto en `productos_notas`
            $notaProducto = OrderOnlineCosmica::where('id_nota', $idNotaProducto)
                ->where('nombre', $product->nombre)
                ->first();

            if ($notaProducto) {
                if ($notaProducto->escaneados < $notaProducto->cantidad) {
                    $notaProducto->escaneados = intval($notaProducto->escaneados) + 1; // Convierte escaneados a entero y suma 1
                    if (intval($notaProducto->escaneados) === intval($notaProducto->cantidad)) { // Convierte cantidad a entero para comparar
                        $notaProducto->estatus = 1; // Marca como completo
                    }
                        $notaProducto->save();
                    return response()->json(['status' => 'success', 'escaneados' => $notaProducto->escaneados]);
                } else {

                    return response()->json(['status' => 'error', 'message' => 'Cantidad ya alcanzada']);
                }
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado o no corresponde a la nota']);
    }
}
