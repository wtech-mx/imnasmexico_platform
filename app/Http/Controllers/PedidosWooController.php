<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Automattic\WooCommerce\Client;
use Carbon\Carbon;
use App\Models\Products;

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

                    // Obtener la orden desde WooCommerce
                    $order = WooCommerce::find("orders/$id");
                    // 2. Recorrer los productos en la orden (line_items)
                    foreach ($order->line_items as $item) {
                        $productName = trim($item->name); // Concepto es el nombre del producto, eliminamos espacios y tabuladores
                        $quantity = $item->quantity; // Cantidad vendida en WooCommerce

                        // 3. Buscar el producto en la tabla interna
                        $productoInterno = Products::where('nombre', $productName)->first();

                        if ($productoInterno) {
                            // 4. Realizar la resta del stock
                            $nuevoStock = $productoInterno->stock - $quantity;

                            // 5. Actualizar el stock en la base de datos
                            $productoInterno->update(['stock' => $nuevoStock]);
                        }
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

                    // Obtener la orden desde WooCommerce Cosmika
                    $orderCosmika = $woocommerceCosmika->get("orders/$id");
                    // Actualizar stock en Cosmika
                    foreach ($orderCosmika->line_items as $item) {
                        $productName = trim($item->name); // Concepto es el nombre del producto, eliminamos espacios y tabuladores
                        $quantity = $item->quantity; // Cantidad vendida en WooCommerce

                        // Buscar el producto en la tabla interna
                        $productoInterno = Products::where('nombre', $productName)->first();

                        if ($productoInterno) {
                            // Realizar la resta del stock
                            $nuevoStock = $productoInterno->stock - $quantity;

                            // Asegúrate de que el stock no sea negativo
                            $nuevoStock = max($nuevoStock, 0);

                            // Actualizar el stock en la base de datos
                            $productoInterno->update(['stock' => $nuevoStock]);
                        }
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

}
