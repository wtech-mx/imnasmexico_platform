<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\Orders;
use App\Models\User;
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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use MercadoPago\{Exception, SDK, Preference, Item};
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
            $payer->telefono = $request->get('telefono');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
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

    public function pay(Orders $order, Request $request)
    {
        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-7084001530614040-031418-70b92db902566a519042ec6bd85289b3-1330780039");
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
            foreach ($orden_ticket as $details) {
                if($details->Cursos->modalidad == 'Online'){
                    Mail::to($order->User->email)->send(new PlantillaTicket($details));
                }else{
                    Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
                }
            }
            Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));

            Session::forget('cart');
        } elseif ($status == 'pending') {
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
                $user = User::where('telefono', $request->telefono)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }
            if ($user->cfdi == NULL) {
                $user->razon_social = $request->get('razon_social');
                $user->rfc = $request->get('rfc');
                $user->cfdi = $request->get('cfdi');
                $user->direccion = $request->get('direccion');
                $user->update();
            }
            $payer = $user;
        } else {
            $payer = new User;
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->telefono = $request->get('telefono');
            $payer->username = $request->get('telefono');
            $payer->razon_social = $request->get('razon_social');
            $payer->rfc = $request->get('rfc');
            $payer->cfdi = $request->get('cfdi');
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

        $stripe->withErrorUrl(route('403'));

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
                if($details->Cursos->modalidad == 'Online'){
                    Mail::to($order->User->email)->send(new PlantillaTicket($details));
                }else{
                    Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
                }
            }
            Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));
        }else{
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
        if (User::where('telefono', $request->telefono)->exists()) {
            $fechaActual = date('Y-m-d');
            $user = User::where('telefono', '=', $request->telefono)->first();
            $order = new Orders;
            $order->id_usuario = $user->id;
            $order->pago = $request->precio;
            $order->forma_pago = 'Externo';
            $order->fecha = $fechaActual;
            $order->estatus = 1;
            $order->code = $code;
            $order->save();

            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_tickets = $request->ticket;
            $order_ticket->id_usuario = $user->id;
            $order_ticket->id_curso = $request->curso;
            $order_ticket->save();

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
            $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
            $user = $orden_ticket2->User->name;
            $id_order = $orden_ticket2->id_order;
            $pago = $orden_ticket2->Orders->pago;
            $forma_pago = $orden_ticket2->Orders->forma_pago;
            // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            foreach ($orden_ticket as $details) {
                if($details->Cursos->modalidad == 'Online'){
                    Mail::to($user->email)->send(new PlantillaTicket($details));
                }else{
                    Mail::to($user->email)->send(new PlantillaTicketPresencial($details));
                }
            }
            Mail::to($user->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));
        } else {
            $code = Str::random(8);
            $fechaActual = date('Y-m-d');
            $user = new User;
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->username = $request->get('telefono');
            $user->code = $code;
            $user->telefono = $request->get('telefono');
            $user->cliente = '1';
            $user->password = Hash::make($request->get('telefono'));
            $user->save();

            $order = new Orders;
            $order->id_usuario = $user->id;
            $order->pago = $request->precio;
            $order->forma_pago = 'Externo';
            $order->fecha = $fechaActual;
            $order->estatus = 1;
            $order->code = $code;
            $order->save();

            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_tickets = $request->ticket;
            $order_ticket->id_usuario = $user->id;
            $order_ticket->id_curso = $request->curso;
            $order_ticket->save();

            // Enviar el correo electrónico
            $datos = User::where('id', '=', $user->id)->first();
            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
            $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
            $user = $orden_ticket2->User->name;
            $id_order = $orden_ticket2->id_order;
            $pago = $orden_ticket2->Orders->pago;
            $forma_pago = $orden_ticket2->Orders->forma_pago;

            foreach ($orden_ticket as $details) {
                if($details->Cursos->modalidad == 'Online'){
                    Mail::to($user->email)->send(new PlantillaTicket($details));
                }else{
                    Mail::to($user->email)->send(new PlantillaTicketPresencial($details));
                }
            }
            Mail::to($user->email)->send(new PlantillaNuevoUser($datos));
            Mail::to($user->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()->with('success', 'User created successfully');
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
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function resultado(Request $request)
    {
        $fechaActual = date('Y-m-d');
        Session::forget('cart');
        if ($request->input('paquete') == 1) {
            $total = 1500;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas'));
            $curso = CursosTickets::where('nombre', '=', 'Diplomado de Cosmetología Facial y Corporal')
            ->where('fecha_final', '>=', $fechaActual)
            ->first();
            if($curso != null){
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
            if($curso != null){
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
            if($aparatologia != null){
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
            if($curso != null){
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
            if($carrera != null){
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

            if($curso != null){
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
            if($spa != null){
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
            if($carrera != null){
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

            if($curso != null){
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
            if($spa != null){
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
            if($carrera != null){
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
            if($post != null){
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
        return redirect()->back()->with('success', 'Product removed successfully');
    }

    public function remove(Request $request)
    {

        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
