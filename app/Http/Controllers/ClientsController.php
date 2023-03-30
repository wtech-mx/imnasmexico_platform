<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersTickets;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $cliente = User::find(auth()->user()->id);
        $orders = Orders::where('id_usuario', '=', auth()->user()->id)->get();
        $order_ticket = OrdersTickets::get();

        return view('user.profile',compact('cliente', 'orders'));
    }
}
