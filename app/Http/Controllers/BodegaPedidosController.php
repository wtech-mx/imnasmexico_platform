<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodegaPedidos;
use App\Models\BodegaPedidosProductos;
use App\Models\BodegaPedidosCosmica;
use App\Models\BodegaPedidosProductosCosmica;
use App\Models\HistorialStock;
use App\Models\Products;
use Session;

class BodegaPedidosController extends Controller
{
    public function productos_stock(Request $request){
        $products = Products::orderBy('stock','ASC')->where('categoria', 'NAS')->where('subcategoria', 'Producto')->where('stock', '!=', NULL)->get();

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
            $pedido_productos->cantidad_entregada_lab = $item['cantidad'];
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

    public function ordenes_nas(Request $request){

        $bodegaPedidoRealizado = BodegaPedidos::where('estatus','=','Realizado')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoAprobado = BodegaPedidos::where('estatus','=','Aprobada')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoConfirmado = BodegaPedidos::where('estatus','=','Confirmado')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoFinalizada = BodegaPedidos::where('estatus','=','Finalizado')->orderBy('fecha_pedido','DESC')->get();

        return view('admin.products.ordenar.index', compact('bodegaPedidoFinalizada','bodegaPedidoAprobado','bodegaPedidoRealizado','bodegaPedidoConfirmado'));
    }

    public function ordenes_nas_firma($id){
        $pedido = BodegaPedidos::where('id', $id)->first();
        $pedido_productos = BodegaPedidosProductos::where('id_pedido', $id)->get();

        return view('admin.products.ordenar.liga', compact('pedido', 'pedido_productos'));
    }

    public function ordenes_nas_firma_update(Request $request, $id)
    {

        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/firma_pedido/');
        }else{
            $ruta_estandar = public_path() . '/firma_pedido/';
        }

        if (!file_exists($ruta_estandar)) {
            mkdir($ruta_estandar, 0777, true);
        }

        $firma = BodegaPedidos::find($id);
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $signature = uniqid() . '.'.$image_type;
        $file = $ruta_estandar . $signature;

        file_put_contents($file, $image_base64);

        $firma->firma = $signature;
        $firma->fecha_aprovado = date("Y-m-d H:i:s");
        $firma->estatus = 'Aprobada';
        $firma->estatus_lab = 'Aprobada';
        $firma->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function ordenes_nas_orden_update(Request $request, $id)
    {
        $ids_pedido = $request->input('id_pedido');
        $ids_producto = $request->input('id_producto');
        $cantidades_pedido = $request->input('cantidad_pedido');
        $cantidades_recibido = $request->input('cantidad_recibido');
        $eliminar_producto = $request->input('eliminar_producto');
        $pedido = BodegaPedidos::where('id', $id)->first();
        if($pedido->estatus == 'Realizado'){
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
                        $pedido->estatus = 'Finalizado';
                        $pedido->fecha_recibido = now();
                        $pedido->save();
                    }
                }

            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    // =============================== C O S M I C A ============================================
    public function productos_stock_cosmica(Request $request){
        $products = Products::orderBy('stock','ASC')->where('categoria', 'Cosmica')->where('subcategoria', 'Producto')->where('stock', '!=', NULL)->get();

        return view('admin.products.bajo_stock_cosmica.index', compact('products'));
    }

    public function guardar_cosmica(Request $request){
        // Validar la solicitud
        $data = $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer',
            'cart.*.nombre' => 'required|string',
            'cart.*.cantidad' => 'required|integer',
            'cart.*.stock' => 'required',
        ]);

        $pedido = new BodegaPedidosCosmica;
        $pedido->fecha_pedido = date('Y-m-d h:m:s');
        $pedido->estatus = 'Realizado';
        $pedido->id_user = auth()->user()->id;
        $pedido->save();


        foreach ($data['cart'] as $item) {
            $pedido_productos = new BodegaPedidosProductosCosmica;
            $pedido_productos->id_pedido = $pedido->id;
            $pedido_productos->id_producto = $item['id']; // Cambiado a acceder por índice de array
            $pedido_productos->cantidad_pedido = $item['cantidad']; // Cambiado a acceder por índice de array
            $pedido_productos->stock_anterior = $item['stock']; // Cambiado a acceder por índice de array
            $pedido_productos->cantidad_restante = $item['cantidad']; // Cambiado a acceder por índice de array
            $pedido_productos->cantidad_entregada_lab = $item['cantidad'];
            $pedido_productos->save();
        }

