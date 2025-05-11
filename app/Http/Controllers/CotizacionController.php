<?php

namespace App\Http\Controllers;

use App\Models\HistorialVendidos;
use App\Models\ProductosNotasId;
use App\Models\NotasProductos;
use App\Models\ProductosBundleId;
use App\Models\HistorialStock;
use App\Models\OrdersCosmica;
use App\Models\OrdersCosmicaOnline;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Str;
use Session;
use Hash;
use DB;
use Carbon\Carbon;
use App\Models\Factura;
class CotizacionController extends Controller
{
    public function index(){

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $notas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion','=' , null)->get();

        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.cotizacion.index', compact('notas', 'products', 'clientes', 'administradores'));
    }

    public function index_aprobada(){

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $notasAprobadas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')
        ->where('tipo_nota','=' , 'Cotizacion')
        ->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado'])
        ->get();

        $products = Products::orderBy('nombre','ASC')->get();
        return view('admin.cotizacion.index_aprobada', compact( 'products', 'clientes', 'administradores','notasAprobadas'));
    }

    public function index_cancelada(){

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $notasCandeladas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->where('estatus_cotizacion','=' , 'Cancelada')->get();

        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.cotizacion.index_cancelada', compact('products', 'clientes', 'administradores','notasCandeladas'));
    }

    public function buscador(Request $request){

        $administradores = User::where('cliente', null)->orWhere('cliente', '5')->get();
        $clientes = User::where('cliente', '1')->orderBy('id', 'DESC')->get();
        $products = Products::orderBy('nombre', 'ASC')->get();

        $query = NotasProductos::query();

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $fechaInicio = $request->input('fecha_inicio');
            $fechaFin = $request->input('fecha_fin');

            $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $query->orderBy('id', 'DESC')->where('tipo_nota', 'Cotizacion');

        $notas = $query->get();
        $notasAprobadas = clone $query->where('estatus_cotizacion', 'Aprobada')->get();

        $notasPendientes = clone $query->where('estatus_cotizacion', 'Pendiente')->get();
        $notasCandeladas = clone $query->where('estatus_cotizacion', 'Cancelada')->get();
        return view('admin.cotizacion.index ', compact('notas', 'products', 'clientes', 'administradores', 'notasAprobadas', 'notasPendientes', 'notasCandeladas'));
    }

    public function create(){
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $products = Products::where('categoria', '!=', 'Ocultar')
        ->where(function($query) {
            $query->whereNull('fecha_fin')
                  ->orWhere('fecha_fin', '>', Carbon::now());
        })
        ->orderBy('nombre', 'ASC')
        ->get();

        return view('admin.cotizacion.create', compact('products', 'clientes'));
    }

    public function edit($id){
        $cotizacion = NotasProductos::find($id);
        $cotizacion_productos = ProductosNotasId::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();

        $products = Products::where('categoria', '!=', 'Ocultar')
        ->where(function($query) {
            $query->whereNull('fecha_fin')
                  ->orWhere('fecha_fin', '>', Carbon::now());
        })
        ->orderBy('nombre', 'ASC')
        ->get();

        return view('admin.cotizindex_cosmicaacion.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function store(request $request){

        // Validar que todos los campos de cantidad estén presentes y no vacíos
        $request->validate([
            'campo3.*' => 'required|integer|min:1'
        ], [
            'campo3.*.required' => 'El campo de cantidad es obligatorio.',
            'campo3.*.integer' => 'El campo de cantidad debe ser un número entero.',
            'campo3.*.min' => 'La cantidad mínima es 1.'
        ]);

        // Creacion de user
        $code = Str::random(8);

        $notas_productos = new NotasProductos;

        if($request->id_client == NULL){

            if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
                if($request->ClienteMeli == 1){
                    $notas_productos->nombre = $request->get('name');
                    $notas_productos->telefono = $request->get('telefono');
                }else{
                    if (User::where('telefono', $request->telefono)->exists()) {
                        $user = User::where('telefono', $request->telefono)->first();
                    } else {
                        $user = User::where('email', $request->email)->first();
                    }
                    $payer = $user;
                    $notas_productos->id_usuario = $payer->id;
                }
            } else {
                if($request->ClienteMeli == 1){
                    $notas_productos->nombre = $request->get('name');
                    $notas_productos->telefono = $request->get('telefono');
                }else{
                    $payer = new User;
                    $payer->name = $request->get('name');
                    $payer->email = $request->get('telefono') . '@imnasmexico.com';
                    $payer->username = $request->get('telefono');
                    $payer->code = $code;
                    $payer->telefono = $request->get('telefono');
                    $payer->cliente = '1';
                    $payer->password = Hash::make($request->get('telefono'));
                    $payer->save();
                    $notas_productos->id_usuario = $payer->id;
                }
            }
        }else{
            $notas_productos->id_usuario = $request->id_client;
        }

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pagos';
        }

        if($request->get('envio') == NULL){
            $envio = 0;
        }else{
            $envio = 250;
        }

        $descuento = floatval($request->get('descuento', 0));

        $nuevosCampos4 = $request->input('campo4', []);
        $nuevosCampos4 = array_map('floatval', $nuevosCampos4); // Convierte a números
        $sumaCampo4 = array_sum($nuevosCampos4);
        // Aplicar descuento si $descuento es mayor que 0
        if ($descuento > 0) {
            $descuentoAplicado = $sumaCampo4 * ($descuento / 100);
            $totalDesc = ($envio + $sumaCampo4) - $descuentoAplicado;
            if($request->get('factura') == NULL){
                $factura = 0;
                $totalConDescuento = $totalDesc;
            }else{
                $factura = $totalDesc * .16;
                $totalConDescuento = $totalDesc + $factura;
            }
        } else {
            $descuentoAplicado = 0;
            $totalDesc = $envio + $sumaCampo4;
            if($request->get('factura') == NULL){
                $factura = 0;
                $totalConDescuento = $totalDesc;
            }else{
                $factura = $totalDesc * .16;
                $totalConDescuento = $totalDesc + $factura;
            }
        }

