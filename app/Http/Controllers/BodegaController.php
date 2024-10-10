<?php

namespace App\Http\Controllers;

use App\Models\HistorialVendidos;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\ProductosNotasCosmica;
use App\Models\ProductosNotasId;
use App\Models\Products;
use Illuminate\Http\Request;

use Codexshaper\WooCommerce\Facades\WooCommerce;
use Automattic\WooCommerce\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class BodegaController extends Controller
{
    public function index_preparacion(Request $request) {
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
        $notas_presencial_preparado = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Preparado')->get();
        $notas_presencial_enviados = NotasProductos::where('tipo_nota', '=', 'Venta Presencial')->where('estatus_cotizacion', '=', 'Enviado')->get();

        $notas_cosmica_preparacion = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Aprobada')->where('fecha_preparacion', '!=', NULL)->get();
        $notas_cosmica_preparado = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Preparado')->get();
        $notas_cosmica_enviados = NotasProductosCosmica::where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', '=', 'Enviado')->get();

        // Pasar las órdenes y notas a la vista
        return view('admin.bodega.index', compact(
            'ApiFiltradaCollectAprobado',
            'ApiFiltradaCollectPreparado',
            'ApiFiltradaCollectEnviado',
            'orders_tienda_principal',
            'orders_tienda_principal_preparados',
            'orders_tienda_principal_enviados',
            'orders_tienda_cosmica',
            'orders_tienda_cosmica_preparados',
            'orders_tienda_cosmica_enviados',
            'notas_preparacion', 'notas_preparado', 'notas_enviados',
            'notas_cosmica_preparacion', 'notas_cosmica_preparado', 'notas_cosmica_enviados',
            'notas_presencial_preparacion', 'notas_presencial_preparado', 'notas_presencial_enviados'
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
                    'key' => $request->get('key'),
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
                return back()->with('success', 'El pedido ha sido actualizado en Paradisus correctamente y el stock ajustado.');
            } else {
                return back()->with('error', 'No se pudo actualizar el pedido en Paradisus.');
            }
        } else {
            return back()->with('error', 'No se pudo obtener los pedidos de la API de Paradisus.');
        }
    }

    public function preparacion_scaner(Request $request, $id){

        $nota_scaner = NotasProductos::where('id', '=', $id)->first();
        $productos_scaner = ProductosNotasId::where('id_notas_productos', '=', $id)->get();
        $allChecked = $productos_scaner->every(function ($producto) {
            return $producto->estatus === 1;
        });

        return view('admin.bodega.scaner.show', compact('nota_scaner', 'productos_scaner', 'allChecked'));
    }

    public function checkProduct(Request $request){
        $sku = $request->input('sku');
        $idNotaProducto = $request->input('id_notas_productos');

        // Busca el producto en la tabla `Products`
        $product = Products::where('sku', $sku)->first();

        if ($product) {
            // Verifica y actualiza el registro correcto en `productos_notas`
            $notaProducto = ProductosNotasId::where('id_notas_productos', $idNotaProducto)
                ->where('producto', $product->nombre)
                ->first();

            if ($notaProducto) {
                $notaProducto->estatus = 1;
                $notaProducto->save();
                return response()->json(['status' => 'success', 'message' => 'Producto encontrado y actualizado']);
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
        $sku = $request->input('sku');
        $idNotaProducto = $request->input('id_notas_productos');

        // Busca el producto en la tabla `Products`
        $product = Products::where('sku', $sku)->first();

        if ($product) {
            // Verifica y actualiza el registro correcto en `productos_notas`
            $notaProducto = ProductosNotasCosmica::where('id_notas_productos', $idNotaProducto)
                ->where('producto', $product->nombre)
                ->first();

            if ($notaProducto) {
                $notaProducto->estatus = 1;
                $notaProducto->save();
                return response()->json(['status' => 'success', 'message' => 'Producto encontrado y actualizado']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Producto no encontrado o no corresponde a la nota']);
    }
}
