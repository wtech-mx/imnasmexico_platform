<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function add_to_cart(CursosTickets $ticket){
        dd($ticket);
    }

    public function pay(Orders $order, Request $request){
        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-7084001530614040-031418-70b92db902566a519042ec6bd85289b3-1330780039");
        $response = json_decode($response);

        $status = $response->status;


        dump($response);
    }
}
