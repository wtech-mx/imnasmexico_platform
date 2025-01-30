<?php

namespace App\Http\Controllers;

use App\Models\OrderOnlineCosmica;
use App\Models\OrdersCosmica;
use App\Models\Products;
use Illuminate\Http\Request;
use MercadoPago\{Exception, SDK, Preference, Item};
use Illuminate\Support\Str;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Throwable;
use Illuminate\Support\Facades\Http;
use Session;

class CartController extends Controller
{
    public function agregar(Request $request){
        $product = Products::find($request->id);
        $cantidad = $request->cantidad;

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Obtener el carrito de productos desde la sesión
        $cart = session()->get('cart_productos', []);

        // Si el producto ya está en el carrito, solo se aumenta la cantidad
        if (isset($cart[$product->id])) {
            $cart[$product->id]['cantidad'] += $cantidad;
        } else {
            // Si no está, se agrega al carrito de productos
            $cart[$product->id] = [
                'nombre' => $product->nombre,
                'precio' => $product->precio_normal,
                'cantidad' => $cantidad,
                'imagen' => $product->imagenes,
            ];
        }

        // Guardar el carrito de productos en la sesión
        session()->put('cart_productos', $cart);

        return response()->json(['mensaje' => 'Producto agregado al carrito', 'carrito' => $cart]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart_productos', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['cantidad'] = $request->cantidad;
            session()->put('cart_productos', $cart);
        }

        $total_producto = number_format($cart[$request->id]['precio'] * $cart[$request->id]['cantidad'], 0, '.', ',');
        $total_carrito = number_format(array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart)), 0, '.', ',');

        return response()->json([
            'success' => true,
            'total_producto' => $total_producto,
            'total_carrito' => $total_carrito
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
            "failure" => "https://plataforma.imnasmexico.com/",
        );
        $preference->auto_return = "approved";
        $preference->external_reference = $code;
        $preference->items = $ticketss;

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
            } else {
                $user = User::where('email', $request->email)->first();
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
            $order_cosmica->save();

            foreach (session('cart_productos') as $id => $details) {
                $order_ticket = new OrderOnlineCosmica;
                $order_ticket->id_nota = $order_cosmica->id;
                $order_ticket->nombre = $details['nombre'];
                $order_ticket->precio = $details['precio'];
                $order_ticket->cantidad = $details['cantidad'];
                $order_ticket->save();
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

    public function pay(OrdersCosmica $order, Request $request)
    {
        $payment_id = $request->get('payment_id');

        $dominio = $request->getHost();
        if ($dominio == 'plataforma.imnasmexico.com') {
            $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-8901800557603427-041420-99b569dfbf4e6ce9160fc673d9a47b1e-1115271504");

        } else {
            $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=TEST-3105049862829838-031417-76d6b6648d0ba342c635d268cd25ba10-236513607");
        }

        $response = json_decode($response);
        $status = $response->status;
        $external_reference = $response->external_reference;
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

}

