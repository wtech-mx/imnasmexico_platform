<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodegaPedidos;
use App\Models\BodegaPedidosCosmica;
use App\Models\BodegaPedidosProductosCosmica;
use App\Models\BodegaPedidosProductos;
use App\Models\HistorialStock;
use App\Models\Products;
use Session;

class LaboratoriosController extends Controller
{
    public function index_nas(){

        $bodegaPedidoRealizado = BodegaPedidos::where('estatus_lab','=','Aprobada')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoPendiente = BodegaPedidos::where('estatus_lab','=','Confirmado')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoConfirmado = BodegaPedidos::where('estatus_lab','=','Finalizado')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoCancelado = BodegaPedidos::where('estatus_lab','=','Cancelada')->orderBy('fecha_pedido','DESC')->get();

        return view('admin.laboratorio.index_nas', compact('bodegaPedidoRealizado','bodegaPedidoConfirmado','bodegaPedidoPendiente', 'bodegaPedidoCancelado'));
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
        $cantidades_recibido = $request->input('cantidad_entrega');
        $stock_nas = $request->input('stock_nas');
        $restantes = 0;
        $stock_actualizado = 0;
        $pedido = BodegaPedidos::where('id', $id)->first();
        foreach ($ids_pedido as $index => $id_pedido) {
            $pedidoProducto = BodegaPedidosProductos::where('id_pedido', $id_pedido)
            ->where('id_producto', $ids_producto[$index])
            ->first();

            $pedido->estatus = 'Confirmado';
            $pedido->save();

            $producto = Products::where('id', $ids_producto[$index])->first();
                // Verifica si hay datos previos en la cantidad entregada
                if ($pedidoProducto) {
                    // Si la cantidad entregada es NULL, considerarla como 0
                    $cantidad_entregada_actual = $pedidoProducto->cantidad_entregada_lab ?? 0;
                    // Sumar la nueva cantidad entregada con la cantidad que ya había sido registrada
                    $restantes = $cantidad_entregada_actual - $cantidades_recibido[$index];
                    $stock_actualizado = $stock_nas[$index] - $cantidades_recibido[$index];
                    $pedidoProducto->lab_entrega = $cantidades_recibido[$index];
                    $pedidoProducto->cantidad_entregada_lab = $restantes;
                    $pedidoProducto->save();

                    $producto->stock_nas = $stock_actualizado;
                    $producto->stock += $cantidades_recibido[$index];// Aumentar el stock con la cantidad recibida
                    $producto->save();

                    $productosPendientes = BodegaPedidosProductos::where('id_pedido', $id_pedido)
                    ->where('cantidad_entregada_lab', '>', 0) // Busca productos con cantidad restante mayor a 0
                    ->count(); // Cuenta los productos que aún tienen piezas pendientes

                    // Si no hay productos pendientes (cantidad_restante == 0), actualizar el estatus del pedido
                    if ($productosPendientes == 0) {
                        $pedido->estatus_lab = 'Finalizado';
                        $pedido->fecha_aprovado_lab = now();
                        $pedido->save();
                    }else{
                        $pedido->estatus_lab = 'Finalizado';
                        $pedido->fecha_aprovado_lab = now();
                        $pedido->save();
                    }
                }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha guardado sus datos con exito');

    }

    public function show_products_nas($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }

    public function index_productos_nas(){

        $products = Products::where('laboratorio','=','NAS')->where('subcategoria', 'Producto')->get();

        return view('admin.laboratorio.index_productos',compact('products'));
    }

    public function index_cosmica(){

        $bodegaPedidoRealizado = BodegaPedidosCosmica::where('estatus_lab','=','Aprobada')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoPendiente = BodegaPedidosCosmica::where('estatus_lab','=','Confirmado')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoConfirmado = BodegaPedidosCosmica::where('estatus_lab','=','Finalizado')->orderBy('fecha_pedido','DESC')->get();

        return view('admin.laboratorio.index_cosmica',compact('bodegaPedidoRealizado','bodegaPedidoConfirmado','bodegaPedidoPendiente'));
    }

    public function show_cosmica($id){
        $pedido = BodegaPedidosCosmica::where('id', $id)->first();
        $pedido_productos = BodegaPedidosProductosCosmica::where('id_pedido', $id)->get();

        return view('admin.laboratorio.autorizado_cosmica', compact('pedido', 'pedido_productos'));
    }

    public function cosmica_ordenes_lab_orden_update(Request $request, $id){
        $ids_pedido = $request->input('id_pedido');
        $ids_producto = $request->input('id_producto');
        $cantidades_recibido = $request->input('cantidad_entrega');
        $stock_cosmica = $request->input('stock_cosmica');
        $restantes = 0;
        $stock_actualizado = 0;
        $pedido = BodegaPedidosCosmica::where('id', $id)->first();
        foreach ($ids_pedido as $index => $id_pedido) {
            $pedidoProducto = BodegaPedidosProductosCosmica::where('id_pedido', $id_pedido)
            ->where('id_producto', $ids_producto[$index])
            ->first();

            $pedido->estatus = 'Confirmado';
            // $pedido->save();

            $producto = Products::where('id', $ids_producto[$index])->first();
                // Verifica si hay datos previos en la cantidad entregada
                if ($pedidoProducto) {
                    // Si la cantidad entregada es NULL, considerarla como 0
                    $cantidad_entregada_actual = $pedidoProducto->cantidad_entregada_lab ?? 0;
                    // Sumar la nueva cantidad entregada con la cantidad que ya había sido registrada
                    $restantes = $cantidad_entregada_actual - $cantidades_recibido[$index];
                    $stock_actualizado = $stock_cosmica[$index] - $cantidades_recibido[$index];
                    $pedidoProducto->lab_entrega = $cantidades_recibido[$index];
                    $pedidoProducto->cantidad_entregada_lab = $restantes;
                    $pedidoProducto->save();

                    $producto->stock_cosmica = $stock_actualizado;
                    $producto->stock += $cantidades_recibido[$index];
                    $producto->save();

                    $productosPendientes = BodegaPedidosProductosCosmica::where('id_pedido', $id_pedido)
                    ->where('cantidad_entregada_lab', '>', 0) // Busca productos con cantidad restante mayor a 0
                    ->count(); // Cuenta los productos que aún tienen piezas pendientes

                    // Si no hay productos pendientes (cantidad_restante == 0), actualizar el estatus del pedido
                    if ($productosPendientes == 0) {
                        $pedido->estatus_lab = 'Finalizado';
                        $pedido->fecha_aprovado_lab = now();
                        $pedido->save();
                    }else{
                        $pedido->estatus_lab = 'Finalizado';
                        $pedido->fecha_aprovado_lab = now();
                        $pedido->save();
                    }

                }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha guardado sus datos con exito');

    }

    public function show_products_cosmica($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }

    public function index_productos_cosmica(){
        $products = Products::where('laboratorio','=','Cosmica')->get();
        $products_cosmica = Products::where('stock_cosmica','<=', 90)->get();

        return view('admin.laboratorio.index_productos_cosmica',compact('products', 'products_cosmica'));
    }

    public function pdf_cajas(Request $request){
        $today =  date('d-m-Y');
        $bajo_productos = Products::where('stock_cosmica','<=', 30)->orderby('stock_cosmica','ASC')->get();
        $medio_productos = Products::where('stock_cosmica','>', 30)->where('stock_cosmica','<=', 90)->orderby('stock_cosmica','ASC')->get();

        $pdf = \PDF::loadView('admin.laboratorio.pdf_stock_cosmica', compact('bajo_productos', 'today', 'medio_productos'));
        //return $pdf->stream();
        return $pdf->download('Productos cosmica bajo stock / '.$today.'.pdf');
    }

    public function getStockHistoryCosmica($id){
        $historial = HistorialStock::where('id_producto', $id)
        ->whereIn('tipo_cambio', ['Caja cosmica resta', 'Caja cosmica suma'])
        ->get();
        return response()->json($historial);
    }

    public function getStockHistoryNas($id){
        $historial = HistorialStock::where('id_producto', $id)
        ->whereIn('tipo_cambio', ['Lab nas suma', 'Lab nas resta'])
        ->get();
        return response()->json($historial);
    }

    public function ordenes_lab_orden_finalizar_update(Request $request, $id){

        $pedido = BodegaPedidos::where('id', $id)->first();
        $pedido->comentario = $request->get('comentario');
        $pedido->estatus_lab = 'Finalizado';
        $pedido->estatus = 'Finalizado';
        $pedido->fecha_aprovado_lab = date('Y-m-d');
        $pedido->fecha_recibido = date('Y-m-d');
        $pedido->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back();
    }
}
