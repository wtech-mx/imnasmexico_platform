<?php

namespace App\Http\Controllers;

use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use Illuminate\Http\Request;

use Codexshaper\WooCommerce\Facades\WooCommerce;
use Automattic\WooCommerce\Client;
use Carbon\Carbon;

class BodegaController extends Controller
{
    public function index_preparacion() {
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


        // Otras consultas de la base de datos
        $notas_preparacion = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_preparado = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();
        $notas_enviados = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Enviado')->get();

        $notas_cosmica_preparacion = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_cosmica_preparado = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();
        $notas_cosmica_enviados = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Enviado')->get();

        // Pasar las órdenes y notas a la vista
        return view('admin.bodega.index', compact(
            'orders_tienda_principal',
            'orders_tienda_principal_preparados',
            'orders_tienda_principal_enviados',
            'orders_tienda_cosmica',
            'orders_tienda_cosmica_preparados',
            'orders_tienda_cosmica_enviados',
            'notas_preparacion', 'notas_preparado', 'notas_enviados',
            'notas_cosmica_preparacion', 'notas_cosmica_preparado', 'notas_cosmica_enviados'
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
        }


        $updatedOrder = $woocommerceNas->put("orders/{$id}", [
            'status' => $request->get('status'),
        ]);

        $updatedOrderMeta = $woocommerceNas->put("orders/{$id}", [
            'meta_data' => [
                [
                    'key' => 'preparado_hora_y_guia',
                    'value' => date("Y-m-d H:i:s"), // Guardar el nombre del archivo
                ],
            ],
        ]);

        // Verificar si la actualización fue exitosa
        if ($updatedOrder) {
            return redirect()->back()->with('success', 'Estado de la orden y archivo actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el estado de la orden.');
        }


    }

}
