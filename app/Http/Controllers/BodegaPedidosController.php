<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodegaPedidos;
use App\Models\BodegaPedidosProductos;
use App\Models\Products;

class BodegaPedidosController extends Controller
{
    public function productos_stock(Request $request){
        $products = Products::orderBy('id','DESC')->get();

        return view('admin.products.bajo_stock.index', compact('products'));
    }

    public function guardar(Request $request){
        // Validar la solicitud
        $data = $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer',
            'cart.*.nombre' => 'required|string',
            'cart.*.cantidad' => 'required|integer',
            'cart.*.stock' => 'required',
        ]);

        $pedido = new BodegaPedidos;
        $pedido->fecha_pedido = date('Y-m-d h:m:s');
        $pedido->estatus = 'Realizado';
        $pedido->id_user = auth()->user()->id;
        $pedido->save();


        foreach ($data['cart'] as $item) {
            $pedido_productos = new BodegaPedidosProductos;
            $pedido_productos->id_pedido = $pedido->id;
            $pedido_productos->id_producto = $item['id']; // Cambiado a acceder por índice de array
            $pedido_productos->cantidad_pedido = $item['cantidad']; // Cambiado a acceder por índice de array
            $pedido_productos->stock_anterior = $item['stock']; // Cambiado a acceder por índice de array
            $pedido_productos->cantidad_restante = $item['cantidad']; // Cambiado a acceder por índice de array
            $pedido_productos->save();
        }

        return response()->json(['redirect_url' => route('productos_stock.show', $pedido->id)]);
    }

    public function show($id){
        $pedido = BodegaPedidos::where('id', $id)->first();
        $pedido_productos = BodegaPedidosProductos::where('id_pedido', $id)->get();

        return view('admin.products.ordenar.show', compact('pedido', 'pedido_productos'));
    }

    public function imprimir($id){
        $today =  date('d-m-Y');

        $pedido = BodegaPedidos::find($id);
        $pedido_productos = BodegaPedidosProductos::where('id_pedido', $pedido->id)->get();

        $pdf = \PDF::loadView('admin.products.ordenar.pdf', compact('pedido', 'today', 'pedido_productos'));
       return $pdf->stream();
     //return $pdf->download('Nota remision'. $folio .'/'.$today.'.pdf');
    }
}