        $notas_productos->metodo_pago = $request->get('metodo_pago');
        $notas_productos->fecha = $request->get('fecha');
        $notas_productos->tipo = $sumaCampo4;
        $notas_productos->restante = $request->get('descuento');
        $notas_productos->total = $totalConDescuento;
        $notas_productos->nota = $request->get('nota');
        $notas_productos->metodo_pago2 = $request->get('metodo_pago2');
        $notas_productos->monto = $request->get('monto');
        $notas_productos->monto2 = $request->get('monto2');

        $notas_productos->tipo_nota = 'Cotizacion';
        $tipoNota = $notas_productos->tipo_nota;

        // Obtener todos los folios del tipo de nota específico
        $folios = NotasProductos::where('tipo_nota', $tipoNota)->pluck('folio');

        // Extraer los números de los folios y encontrar el máximo
        $maxNumero = $folios->map(function ($folio) use ($tipoNota) {
            return intval(substr($folio, strlen($tipoNota[0])));
        })->max();

        // Si hay un folio existente, sumarle 1 al máximo número
        if ($maxNumero) {
            $numeroFolio = $maxNumero + 1;
        } else {
            // Si no hay un folio existente, empezar desde 1
            $numeroFolio = 1;
        }

        // Crear el nuevo folio con el tipo de nota y el número
        $folio = $tipoNota[0] . $numeroFolio;

        // Asignar el nuevo folio al objeto
        $notas_productos->folio = $folio;

        if($request->get('envio') == NULL){
            $notas_productos->envio = 'No';
        }else{
            $notas_productos->envio = 'Si';
        }
        $notas_productos->id_admin = auth()->user()->id;

        if ($request->hasFile("foto_pago2")) {
            $file = $request->file('foto_pago2');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_productos->foto_pago2 = $fileName;
        }

        if($request->get('factura') != NULL){

            $notas_productos->factura = '1';
            $notas_productos->save();
            $facturas = new Factura;

            $facturas->id_usuario = auth()->user()->id;
            $facturas->id_notas_nas = $notas_productos->id;
            $estado = 'Por Facturar';
            $facturas->estatus = $estado;
            $facturas->save();

        }else{
            $notas_productos->save();
        }

        $contadorKits = 1;
        if ($request->has('campo')) {
            $nuevosCampos = $request->input('campo');
            $nuevosCampos2 = $request->input('campo4');
            $nuevosCampos3 = $request->input('campo3');
            $descuento_prod = $request->input('descuento_prod');

            foreach ($nuevosCampos as $index => $campo) {
                $producto = Products::where('id', $campo)->where('categoria', '!=', 'Ocultar')->first();

                if ($producto && $producto->subcategoria == 'Kit') {
                    $productos_bundle = ProductosBundleId::where('id_product', $producto->id)->get();

                    foreach ($productos_bundle as $producto_bundle) {
                        $notas_inscripcion = ProductosNotasId::where('id_notas_productos', $notas_productos->id)
                            ->where('id_producto', $producto_bundle->id_producto)
                            ->first();

                        // Si no existe, crea un nuevo registro
                        $notas_inscripcion = new ProductosNotasId;
                        $notas_inscripcion->id_notas_productos = $notas_productos->id;
                        $notas_inscripcion->producto = $producto_bundle->producto;
                        $notas_inscripcion->id_producto = $producto_bundle->id_producto;
                        $notas_inscripcion->price = '0';
                        $notas_inscripcion->cantidad = $producto_bundle->cantidad;
                        $notas_inscripcion->num_kit = $producto_bundle->id_product;
                        $notas_inscripcion->save();
                    }

                    // Asignar el ID del kit en la columna correspondiente
                    if ($contadorKits <= 6) { // Controlar un máximo de 6 kits
                        $columnaKit = "id_kit" . ($contadorKits > 1 ? $contadorKits : "");
                        $notas_productos->$columnaKit = $producto->id;

                        // Asignar la cantidad correspondiente al kit
                        $cantidadCampo = $request->input('campo3')[$contadorKits - 1] ?? null; // Obtener la cantidad del kit actual
                        if ($cantidadCampo) {
                            $columnaCantidadKit = "cantidad_kit" . ($contadorKits > 1 ? $contadorKits : "");
                            $notas_productos->$columnaCantidadKit = $cantidadCampo;
                        }

                        $contadorKits++;
                    }
                } elseif ($producto->subcategoria == 'Tiendita') {
                    $notas_inscripcion = ProductosNotasId::where('id_notas_productos', $notas_productos->id)
                        ->where('id_producto', $producto->id)
                        ->first();

                        // Si no existe, crea un nuevo registro
                        $notas_inscripcion = new ProductosNotasId;
                        $notas_inscripcion->id_notas_productos = $notas_productos->id;
                        $notas_inscripcion->producto = $producto->nombre;
                        $notas_inscripcion->id_producto = $producto->id;
                        $notas_inscripcion->price = $nuevosCampos2[$index];
                        $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                        $notas_inscripcion->descuento = isset($descuento_prod[$index]) ? $descuento_prod[$index] : 0;
                        $notas_inscripcion->estatus = 1;
                        $notas_inscripcion->save();
                } else {
                    $notas_inscripcion = ProductosNotasId::where('id_notas_productos', $notas_productos->id)
                        ->where('id_producto', $producto->id)
                        ->first();

                        // Si no existe, crea un nuevo registro
                        $notas_inscripcion = new ProductosNotasId;
                        $notas_inscripcion->id_notas_productos = $notas_productos->id;
                        $notas_inscripcion->producto = $producto->nombre;
                        $notas_inscripcion->id_producto = $producto->id;
                        $notas_inscripcion->price = $nuevosCampos2[$index];
                        $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                        $notas_inscripcion->descuento = isset($descuento_prod[$index]) ? $descuento_prod[$index] : 0;
                        $notas_inscripcion->save();
                }
            }
            $notas_productos->save();
        }

