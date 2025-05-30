<?php

namespace App\Http\Controllers;

use App\Models\OrderOnlineCosmica;
use App\Models\OrdersCosmica;
use App\Models\OrdersCosmicaOnline;
use App\Models\OrdersTickets;
use App\Models\Products;
use Illuminate\Http\Request;
use MercadoPago\{Exception, SDK, Preference, Item};
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Meli;
use App\Models\ProductosBundleId;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Throwable;
use Illuminate\Support\Facades\Http;
use Session;

class CartController extends Controller
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

    public function agregar(Request $request)
    {
        $product = Products::find($request->id);
        $cantidad = $request->cantidad ?? 1;

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $cart = session()->get('cart_productos', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['cantidad'] += $cantidad;
        } else {
            $cart[$product->id] = [
                'id_producto' => $product->id,
                'nombre' => $product->nombre,
                'precio' => $product->precio_normal,
                'cantidad' => $cantidad,
                'imagen' => $product->imagenes,
            ];
        }

        session()->put('cart_productos', $cart);

        return response()->json([
            'mensaje' => 'Producto agregado al carrito',
            'carrito' => $cart
        ]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart_productos', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['cantidad'] = (int) $request->cantidad; // Asegurar que sea número entero
            session()->put('cart_productos', $cart);
        }

        // Calcular totales sin formatearlos en strings
        $total_producto = $cart[$request->id]['precio'] * $cart[$request->id]['cantidad'];
        $total_carrito = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart));

        return response()->json([
            'success' => true,
            'total_producto' => round($total_producto, 2), // Devolver como número
            'total_carrito' => round($total_carrito, 2) // Devolver como número
        ]);
    }


    public function remove(Request $request)
    {
        $cart = session()->get('cart_productos', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart_productos', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function processPayment(Request $request)
    {
        // Configurar el SDK de Mercado Pago con las credenciales de API
       SDK::setAccessToken(config('services.mercadopago.token'));

        // Crear un objeto de preferencia de pago
        $preference = new Preference();
        $code = Str::random(8);

        // Crear un objeto de artículo
        foreach (session('cart_productos') as $id => $details) {
            // dd(session('cart_productos'));
            $item = new Item();
            $item->title = $details['nombre'];
            $item->quantity = $details['cantidad'];
            $item->unit_price = $details['precio'];
            $ticketss[] = $item;
        }

        // Crear un objeto de preferencias de pago
        $preference = new \MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => route('order_cosmica.pay'),
            "pending" => route('order_cosmica.pay'),
            "failure" => "https://cosmicaskin.com",
        );

        $preference->auto_return = "approved";
        $preference->external_reference = $code;
        $preference->items = $ticketss;

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
                $user->postcode = $request->get('postcode');
                $user->state = $request->get('state');
                $user->country = $request->get('country');
                $user->direccion = $request->get('direccion');
                $user->city = $request->get('city');
                $user->referencia = $request->get('referencia');
                $user->update();
            } else {
                $user = User::where('email', $request->email)->first();
                $user->postcode = $request->get('postcode');
                $user->state = $request->get('state');
                $user->country = $request->get('country');
                $user->direccion = $request->get('direccion');
                $user->city = $request->get('city');
                $user->referencia = $request->get('referencia');
                $user->update();
            }
            $payer = $user;
        } else {
            $payer = new User;
            $payer->name = $request->get('name') . ' ' . $request->get('ape_paterno') . ' ' . $request->get('ape_materno');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));

            $payer->postcode = $request->get('postcode');
            $payer->state = $request->get('state');
            $payer->country = $request->get('country');
            $payer->direccion = $request->get('direccion');
            $payer->city = $request->get('city');
            $payer->referencia = $request->get('referencia');
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
        }

        try {
            // Crear la preferencia en Mercado Pago

            $preference->save();

            $fechaActual = date('Y-m-d');
            $total = 0;
            foreach (session('cart_productos') as $id => $details) {
                $total += $details['precio'] * $details['cantidad'];
            }

            $order_cosmica = new OrdersCosmica;
            $order_cosmica->id_usuario = $payer->id;
            $order_cosmica->pago = $total;
            $order_cosmica->forma_pago = 'Mercado Pago';
            $order_cosmica->fecha = $fechaActual;
            $order_cosmica->estatus = 0;
            $order_cosmica->code = $code;
            $order_cosmica->external_reference = $code;
            if($request->get('postcode') != NULL ){
                $order_cosmica->forma_envio = 'envio';
            }
            $order_cosmica->save();

            foreach (session('cart_productos') as $id => $details) {

                $producto = Products::where('id', $details['id_producto'])->first();

                if ($producto) {
                    if ($producto && $producto->subcategoria == 'Kit') {
                        $productos_bundle = ProductosBundleId::where('id_product', $producto->id)->get();

                        foreach ($productos_bundle as $producto_bundle) {
                            $order_ticket = new OrdersCosmicaOnline;
                            $order_ticket->id_order = $order_cosmica->id;
                            $order_ticket->nombre = $producto_bundle->producto;
                            $order_ticket->id_producto = $producto_bundle->id_producto;
                            $order_ticket->precio = '0';
                            $order_ticket->cantidad = $producto_bundle->cantidad;
                            $order_ticket->kit = '1';
                            $order_ticket->num_kit = $producto_bundle->id_product;
                            $order_ticket->save();
                        }
                    }else{
                        $order_ticket = new OrdersCosmicaOnline;
                        $order_ticket->id_order = $order_cosmica->id;
                        $order_ticket->id_producto = $details['id_producto'];
                        $order_ticket->nombre = $details['nombre'];
                        $order_ticket->precio = $details['precio'];
                        $order_ticket->cantidad = $details['cantidad'];
                        $order_ticket->save();
                    }
                }
            }
            // Redirigir al usuario al proceso de pago de Mercado Pago
            return Redirect::to($preference->init_point);
        } catch (Exception $e) {
            // Manejar errores de Mercado Pago
            return Redirect::back()->withErrors(['message' => $e->getMessage()]);
        } catch (Throwable $e) {
            // Manejar errores de PHP
            return Redirect::back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function processPaymentMeli(Request $request){
            // Validar los datos del request
            $fechaActual = date('Y-m-d');
            $code = Str::random(8);

            if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
                if (User::where('telefono', $request->telefono)->exists()) {
                    $user = User::where('telefono', $request->telefono)->first();
                    $user->postcode = $request->get('postcode');
                    $user->state = $request->get('state');
                    $user->country = $request->get('country');
                    $user->direccion = $request->get('direccion');
                    $user->city = $request->get('city');
                    $user->update();
                } else {
                    $user = User::where('email', $request->email)->first();
                    $user->postcode = $request->get('postcode');
                    $user->state = $request->get('state');
                    $user->country = $request->get('country');
                    $user->direccion = $request->get('direccion');
                    $user->city = $request->get('city');
                    $user->update();
                }
                $payer = $user;
            } else {
                $payer = new User;
                $payer->name = $request->get('name') . ' ' . $request->get('ape_paterno') . ' ' . $request->get('ape_materno');
                $payer->email = $request->get('email');
                $payer->username = $request->get('telefono');
                $payer->code = $code;
                $payer->telefono = $request->get('telefono');
                $payer->cliente = '1';
                $payer->password = Hash::make($request->get('telefono'));

                $payer->postcode = $request->get('postcode');
                $payer->state = $request->get('state');
                $payer->country = $request->get('country');
                $payer->direccion = $request->get('direccion');
                $payer->city = $request->get('city');
                $payer->save();
                $datos = User::where('id', '=', $payer->id)->first();
            }

            // Verificar si la sesión 'cart_productos' existe
            $cartProductos = session('cart_productos', []);
            $code = Str::random(8);

            // Inicializar la variable de detalles de productos
            $productosDetalle = '';

            // Recorrer los productos en la sesión
            foreach ($cartProductos as $id => $details) {
                $productosDetalle .= "{$details['nombre']} cantidad {$details['cantidad']}\n";
            }

            // Construir la descripción final
            $descripcionFinal = "Productos:\n" . $productosDetalle . "\n";

            $total = 0;
            foreach (session('cart_productos') as $id => $details) {
                $total += $details['precio'] * $details['cantidad'];
            }

            $order_cosmica = new OrdersCosmica;
            $order_cosmica->id_usuario = $payer->id;
            $order_cosmica->pago = $total;
            $order_cosmica->forma_pago = 'Mercado Libre';
            $order_cosmica->forma_envio = 'Mercado Libre';
            $order_cosmica->fecha = $fechaActual;
            $order_cosmica->estatus = 0;
            $order_cosmica->code = $code;
            $order_cosmica->external_reference = $code;
            $order_cosmica->save();

            $tituloMeli = 'Kit De Productos Cosmica Meli #TC'.$order_cosmica->id;

            $endpoint = 'https://api.mercadolibre.com/items';
            $payload = [
                "title" => $tituloMeli,
                "category_id" => "MLM178705",
                'price' => $total,
                "currency_id" => "MXN",
                "available_quantity" => 1,
                "buying_mode" => "buy_it_now",
                "listing_type_id" => "gold_special",
                "condition" => "new",
                "pictures" => [
                    ["source" => "https://plataforma.imnasmexico.com/meli/PROPUESTA-1.png"]
                ],
                "attributes" => [
                    [
                        "id" => "BRAND",
                        "value_name" => "Cosmética Natural"
                    ],
                    [
                        "id" => "SKIN_TYPE",
                        "value_name" => "Grasa"
                    ],
                    [
                        "id" => "APPLICATION_MOMENT",
                        "value_name" => "Día/Noche"
                    ],
                    [
                        "id" => "NAME",
                        "value_name" => $tituloMeli
                    ]
                ],
                "shipping" => [
                    "mode" => "me2",
                    "local_pick_up" => false,
                    "free_shipping" => false,
                    "logistic_type" => "drop_off",
                    "store_pick_up" => false
                ],
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

                    $order_cosmica->item_id_meli = $itemId;
                    $order_cosmica->item_title_meli = $tituloMeli;
                    $order_cosmica->item_descripcion_meli = $descripcionFinal;
                    $order_cosmica->item_descripcion_permalink = $permalink;
                    $order_cosmica->update();

                    foreach (session('cart_productos') as $id => $details) {
                        $order_ticket = new OrdersCosmicaOnline;
                        $order_ticket->id_order = $order_cosmica->id;
                        $order_ticket->id_producto = $details['id_producto'];
                        $order_ticket->nombre = $details['nombre'];
                        $order_ticket->precio = $details['precio'];
                        $order_ticket->cantidad = $details['cantidad'];
                        $order_ticket->save();
                    }

                    // Crear descripción
                    $descriptionEndpoint = "https://api.mercadolibre.com/items/{$itemId}/description";
                    $descriptionPayload = [
                        "plain_text" => $descripcionFinal,
                    ];

                    Http::withHeaders([
                        'Authorization' => "Bearer {$this->accessToken}",
                        'Content-Type' => 'application/json',
                    ])->post($descriptionEndpoint, $descriptionPayload);

                    $order = OrdersCosmica::where('code', $code)->firstOrFail();
                    $order_ticket = OrdersCosmicaOnline::where('id_order', '=', $order->id)->get();

                    Session::forget('cart_productos');

                    return redirect()->route('thankyou.page', ['id' => $order->id]);
                    // return view('tienda_cosmica.thankyou', compact('order', 'order_ticket'));

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

    public function thankYouPage($id){

        $order = OrdersCosmica::findOrFail($id);
        $order_ticket = OrdersCosmicaOnline::where('id_order', '=', $order->id)->get();

        return view('tienda_cosmica.thankyou_meli', compact('order', 'order_ticket'));
    }



    public function pay(OrdersCosmica $order, Request $request)
    {
        $payment_id = $request->get('payment_id');
        $external_reference = $request->get('external_reference');

        $dominio = $request->getHost();
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-8901800557603427-041420-99b569dfbf4e6ce9160fc673d9a47b1e-1115271504");

        $response = json_decode($response);
        if (isset($response->error)) {
            return redirect()->route('order_cosmica.show', $order->code)->with('error', 'Hubo un problema al verificar el pago.');
        }
        $status = $response->status ?? null;
        $external_reference_api = $response->external_reference ?? null;
        $external_reference = $external_reference_api ?: $external_reference;

        // Si no se encuentra el external_reference, redirige con error
        if (!$external_reference) {
            return redirect()->route('order_cosmica.show', $order->code)->with('error', 'No se pudo verificar el pago. Falta external_reference.');
        }

        if ($status == 'approved') {
            $order = OrdersCosmica::where('code', '=', $external_reference)->first();
            $order->num_order = $payment_id;
            $order->estatus = 1;
            $order->update();

            Session::forget('cart_productos');
        } else {
            $order = OrdersCosmica::where('code', '=', $external_reference)->first();
            $order->num_order = $payment_id;
            $order->update();


            Session::forget('cart_productos');
        }
        return redirect()->route('order_cosmica.show', $order->code);
    }

    public function show($code)
    {
        $order = OrdersCosmica::where('code', $code)->firstOrFail();
        $order_ticket = OrdersCosmicaOnline::where('id_order', '=', $order->id)->get();

        return view('tienda_cosmica.thankyou', compact('order', 'order_ticket'));
    }
}

