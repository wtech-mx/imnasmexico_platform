<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Tipodocumentos;
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
use App\Mail\PlantillaDocumentoStps;
use App\Models\Paquetes;
use App\Models\PaquetesIncluye;
use App\Models\RegistroImnas;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use MercadoPago\{Exception, SDK, Preference, Item};
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Codexshaper\WooCommerce\Facades\Product;
use Order;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


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
            $payer->name = $request->get('name') . ' ' . $request->get('ape_paterno') . ' ' . $request->get('ape_materno');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
           // Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
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

                if($details['curso'] == 647){
                    for ($i = 0; $i < $details['quantity']; $i++) {
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $details['id'];
                        $envio->tipo = ($details['id'] == 1009) ? 2 : 1;
                        $envio->save();
                    }

                    $user_registro_imnas = User::where('id', $payer->id)->first();
                    $user_registro_imnas->registro_imnas = '1';
                    $user_registro_imnas->update();
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

        $request->validate([
            'name' => 'required|string|regex:/^[^@.%\/&$#]+$/',
        ]);

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

    public function aplicarCuponNas(Request $request){

        $coupon = Cupon::where('nombre', $request->coupon)->where('tipo', 'nas')->first();

        $cart = session('cart_productos');
        $containsDiplomado = false;
        $totalCartPrice = 0;

        if (! $coupon) {
            return redirect()->back()
            ->with('swal', [
                'icon'    => 'error',
                'title'   => 'Cupón inválido',
                'text'    => 'El cupón que ingresaste no existe.',
                'timer'   => 3000,      // opcional: cierra tras 3s
                'confirm' => false      // opcional: sin botón "Aceptar"
            ]);
        }

        foreach ($cart as $id => $details) {
            $totalCartPrice += $details['precio'] * $details['cantidad'];
        }

        if ($coupon->estado == 'desactivado') {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'Cupón caducado');
        }

        // Verificar el gasto mínimo requerido por el cupón
        if ($totalCartPrice < $coupon->gasto_min) {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'No puedes aplicar este cupón ya que el gasto mínimo requerido no se ha alcanzado.');
        }

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

        // Verificar di existe un Diplomado
        if ($containsDiplomado) {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'No puedes aplicar este cupón a productos tipo "Diplomado" en tu carrito.');
        }

        foreach (session('cart_productos') as $id => $details) {
            if ($coupon->tiene_limite) {
                // Restar 1 al contador de usos restantes solo si el cupón tiene límite
                $coupon->decrement('usos_restantes', 1);
            }
            // Aplicar descuento al precio del producto
            $discountedPrice = $details['precio'] - ($details['precio'] * $coupon->importe / 100);

            // Actualizar precio del producto en la sesión del carrito
            session()->put("cart_productos.{$id}.precio", $discountedPrice);
        }
        $cart = session('cart_productos');
        // Almacenar que el cupón ya se ha aplicado en la sesión
        session()->put('coupon_applied', true);

        Session::flash('modal_checkout', 'Se ha Abierto el checkout');
        return redirect()->back()->with('success', 'Cupón aplicado con éxito');
    }

    public function pagar_registro(Request $request)
    {
        // Configurar el SDK de Mercado Pago con las credenciales de API
        SDK::setAccessToken(config('services.mercadopago.token'));

        // Crear un objeto de preferencia de pago
        $preference = new Preference();
        $code = Str::random(8);

        $item = new Item();
        $item->title = 'Pago Registro IMNAS';
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

        $request->validate([
            'name' => 'required|string|regex:/^[^@.%\/&$#]+$/',
        ]);

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
            $order_ticket->id_tickets = 1008;
            $order_ticket->id_curso = 647;
            $order_ticket->save();

            $envio = new RegistroImnas;
            $envio->id_order = $order->id;
            $envio->id_usuario = $payer->id;
            $envio->tipo = 1;
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
            $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=TEST-3105049862829838-031417-76d6b6648d0ba342c635d268cd25ba10-236513607");
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
            }else if($orden_ticket2->id_curso == 647){
                $cliente = User::where('id', '=', $order->id_usuario)->first();
                $cliente->registro_imnas = 1;
                $cliente->update();
            }else{

                $email_diplomas = 'imnascenter@naturalesainspa.com';
                $destinatario = [ $order->User->email  , $email_diplomas];
                $datos = $order->User->name;

                foreach ($orden_ticket as $details) {

                    $curso = $details->Cursos->nombre;
                    $fecha = $details->Cursos->fecha_inicial;
                    $nombre = $order->User->name;
                    $horas_default = "24";
                    $duracion_hrs = $horas_default;
                    $tipo_documentos = Tipodocumentos::first();

                    if ($details->Cursos->modalidad == 'Online') {
                        Mail::to($order->User->email)->send(new PlantillaTicket($details));
                    } else {
                        Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
                    }

                    if($details->Cursos->certificacion_webinar == 1){
                        $user_certificacion = User::where('id', $order->User->id)->first();
                        $user_certificacion->estatus_constancia = 'documentos';
                        $user_certificacion->agendar_cita = 1;
                        $user_certificacion->update();
                    }

                    if($details->CursosTickets->descripcion == 'Con opción a Documentos de certificadora IMNAS'){

                    }else{
                        if($details->Cursos->stps == '1' && $details->Cursos->titulo_hono == '1'){
                            $id_ticket = $orden_ticket2->id;
                            $ticket = OrdersTickets::find($id_ticket);
                            $ticket->estatus_doc = '1';
                            $ticket->estatus_cedula = '1';
                            $ticket->estatus_diploma = '1';
                            $ticket->estatus_credencial = '1';
                            $ticket->estatus_tira = '1';
                            $ticket->update();
                            $sello = 'Si';

                            if($ticket->Cursos->pack_stps == "Si"){
                                $variables = [
                                    $ticket->Cursos->p_stps_1,
                                    $ticket->Cursos->p_stps_2,
                                    $ticket->Cursos->p_stps_3,
                                    $ticket->Cursos->p_stps_4,
                                    $ticket->Cursos->p_stps_5,
                                    $ticket->Cursos->p_stps_6,
                                ];

                                foreach ($variables as $index => $curso) {
                                    if (isset($curso) && !empty($curso)) {
                                        // Lógica para crear el PDF y enviar el correo aquí
                                        $pdf = PDF::loadView('admin.pdf.diploma_stps', compact('curso', 'fecha', 'tipo_documentos', 'nombre','horas_default','sello'));
                                        $pdf->setPaper('A4', 'portrait');
                                        $contenidoPDF = $pdf->output();

                                        Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
                                    }
                                }
                            }else{
                                $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','horas_default','sello'));
                                $pdf->setPaper('A4', 'portrait');
                                $contenidoPDF = $pdf->output();
                                Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
                            }

                        }
                        if($details->Cursos->stps == '1' && $details->Cursos->titulo_hono == NULL){
                            $id_ticket = $orden_ticket2->id;
                            $ticket = OrdersTickets::find($id_ticket);
                            $ticket->estatus_doc = '1';
                            $ticket->estatus_cedula = '1';
                            $ticket->estatus_titulo = '1';
                            $ticket->estatus_diploma = '1';
                            $ticket->estatus_credencial = '1';
                            $ticket->estatus_tira = '1';
                            $ticket->update();
                            $sello = 'Si';

                            if($ticket->Cursos->pack_stps == "Si"){
                                $variables = [
                                    $ticket->Cursos->p_stps_1,
                                    $ticket->Cursos->p_stps_2,
                                    $ticket->Cursos->p_stps_3,
                                    $ticket->Cursos->p_stps_4,
                                    $ticket->Cursos->p_stps_5,
                                    $ticket->Cursos->p_stps_6,
                                ];

                                foreach ($variables as $index => $curso) {
                                    if (isset($curso) && !empty($curso)) {
                                        // Lógica para crear el PDF y enviar el correo aquí
                                        $pdf = PDF::loadView('admin.pdf.diploma_stps', compact('curso', 'fecha', 'tipo_documentos', 'nombre','horas_default','sello'));
                                        $pdf->setPaper('A4', 'portrait');
                                        $contenidoPDF = $pdf->output();

                                        Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
                                    }
                                }
                            }else{
                                $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','horas_default','sello'));
                                $pdf->setPaper('A4', 'portrait');
                                $contenidoPDF = $pdf->output();
                                Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
                            }

                        }
                    }

                }
               // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));
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

            if($orden_ticket2->id_curso == 647){
                $cliente = User::where('id', '=', $order->id_usuario)->first();
                $cliente->registro_imnas = 1;
                $cliente->update();
            }

            Session::forget('cart');
        }
        return redirect()->route('order.show', $order->code);
    }

    public function pay_stripe(Orders $order, Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[^@.%\/&$#]+$/',
        ]);
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
          //  Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
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
        $order->factura = '1';
        $order->save();

        foreach (session('cart') as $id => $details) {
            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = $payer->id;
            $order_ticket->id_tickets = $details['id'];
            $order_ticket->id_curso = $details['curso'];
            $order_ticket->save();

            if($details['curso'] == 647){
                $envio = new RegistroImnas;
                $envio->id_order = $order->id;
                $envio->id_usuario = $payer->id;
                if($details['id'] == 1009){
                    $envio->tipo = 2;
                }else{
                    $envio->tipo = 1;
                }
                $envio->save();

                $user_registro_imnas = User::where('id', $payer->id)->first();
                $user_registro_imnas->registro_imnas = '1';
                $user_registro_imnas->update();
            }

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

            if($orden_ticket2->Cursos->certificacion_webinar == 1){
                $user_certificacion = User::where('id', $orden_ticket2->User->id)->first();
                $user_certificacion->estatus_constancia = 'documentos';
                $user_certificacion->agendar_cita = 1;
                $user_certificacion->update();
            }

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
          //  Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pago_fuera';
        }

        $order = new Orders;
        $order->id_usuario = $payer->id;
        $order->pago = $request->precio;
        $order->forma_pago = $request->forma_pago;
        $order->fecha = $fechaActual;
        $order->estatus = 1;
        $order->code = $code;
        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $order->foto = $fileName;
        }
        $order->save();

        $order_ticket = new OrdersTickets;
        $order_ticket->id_order = $order->id;
        $order_ticket->id_tickets = $request->ticket;
        $order_ticket->id_usuario = $payer->id;
        $order_ticket->id_curso = $request->curso;
        $order_ticket->save();

        if($order_ticket->Cursos->certificacion_webinar == 1){
            $user_certificacion = User::where('id', $order_ticket->User->id)->first();
            $user_certificacion->estatus_constancia = 'documentos';
            $user_certificacion->agendar_cita = 1;
            $user_certificacion->update();
        }

        // Enviar el correo electrónico
        $datos = User::where('id', '=', $payer->id)->first();
        $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
        $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
        $user = $orden_ticket2->User->name;
        $id_order = $orden_ticket2->id_order;
        $pago = $request->precio;
        $forma_pago = $orden_ticket2->Orders->forma_pago;

        $email_diplomas = 'imnascenter@naturalesainspa.com';
        $destinatario = [ $order->User->email  , $email_diplomas];
        $datos = $order->User->name;

        foreach ($orden_ticket as $details) {

            $curso = $details->Cursos->nombre;
            $fecha = $details->Cursos->fecha_inicial;
            $nombre = $order->User->name;
            $horas_default = "24";
            $duracion_hrs = $horas_default;
            $tipo_documentos = Tipodocumentos::first();

            if($details->Cursos->stps == '1'){
                $id_ticket = $order_ticket->id;
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_doc = '1';
                $ticket->estatus_cedula = '1';
                $ticket->estatus_titulo = '1';
                $ticket->estatus_diploma = '1';
                $ticket->estatus_credencial = '1';
                $ticket->estatus_tira = '1';
                $ticket->update();

                $sello = 'Si';

                $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','horas_default','sello'));
                $pdf->setPaper('A4', 'portrait');
                $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.
                Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
            }

        }
        Mail::to($payer->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()->with('success', 'Inscrito correctamente');
    }

    public function clases_gratis(Request $request)
    {

        $request->validate([
            'name' => 'required|string|regex:/^[^@.%\/&$#]+$/',
            'ape_paterno' => 'required|string',
            'ape_materno' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string|min:10|max:10',
        ]);

        $recaptchaSecret = '6LflbR0qAAAAAF-I8wYNasutQ9NS-nL6alWy5jCa';
        $token = $request->input('token');

        $cu = curl_init();
        curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($cu, CURLOPT_POST, 1);
        curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(['secret' => $recaptchaSecret, 'response' => $token]));
        curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cu);
        curl_close($cu);

        $datos = json_decode($response, true);

      //  if ($datos['success'] && $datos['score'] >= 0.5 && $datos['action'] == 'clases_gratis') {

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
                $payer->name = $request->get('name') . ' ' . $request->get('ape_paterno') . ' ' . $request->get('ape_materno');
                $payer->email = $request->get('email');
                $payer->username = $request->get('telefono');
                $payer->code = $code;
                $payer->telefono = $request->get('telefono');
                $payer->cliente = '1';
                $payer->password = Hash::make($request->get('telefono'));
                $payer->save();
                $datos = User::where('id', '=', $payer->id)->first();
            // Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
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

            if($order_ticket->Cursos->certificacion_webinar == 1){
                $user_certificacion = User::where('id', $order_ticket->User->id)->first();
                $user_certificacion->estatus_constancia = 'documentos';
                $user_certificacion->agendar_cita = 1;
                $user_certificacion->update();
            }

            // Enviar el correo electrónico
            $datos = User::where('id', '=', $payer->id)->first();
            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
            $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
            $user = $orden_ticket2->User->name;
            $id_order = $orden_ticket2->id_order;
            $pago = $orden_ticket2->Orders->pago;
            $forma_pago = $orden_ticket2->Orders->forma_pago;

            $email_diplomas = 'imnascenter@naturalesainspa.com';
            $destinatario = [ $order->User->email  , $email_diplomas];
            $datos = $order->User->name;

            foreach ($orden_ticket as $details) {

                $curso = $details->Cursos->nombre;
                $fecha = $details->Cursos->fecha_inicial;
                $nombre = $order->User->name;
                $horas_default = "24";
                $duracion_hrs = $horas_default;
                $tipo_documentos = Tipodocumentos::first();

                if ($details->Cursos->modalidad == 'Online') {
                    Mail::to($payer->email)->send(new PlantillaTicket($details));
                } else {
                    Mail::to($payer->email)->send(new PlantillaTicketPresencial($details));
                }

                if($details->Cursos->stps == '1'){
                    $id_ticket = $order_ticket->id;
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_doc = '1';
                    $ticket->estatus_cedula = '1';
                    $ticket->estatus_titulo = '1';
                    $ticket->estatus_diploma = '1';
                    $ticket->estatus_credencial = '1';
                    $ticket->estatus_tira = '1';
                    $ticket->update();

                    $sello = 'Si';

                    $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','horas_default','sello'));
                    $pdf->setPaper('A4', 'portrait');
                    $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.
                    Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
                }
            }
            Mail::to($payer->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));


            Alert::success('Registro con exito', 'Se ha registrado con exito');
            return back()->with('success', 'Inscrito correctamente');
        // } else {

        //     return back()->with('error', 'Error de verificación reCAPTCHA. Por favor, inténtalo de nuevo.');
        // }
    }

    public function addToCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        $product = CursosTickets::findOrFail($id);

        // Establecer cantidad predeterminada si no se proporciona
        $requestQuantity = $request->quantity ?? 1;

        // Obtener la cantidad actual en el carrito
        $currentQuantity = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $newQuantity = $currentQuantity + $requestQuantity;

        // Determinar el precio según las condiciones
        if ($id == 1369 && $newQuantity >= 15) {
            $precio = $product->descuento;
        } else {
            if ($id == 1369) {
                $precio = $product->precio;
            } else {
                $precio = $product->descuento === null ? $product->precio : $product->descuento;
            }
        }

        if ($id == 1373) {
            $requestQuantity = 30;
        }

        if (isset($cart[$id])) {
            // Actualizar cantidad y precio en el carrito
            $cart[$id]['quantity'] += $requestQuantity;
            $cart[$id]['price'] = $precio;
        } else {
            // Agregar un nuevo producto al carrito
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->nombre,
                "curso" => $product->id_curso,
                "quantity" => $requestQuantity,
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
        ->where('tipo', 'cursos')
        ->first();

        $cart = session('cart');
        $containsDiplomado = false;
        $totalCartPrice = 0;

        foreach ($cart as $id => $details) {
            if (isset($details['name']) && stripos($details['name'], 'Diplomado') !== false) {
                $containsDiplomado = true;
                break;
            }
        }

        foreach ($cart as $id => $details) {
            $totalCartPrice += $details['price'] * $details['quantity'];
        }

        if ($coupon->estado == 'desactivado') {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'Cupón caducado');
        }

        // Verificar el gasto mínimo requerido por el cupón
        if ($totalCartPrice < $coupon->gasto_min) {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'No puedes aplicar este cupón ya que el gasto mínimo requerido no se ha alcanzado.');
        }

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

        // Verificar di existe un Diplomado
        if ($containsDiplomado) {
            Session::flash('modal_checkout', 'Se ha Abierto el checkout');
            return redirect()->back()->with('warning', 'No puedes aplicar este cupón a productos tipo "Diplomado" en tu carrito.');
        }

        foreach (session('cart') as $id => $details) {
            if ($coupon->tiene_limite) {
                // Restar 1 al contador de usos restantes solo si el cupón tiene límite
                $coupon->decrement('usos_restantes', 1);
            }
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
        $paquete = Paquetes::first();
        $fechaActual = date('Y-m-d');
        Session::forget('cart');
        if ($request->input('paquete') == 1) {
            $total = $paquete->precio_curso_1;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas'));
            $paquetesIncluye = PaquetesIncluye::where('num_paquete', '=', 1)->get();
            foreach ($paquetesIncluye as $paquete) {
                $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', $paquete->nombre_curso)
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->where('cursos.diplomado_colores', '=', null)
                ->select('cursos_tickets.*')
                ->first();

                if ($curso != null) {
                    $cart = session()->get('cart', []);
                    $cart[] = [
                        "id" => $curso->id,
                        "name" => $curso->nombre,
                        "curso" => $curso->id_curso,
                        "quantity" => 1,
                        "price" => $total,
                        "paquete" => $paquete->num_paquete,
                        "image" => $curso->imagen
                    ];
                   session()->put('cart', $cart);
                }else{

                    return view('errors.sin_cursospaquetes');
                }

            }
        } elseif ($request->input('paquete') == 2) {
            $total = $paquete->precio_curso_2;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas2'));
            $paquetesIncluye = PaquetesIncluye::where('num_paquete', '=', 2)->get();
            foreach ($paquetesIncluye as $paquete) {
                $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', $paquete->nombre_curso)
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->where('cursos.diplomado_colores', '=', null)
                ->select('cursos_tickets.*')
                ->first();

                if ($curso != null) {
                    $cart = session()->get('cart', []);
                    $cart[] = [
                        "id" => $curso->id,
                        "name" => $curso->nombre,
                        "curso" => $curso->id_curso,
                        "quantity" => 1,
                        "price" => $total,
                        "paquete" => $paquete->num_paquete,
                        "image" => $curso->imagen
                    ];
                    session()->put('cart', $cart);
                }else{

                    return view('errors.sin_cursospaquetes');
                }
            }

        } elseif ($request->input('paquete') == 3) {
            $total = $paquete->precio_curso_3;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas3'));
            $paquetesIncluye = PaquetesIncluye::where('num_paquete', '=', 3)->get();
            foreach ($paquetesIncluye as $paquete) {
                $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', $paquete->nombre_curso)
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->where('cursos.diplomado_colores', '=', null)
                ->select('cursos_tickets.*')
                ->first();

                if ($curso != null) {
                    $cart = session()->get('cart', []);
                    $cart[] = [
                        "id" => $curso->id,
                        "name" => $curso->nombre,
                        "curso" => $curso->id_curso,
                        "quantity" => 1,
                        "price" => $total,
                        "paquete" => $paquete->num_paquete,
                        "image" => $curso->imagen
                    ];
                    session()->put('cart', $cart);
                }else{

                    return view('errors.sin_cursospaquetes');
                }
            }
        } elseif ($request->input('paquete') == 4) {
            $total = $paquete->precio_curso_4;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas4'));
            $paquetesIncluye = PaquetesIncluye::where('num_paquete', '=', 4)->get();
            foreach ($paquetesIncluye as $paquete) {
                $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', $paquete->nombre_curso)
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->where('cursos.diplomado_colores', '=', null)
                ->select('cursos_tickets.*')
                ->first();

                if ($curso != null) {
                    $cart = session()->get('cart', []);
                    $cart[] = [
                        "id" => $curso->id,
                        "name" => $curso->nombre,
                        "curso" => $curso->id_curso,
                        "quantity" => 1,
                        "price" => $total,
                        "paquete" => $paquete->num_paquete,
                        "image" => $curso->imagen
                    ];
                    session()->put('cart', $cart);
                }else{

                    return view('errors.sin_cursospaquetes');
                }
            }
        } elseif ($request->input('paquete') == 5) {
            $total = $paquete->precio_curso_5;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas5'));
            $paquetesIncluye = PaquetesIncluye::where('num_paquete', '=', 5)->get();
            foreach ($paquetesIncluye as $paquete) {
                $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', $paquete->nombre_curso)
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->where('cursos.diplomado_colores', '=', null)
                ->select('cursos_tickets.*')
                ->first();

                if ($curso != null) {
                    $cart = session()->get('cart', []);
                    $cart[] = [
                        "id" => $curso->id,
                        "name" => $curso->nombre,
                        "curso" => $curso->id_curso,
                        "quantity" => 1,
                        "price" => $total,
                        "paquete" => $paquete->num_paquete,
                        "image" => $curso->imagen
                    ];
                    session()->put('cart', $cart);
                }else{

                    return view('errors.sin_cursospaquetes');
                }
            }
        } elseif ($request->input('paquete') == 6) {
            $total = $paquete->precio_curso_6;
            $opcionesSeleccionadas = explode('|', $request->input('opciones_seleccionadas6'));
            $paquetesIncluye = PaquetesIncluye::where('num_paquete', '=', 6)->get();
            foreach ($paquetesIncluye as $paquete) {
                $curso = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
                ->where('cursos.nombre', '=', $paquete->nombre_curso)
                ->where('cursos.fecha_final', '>=', $fechaActual)
                ->where('cursos.modalidad', '=', 'Online')
                ->where('cursos.diplomado_colores', '=', null)
                ->whereBetween('cursos.fecha_inicial', ['2025-01-01', '2025-01-31'])
                ->select('cursos_tickets.*')
                ->first();

                if ($curso != null) {
                    $cart = session()->get('cart', []);
                    $cart[] = [
                        "id" => $curso->id,
                        "name" => $curso->nombre,
                        "curso" => $curso->id_curso,
                        "quantity" => 1,
                        "price" => $total,
                        "paquete" => $paquete->num_paquete,
                        "image" => $curso->imagen
                    ];
                    session()->put('cart', $cart);
                }else{

                    return view('errors.sin_cursospaquetes');
                }
            }
        }


        // session()->flash('addedToCart', true);
        Session::flash('modal_checkout', 'Se ha Abierto el checkout');
        return redirect()->back()->with('success', 'Paquete agregado con exito');
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
