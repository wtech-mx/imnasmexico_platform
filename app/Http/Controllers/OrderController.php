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
use App\Mail\PlantillaTicket;
use Stripe;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function show($code){
        $order = Orders::where('code', $code)->firstOrFail();
        $order_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();

        return view('user.order', compact('order', 'order_ticket'));
    }

    public function pay(Orders $order, Request $request){
        $fechaActual = date('Y-m-d');
        $total = 0;
        foreach(session('cart') as $id => $details){
            $total += $details['price'] * $details['quantity'];
        }
        $code = Str::random(8);

        $order = new Orders;
        $order->id_usuario = 1;
        $order->pago = $total ;
        $order->forma_pago = 'Mercado Pago';
        $order->fecha = $fechaActual ;
        $order->estatus = 0;
        $order->code = $code;
        $order->save();

        foreach(session('cart') as $id => $details){
            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = 3;
            $order_ticket->id_tickets = $details['id'];
            $order_ticket->id_curso = $details['curso'];
            $order_ticket->save();
        }

        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-7084001530614040-031418-70b92db902566a519042ec6bd85289b3-1330780039");
        $response = json_decode($response);

        $status = $response->status;
        if($status == 'approved'){
            $order = Orders::find($order->id);
            $order->num_order = $payment_id;
            $order->estatus = 1;
            $order->update();

            $request->session()->flush();

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->first();
            Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            Mail::to($order->User->email)->send(new PlantillaTicket($orden_ticket));
        }

        return redirect()->route('order.show', $order);
    }

    public function pay_stripe(Orders $order, Request $request){
        $fechaActual = date('Y-m-d');
        $total = 0;
        foreach(session('cart') as $id => $details){
            $total += $details['price'] * $details['quantity'];
        }
        $code = Str::random(8);

        $order = new Orders;
        $order->id_usuario = 1;
        $order->pago = $total ;
        $order->forma_pago = 'STRIPE';
        $order->fecha = $fechaActual ;
        $order->estatus = 0;
        $order->code = $code;
        $order->save();

        foreach(session('cart') as $id => $details){
            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = 3;
            $order_ticket->id_tickets = $details['id'];
            $order_ticket->id_curso = $details['curso'];
            $order_ticket->save();
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe = Stripe\Charge::create ([
                "amount" => $total * 100,
                "currency" => "MXN",
                "source" => $request->stripeToken,
                "description" => $order_ticket->Cursos->nombre
        ]);

        if($stripe->status == 'succeeded'){
            $order = Orders::find($order->id);
            $order->num_order = $stripe->id;
            $order->estatus = 1;
            $order->update();

            $request->session()->flush();

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->first();
            Mail::to($order_ticket->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            Mail::to($order_ticket->User->email)->send(new PlantillaTicket($orden_ticket));
        }

        return redirect()->route('order.show', $order);
    }

    public function pay_externo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'telefono' => 'required'
        ]);
        $code = Str::random(8);
        if(User::where('telefono', $request->telefono)->exists()){
            $fechaActual = date('Y-m-d');
            $user = User::where('telefono', '=', $request->telefono)->first();
            $order = new Orders;
            $order->id_usuario = $user->id;
            $order->pago = $request->precio ;
            $order->forma_pago = 'Externo';
            $order->fecha = $fechaActual ;
            $order->estatus = 1;
            $order->code = $code;
            $order->save();

            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_tickets = $request->ticket;
            $order_ticket->id_usuario = $user->id;
            $order_ticket->id_curso = $request->curso;
            $order_ticket->save();

            $recibido = Orders::where('id', '=', $order->id)->first();
            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->first();

            Mail::to($request->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            Mail::to($request->email)->send(new PlantillaTicket($orden_ticket));
        }else{
            $fechaActual = date('Y-m-d');
            $user = new User;
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->telefono = $request->get('telefono');
            $user->cliente = '1';
            $user->password = Hash::make($request->get('telefono'));
            $user->save();

            $order = new Orders;
            $order->id_usuario = $user->id;
            $order->pago = $request->precio ;
            $order->forma_pago = 'Externo';
            $order->fecha = $fechaActual ;
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
            $recibido = Orders::where('id', '=', $order->id)->first();
            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->first();

            Mail::to($user->email)->send(new PlantillaNuevoUser($datos));
            Mail::to($user->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            Mail::to($user->email)->send(new PlantillaTicket($orden_ticket));
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return back()->with('success','User created successfully');
    }

    public function addToCart($id){
        $product = CursosTickets::findOrFail($id);
        $cart = session()->get('cart', []);

        if($product->descuento == NULL){
            $precio = $product->precio;
        }else{
            $precio = $product->descuento;
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [

                "id" => $product->id,
                "name" => $product->nombre,
                "curso" => $product->id_curso,
                "quantity" => 1,
                "price" => $precio,
                "image" => $product->imagen
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function update(Request $request){
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        $cart = $request->session()->forget('cart');
        // dd($cart);
        return redirect()->back();
    }

}
