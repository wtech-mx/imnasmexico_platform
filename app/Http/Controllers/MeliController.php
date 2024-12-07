<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MeliController extends Controller
{
    private $accessToken = 'APP_USR-4791982421745244-120619-6e5686be00416a46416e810056b082a8-2084225921';
    private $sellerId = '2084225921';

    /**
     * Formatea las órdenes obtenidas desde la API.
     *
     * @param array $orders
     * @return array
     */
    private function formatOrders(array $orders): array
    {
        $formattedOrders = [];

        foreach ($orders as $order) {
            $isPack = isset($order['pack_id']) && $order['pack_id'] !== null;
            $orderItems = $order['order_items'];

            foreach ($orderItems as $item) {

                // Convertir la fecha y sumar 2 horas
                $paymentDate = isset($order['payments'][0]['date_approved'])
                ? Carbon::parse($order['payments'][0]['date_approved'])->subHours(2)->format('d M H:i') . ' hs'
                : null;

                $formattedOrders[] = [
                    'payment_reason'       => $order['payments'][0]['reason'] ?? null,
                    'total_paid_amount'    => $order['payments'][0]['total_paid_amount'] ?? null,
                    'transaction_amount'   => $order['payments'][0]['transaction_amount'] ?? null,
                    'payment_date'         => $paymentDate, // Formateado
                    'payment_status'       => $order['payments'][0]['status'] ?? null,
                    'shipping_id'          => $order['shipping']['id'] ?? null,
                    'item_id'              => $item['item']['id'] ?? null,
                    'item_title'           => $item['item']['title'] ?? null,
                    'item_category_id'     => $item['item']['category_id'] ?? null,
                    'item_variation_id'    => $item['item']['variation_id'] ?? null,
                    'item_seller_custom'   => $item['item']['seller_custom_field'] ?? null,
                    'item_global_price'    => $item['item']['global_price'] ?? null,
                    'item_warranty'        => $item['item']['warranty'] ?? null,
                    'item_seller_sku'      => $item['item']['seller_sku'] ?? null,
                    'quantity'             => $item['quantity'] ?? null,
                    'unit_price'           => $item['unit_price'] ?? null,
                    'full_unit_price'      => $item['full_unit_price'] ?? null,
                    'order_id'             => $order['id'] ?? null,
                    'buyer_id'             => $order['buyer']['id'] ?? null,
                    'buyer_nickname'       => $order['buyer']['nickname'] ?? null,
                    'total_amount'         => $order['total_amount'] ?? null,
                    'paid_amount'          => $order['paid_amount'] ?? null,
                    'is_pack'              => $isPack,
                    'pack_id'              => $order['pack_id'] ?? null,
                ];
            }
        }

        return $formattedOrders;
    }

    /**
     * Muestra las órdenes en la vista.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */

     public function index_token(){

        return view('admin.meli.token');
     }

    public function index()
    {
        $endpoint = "https://api.mercadolibre.com/orders/search?seller={$this->sellerId}&sort=date_desc";

        // Realizar la solicitud a la API de Mercado Libre
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->accessToken}",
        ])->get($endpoint);

        if ($response->successful()) {
            $data = $response->json();
            $ordenes = $data['results'] ?? []; // Obtiene las órdenes

            // Formatear las órdenes para la vista
            $formattedOrders = $this->formatOrders($ordenes);
            // Pasar los datos a la vista
            return view('admin.meli.ventas', compact('formattedOrders'));
        } else {
            // Manejar errores
            $error = $response->json();
            return response()->json(['error' => $error], $response->status());
        }
    }
}