        return response()->json(['redirect_url' => route('productos_stock_cosmica.show', $pedido->id)]);
    }

    public function show_cosmica($id){
        $pedido = BodegaPedidosCosmica::where('id', $id)->first();
        $pedido_productos = BodegaPedidosProductosCosmica::where('id_pedido', $id)->get();

        return view('admin.products.ordenar_cosmica.show', compact('pedido', 'pedido_productos'));
    }

    public function imprimir_cosmica($id){
        $today =  date('d-m-Y');

        $pedido = BodegaPedidosCosmica::find($id);
        $pedido_productos = BodegaPedidosProductosCosmica::where('id_pedido', $pedido->id)->get();

        $pdf = \PDF::loadView('admin.products.ordenar_cosmica.pdf', compact('pedido', 'today', 'pedido_productos'));
       return $pdf->stream();
     //return $pdf->download('Nota remision'. $folio .'/'.$today.'.pdf');
    }

    public function ordenes_cosmica(Request $request){

        $bodegaPedidoRealizado = BodegaPedidosCosmica::where('estatus','=','Realizado')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoAprobado = BodegaPedidosCosmica::where('estatus','=','Aprobada')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoConfirmado = BodegaPedidosCosmica::where('estatus','=','Confirmado')->orderBy('fecha_pedido','DESC')->get();
        $bodegaPedidoFinalizada = BodegaPedidosCosmica::where('estatus','=','Finalizado')->orderBy('fecha_pedido','DESC')->get();

        return view('admin.products.ordenar_cosmica.index', compact('bodegaPedidoFinalizada','bodegaPedidoAprobado','bodegaPedidoRealizado','bodegaPedidoConfirmado'));
    }

    public function ordenes_cosmica_firma($id){
        $pedido = BodegaPedidosCosmica::where('id', $id)->first();
        $pedido_productos = BodegaPedidosProductosCosmica::where('id_pedido', $id)->get();

        return view('admin.products.ordenar_cosmica.liga', compact('pedido', 'pedido_productos'));
    }

    public function ordenes_cosmica_firma_update(Request $request, $id)
    {

        $dominio = $request->getHost();
        $today =  date('Y-m-d');
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/firma_pedido/');
        }else{
            $ruta_estandar = public_path() . '/firma_pedido/';
        }

        if (!file_exists($ruta_estandar)) {
            mkdir($ruta_estandar, 0777, true);
        }

        $firma = BodegaPedidosCosmica::find($id);
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $signature = uniqid() . '.'.$image_type;
        $file = $ruta_estandar . $signature;

        file_put_contents($file, $image_base64);

        $firma->firma = $signature;
        $firma->fecha_aprovado = date("Y-m-d H:i:s");
        $firma->estatus = 'Aprobada';
        $firma->estatus_lab = 'Aprobada';
        $firma->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function ordenes_cosmica_orden_update(Request $request, $id)
    {
        $ids_pedido = $request->input('id_pedido');
        $ids_producto = $request->input('id_producto');
        $cantidades_pedido = $request->input('cantidad_pedido');
        $cantidades_recibido = $request->input('cantidad_recibido');
        $eliminar_producto = $request->input('eliminar_producto');
        $pedido = BodegaPedidosCosmica::where('id', $id)->first();
        if($pedido->estatus == 'Realizado'){
            foreach ($ids_pedido as $index => $id_pedido) {
                if ($eliminar_producto[$index] == 1) {
                    BodegaPedidosProductosCosmica::where('id_pedido', $id_pedido)
                        ->where('id_producto', $ids_producto[$index])
                        ->delete();
                } else {
                    $pedidoProducto = BodegaPedidosProductosCosmica::where('id_pedido', $id_pedido)
                                        ->where('id_producto', $ids_producto[$index])
                                        ->first();

                    // Actualiza la cantidad_pedido
                    if ($pedidoProducto) {
                        $pedidoProducto->cantidad_pedido = $cantidades_pedido[$index];
                        $pedidoProducto->cantidad_restante = $cantidades_pedido[$index];
                        $pedidoProducto->save();
                    }
                }
            }
        }else{
            $suma = 0;
            $resta = 0;
            $suma_stock = 0;
            foreach ($ids_pedido as $index => $id_pedido) {
                $pedidoProducto = BodegaPedidosProductosCosmica::where('id_pedido', $id_pedido)
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

                    $productosPendientes = BodegaPedidosProductosCosmica::where('id_pedido', $id_pedido)
                    ->where('cantidad_restante', '>', 0) // Busca productos con cantidad restante mayor a 0
                    ->count(); // Cuenta los productos que aún tienen piezas pendientes

                    // Si no hay productos pendientes (cantidad_restante == 0), actualizar el estatus del pedido
                    if ($productosPendientes == 0) {
                        $pedido->estatus = 'Finalizado';
                        $pedido->fecha_recibido = now();
                        $pedido->save();
                    }
                }

            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function cancelar($id){

        $pedido = BodegaPedidosCosmica::where('id', $id)->first();
        $pedido->estatus = 'Cancelado';
        $pedido->estatus_lab = 'Cancelado';
        $pedido->update();

        return redirect()->back()->with('success', 'Cancelado con exitoso.');
    }

}
