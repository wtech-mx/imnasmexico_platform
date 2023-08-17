<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\Orders;
use App\Models\Cupon;
use App\Models\User;
use App\Models\Factura;
use App\Models\EnviosOrder;
use Hash;
use Illuminate\Support\Arr;
use Session;
use App\Models\OrdersTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use App\Mail\PlantillaPedidoRecibido;
use App\Mail\PlantillaTicketPresencial;
use App\Mail\PlantillaTicket;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use MercadoPago\{Exception, SDK, Preference, Item};
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Codexshaper\WooCommerce\Facades\Product;
use Order;
use Illuminate\Support\Facades\Validator;


use Throwable;

class OrderController extends Controller
{
    public function show($code)
    {
        $order = Orders::where('code', $code)->firstOrFail();
        $order_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();

        return view('user.order', compact('order', 'order_ticket'));
    }

    public function processPayment(Request $request)
    {
        // Configurar el SDK de Mercado Pago con las credenciales de API
       SDK::setAccessToken(config('services.mercadopago.token'));

        // Crear un objeto de preferencia de pago
        $preference = new Preference();
        $code = Str::random(8);

        // Crear un objeto de artículo
        foreach (session('cart') as $id => $details) {
            // dd(session('cart'));
            $item = new Item();
            $item->title = $details['name'];
            $item->quantity = $details['quantity'];
            if ($details['price'] == 0) {
                $item->unit_price = 0.01;
            } else {
                $item->unit_price = $details['price'];
            }
            $ticketss[] = $item;
        }

        // Crear un objeto de preferencias de pago
        $preference = new \MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => route('order.pay'),
            "pending" => route('order.pay'),
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
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
            Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        try {
            // Crear la preferencia en Mercado Pago

            $preference->save();

            $fechaActual = date('Y-m-d');
            $total = 0;
            foreach (session('cart') as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }

            $order = new Orders;
            $order->id_usuario = $payer->id;
            $order->pago = $total;
            $order->forma_pago = 'Mercado Pago';
            $order->fecha = $fechaActual;
            $order->estatus = 0;
            $order->code = $code;
            $order->external_reference = $code;
            $order->save();

            foreach (session('cart') as $id => $details) {
                $order_ticket = new OrdersTickets;
                $order_ticket->id_order = $order->id;
                $order_ticket->id_usuario = $payer->id;
                $order_ticket->id_tickets = $details['id'];
                $order_ticket->id_curso = $details['curso'];

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

    public function pagar_envio(Request $request)
    {

        // Configurar el SDK de Mercado Pago con las credenciales de API
        SDK::setAccessToken(config('services.mercadopago.token'));

        // Crear un objeto de preferencia de pago
        $preference = new Preference();
        $code = Str::random(8);

        $item = new Item();
        $item->title = 'Pago Envio';
        $item->quantity = 1;
        $item->unit_price = 250;
        $ticketss = array($item);

        // Crear un objeto de preferencias de pago
        $preference = new \MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => route('order.pay'),
            "pending" => route('order.pay'),
            "failure" => "https://plataforma.imnasmexico.com/",
        );
        $preference->auto_return = "approved";
        $preference->external_reference = $code;
        $preference->items = $ticketss;

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
                $user->direccion = $request->get('address_1');
                $user->city = $request->get('city');
                $user->state = $request->get('state');
                $user->postcode = $request->get('postcode');
                $user->country = $request->get('country');
                $user->update();
            } else {
                $user = User::where('email', $request->email)->first();
                $user->direccion = $request->get('address_1');
                $user->city = $request->get('city');
                $user->state = $request->get('state');
                $user->postcode = $request->get('postcode');
                $user->country = $request->get('country');
                $user->update();
            }
            $payer = $user;
        } else {
            $payer = new User;
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->direccion = $request->get('address_1');
            $payer->city = $request->get('city');
            $payer->state = $request->get('state');
            $payer->postcode = $request->get('postcode');
            $payer->country = $request->get('country');
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
            // Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        try {
            // Crear la preferencia en Mercado Pago

            $preference->save();

            $fechaActual = date('Y-m-d');
            $order = new Orders;
            $order->id_usuario = $payer->id;
            $order->pago = 250;
            $order->forma_pago = 'Mercado Pago';
            $order->fecha = $fechaActual;
            $order->estatus = 0;
            $order->code = $code;
            $order->external_reference = $code;
            $order->save();

            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = $payer->id;
            $order_ticket->id_tickets = 137;
            $order_ticket->id_curso = 109;
            $order_ticket->save();

            $estatus_envio = "Pendiente";

            $envio = new EnviosOrder;
            $envio->id_order = $order->id;
            $envio->id_user = $payer->id;
            $envio->estatus = $estatus_envio;
            $envio->save();

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

    public function index_envios(Request $request){

        $envios = EnviosOrder::get();

        return view('admin.envios.index', compact('envios'));
    }

    public function envios_update(Request $request,$id){


        $envios = EnviosOrder::find($id);
        $envios->estatus = $request->get('estatus');
        $envios->update();

        Session::flash('success', 'Se ha Actualziado sus datos con exito');
        return redirect()->back()->with('success', 'Actualziado con exito');
    }


    public function pay(Orders $order, Request $request)
    {
        $payment_id = $request->get('payment_id');

        $dominio = $request->getHost();
        if ($dominio == 'plataforma.imnasmexico.com') {
            $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-8901800557603427-041420-99b569dfbf4e6ce9160fc673d9a47b1e-1115271504");
        } else {
            $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-8901800557603427-041420-99b569dfbf4e6ce9160fc673d9a47b1e-1115271504");
        }

        $response = json_decode($response);
        $status = $response->status;
        $external_reference = $response->external_reference;
        if ($status == 'approved') {
            $order = Orders::where('code', '=', $external_reference)->first();
            $order->num_order = $payment_id;
            $order->estatus = 1;
            $order->update();

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
            $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
            $user = $orden_ticket2->User->name;
            $id_order = $orden_ticket2->id_order;
            $pago = $orden_ticket2->Orders->pago;
            $forma_pago = $orden_ticket2->Orders->forma_pago;
            // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));

            if($orden_ticket2->id_tickets == 137){
                // Recorrer los productos y agregarlos al array line_items
                    $line_items[] = [
                        // 'product_id' => 20127,
                        'product_id' => 1526,
                        'quantity' => 1
                    ];
                // Crear el array de datos completo para enviar a la API
                $data = [
                    'payment_method' => 'Mercado Pago Platform',
                    'payment_method_title' => 'Platform MP',
                    'set_paid' => true,
                    'line_items' => $line_items,
                    'status' => 'processing',
                    'billing' => [
                        'first_name' => $order->User->name,
                        'last_name' => '',
                        'address_1' => $order->User->direccion,
                        'address_2' => '',
                        'city' => $order->User->city,
                        'state' => $order->User->state,
                        'postcode' => $order->User->postcode,
                        'country' => 'Mexico',
                        'email' => $order->User->email,
                        'phone' => $order->User->telefono
                    ],
                    'shipping' => [
                        'first_name' => $order->User->name,
                        'last_name' => '',
                        'address_1' => $order->User->direccion,
                        'address_2' => '',
                        'city' => $order->User->city,
                        'state' => $order->User->state,
                        'postcode' => $order->User->postcode,
                        'country' => 'Mexico'
                    ],
                ];

                $ordenwoo = Order::create($data);
            }else{
                foreach ($orden_ticket as $details) {
                    if ($details->Cursos->modalidad == 'Online') {
                        Mail::to($order->User->email)->send(new PlantillaTicket($details));
                    } else {
                        Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
                    }
                }
                Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));
            }

            Session::forget('cart');
        } else {
            $order = Orders::where('code', '=', $external_reference)->first();
            $order->num_order = $payment_id;
            $order->update();

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
            $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
            $user = $orden_ticket2->User->name;
            $id_order = $orden_ticket2->id_order;
            $pago = $orden_ticket2->Orders->pago;
            $forma_pago = $orden_ticket2->Orders->forma_pago;
            // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));

            Session::forget('cart');
        }
        return redirect()->route('order.show', $order->code);
    }

