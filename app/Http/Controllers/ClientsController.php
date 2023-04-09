<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;

class ClientsController extends Controller
{
    public function index($code){
        $cliente = User::where('code', $code)->firstOrFail();
        $orders = Orders::where('id_usuario', '=', auth()->user()->id)->get();
        $order_ticket = OrdersTickets::where('id_usuario', '=', auth()->user()->id)->get();
        
        $usuarioId = Auth::id(); // Obtén el ID del usuario logueado
        // Verifica si el usuario ha comprado un ticket para el curso
        $usuario_compro = OrdersTickets::join('cursos', 'orders_tickets.id_curso', '=', 'cursos.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('cursos.video_cad','=', 1)
                        ->get();
        return view('user.profile',compact('cliente', 'orders', 'usuario_compro', 'order_ticket'));
    }

    public function update(Request $request, $code)
    {
        $user = User::where('code', $code)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->telefono = $request->get('telefono');
        $user->password = Hash::make($request->get('telefono'));
        $user->cfdi = $request->get('cfdi');
        $user->rfc = $request->get('rfc');
        $user->razon_social = $request->get('razon_social');
        $user->direccion = $request->get('direccion');
        $user->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('perfil.index', $code)
            ->with('success', 'usuario editado con exito.');
    }
}
