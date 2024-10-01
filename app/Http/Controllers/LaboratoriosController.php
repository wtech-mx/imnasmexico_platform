<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodegaPedidos;
use App\Models\BodegaPedidosProductos;
use App\Models\Products;
use Session;

class LaboratoriosController extends Controller
{
    public function index_nas(){

        $bodegaPedidoRealizado = BodegaPedidos::where('estatus','=','Aprobada')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoConfirmado = BodegaPedidos::where('estatus','=','Confirmado')->orderBy('fecha_pedido','DESC')->get();

        return view('admin.laboratorio.index_nas', compact('bodegaPedidoRealizado','bodegaPedidoConfirmado'));
    }

    public function show($id){
        $pedido = BodegaPedidos::where('id', $id)->first();
        $pedido_productos = BodegaPedidosProductos::where('id_pedido', $id)->get();

        return view('admin.laboratorio.autorizados', compact('pedido', 'pedido_productos'));
    }

    public function ordenes_lab_orden_update(Request $request, $id)
    {

        $ids_pedido = $request->input('id_pedido');
        $ids_producto = $request->input('id_producto');
        $cantidades_pedido = $request->input('cantidad_pedido');
        $cantidad_entregada_lab = $request->input('cantidad_entregada_lab');
        $cantidades_recibido = $request->input('cantidad_recibido');
        $eliminar_producto = $request->input('eliminar_producto');

        $pedido = BodegaPedidos::where('id', $id)->first();
        if($pedido->estatus == 'Aprobada'){

            $bodegaPedido = BodegaPedidos::find($id);
            $bodegaPedido->estatus = 'Confirmado';
            $bodegaPedido->fecha_aprovado_lab = date("Y-m-d H:i:s");
            $bodegaPedido->update();

            foreach ($ids_pedido as $index => $id_pedido) {
                if ($eliminar_producto[$index] == 1) {
                    BodegaPedidosProductos::where('id_pedido', $id_pedido)
                        ->where('id_producto', $ids_producto[$index])
                        ->delete();
                } else {
                    $pedidoProducto = BodegaPedidosProductos::where('id_pedido', $id_pedido)
                                        ->where('id_producto', $ids_producto[$index])
                                        ->first();

                    // Actualiza la cantidad_pedido
                    if ($pedidoProducto) {
                        $pedidoProducto->cantidad_pedido = $cantidades_pedido[$index];
                        $pedidoProducto->cantidad_restante = $cantidades_pedido[$index];
                        $pedidoProducto->cantidad_entregada_lab = $cantidad_entregada_lab[$index];
                        $pedidoProducto->save();
                    }
                }
            }
        }else{
            $suma = 0;
            $resta = 0;
            $suma_stock = 0;
            foreach ($ids_pedido as $index => $id_pedido) {
                $pedidoProducto = BodegaPedidosProductos::where('id_pedido', $id_pedido)
                                        ->where('id_producto', $ids_producto[$index])
                                        ->first();
                $producto = Products::where('id', $ids_producto[$index])->first();

                // Verifica si hay datos previos en la cantidad recibida
                if ($pedidoProducto) {
                    // Si la cantidad recibida es NULL, considerarla como 0
                    $cantidad_recibida_actual = $pedidoProducto->cantidad_recibido ?? 0;

                    // Sumar la nueva cantidad recibida con la cantidad que ya había sido registrada
                    $nueva_cantidad_recibida = $cantidad_recibida_actual + $cantidades_recibido[$index];

                    // Calcular la cantidad restante restando lo que se ha recibido del total pedido
                    $cantidad_restante = $cantidades_pedido[$index] - $nueva_cantidad_recibida;

                    // Actualizar los campos correspondientes
                    $pedidoProducto->cantidad_recibido = $nueva_cantidad_recibida;
                    $pedidoProducto->cantidad_restante = $cantidad_restante;

                    // Marcar la fecha de liquidación o recepción según la cantidad restante
                    if ($cantidad_restante <= 0) {
                        $pedidoProducto->fecha_liquidado = now(); // Fecha y hora actual
                    } elseif ($cantidad_restante > 0) {
                        $pedidoProducto->fecha_recibido = now();
                    }

                    $pedidoProducto->save();

                    // Actualizar el stock del producto
                    $nuevo_stock = $producto->stock + $cantidades_recibido[$index];
                    $producto->stock = $nuevo_stock;
                    $producto->update();

                    $productosPendientes = BodegaPedidosProductos::where('id_pedido', $id_pedido)
                    ->where('cantidad_restante', '>', 0) // Busca productos con cantidad restante mayor a 0
                    ->count(); // Cuenta los productos que aún tienen piezas pendientes

                    // Si no hay productos pendientes (cantidad_restante == 0), actualizar el estatus del pedido
                    if ($productosPendientes == 0) {
                        $pedido->estatus = 'Finalizada';
                        $pedido->fecha_recibido = now();
                        $pedido->save();
                    }
                }

            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function index_productos_nas(){

        $products = Products::where('laboratorio','=','NAS')->get();

        return view('admin.laboratorio.index_productos',compact('products'));
    }

    public function index_cosmica(){

        return view('admin.laboratorio.index_cosmica');

    }

    public function index_productos_cosmica(){

        $products = Products::where('laboratorio','=','Cosmica')->get();

        return view('admin.laboratorio.index_productos_cosmica',compact('products'));

    }


}