    public function pay_stripe(Orders $order, Request $request)
    {
        $code = Str::random(8);
        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user2 = User::where('telefono', $request->telefono)->first();
            } else {
                $user2 = User::where('email', $request->email)->first();
            }
            if ($user2->cfdi == NULL) {
                $user2->razon_social = $request->get('razon_social');
                $user2->rfc = $request->get('rfc');
                $user2->cfdi = $request->get('cfdi');
                $user2->direccion = $request->get('direccion');
                $user2->update();
            }
            $payer = $user2;
        } else {
            $payer = new User;
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->telefono = $request->get('telefono');
            $payer->username = $request->get('telefono');
            $payer->razon_social = $request->get('razon_social');
            $payer->cliente = '1';
            $payer->rfc = $request->get('rfc');
            $payer->cfdi = $request->get('cfdi');
            $payer->direccion = $request->get('direccion');
            $payer->code = $code;
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
            Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        $fechaActual = date('Y-m-d');
        $total = 0;
        foreach (session('cart') as $id => $details) {
            $total += $details['price'] * $details['quantity'];
            $mult_iva = $total * .16;
            $total_iva = $total + $mult_iva;
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe = Stripe\Charge::create([
            "amount" => $total_iva * 100,
            "currency" => "MXN",
            "source" => $request->stripeToken,
            "description" => $payer->name
        ]);

        $order = new Orders;
        $order->id_usuario = $payer->id;
        $order->pago = $total_iva;
        $order->forma_pago = 'STRIPE';
        $order->fecha = $fechaActual;
        $order->estatus = 0;
        $order->code = $code;
        $order->save();

        foreach (session('cart') as $id => $details) {
            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = $payer->id;
            $order_ticket->id_tickets = $details['id'];
            $order_ticket->id_curso = $details['curso'];
            $order_ticket->save();
        }

        if ($stripe->status === 'succeeded') {
            $order = Orders::find($order->id);
            $order->num_order = $stripe->id;
            $order->estatus = 1;
            $order->update();

            Session::forget('cart');

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
            $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
            $user = $orden_ticket2->User->name;
            $id_order = $orden_ticket2->id_order;
            $pago = $orden_ticket2->Orders->pago;
            $forma_pago = $orden_ticket2->Orders->forma_pago;
            // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            foreach ($orden_ticket as $details) {
                if ($details->Cursos->modalidad == 'Online') {
                    Mail::to($order->User->email)->send(new PlantillaTicket($details));
                } else {
                    Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
                }
            }
            Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));

            $facturas = new Factura;
            $facturas->id_usuario = $order->User->id;
            $facturas->id_orders = $order->id;
            $estado = 'En Espera';
            $facturas->estatus = $estado;
            $facturas->save();

            // $line_items = [];
            // // Recorrer los tickets y agregarlos al array line_items
            // foreach ($orden_ticket as $ticket) {
            //     $line_items[] = [
            //         'product_id' => 'nombre del producto',
            //         'quantity' => 1
            //     ];
            // }

            // // Creacion de orden en woo
            // $data = [
            //     'payment_method'       => 'Stripe Platform',
            //     'payment_method_title' => 'Stripe Platform',
            //     'set_paid'             => true,
            //     'billing'              => [
            //         'first_name' => 'John',
            //         'last_name'  => 'Doe',
            //         'address_1'  => '969 Market',
            //         'address_2'  => '',
            //         'city'       => 'San Francisco',
            //         'state'      => 'CA',
            //         'postcode'   => '94103',
            //         'country'    => 'US',
            //         'email'      => 'john.doe@example.com',
            //         'phone'      => '(555) 555-5555',
            //     ],
            //     'shipping'             => [
            //         'first_name' => 'John',
            //         'last_name'  => 'Doe',
            //         'address_1'  => '969 Market',
            //         'address_2'  => '',
            //         'city'       => 'San Francisco',
            //         'state'      => 'CA',
            //         'postcode'   => '94103',
            //         'country'    => 'US',
            //     ],
            //     'line_items' => $line_items,
            // ];

            // $order = Order::create($data);

        } else {
            $order = Orders::find($order->id);
            $order->num_order = $stripe->id;
            $order->update();

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
            $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
            $user = $orden_ticket2->User->name;
            $id_order = $orden_ticket2->id_order;
            $pago = $orden_ticket2->Orders->pago;
            $forma_pago = $orden_ticket2->Orders->forma_pago;
            // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));

            Session::forget('cart');
        }

        return redirect()->route('order.show', $order->code);
    }

    public function pay_externo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'telefono' => 'required'
        ]);
        $code = Str::random(8);
        $fechaActual = date('Y-m-d');

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }
            $payer = $user;
        } else {
            $payer = new User;
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
            Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        $order = new Orders;
        $order->id_usuario = $payer->id;
        $order->pago = $request->precio;
        $order->forma_pago = 'Externo';
        $order->fecha = $fechaActual;
        $order->estatus = 1;
        $order->code = $code;
        $order->save();

        $order_ticket = new OrdersTickets;
        $order_ticket->id_order = $order->id;
        $order_ticket->id_tickets = $request->ticket;
        $order_ticket->id_usuario = $payer->id;
        $order_ticket->id_curso = $request->curso;
        $order_ticket->save();

        // Enviar el correo electrónico
        $datos = User::where('id', '=', $payer->id)->first();
        $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
        $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
        $user = $orden_ticket2->User->name;
        $id_order = $orden_ticket2->id_order;
        $pago = $request->precio;
        $forma_pago = $orden_ticket2->Orders->forma_pago;

        foreach ($orden_ticket as $details) {
            if ($details->Cursos->modalidad == 'Online') {
                Mail::to($payer->email)->send(new PlantillaTicket($details));
            } else {
                Mail::to($payer->email)->send(new PlantillaTicketPresencial($details));
            }
        }
        Mail::to($payer->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()->with('success', 'Inscrito correctamente');
    }

    public function clases_gratis(Request $request)
    {


        $code = Str::random(8);
        $fechaActual = date('Y-m-d');
        $curso = Cursos::where('id', '=', $request->ticket)->first();
        $curso_ticket = CursosTickets::where('id_curso', '=', $curso->id)->first();

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }
            $payer = $user;

            $ordenestickets = OrdersTickets::where('id_tickets', '=',$curso_ticket->id)->where('id_usuario', '=',$payer->id)
            ->first();

            if($ordenestickets == null){

            }else{

                Alert::warning('Registro con exito', 'Se ha registrado con exito');
                return back()->with('warning', 'Ya te has registrado');
            }

        } else {
            $payer = new User;
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
            Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        $order = new Orders;
        $order->id_usuario = $payer->id;
        $order->pago = $curso->precio;
        $order->forma_pago = 'Clase Gratis';
        $order->fecha = $fechaActual;
        $order->estatus = 1;
        $order->code = $code;
        $order->save();

        $order_ticket = new OrdersTickets;
        $order_ticket->id_order = $order->id;
        $order_ticket->id_tickets = $curso_ticket->id;
        $order_ticket->id_usuario = $payer->id;
        $order_ticket->id_curso = $curso->id;
        $order_ticket->save();

        // Enviar el correo electrónico
        $datos = User::where('id', '=', $payer->id)->first();
        $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
        $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
        $user = $orden_ticket2->User->name;
        $id_order = $orden_ticket2->id_order;
        $pago = $orden_ticket2->Orders->pago;
        $forma_pago = $orden_ticket2->Orders->forma_pago;

        foreach ($orden_ticket as $details) {
            if ($details->Cursos->modalidad == 'Online') {
                Mail::to($payer->email)->send(new PlantillaTicket($details));
            } else {
                Mail::to($payer->email)->send(new PlantillaTicketPresencial($details));
            }
        }
        Mail::to($payer->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));


        Alert::success('Registro con exito', 'Se ha registrado con exito');
        return back()->with('success', 'Inscrito correctamente');
    }

    public function addToCart($id)
    {
        $cart = session()->get('cart', []);

        $product = CursosTickets::findOrFail($id);
        if ($product->descuento == NULL) {
            $precio = $product->precio;
        } else {
            $precio = $product->descuento;
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {

            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->nombre,
                "curso" => $product->id_curso,
                "quantity" => 1,
                "price" => $precio,
                "paquete" => 0,
                "image" => $product->imagen
            ];
        }

        session()->put('cart', $cart);
        Session::flash('modal_checkout', 'Se ha Abierto el checkout');
        return redirect()->back()->with('success', '¡Producto agregado');
    }

    public function aplicarCupon(Request $request){

        $coupon = Cupon::where('nombre', $request->coupon)
        ->where('estado', '=', 'activo')
        ->first();

        if (!$coupon) {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'Cupón inválido');
        }

        if ($coupon->fecha_inicio && $coupon->fecha_fin < now()) {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'Cupón caducado');
        }

        if (session()->has('coupon_applied')) {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'Cupón ya aplicado');
        }

        foreach (session('cart') as $id => $details) {
            // Aplicar descuento al precio del producto
            $discountedPrice = $details['price'] - ($details['price'] * $coupon->importe / 100);

            // Actualizar precio del producto en la sesión del carrito
            session()->put("cart.{$id}.price", $discountedPrice);
        }
        $cart = session('cart');
        // Almacenar que el cupón ya se ha aplicado en la sesión
        session()->put('coupon_applied', true);

        Session::flash('modal_checkout', 'Se ha Abierto el checkout');
        return redirect()->back()->with('success', 'Cupón aplicado con éxito');
    }

    public function removeCoupon(){
        session()->forget('coupon_applied');

        foreach (session('cart') as $id => $details) {
            // Restablecer el precio original del producto
            $originalPrice = CursosTickets::where('id', $id)->value('precio');

            // Actualizar precio del producto en la sesión del carrito
            session()->put("cart.{$id}.price", $originalPrice);
        }

        Session::flash('modal_checkout', 'Se ha Abierto el checkout');
        return redirect()->back()->with('warning', 'Cupón eliminado con éxito');
    }

    public function resultado(Request $request)
    {
        $fechaActual = date('Y-m-d');
        Session::forget('cart');
        if ($request->input('paquete') == 1) {
            $total = 1350;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas'));
            $curso = CursosTickets::where('nombre', '=', 'Diplomado de Cosmetología Facial y Corporal')
                ->where('fecha_final', '>=', $fechaActual)
                ->first();
            if ($curso != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $curso->id,
                    "name" => $curso->nombre,
                    "curso" => $curso->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $curso->imagen
                ];
            }

            $canasta = CursosTickets::where('nombre', '=', $request->input('canasta'))
                ->first();
            $cart = session()->get('cart', []);
            $cart[] = [
                "id" => $canasta->id,
                "name" => $canasta->nombre,
                "curso" => $canasta->id_curso,
                "quantity" => 1,
                "price" => 0,
                "paquete" => 1,
                "image" => $canasta->imagen
            ];
            session()->put('cart', $cart);
        } elseif ($request->input('paquete') == 2) {
            $total = 2000;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas2'));
            $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Diplomado de Cosmetología Facial y Corporal')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($curso != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $curso->id,
                    "name" => $curso->nombre,
                    "curso" => $curso->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $curso->imagen
                ];
                session()->put('cart', $cart);
            }

            $aparatologia = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Diplomado de regulación y administración de spa ante COFEPRIS')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($aparatologia != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $aparatologia->id,
                    "name" => $aparatologia->nombre,
                    "curso" => $aparatologia->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $aparatologia->imagen
                ];
                session()->put('cart', $cart);
            }

            $canasta = CursosTickets::where('nombre', '=', $request->input('canasta'))
                ->first();
            $cart = session()->get('cart', []);
            $cart[] = [
                "id" => $canasta->id,
                "name" => $canasta->nombre,
                "curso" => $canasta->id_curso,
                "quantity" => 1,
                "price" => 0,
                "paquete" => 1,
                "image" => $canasta->imagen
            ];
            session()->put('cart', $cart);
        } elseif ($request->input('paquete') == 3) {
            $total = 2750;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas3'));
            $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Diplomado de Cosmetología Facial y Corporal')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($curso != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $curso->id,
                    "name" => $curso->nombre,
                    "curso" => $curso->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $curso->imagen
                ];
                session()->put('cart', $cart);
            }

            $carrera = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Carrera de Cosmiatria Estética')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($carrera != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $carrera->id,
                    "name" => $carrera->nombre,
                    "curso" => $carrera->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $carrera->imagen
                ];
                session()->put('cart', $cart);
            }

            $canasta = CursosTickets::where('nombre', '=', $request->input('canasta'))
                ->first();
            $cart = session()->get('cart', []);
            $cart[] = [
                "id" => $canasta->id,
                "name" => $canasta->nombre,
                "curso" => $canasta->id_curso,
                "quantity" => 1,
                "price" => 0,
                "paquete" => 1,
                "image" => $canasta->imagen
            ];
            session()->put('cart', $cart);
        } elseif ($request->input('paquete') == 4) {
            $total = 3250;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas4'));
            $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Diplomado de Cosmetología Facial y Corporal')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();

            if ($curso != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $curso->id,
                    "name" => $curso->nombre,
                    "curso" => $curso->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $curso->imagen
                ];
                session()->put('cart', $cart);
            }

            $spa = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Diplomado de regulación y administración de spa ante COFEPRIS')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($spa != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $spa->id,
                    "name" => $spa->nombre,
                    "curso" => $spa->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $spa->imagen
                ];
                session()->put('cart', $cart);
            }
            $carrera = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Carrera de Cosmiatria Estética')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($carrera != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $carrera->id,
                    "name" => $carrera->nombre,
                    "curso" => $carrera->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $carrera->imagen
                ];
                session()->put('cart', $cart);
            }

            $canasta = CursosTickets::where('nombre', '=', $request->input('canasta'))
                ->first();
            $cart = session()->get('cart', []);
            $cart[] = [
                "id" => $canasta->id,
                "name" => $canasta->nombre,
                "curso" => $canasta->id_curso,
                "quantity" => 1,
                "price" => 0,
                "paquete" => 1,
                "image" => $canasta->imagen
            ];
            session()->put('cart', $cart);
        } elseif ($request->input('paquete') == 5) {
            $total = 3625;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas5'));
            $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Diplomado de Cosmetología Facial y Corporal')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();

            if ($curso != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $curso->id,
                    "name" => $curso->nombre,
                    "curso" => $curso->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $curso->imagen
                ];
                session()->put('cart', $cart);
            }

            $spa = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Diplomado de regulación y administración de spa ante COFEPRIS')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($spa != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $spa->id,
                    "name" => $spa->nombre,
                    "curso" => $spa->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $spa->imagen
                ];
                session()->put('cart', $cart);
            }
            $carrera = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Carrera de Cosmiatria Estética')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($carrera != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $carrera->id,
                    "name" => $carrera->nombre,
                    "curso" => $carrera->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $carrera->imagen
                ];
                session()->put('cart', $cart);
            }
            $post = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', 'Diplomado de Post Operatorio Facial y Corporal')
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->select('cursos_tickets.*')
                ->first();
            if ($post != null) {
                $cart = session()->get('cart', []);
                $cart[] = [
                    "id" => $post->id,
                    "name" => $post->nombre,
                    "curso" => $post->id_curso,
                    "quantity" => 1,
                    "price" => 0,
                    "paquete" => 1,
                    "image" => $post->imagen
                ];
                session()->put('cart', $cart);
            }

            $canasta = CursosTickets::where('nombre', '=', $request->input('canasta'))
                ->first();
            $cart = session()->get('cart', []);
            $cart[] = [
                "id" => $canasta->id,
                "name" => $canasta->nombre,
                "curso" => $canasta->id_curso,
                "quantity" => 1,
                "price" => 0,
                "paquete" => 1,
                "image" => $canasta->imagen
            ];
            session()->put('cart', $cart);
        }
        $ticketsSeleccionados = CursosTickets::whereIn('id', $opcionesSeleccionadas)->get();
        for ($i = 0; $i < count($ticketsSeleccionados); $i++) {
            $cart[$ticketsSeleccionados[$i]->id] = [
                "id" => $ticketsSeleccionados[$i]->id,
                "name" => $ticketsSeleccionados[$i]->nombre,
                "curso" => $ticketsSeleccionados[$i]->id_curso,
                "quantity" => 1,
                "price" => $total,
                "paquete" => 1,
                "image" => $ticketsSeleccionados[$i]->imagen
            ];
            session()->put('cart', $cart);
        }

        // session()->flash('addedToCart', true);
        Session::flash('modal_checkout', 'Se ha Abierto el checkout');
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function vaciar_carrito(Request $request)
    {
        Session::forget('cart');
        return redirect()->back()->with('warning', 'Se ha vaciado el carrito');
    }

    public function remove(Request $request)
    {

        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            session()->flash('warning', 'Producto eliminado del carrito');
        }
    }
}
