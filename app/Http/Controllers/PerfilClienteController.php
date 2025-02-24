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

    public function searchName(Request $request){
        $search = $request->get('q');

        $users = User::where('name', 'LIKE', "%{$search}%")->get();
        $notasProductos = NotasProductos::where('nombre', 'LIKE', "%{$search}%")->get();
        $notasProductosCosmica = NotasProductosCosmica::where('nombre', 'LIKE', "%{$search}%")->get();

        // Combina los resultados y elimina duplicados
        $results = $users->merge($notasProductos)->merge($notasProductosCosmica)->unique('name');

        return response()->json($results);
    }

    public function searchPhone(Request $request){
        $search = $request->get('q');

        $users = User::where('telefono', 'LIKE', "%{$search}%")->get();
        $notasProductos = NotasProductos::where('telefono', 'LIKE', "%{$search}%")->get();
        $notasProductosCosmica = NotasProductosCosmica::where('telefono', 'LIKE', "%{$search}%")->get();

        // Combina los resultados y elimina duplicados
        $results = $users->merge($notasProductos)->merge($notasProductosCosmica)->unique('telefono');

        return response()->json($results);
    }

    public function buscador(Request $request)
    {
        $phone = $request->phone;
        $name = $request->name;

        $clientes = User::where('cliente', '=', '1')->orderBy('id', 'DESC')->get();
        $cliente = null;

        if ($phone !== null) {
            $cliente = User::where('cliente', '=', '1')->where('telefono', '=', $phone)->first();
            $tipo = 'Usuario';
            if (!$cliente) {
                $cliente = NotasProductos::where('telefono', '=', $phone)->first();
                $tipo = 'Nota';
            }

            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('telefono', '=', $phone)->first();
                $tipo = 'Nota';
            }
        }

        if ($name !== null) {
            $cliente = User::where('cliente', '=', '1')->where('name', '=', $name)->first();
            $tipo = 'Usuario';
            if (!$cliente) {
                $cliente = NotasProductos::where('nombre', '=', $name)->first();
                $tipo = 'Nota';
            }

            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('nombre', '=', $name)->first();
                $tipo = 'Nota';
            }
        }

        $distribuidora = $cliente ? Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id', 'DESC')->first() : null;

        return view('admin.clientes.perfil.index', compact('clientes', 'cliente', 'distribuidora', 'tipo'));
    }

    public function informacion(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();
        $tipo = 'Usuario';

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'tipo'));
    }

    public function cursos(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cursos = OrdersTickets::join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders.id_usuario','=' ,$id)->where('orders.estatus','=' , '1')->get();
        $tipo = 'Usuario';

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cursos', 'tipo'));
    }

    public function compras_tiendita(Request $request, $phone){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('telefono', '=', $phone)->first();
        if ($cliente) {
            $distribuidora = Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id','DESC')->first();
            $tipo = 'Usuario';
            $compras = NotasProductos::where('id_usuario', $cliente->id)
            ->orWhere('telefono', $phone)
            ->where('tipo_nota','=' , 'Venta Presencial')
            ->get();
        }else{
            $distribuidora = null;
            $tipo = 'Nota';
            $cliente = NotasProductos::where('telefono', '=', $phone)->first();
            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('telefono', '=', $phone)->first();
            }
            $compras = NotasProductos::where('tipo_nota','=' , 'Venta Presencial')->where('telefono','=' ,$phone)->get();
        }

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'compras', 'tipo'));
    }

    public function cotizaciones_nas(Request $request, $phone){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('telefono', '=', $phone)->first();
        if ($cliente) {
            $distribuidora = Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id','DESC')->first();
            $tipo = 'Usuario';
            $cotizaciones = NotasProductos::where('id_usuario', $cliente->id)
            ->orWhere('telefono', $phone)
            ->where('tipo_nota','=' , 'Cotizacion')
            ->get();
        }else{
            $distribuidora = null;
            $tipo = 'Nota';
            $cliente = NotasProductos::where('telefono', '=', $phone)->first();
            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('telefono', '=', $phone)->first();
            }
            $cotizaciones = NotasProductos::where('tipo_nota','=' , 'Cotizacion')->where('telefono', $phone)->get();
        }

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cotizaciones', 'tipo'));
    }

    public function cotizaciones_cosmica(Request $request, $phone){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('telefono', '=', $phone)->first();
        if ($cliente) {
            $distribuidora = Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id', 'DESC')->first();
            $tipo = 'Usuario';
            // Si el cliente no es null, busca por id_usuario y telefono
            $cotizaciones_cosmica = NotasProductosCosmica::where('id_usuario', $cliente->id)
                ->orWhere('telefono', $phone)
                ->get();
        } else {
            $distribuidora = null;
            $tipo = 'Nota';
            $cliente = NotasProductos::where('telefono', '=', $phone)->first();
            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('telefono', '=', $phone)->first();
            }
            // Si el cliente es null, busca solo por telefono
            $cotizaciones_cosmica = NotasProductosCosmica::where('telefono', $phone)->get();
        }

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cotizaciones_cosmica', 'tipo'));
    }

    public function membresia_cosmica(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cosmica_user = Cosmikausers::where('id_cliente', '=', $id)->first();
        $tipo = 'Usuario';

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cosmica_user', 'tipo'));
    }

}
