<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    public function index($code)
    {
        $cliente = User::where('code', $code)->firstOrFail();
        $orders = Orders::where('id_usuario', '=', auth()->user()->id)->get();
        $order_ticket = OrdersTickets::get();

        $usuarioId = Auth::id(); // Obtén el ID del usuario logueado
        // Verifica si el usuario ha comprado un ticket para el curso
        $usuario_compro = OrdersTickets::join('cursos', 'orders_tickets.id_curso', '=', 'cursos.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('cursos.video_cad','=', 1)
                        ->get();
        return view('user.profile',compact('cliente', 'orders', 'usuario_compro'));
    }
}
