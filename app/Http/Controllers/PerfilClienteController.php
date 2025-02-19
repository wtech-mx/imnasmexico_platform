<?php

namespace App\Http\Controllers;

use App\Models\Cosmikausers;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\Orders;
use App\Models\OrdersTickets;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilClienteController extends Controller
{
    public function index(){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        return view('admin.clientes.perfil.index',compact('clientes'));
    }

    public function buscador(Request $request){
        $id_client = $request->id_client;
        $phone = $request->phone;

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        if ($id_client !== null) {
            $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id_client)->first();
        } elseif ($phone !== null) {
            $cliente = User::where('cliente','=' ,'1')->where('id', '=', $phone)->first();
        }

        $distribuidora = Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id','DESC')->first();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora'));
    }

    public function informacion(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora'));
    }

    public function cursos(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cursos = OrdersTickets::join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders.id_usuario','=' ,$id)->where('orders.estatus','=' , '1')->get();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cursos'));
    }

    public function compras_tiendita(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $compras = NotasProductos::where('tipo_nota','=' , 'Venta Presencial')->where('id_usuario','=' ,$id)->get();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'compras'));
    }

    public function cotizaciones_nas(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cotizaciones = NotasProductos::where(function ($query) use ($id, $cliente) {
            $query->where('id_usuario', '=', $id);
            if ($cliente && $cliente->telefono) {
                $query->orWhere('telefono', '=', $cliente->telefono);
            }
        })->where('tipo_nota','=' , 'Cotizacion')->get();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cotizaciones'));
    }

    public function cotizaciones_cosmica(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cotizaciones_cosmica = NotasProductosCosmica::where(function ($query) use ($id, $cliente) {
            $query->where('id_usuario', '=', $id);
            if ($cliente && $cliente->telefono) {
                $query->orWhere('telefono', '=', $cliente->telefono);
            }
        })->get();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cotizaciones_cosmica'));
    }

    public function membresia_cosmica(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cosmica_user = Cosmikausers::where('id_cliente', '=', $id)->first();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cosmica_user'));
    }

}