        if($request->get('tipo_cotizacion') == 'Perfil Alumno'){
            return redirect()->back()->with('success', 'Se ha creado su cotizacion con exito');
        }else{
            return redirect()->route('notas_cotizacion.index')
            ->with('success', 'Creado exitosamente.');
        }
    }

    public function update(Request $request, $id) {
        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');

        $productosIdsEnviados = [];

        if ($producto !== null) {
            foreach ($producto as $nombreProducto) {
                $productoModelo = Products::where('nombre', $nombreProducto)->first();
                if ($productoModelo) {
                    $productosIdsEnviados[] = $productoModelo->id;
                }
            }
        }

        ProductosNotasId::where('id_notas_productos', $id)
        ->where(function ($query) use ($productosIdsEnviados) {
            $query->whereNotIn('id_producto', $productosIdsEnviados)
                  ->whereNull('num_kit'); // <--- Evita borrar los que pertenecen a un kit
        })->delete();

        if ($producto !== null) {
            for ($count = 0; $count < count($producto); $count++) {
                $producto_first = Products::where('nombre', $producto[$count])
                    ->where('categoria', '!=', 'Ocultar')->first();

                if (!$producto_first) continue;

                $producto_nota = ProductosNotasId::where('id_notas_productos', $id)
                    ->where('id_producto', $producto_first->id)->first();

                $cleanPrice = floatval(str_replace(['$', ','], '', $price[$count]));

                if ($producto_nota) {
                    $producto_nota->update([
                        'price' => $cleanPrice,
                        'cantidad' => $cantidad[$count],
                        'descuento' => $descuento[$count],
                    ]);
                }
            }
        }

        $campo = $request->input('campo');
        if (!empty(array_filter($campo))) {
            $campo4 = $request->input('campo4');
            $campo3 = $request->input('campo3');
            $descuento_prod = $request->input('descuento_prod');

            $contadorKits = 1;

            $nota = NotasProductos::findOrFail($id);

            // Detectar en qué columna `id_kit` hay espacio disponible
            $kit_slots_disponibles = [];
            for ($i = 1; $i <= 6; $i++) {
                $columnaKit = "id_kit" . ($i == 1 ? '' : $i);
                if (empty($nota->$columnaKit)) {
                    $kit_slots_disponibles[] = $i;
                }
            }


            for ($count = 0; $count < count($campo); $count++) {
                $producto_first = Products::where('id', $campo[$count])
                    ->where('categoria', '!=', 'Ocultar')->first();

                if (!$producto_first) continue;

                if ($producto_first->subcategoria == 'Kit') {
                    // Verifica si ya existen productos con ese num_kit
                    $ya_existe_kit = ProductosNotasId::where('id_notas_productos', $id)
                        ->where('num_kit', $producto_first->id)
                        ->exists();

                    if (!$ya_existe_kit) {
                        $productos_bundle = ProductosBundleId::where('id_product', $producto_first->id)->get();

                        foreach ($productos_bundle as $producto_bundle) {
                            ProductosNotasId::create([
                                'id_notas_productos' => $id,
                                'producto' => $producto_bundle->producto,
                                'id_producto' => $producto_bundle->id_producto,
                                'price' => 0,
                                'cantidad' => $producto_bundle->cantidad,
                                'kit' => 1,
                                'num_kit' => $producto_first->id
                            ]);
                        }

                        // Guardar el kit y su cantidad en la nota
                        if (!empty($kit_slots_disponibles)) {
                            $slot = array_shift($kit_slots_disponibles); // Toma el primer slot disponible
                            $columnaKit = "id_kit" . ($slot == 1 ? '' : $slot);
                            $columnaCantidadKit = "cantidad_kit" . ($slot == 1 ? '' : $slot);

                            $nota->$columnaKit = $producto_first->id;
                            $nota->$columnaCantidadKit = $campo3[$count];
                            $nota->save();
                        }


                    }
                }
                 else {
                    ProductosNotasId::create([
                        'id_notas_productos' => $id,
                        'producto' => $producto_first->nombre,
                        'id_producto' => $producto_first->id,
                        'price' => floatval(str_replace(['$', ','], '', $campo4[$count])),
                        'cantidad' => $campo3[$count],
                        'descuento' => $descuento_prod[$count] ?? 0,
                    ]);
                }
            }
        }

        $nota = NotasProductos::findOrFail($id);
        $nota->subtotal = floatval(str_replace(['$', ','], '', $request->get('subtotal_final')));
        $nota->tipo = floatval(str_replace(['$', ','], '', $request->get('subtotal_final')));
        $nota->total = floatval(str_replace(['$', ','], '', $request->get('total_final')));
        $nota->envio = $request->get('envio');
        $nota->dinero_recibido = $request->get('costo_envio');

        $kits_cantidades = $request->input('cantidad_kit');
        for ($i = 1; $i <= 6; $i++) {
            $idKitCampo = "id_kit" . ($i == 1 ? '' : $i);
            $cantidadKitCampo = "cantidad_kit" . ($i == 1 ? '' : $i);
            if (!empty($nota->$idKitCampo) && isset($kits_cantidades[$i - 1])) {
                $nota->$cantidadKitCampo = $kits_cantidades[$i - 1];
            }
        }
        $nota->save();

        return redirect()->route('notas_cotizacion.index')
            ->with('success', 'actualizada exitosamente.');
    }

    public function update_estatus(Request $request, $id){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera/');
        }else{
            $pago_fuera = public_path() . '/pago_fuera/';
        }

        $nota = NotasProductos::findOrFail($id);
        $nota->estatus_cotizacion  = $request->get('estatus_cotizacion');
        $nota->estadociudad  = $request->get('estado');

            if($request->get('estatus_cotizacion') == 'Preparado'){
                $nota->fecha_preparado  = date("Y-m-d H:i:s");
                $producto_pedido = ProductosNotasId::where('id_notas_productos', $id)->get();

                foreach ($producto_pedido as $campo) {
                    $product_first = Products::where('id', $campo->id_producto)->where('categoria', '!=', 'Ocultar')->first();
                    if ($product_first && $campo->cantidad > 0) {
                        $producto_historial = new HistorialVendidos;
                        $producto_historial->id_producto = $product_first->id;
                        $producto_historial->stock_viejo = $product_first->stock;
                        $producto_historial->cantidad_restado = $campo->cantidad;
                        $producto_historial->stock_actual = $product_first->stock - $campo->cantidad;
                        if($nota->tipo_nota == 'Venta Presencial'){
                            $producto_historial->id_venta_nas = $id;
                        }else{
                            $producto_historial->id_cotizacion_nas = $id;
                        }
                        $producto_historial->save();

                        $product_first->stock -= $campo->cantidad;
                        $product_first->save();
                    }
                }
            }else if($request->get('estatus_cotizacion') == 'Enviado'){
                $nota->fecha_envio  = date("Y-m-d H:i:s");
                $nota->fecha_aprobada  = date("Y-m-d");
                $producto_pedido = ProductosNotasId::where('id_notas_productos', $id)->get();
                foreach ($producto_pedido as $campo) {
                    $product_first = Products::where('id', $campo->id_producto)->where('categoria', '!=', 'Ocultar')->first();
                    if ($product_first && $campo->cantidad > 0) {
                        $producto_historial = new HistorialVendidos;
                        $producto_historial->id_producto = $product_first->id;
                        $producto_historial->stock_viejo = $product_first->stock;
                        $producto_historial->cantidad_restado = $campo->cantidad;
                        $producto_historial->stock_actual = $product_first->stock - $campo->cantidad;
                        $producto_historial->id_venta_nas = $id;
                        $producto_historial->save();

                        $product_first->stock -= $campo->cantidad;
                        $product_first->save();
                    }
                }
            }else if($request->get('estatus_cotizacion') == 'Aprobada'){
                $nota->fecha_aprobada  = date("Y-m-d");

                if ($request->hasFile("foto_pago")) {
                    $file = $request->file('foto_pago');
                    $path = $pago_fuera;
                    $fileName = uniqid() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $nota->foto_pago = $fileName;
                }

                if ($request->hasFile("doc_guia")) {
                    $file = $request->file('doc_guia');
                    $path = $pago_fuera;
                    $fileName = uniqid() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $nota->doc_guia = $fileName;
                }

                if ($request->hasFile("guia_rep")) {
                    $file = $request->file('guia_rep');
                    $path = $pago_fuera;
                    $fileName = uniqid() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $nota->doc_guia = $fileName;
                }

                $nota->fecha_preparacion  = date("Y-m-d H:i:s");

                $nota->metodo_pago  = $request->get('metodo_pago');

                $nota->fecha_entrega  = $request->get('fecha_entrega');
                $nota->direccion_entrega  = $request->get('direccion_entrega');
                $nota->comentario_rep  = $request->get('comentario_rep');
                $nota->id_admin_venta  = auth()->user()->id;
            } else if($request->get('estatus_cotizacion') == 'Aprobado por tiendita'){
                // Cambiar el folio y pasar a Aprobada
                $nota->estatus_cotizacion = 'Aprobada';
                $nota->tipo_nota = 'Venta Presencial';
                $nota->metodo_pago = $request->get('metodo_pago2');
                $nota->foto_pago = $request->get('foto_pago2');
                $nota->id_admin = auth()->user()->id;

                // Obtener todos los folios del tipo de nota específico
                $folios = NotasProductos::where('tipo_nota', 'Venta Presencial')->pluck('folio');

                // Extraer los números de los folios y encontrar el máximo
                $maxNumero = $folios->map(function ($folio) {
                    return intval(substr($folio, strlen('V')));
                })->max();

                // Si hay un folio existente, sumarle 1 al máximo número
                if ($maxNumero) {
                    $numeroFolio = $maxNumero + 1;
                } else {
                    // Si no hay un folio existente, empezar desde 1
                    $numeroFolio = 1;
                }

                // Crear el nuevo folio con el tipo de nota y el número
                $folio = 'V' . $numeroFolio;

                // Asignar el nuevo folio al objeto
                $nota->folio = $folio;
            }

        $nota->save();

        if($request->get('estatus_cotizacion') == 'Preparado' || $request->get('estatus_cotizacion') == 'Enviado'){
            return redirect()->route('index_preparacion.bodega')
            ->with('success', 'actualizada exitosamente.');
        }else{
            return redirect()->back()->with('success', 'Se ha actualizado');
        }


    }

    public function update_t_cosmica(Request $request, $id){
        $diaActual = date('Y-m-d');

        $nota = OrdersCosmica::findOrFail($id);
        $nota->fecha_envio  = $diaActual;
        $nota->estatus_bodega  = $request->get('estatus_bodega');
        $nota->update();

        return redirect()->back()->with('success', 'Se ha actualizado');
    }

    public function update_guia(Request $request, $id){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera/');
        }else{
            $pago_fuera = public_path() . '/pago_fuera/';
        }

        $nota = NotasProductos::findOrFail($id);
        $nota->fecha_preparacion  = date("Y-m-d H:i:s");
        if ($request->hasFile("doc_guia")) {
            $file = $request->file('doc_guia');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->doc_guia = $fileName;
        }
        $nota->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');

    }

    public function imprimir($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasProductos::find($id);

        $nota_productos = ProductosNotasId::where('id_notas_productos', $nota->id)->get();

        // Iterar sobre los productos de la nota para buscar la imagen correspondiente
        foreach ($nota_productos as $producto_nota) {
            $producto = Products::where('nombre', $producto_nota->producto)->where('categoria', '!=', 'Ocultar')->first();

            if ($producto) {
                $producto_nota->imagen_producto = $producto->imagenes;
            } else {
                $producto_nota->imagen_producto = null; // O algún valor por defecto
            }
        }

        $pdf = \PDF::loadView('admin.notas_productos.pdf_nota', compact('nota', 'today', 'nota_productos'));
        if($nota->folio == null){
            $folio = $nota->id;
        }else{
            $folio = $nota->folio;
        }
        return $pdf->stream();
         //return $pdf->download('Nota cotizacion'. $folio .'/'.$today.'.pdf');
    }

    public function delete($id)
    {
        $registro = ProductosNotasId::find($id); // Buscar el registro por su ID
        // Realizar las operaciones necesarias antes de eliminar el registro, si las hay
        $registro->delete();

        $sum_total = DB::table('productos_notas_id')->get();
        $total_pro = 0;
        foreach($sum_total as  $productos){
            $precio = $productos->price;
            $cantidad = $productos->cantidad;
            $subtotal = $precio * $cantidad;
            $total_pro += $subtotal;
        }

        $nota = NotasProductos::where('id', '=', $registro->id_notas_productos)->first();
        if ($nota->tipo == 'Fijo') {
            $descuento = $nota->restante;
            $total_pro -= $descuento;
        }elseif ($nota->tipo == 'Porcentaje') {
            $descuento = $nota->restante / 100;
            $descuentoAplicado = $total_pro * $descuento;
            $total_pro -= $descuentoAplicado;
        }
        $nota->total = $total_pro;
        $nota->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha eliminado');
    }

    public function update_productos(Request $request){
        $productos = $request->input('productos');

        foreach ($productos as $id => $data) {
            $producto = ProductosNotasId::findOrFail($id);
            $producto->producto = $data['producto'];
            $producto->price = $data['price'];
            $producto->cantidad = $data['cantidad'];
            $producto->save();
        }

        $sum_total = DB::table('productos_notas_id')->get();
        $total_pro = 0;
        foreach($sum_total as  $productos){
            $precio = $productos->price;
            $cantidad = $productos->cantidad;
            $subtotal = $precio * $cantidad;
            $total_pro += $subtotal;
        }

        $nota = NotasProductos::where('id', '=', $producto->id_notas_productos)->first();
        if ($nota->tipo == 'Fijo') {
            $descuento = $nota->restante;
            $total_pro -= $descuento;
        }elseif ($nota->tipo == 'Porcentaje') {
            $descuento = $nota->restante / 100;
            $descuentoAplicado = $total_pro * $descuento;
            $total_pro -= $descuentoAplicado;
        }
        $nota->total = $total_pro;
        $nota->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');
    }

    public function eliminar($id){
        // Encuentra la nota por su ID
        $nota = NotasProductos::find($id);

        // Elimina todos los productos relacionados
        $nota->ProductosNotasId()->delete();

        // Verifica si la nota existe
        if (!$nota) {
            abort(404, 'La nota no existe');
        }

        // Elimina la nota
        $nota->delete();

        // Redirecciona o responde según tus necesidades
        return redirect()->back()->with('success', 'La nota se eliminó correctamente');
    }

    public function imprimir_reporte(Request $request){

        // Configuración de fechas de filtro
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $notas = NotasProductos::whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion','=' , null)->get();

        $notasAprobadas = NotasProductos::whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')
        ->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado'])
        ->get();

        $notasPendientes = NotasProductos::whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->where('estatus_cotizacion','=' , 'Pendiente')->get();

        $notasCandeladas = NotasProductos::whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->where('estatus_cotizacion','=' , 'Cancelada')->get();

        $products = Products::orderBy('nombre','ASC')->get();
        $today =  date('d-m-Y');

        if ($request->input('action') === 'Generar PDF') {

            $today =  date('d-m-Y');
            $query = NotasProductos::query();

            if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');

                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            }

            $query->orderBy('id', 'DESC')->where('tipo_nota', '=', 'Cotizacion')->where('estatus_cotizacion', NULL);
            $totalSum = $query->sum('total');
            $cotizaciones = $query->get();

            // 2. Obtener los IDs de las cotizaciones filtradas
            $cotizacionIds = $cotizaciones->pluck('id');

            // 3. Obtener y sumar las cantidades por producto de esas cotizaciones
            $productosMasCotizados = ProductosNotasId::whereIn('id_notas_productos', $cotizacionIds)
                ->select('producto', DB::raw('SUM(cantidad) as total_cantidad'))
                ->groupBy('producto')
                ->orderBy('total_cantidad', 'DESC')
                ->limit(5)
                ->get();

            $productosMenosCotizados = ProductosNotasId::whereIn('id_notas_productos', $cotizacionIds)
                ->select('producto', DB::raw('SUM(cantidad) as total_cantidad'))
                ->groupBy('producto')
                ->orderBy('total_cantidad', 'ASC')
                ->limit(5)
                ->get();

                $labels = $productosMasCotizados->pluck('producto')->toArray();
                $labelsMenos = $productosMenosCotizados->pluck('producto')->toArray();

                $data = $productosMasCotizados->pluck('total_cantidad')->toArray();
                $dataMenos = $productosMenosCotizados->pluck('total_cantidad')->toArray();

                $chartData = [
                    "type" => 'bar', // Cambiar de 'bar' a 'pie' para una gráfica de pastel
                    "data" => [
                        "labels" => $labels, // Etiquetas para los productos
                        "datasets" => [
                            [
                                "label" => "Productos más cotizados",
                                "data" => $data, // Cantidades correspondientes a cada producto
                                "backgroundColor" => [
                                    '#27ae60', '#f1c40f', '#e74c3c', '#3498db', '#9b59b6'
                                ],
                            ],
                        ],
                    ],
                    "options" => [
                        "plugins" => [
                            "datalabels" => [
                                "color" => 'white', // Cambia el color del texto a blanco
                            ],
                        ],
                        "legend" => [
                            "display" => true // Mostrar la leyenda de colores
                        ],
                    ],
                ];

                $chart_Menos = [
                    "type" => 'bar', // Cambiar de 'bar' a 'pie' para una gráfica de pastel
                    "data" => [
                        "labels" => $labelsMenos, // Etiquetas para los productos
                        "datasets" => [
                            [
                                "label" => "Productos más cotizados",
                                "data" => $dataMenos, // Cantidades correspondientes a cada producto
                                "backgroundColor" => [
                                    '#27ae60', '#f1c40f', '#e74c3c', '#3498db', '#9b59b6'
                                ],
                            ],
                        ],
                    ],
                    "options" => [
                        "plugins" => [
                            "datalabels" => [
                                "color" => 'white', // Cambia el color del texto a blanco
                            ],
                        ],
                        "legend" => [
                            "display" => true // Mostrar la leyenda de colores
                        ],
                    ],
                ];

                $chartData = json_encode($chartData);
                $chart_Menos = json_encode($chart_Menos);


                $chartURL = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData);
                $chartURLMennos = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chart_Menos);

                $chartData = file_get_contents($chartURL);
                $chartDataMenos = file_get_contents($chartURLMennos);

                $chart = 'data:image/png;base64, '.base64_encode($chartData);
                $chart_menoscot = 'data:image/png;base64, '.base64_encode($chartDataMenos);

            $query2 = NotasProductos::query();

            if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');

                $query2->whereBetween('fecha_aprobada', [$fechaInicio, $fechaFin]);
            }

            $query2->orderBy('id', 'DESC')->where('tipo_nota', 'Cotizacion')->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado']);
            $totalSum2 = $query2->sum('total');
            $ventas = $query2->get();

            $nota_productos = ProductosNotasId::get();

            // 2. Obtener los IDs de las cotizaciones filtradas
            $ventasIds = $ventas->pluck('id');

            // 3. Obtener y sumar las cantidades por producto de esas cotizaciones
            $productosMasVendidos = ProductosNotasId::whereIn('id_notas_productos', $ventasIds)
                ->select('producto', DB::raw('SUM(cantidad) as total_cantidad'))
                ->groupBy('producto')
                ->orderBy('total_cantidad', 'DESC')
                ->limit(5)
                ->get();

            $productosMenosVendidos = ProductosNotasId::whereIn('id_notas_productos', $ventasIds)
                ->select('producto', DB::raw('SUM(cantidad) as total_cantidad'))
                ->groupBy('producto')
                ->orderBy('total_cantidad', 'ASC')
                ->limit(5)
                ->get();

                $labels2 = $productosMasVendidos->pluck('producto')->toArray();
                $labels_ProductMenos = $productosMenosVendidos->pluck('producto')->toArray();

                $data2 = $productosMasVendidos->pluck('total_cantidad')->toArray();
                $data_ProductMenos = $productosMenosVendidos->pluck('total_cantidad')->toArray();

                $chartData2 = [
                    "type" => 'bar', // Cambiar de 'bar' a 'pie' para una gráfica de pastel
                    "data" => [
                        "labels" => $labels2, // Etiquetas para los productos
                        "datasets" => [
                            [
                                "label" => "Productos más vendidos",
                                "data" => $data2, // Cantidades correspondientes a cada producto
                                "backgroundColor" => [
                                    '#27ae60', '#f1c40f', '#e74c3c', '#3498db', '#9b59b6'
                                ],
                            ],
                        ],
                    ],
                    "options" => [
                        "plugins" => [
                            "datalabels" => [
                                "color" => 'white', // Cambia el color del texto a blanco
                            ],
                        ],
                        "legend" => [
                            "display" => true // Mostrar la leyenda de colores
                        ],
                    ],
                ];

                $chartData_ProductMenos = [
                    "type" => 'bar', // Cambiar de 'bar' a 'pie' para una gráfica de pastel
                    "data" => [
                        "labels" => $labels_ProductMenos, // Etiquetas para los productos
                        "datasets" => [
                            [
                                "label" => "Productos más vendidos",
                                "data" => $data_ProductMenos, // Cantidades correspondientes a cada producto
                                "backgroundColor" => [
                                    '#27ae60', '#f1c40f', '#e74c3c', '#3498db', '#9b59b6'
                                ],
                            ],
                        ],
                    ],
                    "options" => [
                        "plugins" => [
                            "datalabels" => [
                                "color" => 'white', // Cambia el color del texto a blanco
                            ],
                        ],
                        "legend" => [
                            "display" => true // Mostrar la leyenda de colores
                        ],
                    ],
                ];

                $chartData2 = json_encode($chartData2);

                $chartData_ProductMenos = json_encode($chartData_ProductMenos);

                $chartURL2 = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData2);

                $chartURL_ProductMeno = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData_ProductMenos);

                $chartData2 = file_get_contents($chartURL2);

                $chartData_ProductMenos = file_get_contents($chartURL_ProductMeno);

                $chart2 = 'data:image/png;base64, '.base64_encode($chartData2);

                $chart_ProductMeno = 'data:image/png;base64, '.base64_encode($chartData_ProductMenos);

                $ciudadesData = NotasProductos::whereNotNull('estadociudad') // Filtra los registros donde estadociudad no es null
                ->whereBetween('fecha_aprobada', [$fechaInicio, $fechaFin])
                ->select('estadociudad', DB::raw('COUNT(*) as total_compras'))
                ->groupBy('estadociudad')
                ->orderBy('total_compras', 'desc')
                ->groupBy('estadociudad')
                ->get();

                $colores = [
                    '#1abc9c', '#16a085', '#2ecc71', '#27ae60', '#3498db', '#2980b9', '#9b59b6',
                    '#8e44ad', '#34495e', '#2c3e50', '#f1c40f', '#f39c12', '#e67e22', '#d35400',
                    '#e74c3c', '#c0392b', '#ecf0f1', '#bdc3c7', '#95a5a6', '#7f8c8d', '#e91e63',
                    '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#00bcd4', '#009688', '#4caf50',
                    '#8bc34a', '#cddc39', '#ffeb3b', '#ffc107', '#ff9800', '#ff5722'
                ];

                // $labelsGrafica = $ciudadesData->pluck('estadociudad')->toArray();

                $labelsGrafica = $ciudadesData->map(function($item) {
                    return $item->estadociudad . ' (' . $item->total_compras . ')';
                })->toArray();

                $dataGrafica = $ciudadesData->pluck('total_compras')->toArray();

                $chartDataGrafica = [
                    "type" => 'pie', // Puedes cambiarlo a 'pie', 'line', etc.
                    "data" => [
                        "labels" => $labelsGrafica, // Etiquetas para las ciudades
                        "datasets" => [
                            [
                                "label" => "Compras por Ciudad",
                                "data" => $dataGrafica, // Cantidades correspondientes a cada ciudad
                                "backgroundColor" => $colores, // Aplica los colores generados
                            ],
                        ],
                    ],
                    "options" => [
                        "plugins" => [
                            "datalabels" => [
                                "color" => 'white', // Cambia el color del texto a blanco
                            ],
                        ],
                        "legend" => [
                            "display" => true // Mostrar la leyenda de colores
                        ],
                    ],
                ];

                $chartDataGrafica = json_encode($chartDataGrafica);
                $chartURLGrafica = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartDataGrafica);

                $chartDataGrafica = file_get_contents($chartURLGrafica);
                $chartGrafica = 'data:image/png;base64, '.base64_encode($chartDataGrafica);


            $pdf = \PDF::loadView('admin.cotizacion.pdf_reporte', compact('chartGrafica','chart_ProductMeno','chart_menoscot','cotizaciones', 'today', 'ventas', 'chart', 'chart2', 'totalSum', 'totalSum2', 'fechaInicio', 'fechaFin'));

            // return $pdf->stream();
            return $pdf->download('Reporte NAS / '.$today.'.pdf');

        }else if($request->input('action') === 'Generar PDF Global'){
            $fechaInicioAnio = '2024-01-01';
            $fechaFinAnio = '2024-12-31';

            // Query
            $productosVendidos = DB::table('notas_productos')
                ->join('productos_notas_id', 'notas_productos.id', '=', 'productos_notas_id.id_notas_productos')
                ->join('products', 'productos_notas_id.id_producto', '=', 'products.id') // Relación con productos
                ->where('products.categoria', 'NAS')
                ->where('products.subcategoria', 'Producto')
                ->whereNotNull('notas_productos.estatus_cotizacion') // Estatus diferente de null
                ->where('notas_productos.estatus_cotizacion', '!=', 'Cancelada') // Estatus diferente de Cancelada
                ->whereBetween('notas_productos.fecha', [$fechaInicioAnio, $fechaFinAnio]) // Rango de fechas del año
                ->where('products.precio_normal', '!=', 0)
                ->select('products.nombre as producto', DB::raw('COUNT(productos_notas_id.id_producto) as vendidos'))
                ->groupBy('products.nombre') // Agrupamos por nombre del producto
                ->orderBy('vendidos', 'desc') // Opcional, para ordenar por mayor cantidad vendida
                ->get();

            $query = NotasProductos::query();

            if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');

                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            }
            //productos menos cotizados

            $query2 = NotasProductos::query();

            $totalSum2 = NotasProductos::where('tipo_nota', 'Venta Presencial')
            ->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado'])
            ->whereBetween('fecha', [$fechaInicioAnio, $fechaFinAnio])
            ->sum('total');

                $ventas = $query2->get();

                $nota_productos = ProductosNotasId::get();

                // 2. Obtener los IDs de las cotizaciones filtradas
                $ventasIds = $ventas->pluck('id');

                // 3. Obtener y sumar las cantidades por producto de esas cotizaciones
                $productosMasVendidos = DB::table('notas_productos')
                    ->join('productos_notas_id', 'notas_productos.id', '=', 'productos_notas_id.id_notas_productos')
                    ->join('products', 'productos_notas_id.id_producto', '=', 'products.id') // Relación con productos
                    ->where('products.categoria', 'NAS')
                    ->where('products.subcategoria', 'Producto')
                    ->whereNotNull('notas_productos.estatus_cotizacion') // Estatus diferente de null
                    ->where('notas_productos.estatus_cotizacion', '!=', 'Cancelada') // Estatus diferente de Cancelada
                    ->whereBetween('notas_productos.fecha', [$fechaInicioAnio, $fechaFinAnio]) // Rango de fechas del año
                    ->where('products.precio_normal', '!=', 0)
                    ->select('products.nombre as producto', DB::raw('SUM(productos_notas_id.cantidad) as total_vendidos'))
                    ->groupBy('products.nombre') // Agrupamos por nombre del producto
                    ->orderBy('total_vendidos', 'desc') // Orden descendente para los más vendidos
                    ->limit(10) // Mostrar los 10 más vendidos
                    ->get();

                $labels2 = $productosMasVendidos->pluck('producto')->toArray();
                $data2 = $productosMasVendidos->pluck('total_vendidos')->toArray(); // Usamos el nombre correcto de la columna

                $chartData2 = [
                    "type" => 'bar',
                    "data" => [
                        "labels" => $labels2,
                        "datasets" => [
                            [
                                "label" => "Productos Más Vendidos",
                                "data" => $data2,
                                "backgroundColor" => [
                                    '#1abc9c', '#16a085', '#2ecc71', '#27ae60', '#3498db', '#2980b9', '#9b59b6',
                                    '#8e44ad', '#34495e', '#2c3e50', '#f1c40f', '#f39c12', '#e67e22', '#d35400',
                                    '#e74c3c', '#c0392b', '#ecf0f1', '#bdc3c7', '#95a5a6', '#7f8c8d', '#e91e63',
                                    '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#00bcd4', '#009688', '#4caf50',
                                    '#8bc34a', '#cddc39'
                                ],
                            ],
                        ],
                    ],
                    "options" => [
                        "scales" => [
                            "y" => [
                                "beginAtZero" => true,
                                "ticks" => [
                                    "stepSize" => 1, // Escala en pasos de 1
                                ],
                            ],
                        ],
                        "plugins" => [
                            "datalabels" => [
                                "color" => 'white',
                            ],
                        ],
                        "legend" => [
                            "display" => true,
                        ],
                    ],
                ];

                $chartData2 = json_encode($chartData2);

                $chartURL2 = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData2);

                $chartData2 = file_get_contents($chartURL2);
                $chart2 = 'data:image/png;base64, '.base64_encode($chartData2);


                // Consulta para productos menos vendidos
                $productosMenosVendidos = DB::table('notas_productos')
                ->join('productos_notas_id', 'notas_productos.id', '=', 'productos_notas_id.id_notas_productos')
                ->join('products', 'productos_notas_id.id_producto', '=', 'products.id') // Relación con productos
                ->where('products.categoria', 'NAS')
                ->where('products.subcategoria', 'Producto')
                ->whereNotNull('notas_productos.estatus_cotizacion') // Estatus diferente de null
                ->where('notas_productos.estatus_cotizacion', '!=', 'Cancelada') // Estatus diferente de Cancelada
                ->whereBetween('notas_productos.fecha', [$fechaInicioAnio, $fechaFinAnio]) // Rango de fechas del año
                ->where('products.precio_normal', '!=', 0)
                ->select('products.nombre as producto', DB::raw('SUM(productos_notas_id.cantidad) as total_vendidos'))
                ->groupBy('products.nombre') // Agrupamos por nombre del producto
                ->orderBy('total_vendidos', 'asc') // Orden ascendente para menos vendidos
                ->limit(10) // Mostrar los 10 menos vendidos
                ->get();

                $labels3 = $productosMenosVendidos->pluck('producto')->toArray();
                $data3 = $productosMenosVendidos->pluck('total_vendidos')->toArray();

                $chartData3 = [
                    "type" => 'bar',
                    "data" => [
                        "labels" => $labels3, // Etiquetas para los productos
                        "datasets" => [
                            [
                                "label" => "Productos Menos Vendidos",
                                "data" => $data3, // Cantidades correspondientes a cada producto
                                "backgroundColor" => [
                                    '#1abc9c', '#16a085', '#2ecc71', '#27ae60', '#3498db', '#2980b9', '#9b59b6',
                                    '#8e44ad', '#34495e', '#2c3e50', '#f1c40f', '#f39c12', '#e67e22', '#d35400',
                                    '#e74c3c', '#c0392b', '#ecf0f1', '#bdc3c7', '#95a5a6', '#7f8c8d', '#e91e63',
                                    '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#00bcd4', '#009688', '#4caf50',
                                    '#8bc34a', '#cddc39'
                                ],
                            ],
                        ],
                    ],
                    "options" => [
                        "plugins" => [
                            "datalabels" => [
                                "color" => 'white', // Cambia el color del texto a blanco
                            ],
                        ],
                        "legend" => [
                            "display" => true, // Mostrar la leyenda de colores
                        ],
                    ],
                ];


                $chartData3 = json_encode($chartData3);

                $chartURL3 = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData3);

                $chartData3 = file_get_contents($chartURL3);
                $chart3 = 'data:image/png;base64, '.base64_encode($chartData3);

                $ciudadesData = NotasProductos::whereNotNull('estadociudad') // Filtra los registros donde estadociudad no es null
                ->whereBetween('fecha_aprobada', [$fechaInicioAnio, $fechaFinAnio])
                ->select('estadociudad', DB::raw('COUNT(*) as total_compras'))
                ->groupBy('estadociudad')
                ->orderBy('total_compras', 'desc')
                ->groupBy('estadociudad')
                ->get();

                $colores = [
                    '#1abc9c', '#16a085', '#2ecc71', '#27ae60', '#3498db', '#2980b9', '#9b59b6',
                    '#8e44ad', '#34495e', '#2c3e50', '#f1c40f', '#f39c12', '#e67e22', '#d35400',
                    '#e74c3c', '#c0392b', '#ecf0f1', '#bdc3c7', '#95a5a6', '#7f8c8d', '#e91e63',
                    '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#00bcd4', '#009688', '#4caf50',
                    '#8bc34a', '#cddc39', '#ffeb3b', '#ffc107', '#ff9800', '#ff5722'
                ];

                // $labelsGrafica = $ciudadesData->pluck('estadociudad')->toArray();

                $labelsGrafica = $ciudadesData->map(function($item) {
                    return $item->estadociudad . ' (' . $item->total_compras . ')';
                })->toArray();

                $dataGrafica = $ciudadesData->pluck('total_compras')->toArray();

                $chartDataGrafica = [
                    "type" => 'pie', // Puedes cambiarlo a 'pie', 'line', etc.
                    "data" => [
                        "labels" => $labelsGrafica, // Etiquetas para las ciudades
                        "datasets" => [
                            [
                                "label" => "Compras por Ciudad",
                                "data" => $dataGrafica, // Cantidades correspondientes a cada ciudad
                                "backgroundColor" => $colores, // Aplica los colores generados
                            ],
                        ],
                    ],
                    "options" => [
                        "plugins" => [
                            "datalabels" => [
                                "color" => 'white', // Cambia el color del texto a blanco
                            ],
                        ],
                        "legend" => [
                            "display" => true // Mostrar la leyenda de colores
                        ],
                    ],
                ];

                $chartDataGrafica = json_encode($chartDataGrafica);
                $chartURLGrafica = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartDataGrafica);

                $chartDataGrafica = file_get_contents($chartURLGrafica);
                $chartGrafica = 'data:image/png;base64, '.base64_encode($chartDataGrafica);

                $ventasPorMes = DB::table('notas_productos')
                    ->select(
                        DB::raw("DATE_FORMAT(fecha, '%Y-%m') as mes"),
                        DB::raw("SUM(total) as total_mensual")
                    )
                    ->where('tipo_nota', 'Venta Presencial')
                    ->whereNotNull('estatus_cotizacion')
                    ->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado']) // Filtro actualizado
                    ->whereBetween('fecha', [$fechaInicioAnio, $fechaFinAnio])
                    ->groupBy(DB::raw("DATE_FORMAT(fecha, '%Y-%m')"))
                    ->orderBy('mes', 'asc')
                    ->get();

                // Formatear los resultados para incluir meses sin ventas
                $meses = collect([
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
                    'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ]);

                $resultado = collect($ventasPorMes)->mapWithKeys(function ($item) {
                    $fecha = Carbon::parse($item->mes . '-01'); // Parseamos el mes y el año
                    return [
                        $fecha->locale('es')->isoFormat('MMMM YYYY') => $item->total_mensual
                    ];
                });

            $pdf = \PDF::loadView('admin.cotizacion.pdf_reporte_global', compact('productosVendidos', 'resultado','today', 'ventas',  'chart2','chart3','chartGrafica', 'totalSum2', 'fechaInicio', 'fechaFin'));

            return $pdf->stream();
            //  return $pdf->download('Reporte Cosmica Ventas Global/ '.$today.'.pdf');

        }

        // Si no se solicita PDF, mostrar los resultados en la vista
        return view('admin.cotizacion.index_busqueda', compact('notas', 'products', 'clientes', 'administradores','notasAprobadas','notasPendientes','notasCandeladas'));

    }

    public function imprimir_ecommerce($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = OrdersCosmica::find($id);

        $nota_productos = OrdersCosmicaOnline::where('id_order', $nota->id)->get();

        // Iterar sobre los productos de la nota para buscar la imagen correspondiente
        foreach ($nota_productos as $producto_nota) {
            $producto = Products::where('id', $producto_nota->id_producto)->where('categoria', '!=', 'Ocultar')->first();

            if ($producto) {
                $producto_nota->imagen_producto = $producto->imagenes;
            } else {
                $producto_nota->imagen_producto = null; // O algún valor por defecto
            }
        }



        $pdf = \PDF::loadView('admin.cosmica_ecommerce.pdf_nota', compact('nota', 'today', 'nota_productos'));
        if($nota->folio == null){
            $folio = $nota->id;
        }else{
            $folio = $nota->folio;
        }
        return $pdf->stream();
         //return $pdf->download('Nota cotizacion'. $folio .'/'.$today.'.pdf');
    }
}
