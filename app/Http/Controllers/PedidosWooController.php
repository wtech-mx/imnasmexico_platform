<?php

namespace App\Http\Controllers;

use App\Models\HistorialVendidos;
use App\Models\OrderOnlineCosmica;
use App\Models\OrderOnlineNas;
use App\Models\OrdersCosmica;
use App\Models\OrdersCosmicaOnline;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Automattic\WooCommerce\Client;
use Carbon\Carbon;
use App\Models\Products;
use Session;

class PedidosWooController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si se han pasado fechas en el request
        $startDate = $request->input('start_date') ?: Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->input('end_date') ?: Carbon::now()->endOfMonth()->format('Y-m-d');

        // Formatear las fechas para la consulta en WooCommerce
        $startDateTime = $startDate . 'T00:00:00';  // Agregar hora inicial
        $endDateTime = $endDate . 'T23:59:59';      // Agregar hora final

        // Obtener los pedidos de WooCommerce en el rango de fechas
        $orders = WooCommerce::all('orders', [
            'after' => $startDateTime,
            'before' => $endDateTime,
            'per_page' => 100,  // Limitar a 100 órdenes
        ]);

        // Retornar la vista con los pedidos
        return view('admin.notas_productos.index_woo', compact('orders'));
    }

    public function index_cosmika(Request $request)
    {
        // Obtener las fechas de inicio y fin del mes actual o las fechas seleccionadas en el formulario
        $startDate = $request->input('start_date') ?: Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->input('end_date') ?: Carbon::now()->endOfMonth()->format('Y-m-d');

        // Formatear las fechas para la consulta
        $startDateTime = $startDate . 'T00:00:00';
        $endDateTime = $endDate . 'T23:59:59';

        // Crear instancia del cliente Automattic\WooCommerce\Client para la segunda tienda
        $woocommerceCosmika = new Client(
            'https://cosmicaskin.com', // URL de la tienda secundaria
            'ck_ad48c46c5cc1e9efd9b03e4a8cb981e52a149586', // Consumer Key de la tienda secundaria
            'cs_2e6ba2691ca30408d31173f1b8e61e5b67e4f3ff', // Consumer Secret de la tienda secundaria
            [
                'wp_api' => true,
                'version' => 'wc/v3',
            ]
        );

        // Obtener pedidos de la segunda tienda
        $orders = $woocommerceCosmika->get('orders', [
            'after' => $startDateTime,
            'before' => $endDateTime,
            'per_page' => 100,
        ]);


        // Retornar la vista con los pedidos de la segunda tienda
        return view('admin.cotizacion_cosmica.index_woo', compact('orders'));
    }

    public function updateStatuWoo(Request $request, $id)
    {
        // Validar el nuevo estado y el archivo
        $request->validate([
            'status' => 'required|string',
            'guia_de_envio' => 'nullable|file', // Validar si se carga el archivo
        ]);

        // Actualizar el estado de la orden en WooCommerce
        $updatedOrder = WooCommerce::update('orders/' . $id, [
            'status' => $request->status,
        ]);

        // Verificar si se seleccionó el estado "guia_cargada" y si se subió un archivo
            // Definir la ruta para guardar el archivo
            $dominio = $request->getHost();
            if ($dominio == 'plataforma.imnasmexico.com') {
                $ruta_guia = base_path('../public_html/plataforma.imnasmexico.com/guias');
            } else {
                $ruta_guia = public_path() . '/guias';
            }

            $fecha_y_hora_guia = date("Y-m-d H:i:s");

            if ($request->hasFile("guia_de_envio")) {
                // Guardar el archivo con un nombre único
                $file = $request->file('guia_de_envio');
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move($ruta_guia, $fileName);

                // Ruta completa del archivo guardado
                $filePath = $ruta_guia . '/' . $fileName;


                // Actualizar la meta información en WooCommerce para el campo 'guia_de_envio'
                $updatedOrderMeta = WooCommerce::update('orders/' . $id, [
                    'meta_data' => [
                        [
                            'key' => 'guia_de_envio',
                            'value' => $fileName, // Guardar la ruta completa del archivo en WooCommerce
                        ],
                        [
                            'key' => 'fecha_y_hora_guia',
                            'value' => $fecha_y_hora_guia, // Guardar la ruta completa del archivo en WooCommerce
                        ],
                    ],
                ]);

                $order = WooCommerce::find("orders/$id");
                foreach ($order->line_items as $item) {
                    $order_online_nas = new OrderOnlineNas;
                    $order_online_nas->id_nota = $id;
                    $order_online_nas->nombre = $item->name;
                    $order_online_nas->cantidad = $item->quantity;
                    $order_online_nas->save();
                }
            }else{
                // Actualizar la meta información en WooCommerce para el campo 'guia_de_envio'
                $updatedOrderMeta = WooCommerce::update('orders/' . $id, [
                    'meta_data' => [
                        [
                            'key' => 'fecha_y_hora_guia',
                            'value' => $fecha_y_hora_guia, // Guardar la ruta completa del archivo en WooCommerce
                        ],
                    ],
                ]);
            }


        // Verificar si la actualización fue exitosa
        if ($updatedOrder) {
            return redirect()->back()->with('success', 'Estado de la orden y archivo actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el estado de la orden.');
        }
    }

    public function updateStatuWooCosmika(Request $request, $id)
    {
        // Validar el nuevo estado y el archivo
        $request->validate([
            'status' => 'required|string',
            'guia_de_envio' => 'nullable|file', // Validar si se carga el archivo
        ]);

        $fecha_y_hora_guia = date("Y-m-d H:i:s");

                // Crear instancia del cliente Automattic\WooCommerce\Client para la segunda tienda (Cosmika)
                $woocommerceCosmika = new Client(
                    'https://cosmicaskin.com', // URL de la tienda secundaria
                    'ck_ad48c46c5cc1e9efd9b03e4a8cb981e52a149586', // Consumer Key de la tienda secundaria
                    'cs_2e6ba2691ca30408d31173f1b8e61e5b67e4f3ff', // Consumer Secret de la tienda secundaria
                    [
                        'wp_api' => true,
                        'version' => 'wc/v3',
                    ]
                );

                $updatedOrder = $woocommerceCosmika->put("orders/{$id}", [
                    'status' => $request->status,
                ]);

                // Definir la ruta para guardar el archivo
                $dominio = $request->getHost();
                $ruta_guia = ($dominio == 'plataforma.imnasmexico.com')
                    ? base_path('../public_html/plataforma.imnasmexico.com/guias')
                    : public_path() . '/guias';

                $fecha_y_hora_guia = date("Y-m-d H:i:s");

                if ($request->hasFile("guia_de_envio")) {
                    // Guardar el archivo con un nombre único
                    $file = $request->file('guia_de_envio');
                    $fileName = uniqid() . '_' . $file->getClientOriginalName();
                    $file->move($ruta_guia, $fileName);

                    // Actualizar la meta información en WooCommerce para el campo 'guia_de_envio'
                    $updatedOrderMeta = $woocommerceCosmika->put("orders/{$id}", [
                        'meta_data' => [
                            [
                                'key' => 'guia_de_envio',
                                'value' => $fileName, // Guardar el nombre del archivo
                            ],
                            [
                                'key' => 'fecha_y_hora_guia',
                                'value' => $fecha_y_hora_guia, // Guardar la ruta completa del archivo en WooCommerce
                            ],
                        ],
                    ]);
                    $order = $woocommerceCosmika->get("orders/$id");
                    foreach ($order->line_items as $item) {
                        $order_online_nas = new OrderOnlineCosmica;
                        $order_online_nas->id_nota = $id;
                        $order_online_nas->nombre = $item->name;
                        $order_online_nas->cantidad = $item->quantity;
                        $order_online_nas->save();
                    }
                }else{
                    // Actualizar la meta información en WooCommerce para el campo 'guia_de_envio'
                    $updatedOrderMeta = $woocommerceCosmika->put("orders/{$id}", [
                        'meta_data' => [
                            [
                                'key' => 'fecha_y_hora_guia',
                                'value' => $fecha_y_hora_guia, // Guardar la ruta completa del archivo en WooCommerce
                            ],
                        ],
                    ]);
                }

            // Verificar si la actualización fue exitosa
            if ($updatedOrder) {
                return redirect()->back()->with('success', 'Estado de la orden y archivo actualizado correctamente.');
            } else {
                return redirect()->back()->with('error', 'Hubo un problema al actualizar el estado de la orden.');
            }
    }

    public function index_cosmika_ecommerce_apro(Request $request)
    {
        // $startDate = $request->input('start_date') ?: Carbon::now()->startOfMonth()->format('Y-m-d');
        // $endDate = $request->input('end_date') ?: Carbon::now()->endOfMonth()->format('Y-m-d');

        // $startDateTime = $startDate . 'T00:00:00';
        // $endDateTime = $endDate . 'T23:59:59';

        $notas = OrdersCosmica::orderBy('id','DESC')->where('estatus','=' , '1')->get();

        return view('admin.cosmica_ecommerce.index', compact('notas'));
    }

    public function index_cosmika_ecommerce_pen(Request $request)
    {
        $startDate = $request->input('start_date') ?: Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->input('end_date') ?: Carbon::now()->endOfMonth()->format('Y-m-d');

        $startDateTime = $startDate . 'T00:00:00';
        $endDateTime = $endDate . 'T23:59:59';

        $notas = OrdersCosmica::orderBy('id','DESC')->where('estatus','=' , '0')->get();

        return view('admin.cosmica_ecommerce.index', compact('notas'));
    }

    public function index_cosmika_ecommerce_preparacion(Request $request)
    {
        $startDate = $request->input('start_date') ?: Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->input('end_date') ?: Carbon::now()->endOfMonth()->format('Y-m-d');

        $startDateTime = $startDate . 'T00:00:00';
        $endDateTime = $endDate . 'T23:59:59';

        $notas = OrdersCosmica::orderBy('id','DESC')->where('estatus_bodega','=' , 'En preparacion')->get();

        return view('admin.cosmica_ecommerce.index', compact('notas'));
    }


    public function update_guia_ecommerce(Request $request, $id){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera/');
        }else{
            $pago_fuera = public_path() . '/pago_fuera/';
        }

        $nota = OrdersCosmica::findOrFail($id);
        $nota->fecha_preparacion  = date("Y-m-d H:i:s");
        $nota->estatus_bodega  = 'En preparacion';
        if ($request->hasFile("doc_guia")) {
            $file = $request->file('doc_guia');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->guia_doc = $fileName;
        }
        $nota->save();

        return redirect()->back()->with('success', 'Se ha actualizada');

    }

    public function imprimir_cosmica($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = OrdersCosmica::find($id);

        $nota_productos = OrdersCosmicaOnline::where('id_order', $nota->id)->get();


        $pdf = \PDF::loadView('admin.cosmica_ecommerce.pdf_nota', compact('nota', 'today', 'nota_productos'));

        return $pdf->stream();
    }

    public function preparacion_scaner(Request $request, $id){

        $nota_scaner = OrdersCosmica::where('id', '=', $id)->first();
        $productos_scaner = OrdersCosmicaOnline::where('id_order', '=', $id)
        ->get()
        ->map(function ($producto) {
            $producto->escaneados = $producto->escaneados ?? 0; // Asegúrate de incluir el valor actual
            return $producto;
        });

        $allChecked = $productos_scaner->every(function ($producto) {
            return $producto->estatus === 1;
        });

        return view('admin.bodega.scaner.show_cosmica_ecome', compact('nota_scaner', 'productos_scaner', 'allChecked'));
    }

    public function update_estatus(Request $request, $id){
        $nota = OrdersCosmica::findOrFail($id);
        $nota->estatus_bodega  = $request->get('estatus_cotizacion');

            if($request->get('estatus_bodega') == 'Preparado'){
                $nota->fecha_preparado  = date("Y-m-d H:i:s");
                $producto_pedido = OrdersCosmicaOnline::where('id_order', $id)->get();

                foreach ($producto_pedido as $campo) {
                    $product_first = Products::where('id', $campo->id_producto)->where('categoria', '!=', 'Ocultar')->first();
                    if ($product_first && $campo->cantidad > 0) {
                        $producto_historial = new HistorialVendidos;
                        $producto_historial->id_producto = $product_first->id;
                        $producto_historial->stock_viejo = $product_first->stock;
                        $producto_historial->cantidad_restado = $campo->cantidad;
                        $producto_historial->stock_actual = $product_first->stock - $campo->cantidad;
                        $producto_historial->id_cosmica_online = $id;
                        $producto_historial->save();

                        $product_first->stock -= $campo->cantidad;
                        $product_first->save();
                    }
                }
            }else if($request->get('estatus_cotizacion') == 'Enviado'){
                $nota->fecha_envio  = date("Y-m-d H:i:s");
                $nota->fecha_aprobada  = date("Y-m-d");
                $producto_pedido = OrdersCosmicaOnline::where('id_notas_productos', $id)->get();
                foreach ($producto_pedido as $campo) {
                    $product_first = Products::where('id', $campo->id_producto)->where('categoria', '!=', 'Ocultar')->first();
                    if ($product_first && $campo->cantidad > 0) {
                        $producto_historial = new HistorialVendidos;
                        $producto_historial->id_producto = $product_first->id;
                        $producto_historial->stock_viejo = $product_first->stock;
                        $producto_historial->cantidad_restado = $campo->cantidad;
                        $producto_historial->stock_actual = $product_first->stock - $campo->cantidad;
                        $producto_historial->id_venta_nas = $id;
                        $producto_historial->save();

                        $product_first->stock -= $campo->cantidad;
                        $product_first->save();
                    }
                }
            }

        $nota->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('index_preparacion.bodega')
        ->with('success', 'Creado exitosamente.');
    }

    public function checkProduct(Request $request){

        $sku_scaner = $request->input('sku');
        $sku = trim($sku_scaner);
        $idNotaProducto = $request->input('id_notas_productos');

        // Busca el producto en la tabla `Products`
        $product = Products::where('sku', $sku)->first();

        if ($product) {
            // Verifica y actualiza el registro correcto en `productos_notas`
            $notaProducto = OrdersCosmicaOnline::where('id_order', $idNotaProducto)
            ->where('id_producto', $product->id)
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
