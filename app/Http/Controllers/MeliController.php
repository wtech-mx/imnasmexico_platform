<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Meli;
use App\Models\NotasProductosCosmica;
use App\Models\ProductosNotasCosmica;
use App\Models\Products;

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
         $endpoint = "https://api.mercadolibre.com/shipments/{$shippingId}/history";

         $response = Http::withHeaders([
             'Authorization' => "Bearer {$this->accessToken}",
             'x-format-new'  => 'true',
         ])->get($endpoint);

         if ($response->successful()) {
             $history = $response->json();

             // Filtrar las entradas para excluir "first_visit"
             $filteredHistory = collect($history)->reject(fn($entry) => $entry['substatus'] === 'first_visit');

             // Ordenar por fecha descendente
             $sortedHistory = $filteredHistory->sortByDesc(fn($entry) => $entry['date'])->values();

             // Obtener el registro más reciente
             $latestEntry = $sortedHistory->first();

             if ($latestEntry) {
                 return [
                     'date'      => Carbon::parse($latestEntry['date'])->format('d M Y H:i:s'),
                     'substatus' => $latestEntry['substatus'] ?? null,
                     'status'    => $latestEntry['status'],
                 ];
             }
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


    private function formatOrders(array $orders): array{
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

                $formattedOrders[] = [
                    'payment_reason'       => $order['payments'][0]['reason'] ?? null,
                    'total_paid_amount'    => $order['payments'][0]['total_paid_amount'] ?? null,
                    'transaction_amount'   => $order['payments'][0]['transaction_amount'] ?? null,
                    'payment_date'         => isset($order['payments'][0]['date_approved'])
                        ? Carbon::parse($order['payments'][0]['date_approved'])->subHours(2)->format('d M H:i') . ' hs'
                        : null,
                    'payment_status'       => $order['payments'][0]['status'] ?? null,
                    'shipping_id'          => $shippingId,
                    'shipment_details'     => $shipmentDetails, // Detalles del envío
                    'item_id'              => $item['item']['id'] ?? null,
                    'item_title'           => $item['item']['title'] ?? null,
                    'quantity'             => $item['quantity'] ?? null,
                    'order_id'             => $order['id'] ?? null,
                    'buyer_nickname'       => $order['buyer']['nickname'] ?? null,
                    'is_pack'              => $isPack,
                    'pack_id'              => $order['pack_id'] ?? null,
                    'status'               => $order['status'] ?? null,
                    'thumbnail_url'        => $itemDetails['thumbnail_url'], // URL de miniatura
                    'picture_url'          => $itemDetails['picture_url'],   // URL de la imagen completa
                ];
            }
        }

        return $formattedOrders;
    }

    public function index(){
        $endpoint = "https://api.mercadolibre.com/orders/search?seller={$this->sellerId}&sort=date_desc";

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
        return view('admin.meli.ventas', compact('groupedOrders', 'errorMessage'));
    }

    public function meli_show($id)
    {
        // Obtener los datos existentes
        $cotizacion = NotasProductosCosmica::find($id);
        $cotizacion_productos = ProductosNotasCosmica::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::where('categoria', '=', 'Cosmica')->orderBy('nombre', 'ASC')->get();

        // Realizar la petición a la API de Mercado Libre para obtener categorías
        $endpoint = 'https://api.mercadolibre.com/sites/MLM/categories';

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->accessToken}",
            ])->get($endpoint);

            if ($response->successful()) {
                $categories = $response->json(); // Guardar las categorías como un arreglo
            } else {
                $categories = []; // Si falla la petición, devolver un arreglo vacío
            }
        } catch (\Exception $e) {
            $categories = []; // Si hay un error, devolver un arreglo vacío
        }

        // Pasar todo a la vista
        return view('admin.cotizacion_cosmica.meli_create', compact('products', 'cotizacion', 'cotizacion_productos', 'categories'));
    }

    public function publishToMeli(Request $request, $id)
    {
        // Validar los datos del request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|string',
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
        $payload = [
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'price' => $validatedData['price'],
            'currency_id' => 'MXN',
            'available_quantity' => 1,
            'buying_mode' => 'buy_it_now',
            'listing_type_id' => 'gold_special',
            'condition' => 'new',
            'description' => [
                'plain_text' => $descripcionFinal,
            ],
            'tags' => ['immediate_payment'],
            'sale_terms' => [
                [
                    'id' => 'WARRANTY_TYPE',
                    'value_name' => 'Garantía del vendedor'
                ],
                [
                    'id' => 'WARRANTY_TIME',
                    'value_name' => '5 días'
                ]
            ],
            'pictures' => [
                [
                    'source' => 'https://plataforma.imnasmexico.com/assets/user/utilidades/meli_item.png',
                ],
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->accessToken}",
                'Content-Type' => 'application/json',
            ])->post($endpoint, $payload);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Artículo publicado exitosamente en Mercado Libre.');
            } else {
                // Capturar y mostrar el mensaje de error completo
                $errorDetails = $response->json(); // Obtener todos los detalles del error
                $errorMessage = $errorDetails['message'] ?? 'Error desconocido';
                $causes = isset($errorDetails['cause']) ? json_encode($errorDetails['cause'], JSON_PRETTY_PRINT) : 'No se especificaron causas.';
                return redirect()->back()->with('error', "Error al publicar: {$errorMessage}. Detalles: {$causes}");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }



}