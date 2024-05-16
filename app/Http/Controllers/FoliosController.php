<?php

namespace App\Http\Controllers;

use App\Models\OrdersTickets;
use Illuminate\Http\Request;

class FoliosController extends Controller
{
    public function index(){

        return view('user.folio');
    }

    public function buscador(Request $request){

        $tickets = OrdersTickets::where('folio', '=', $request->get('folio'))->first();
        $folio = $request->get('folio');

        return view('user.folio',compact('tickets', 'folio'));
    }
}
