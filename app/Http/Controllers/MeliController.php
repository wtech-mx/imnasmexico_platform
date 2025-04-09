<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Meli;
use App\Models\NotasProductosCosmica;
use App\Models\ProductosNotasCosmica;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class MeliController extends Controller
{

    private $accessToken;
    private $sellerId;

    public function __construct()
    {
        // Obtener los datos dinámicos del modelo
        $meliData = Meli::first(); // Asumiendo que siempre hay un registro
        if ($meliData) {
            $this->accessToken = $meliData->autorizacion ?? 'APP_USR-4791982421745244-120619-6e5686be00416a46416e810056b082a8-2084225921'; // Proporciona un valor predeterminado si es nulo
            $this->sellerId = $meliData->sellerId ?? '2084225921';
        } else {
            // Opcional: manejar el caso donde no exista un registro
            abort(500, 'No se encontraron datos de configuración en la tabla Meli.');
        }
    }

    public function refreshToken()
    {
        // Obtener los datos necesarios de la base de datos
        $meliData = Meli::first();

        if (!$meliData) {
            return response()->json(['message' => 'Configuración de Mercado Libre no encontrada'], 404);
        }

        // URL y parámetros para la solicitud
        $url = 'https://api.mercadolibre.com/oauth/token';
        // $params = [
        //     'grant_type'    => 'refresh_token',
        //     'client_id'     => '4791982421745244',
        //     'client_secret' => 'QDjLYIwGbfAYnq6kgJeVO93pYTRyMuP8',
        //     'refresh_token' => 'TG-673553c6e63ca60001ff0d79-2084225921', // Token actual para renovarlo
        // ];

        $params = [
            'grant_type'    => 'refresh_token',
            'client_id'     => $meliData->app_id,
            'client_secret' => $meliData->client_secret,
            'refresh_token' => $meliData->accesstoken, // Token actual para renovarlo
        ];

        // Hacer la solicitud a la API
        $response = Http::asForm()->post($url, $params);

        if ($response->successful()) {
            $data = $response->json();

            // Guardar el nuevo token en la base de datos
            $meliData->update([
                'autorizacion' => $data['access_token'],
                'accesstoken' => $data['refresh_token'],
            ]);

            return response()->json([
                'message' => 'Token actualizado exitosamente',
                'autorizacion' => $data['access_token'],
                'access_token' => $data['refresh_token'],
            ]);
        }

        return response()->json([
            'message' => 'Error al actualizar el token',
            'details' => $response->json(),
        ], $response->status());
    }

    public function index_token(){
        return view('admin.meli.token');
     }

     public function updateToken(Request $request){
         // Validar el campo recibido
         $request->validate([
             'accesstoken' => 'required|string',
         ]);

         // Buscar el primer registro (o ajustar según tus necesidades)
         $meli = Meli::first();

         if ($meli) {
             // Actualizar el campo 'accesstoken'
             $meli->update([
                 'accesstoken' => $request->input('accesstoken'),
             ]);

             return redirect()->back()->with('success', 'Access Token actualizado correctamente.');
         }

         return redirect()->back()->with('error', 'No se encontró ningún registro para actualizar.');
     }

     private function groupOrdersByPackId(array $orders): array{
         $groupedOrders = [];

         foreach ($orders as $order) {
             $packId = $order['pack_id'] ?? null;
             $orderId = $order['order_id'];
             $shippingId = $order['shipping_id'] ?? null;

             if ($packId) {
                 // Agrupar por pack_id y asegurarnos de usar datos consistentes
                 if (!isset($groupedOrders[$packId])) {
                     $groupedOrders[$packId] = [
                         'pack_id'     => $packId,
                         'order_id'    => $orderId,    // Usamos el order_id del primer registro
                         'shipping_id' => $shippingId, // Usamos el shipping_id del primer registro
                         'orders'      => [],
                     ];
                 }
                 $groupedOrders[$packId]['orders'][] = $order;
             } else {
                 // Si no tiene pack_id, agrupar por order_id
                 if (!isset($groupedOrders[$orderId])) {
                     $groupedOrders[$orderId] = [
                         'pack_id'     => null,
                         'order_id'    => $orderId,
                         'shipping_id' => $shippingId,
                         'orders'      => [],
                     ];
                 }
                 $groupedOrders[$orderId]['orders'][] = $order;
             }
         }

         return array_values($groupedOrders);
     }

     private function getShipmentDetails($shippingId)
     {
         $endpoint = "https://api.mercadolibre.com/shipments/{$shippingId}";

         $response = Http::withHeaders([
             'Authorization' => "Bearer {$this->accessToken}",
         ])->get($endpoint);

         if ($response->successful()) {
             $shipmentDetails = $response->json();

             return [
                 'date_created' => Carbon::parse($shipmentDetails['date_created'])->format('d M Y H:i:s'),
                 'status' => $shipmentDetails['status'],
                 'substatus' => $shipmentDetails['substatus'] ?? null,
                 'buffering_date' => isset($shipmentDetails['shipping_option']['buffering']['date']) ? Carbon::parse($shipmentDetails['shipping_option']['buffering']['date'])->format('d M Y') : null,
                 'estimated_delivery_final' => isset($shipmentDetails['shipping_option']['estimated_delivery_final']['date']) ? Carbon::parse($shipmentDetails['shipping_option']['estimated_delivery_final']['date'])->format('d M Y') : null,
             ];
         }

         return null; // Devuelve null si no es exitoso o no hay datos
     }

     private function getItemDetails($itemId){
        $endpoint = "https://api.mercadolibre.com/items/{$itemId}";

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->accessToken}",
        ])->get($endpoint);

        if ($response->successful()) {
            $itemData = $response->json();
            return [
                'thumbnail_url' => $itemData['pictures'][0]['secure_url'] ?? null, // Primera imagen (segura)
                'picture_url'   => $itemData['pictures'][0]['url'] ?? null,
            ];
        }

        return [
            'thumbnail_url' => null,
            'picture_url'   => null,
        ]; // Retornar valores por defecto si hay error.
    }

    private function formatOrders(array $orders): array
    {
        $formattedOrders = [];

        foreach ($orders as $order) {
            $isPack = isset($order['pack_id']) && $order['pack_id'] !== null;
            $orderItems = $order['order_items'];

            foreach ($orderItems as $item) {
                $shippingId = $order['shipping']['id'] ?? null;

                // Obtener detalles del envío solo si hay un shipping_id
                $shipmentDetails = $shippingId ? $this->getShipmentDetails($shippingId) : null;

                // Obtener detalles del producto (incluyendo imágenes)
                $itemDetails = $this->getItemDetails($item['item']['id']);

                // Buscar en NotasProductosCosmica si el título contiene un código después de '#'
                $folio = null;
                $match = [];
                if (preg_match('/#(\w+)$/', $item['item']['title'], $match)) {
                    $folio = $match[1]; // Extraer el folio después de '#'
                }

                // Consultar en la base de datos
                $notasProducto = $folio ? NotasProductosCosmica::where('folio', $folio)->first() : null;

                $formattedOrders[] = [
                    'payment_reason'       => $order['payments'][0]['reason'] ?? null,
                    'total_paid_amount'    => $order['payments'][0]['total_paid_amount'] ?? null,
                    'transaction_amount'   => $order['payments'][0]['transaction_amount'] ?? null,
                    'payment_date'         => isset($order['payments'][0]['date_approved'])
                        ? Carbon::parse($order['payments'][0]['date_approved'])->subHours(2)->format('d M H:i') . ' hs'
                        : null,
                    'payment_status'       => $order['payments'][0]['status'] ?? null,
                    'shipping_id'          => $shippingId,
                    'shipment_details'     => $shipmentDetails,
                    'item_id'              => $item['item']['id'] ?? null,
                    'item_title'           => $item['item']['title'] ?? null,
                    'quantity'             => $item['quantity'] ?? null,
                    'order_id'             => $order['id'] ?? null,
                    'buyer_nickname'       => $order['buyer']['nickname'] ?? null,
                    'is_pack'              => $isPack,
                    'pack_id'              => $order['pack_id'] ?? null,
                    'status'               => $order['status'] ?? null,
                    'thumbnail_url'        => $itemDetails['thumbnail_url'],
                    'picture_url'          => $itemDetails['picture_url'],
                    'cosmica_nota_id'      => $notasProducto->id ?? null, // ID del registro de NotasProductosCosmica
                ];
            }
        }

        return $formattedOrders;
    }

    public function index(Request $request){
        $meli = Meli::first();

        // Calcular el rango por defecto (últimos 20 días)
        $fechaFin = now()->toIso8601String(); // Fecha actual en formato ISO 8601
        $fechaInicio = now()->subDays(20)->toIso8601String(); // Últimos 20 días

        // Verificar si se proporciona un filtro personalizado
        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $fechaInicio = $request->input('fecha_inicio') . 'T00:00:00.000-00:00';
            $fechaFin = $request->input('fecha_fin') . 'T23:59:59.999-00:00';
        }

        $endpoint = "https://api.mercadolibre.com/orders/search?seller={$this->sellerId}&order.date_created.from=$fechaInicio&order.date_created.to=$fechaFin&sort=date_desc";
        $maxAttempts = 3; // Número máximo de intentos
        $attempt = 0; // Intento actual
        $timeout = 60; // Timeout total en segundos
        $connectTimeout = 30; // Timeout de conexión en segundos

        // Realizar la solicitud a la API de Mercado Libre
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->accessToken}",
        ])->get($endpoint);

        $groupedOrders = []; // Definir por defecto como arreglo vacío
        $errorMessage = null; // Mensaje de error por defecto

        if ($response->successful()) {
            $data = $response->json();
            $ordenes = $data['results'] ?? []; // Obtiene las órdenes

            // Formatear las órdenes
            $formattedOrders = $this->formatOrders($ordenes);

            // Agrupar las órdenes por pack_id
            $groupedOrders = $this->groupOrdersByPackId($formattedOrders);

            // Paginación
            $perPage = 20; // Número de elementos por página
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentItems = array_slice($groupedOrders, ($currentPage - 1) * $perPage, $perPage);
            $groupedOrders = new LengthAwarePaginator($currentItems, count($groupedOrders), $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
            ]);
        } else {
            // Manejar errores
            $error = $response->json();
            $status = $response->status();

            if ($status === 401 && isset($error['message']) && $error['message'] === 'invalid_token') {
                $errorMessage = 'El token ha expirado. Por favor, actualiza el token.';
            } else {
                $errorMessage = 'Error al conectar con Mercado Libre. Inténtalo más tarde.';
            }
        }

        // Pasar las variables a la vista
        return view('admin.meli.ventas', compact('groupedOrders', 'meli', 'errorMessage', 'fechaInicio', 'fechaFin'));
    }

    public function downloadShippingLabel($shippingId, $cosmica_nota_id = null)
    {

        // Actualizar el registro de NotasProductosCosmica con el shippingId
        if ($cosmica_nota_id) {
            // Buscar el registro de NotasProductosCosmica si se proporciona $cosmica_nota_id
            $notasCosmica = NotasProductosCosmica::find($cosmica_nota_id);
            $notasCosmica->update([
                'shippingId_meli' => $shippingId,
            ]);
        }

        // Endpoint para obtener la guía en formato PDF
        $endpoint = "https://api.mercadolibre.com/shipment_labels?shipment_ids={$shippingId}&response_type=pdf";

        try {
            // Realizar la petición a la API de Mercado Libre
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->accessToken}",
            ])->get($endpoint);

            if ($response->successful()) {
                // Descargar el archivo PDF
                $pdfContent = $response->body();

                // Guardar el PDF en el almacenamiento temporal
                $fileName = "guia_envio_{$shippingId}.pdf";
                $filePath = storage_path("app/public/{$fileName}");
                Storage::disk('public')->put($fileName, $pdfContent);

                // Retornar el PDF para que el navegador lo descargue
                return response()->download($filePath)->deleteFileAfterSend(true);
            } else {
                // Manejar errores de la API
                return redirect()->back()->withErrors([
                    'message' => "Error al obtener la guía de envío: {$response->status()}",
                ]);
            }

        } catch (\Exception $e) {
            // Manejar excepciones
            return redirect()->back()->withErrors([
                'message' => "Ocurrió un error: {$e->getMessage()}",
            ]);
        }

    }


    public function meli_show($id, $order_id = null)
    {
        // Obtener los datos existentes
        $cotizacion = NotasProductosCosmica::find($id);
        $cotizacion_productos = ProductosNotasCosmica::where('id_notas_productos', '=', $id)
            ->where('price', '!=', null)
            ->get();
        $products = Products::where('categoria', '=', 'Cosmica')
            ->orderBy('nombre', 'ASC')
            ->get();

        $NotasProductosCosmica = $cotizacion->folio;

        // Construir el título con los nombres de los productos si no existe item_title_meli
        if (is_null($cotizacion->item_title_meli)) {
            $productNames = 'Kit de productos cosmica #' . $NotasProductosCosmica;
        } else {
            $productNames = 'Kit de productos cosmica #' . $NotasProductosCosmica;
        }

        // Realizar la petición a la API de Mercado Libre para obtener categorías
        $endpointCategories = 'https://api.mercadolibre.com/sites/MLM/categories';
        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->accessToken}",
            ])->get($endpointCategories);

            if ($response->successful()) {
                $categories = $response->json(); // Guardar las categorías como un arreglo
            } else {
                $categories = []; // Si falla la petición, devolver un arreglo vacío
            }
        } catch (\Exception $e) {
            $categories = []; // Si hay un error, devolver un arreglo vacío
        }

        // Si order_id tiene un valor, realizar las peticiones relacionadas con la orden
        $orderDetails = null;
        $shipmentDetails = null;
        if ($order_id) {
            // Obtener los detalles de la orden
            $endpointOrder = "https://api.mercadolibre.com/orders/{$order_id}";
            try {
                $orderResponse = Http::withHeaders([
                    'Authorization' => "Bearer {$this->accessToken}",
                ])->get($endpointOrder);

                if ($orderResponse->successful()) {
                    $orderDetails = $orderResponse->json();

                    // Verificar si existe información de envío y realizar la petición
                    if (isset($orderDetails['shipping']['id'])) {
                        $shipmentId = $orderDetails['shipping']['id'];
                        $endpointShipment = "https://api.mercadolibre.com/shipments/{$shipmentId}";
                        try {
                            $shipmentResponse = Http::withHeaders([
                                'Authorization' => "Bearer {$this->accessToken}",
                                'x-format-new' => 'true',
                            ])->get($endpointShipment);

                            if ($shipmentResponse->successful()) {
                                $shipmentDetails = $shipmentResponse->json(); // Guardar los detalles del envío
                            }
                        } catch (\Exception $e) {
                            $shipmentDetails = null; // Si hay un error, dejar null
                        }
                    }
                }
            } catch (\Exception $e) {
                $orderDetails = null; // Si hay un error, dejar null
            }
        }

        // Pasar todo a la vista
        return view('admin.cotizacion_cosmica.meli_create', compact('products', 'cotizacion', 'cotizacion_productos', 'categories', 'productNames', 'orderDetails', 'shipmentDetails'));
    }


    public function meli_show_order($order_id)
    {

        // Si order_id tiene un valor, realizar las peticiones relacionadas con la orden
        $shipmentDetails = null;

        if (isset($order_id)) {
            $endpointShipment = "https://api.mercadolibre.com/shipments/{$order_id}";
            try {
                $shipmentResponse = Http::withHeaders([
                    'Authorization' => "Bearer {$this->accessToken}",
                    'x-format-new' => 'true',
                ])->get($endpointShipment);

                if ($shipmentResponse->successful()) {
                    $shipmentDetails = $shipmentResponse->json(); // Guardar los detalles del envío
                }
            } catch (\Exception $e) {
                $shipmentDetails = null; // Si hay un error, dejar null
            }
        }


        // Pasar todo a la vista
        return view('admin.cotizacion_cosmica.meli_create_order', compact('shipmentDetails'));
    }


    public function publishToMeli(Request $request, $id)
    {
        // Validar los datos del request
        $validatedData = $request->validate([
            'price' => 'required|numeric|min:1',
            'description' => 'required|string|max:2000',
        ]);

        // Construir la descripción con los productos y cantidades
        $productos = $request->input('productos', []);
        $cantidades = $request->input('cantidad', []);
        $productosDetalle = '';
        foreach ($productos as $index => $producto) {
            $cantidad = $cantidades[$index] ?? 0;
            $productosDetalle .= "{$producto} cantidad {$cantidad}\n";
        }

        $descripcionFinal = "Productos:\n" . $productosDetalle . "\n" . $validatedData['description'];

        $endpoint = 'https://api.mercadolibre.com/items';
        // $payload = [
        //     "title" => $request->title,
        //     "category_id" => "MLM178705",
        //     'price' => $validatedData['price'],
        //     "currency_id" => "MXN",
        //     "available_quantity" => 1,
        //     "buying_mode" => "buy_it_now",
        //     "listing_type_id" => "gold_special",
        //     "condition" => "new",
        //     "pictures" => [
        //         ["source" => "https://plataforma.imnasmexico.com/meli/PROPUESTA-1.png"]
        //     ],
        //     "attributes" => [
        //         [
        //             "id" => "BRAND",
        //             "value_name" => "Cosmética Natural"
        //         ],
        //         [
        //             "id" => "SKIN_TYPE",
        //             "value_name" => "Grasa"
        //         ],
        //         [
        //             "id" => "APPLICATION_MOMENT",
        //             "value_name" => "Día/Noche"
        //         ],
        //         [
        //             "id" => "NAME",
        //             "value_name" => $request->title
        //         ]
        //     ],
        //     "shipping" => [
        //         "mode" => "me2",
        //         "local_pick_up" => false,
        //         "free_shipping" => false,
        //         "logistic_type" => "drop_off",
        //         "store_pick_up" => false
        //     ],
        // ];

        $payload = [
            "title" => $request->title,
            "category_id" => "MLM178705",
            "price" => $validatedData['price'],
            "currency_id" => "MXN",
            "available_quantity" => 1,
            "buying_mode" => "buy_it_now",
            "listing_type_id" => "silver", // Puedes cambiarlo dinámicamente si gustas
            "condition" => "not_specified", // O "new" si aplica

            "pictures" => [
                ["source" => "https://plataforma.imnasmexico.com/meli/PROPUESTA-1.png"]
            ],

            "attributes" => [
                [
                    "id" => "BRAND",
                    "value_name" => "Cosmética Natural"
                ],
                [
                    "id" => "NAME",
                    "value_name" => $request->title
                ],
                // Puedes agregar más dinámicamente si quieres
            ],

            "shipping" => [
                "mode" => "me2", // usa "me2" si tienes habilitado Mercado Envíos
                "local_pick_up" => false,
                "free_shipping" => $request->envio_gratis ?? false, // true o false
                "logistic_type" => "drop_off",
                "store_pick_up" => false
            ]
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->accessToken}",
                'Content-Type' => 'application/json',
            ])->post($endpoint, $payload);

            if ($response->successful()) {
                $responseData = $response->json();
                $itemId = $responseData['id'];
                $permalink = $responseData['permalink'];

                // Guardar item_id_meli, item_title_meli, y item_descripcion_meli en la base de datos
                $cotizacion = NotasProductosCosmica::find($id);
                $cotizacion->update([
                    'item_id_meli' => $itemId,
                    'item_title_meli' => $request->title,
                    'item_descripcion_meli' => $descripcionFinal,
                    'item_descripcion_permalink' => $permalink,
                ]);

                // Crear descripción
                $descriptionEndpoint = "https://api.mercadolibre.com/items/{$itemId}/description";
                $descriptionPayload = [
                    "plain_text" => $descripcionFinal,
                ];

                Http::withHeaders([
                    'Authorization' => "Bearer {$this->accessToken}",
                    'Content-Type' => 'application/json',
                ])->post($descriptionEndpoint, $descriptionPayload);

                return redirect()->back()->with('success', 'Artículo publicado y descripción actualizada exitosamente en Mercado Libre.');
            } else {
                $errorDetails = $response->json();
                $errorMessage = $errorDetails['message'] ?? 'Error desconocido';
                $causes = isset($errorDetails['cause']) ? json_encode($errorDetails['cause'], JSON_PRETTY_PRINT) : 'No se especificaron causas.';

                return redirect()->back()->with('error', "Error al publicar: {$errorMessage}. Detalles: {$causes}");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

}
