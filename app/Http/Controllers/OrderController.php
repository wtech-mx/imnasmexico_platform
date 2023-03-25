<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\Orders;
use App\Models\OrdersTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use session;

class OrderController extends Controller
{
    public function add_to_cart(CursosTickets $ticket){
        dd($ticket);
    }

    public function show($order){
        $order = Orders::findOrFail($order);
        $order_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();

        return view('user.order', compact('order', 'order_ticket'));
    }

    public function pay(Orders $order, Request $request){
        $fechaActual = date('Y-m-d');
        $total = 0;
        foreach(session('cart') as $id => $details){
            $total += $details['price'] * $details['quantity'];
        }

        $order = new Orders;
        $order->id_usuario = 1;
        $order->pago = $total ;
        $order->forma_pago = 'Mercado Pago';
        $order->fecha = $fechaActual ;
        $order->estatus = 0;
        $order->save();

        foreach(session('cart') as $id => $details){
            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_tickets = $details['id'];
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
        }elseif($status == 'approved'){
            $order = Orders::find($order->id);
            $order->num_order = $payment_id;
            $order->estatus = 1;
            $order->update();

            $request->session()->flush();
        }

        return redirect()->route('order.show', $order);
    }

    public function addToCart($id)

    {
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
            $cart = session()->get('cart');
                unset($cart);
                session()->put('cart', $cart);
            session()->flash('success', 'Product removed successfully');
    }

}
