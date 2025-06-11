<?php

namespace App\Http\Controllers;


use App\Models\ProductosNotasId;
use App\Models\NotasProductos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use App\Models\Cosmikausers;
use App\Models\ProductosBundleId;
use App\Models\Products;
use App\Models\HistorialVendidos;
use App\Models\HistorialStock;
use Illuminate\Support\Str;
use Session;
use Hash;
use DB;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Models\Factura;


class NotasProductosController extends Controller
{
    public function index(){

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();


        $notas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Venta Presencial')->get();

        $products = Products::orderBy('nombre','ASC')->where('categoria', '!=', 'Ocultar')->get();

        return view('admin.notas_productos.index', compact('notas', 'products', 'clientes', 'administradores'));
    }

    public function buscador(Request $request){

        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $products = Products::orderBy('nombre','ASC')->get();

        $id_client = $request->id_client;
        $phone = $request->phone;
        $admin = $request->administradores;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;

        $query = NotasProductos::query();

        if ($id_client !== 'null' && $id_client !== null) {
            $query->where('id_usuario', $id_client);
        } elseif ($phone !== 'null' && $phone !== null) {
            $query->where('id_usuario', $phone);
        }

        if ($admin !== 'null' && $admin !== null) {
            $query->where('id_admin', $admin);
        }

        if ($fecha_inicio !== null) {
            $query->whereDate('fecha', '>=', $fecha_inicio);
        }

        if ($fecha_fin !== null) {
            $query->whereDate('fecha', '<=', $fecha_fin);
        }

        $notas = $query->get();

        return view('admin.notas_productos.index', compact('notas', 'products', 'clientes', 'administradores'));
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

        return view('admin.notas_productos.create', compact('products', 'clientes'));
    }

    public function ventas_cliente($id){
        $user = Cosmikausers::where('id_cliente', $id)->first();

        if ($user && $user->membresia_estatus === 'Activa') {
            return response()->json([
                'status' => 'activo',
                'membresia' => $user->membresia,
            ]);
        } else {
            return response()->json([
                'status' => 'inactivo',
            ]);
        }
    }

    public function store(request $request){

        // Creacion de user
        $code = Str::random(8);

        $notas_productos = new NotasProductos;
        if($request->id_client == NULL){
            if($request->get('email') == NULL){
                $notas_productos->nombre = $request->get('name');
                $notas_productos->telefono = $request->get('telefono');
            }else{
                if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
                    if (User::where('telefono', $request->telefono)->exists()) {
                        $user = User::where('telefono', $request->telefono)->first();
                    } else {
                        $user = User::where('email', $request->email)->first();
                    }
                    $payer = $user;
                } else {
                    $payer = new User;
                    $payer->name = $request->get('name');
                    $payer->email = $request->get('email');
                    $payer->username = $request->get('telefono');
                    $payer->code = $code;
                    $payer->telefono = $request->get('telefono');
                    $payer->cliente = '1';
                    $payer->password = Hash::make($request->get('telefono'));
                    $payer->save();
                    $datos = User::where('id', '=', $payer->id)->first();
                    // Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
                }
                $notas_productos->id_usuario = $payer->id;
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

        $notas_productos->tipo_nota = 'Venta Presencial';
        $notas_productos->metodo_pago = $request->get('metodo_pago');
        $notas_productos->estatus_cotizacion = 'Aprobada';
        $notas_productos->fecha_preparacion = date('Y-m-d');
        $notas_productos->fecha = $request->get('fecha');
        $notas_productos->tipo = $sumaCampo4;
        $notas_productos->restante = $request->get('descuento');
        $notas_productos->total = $totalConDescuento;
        $notas_productos->nota = $request->get('nota');
        $notas_productos->metodo_pago2 = $request->get('metodo_pago2');
        $notas_productos->monto = $request->get('monto');
        $notas_productos->monto2 = $request->get('monto2');
        $tipoNota = $notas_productos->tipo_nota;

        if($request->id_client == NULL){
        }else{
            if(Cosmikausers::where('id_cliente', $notas_productos->id_usuario)->exists()){
                $distribuidora = Cosmikausers::where('id_cliente', $notas_productos->id_usuario)->first();
                $suma = $distribuidora->puntos_acomulados + $notas_productos->total;

                // Obtener solo los múltiplos de 1000
                $puntos_sumar = floor($suma / 1000) * 1000;

                // Solo sumar si puntos_sumar es mayor o igual a 1000
                if ($puntos_sumar >= 1000) {
                    $distribuidora->puntos_acomulados = $puntos_sumar;
                    $distribuidora->consumido_totalmes = $suma;
                    $distribuidora->update();
                }
            }
        }

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
            $facturas->id_notas_nas_tiendita = $notas_productos->id;
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

                        $descuentoCampo = $request->input('descuento_prod')[$contadorKits - 1] ?? null; // Obtener la cantidad del kit actual
                        if ($descuentoCampo) {
                            $columnaDescuentoKit = "descuento_kit" . ($contadorKits > 1 ? $contadorKits : "");
                            $notas_productos->$columnaDescuentoKit = $descuentoCampo;
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

                        if ($request->get('factura') != NULL && $producto->categoria === 'Cosmica') {
                            $notas_inscripcion->precio_iva = round($notas_inscripcion->price * 1.16);
                        }
                        $notas_inscripcion->save();
                }
            }
            $notas_productos->save();
        }

        if($request->get('tipo_cotizacion') == 'Perfil Alumno'){
            return redirect()->back()->with('success', 'Se ha creado su cotizacion con exito');
        }else{
            Session::flash('success', 'Se ha guardado sus datos con exito');
            return redirect()->back()->with('success', 'Se ha creado su cotizacion con exito');

        }
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

        return view('admin.notas_productos.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function update(Request $request, $id) {
        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');
        $total = 0;

        $productosIdsEnviados = [];

        if($producto == NULL){

        }else{

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

        if($producto == NULL){

        }else{
            for ($count = 0; $count < count($producto); $count++) {
                // Buscar el producto en tabla Products
                $producto_first = Products::where('nombre', $producto[$count])
                    ->where('categoria', '!=', 'Ocultar')
                    ->first();

                if (!$producto_first) {
                    continue; // Si no existe el producto, saltamos
                }

                // Buscar el producto ya asociado a la cotización
                $producto_nota = ProductosNotasId::where('id_notas_productos', $id)
                    ->where('id_producto', $producto_first->id)
                    ->first();

                $cleanPrice = floatval(str_replace(['$', ','], '', $price[$count]));

                // Si ya existe, lo actualizamos
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
                            $columnaDescuentoKit = "descuento_kit" . ($slot == 1 ? '' : $slot);

                            $nota->$columnaKit = $producto_first->id;
                            $nota->$columnaCantidadKit = $campo3[$count];
                            $nota->$columnaDescuentoKit = $descuento_prod[$count];
                            $nota->save();
                        }
                    }
                }else {
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

        $cleanPrice4 = floatval(str_replace(['$', ','], '', $request->get('subtotal_final')));
        $cleanPriceTotal = floatval(str_replace(['$', ','], '', $request->get('total_final')));
        $nota->subtotal = $cleanPrice4;
        $nota->total = $cleanPriceTotal;
        $nota->envio = $request->get('envio');
        $nota->dinero_recibido = $request->get('costo_envio');

        $nota->metodo_pago = $request->get('metodo_pago');
        // $nota->restante = $request->get('descuento');
        // $nota->total = $totalConDescuento;
        $nota->nota = $request->get('nota');
        $nota->metodo_pago2 = $request->get('metodo_pago2');
        $nota->monto = $request->get('monto');
        $nota->monto2 = $request->get('monto2');

        $kits_cantidades = $request->input('cantidad_kit');
        $descuento_prod = $request->input('descuento_kit');
        for ($i = 1; $i <= 6; $i++) {
            $idKitCampo = "id_kit" . ($i == 1 ? '' : $i); // id_kit, id_kit2, ..., id_kit6
            $cantidadKitCampo = "cantidad_kit" . ($i == 1 ? '' : $i); // cantidad_kit, cantidad_kit2, ...
            $columnaDescuentoKit = "descuento_kit" . ($i == 1 ? '' : $i);

            if (!empty($nota->$idKitCampo)) {
                // Si existe el kit, actualizamos su cantidad con la correspondiente del array
                $index = $i - 1; // los arrays empiezan en 0
                if (isset($kits_cantidades[$index])) {
                    $nota->$cantidadKitCampo = $kits_cantidades[$index];
                    $nota->$columnaDescuentoKit = $descuento_prod[$index];
                }
            }
        }

        if($request->get('factura') != NULL){
            $nota->factura = '1';
            $nota->save();
            $facturas = new Factura;
            $facturas->id_usuario = auth()->user()->id;
            $facturas->id_notas_nas = $nota->id;
            $estado = 'Por Facturar';
            $facturas->estatus = $estado;
            $facturas->save();
        }else{
            $nota->save();
        }

        return redirect()->back()->with('success', 'Actualizado');
    }

    public function imprimir($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasProductos::find($id);

        $nota_productos = ProductosNotasId::where('id_notas_productos', $nota->id)->get();

        $pdf = \PDF::loadView('admin.notas_productos.pdf_nota', compact('nota', 'today', 'nota_productos'));

       if($nota->folio == null){
            $folio = $nota->id;
        }else{
            $folio = $nota->folio;
        }

        return $pdf->stream();
        // return $pdf->download('Nota remision'. $folio .'/'.$today.'.pdf');
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

            // Actualizar los campos modificados
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

    public function update_estatus(Request $request, $id){

        $nota = NotasProductos::findOrFail($id);
        $estatusNuevo = $request->get('estatus_cotizacion');


        if ($estatusNuevo === 'Cancelar') {
            $nota->estatus_cotizacion  = $request->get('estatus_cotizacion');
            $producto_pedido = ProductosNotasId::where('id_notas_productos', $id)->get();

            foreach ($producto_pedido as $campo) {
                // Obtener el producto en cuestión
                $product = Products::where('nombre', $campo->producto)->where('categoria', '!=', 'Ocultar')->first();

                if ($product) {
                    // Recuperar el historial de ventas correspondiente a esta cotización y producto
                    $historial = HistorialVendidos::where('id_producto', $product->id)
                        ->where('id_cotizacion_nas', $id)
                        ->first();

                    if ($historial) {
                        // Revertir el stock a su valor original
                        $product->stock += $historial->cantidad_restado;
                        $product->save();

                        // Registrar el cambio en la tabla HistorialStock
                        $historialData = [
                            'id_producto' => $product->id,
                            'user' => auth()->user()->name, // Se asume que el usuario está autenticado
                            'precio_normal' => $product->precio_normal,
                            'precio_rebajado' => $product->precio_rebajado,
                            'sku' => $product->sku,
                            'stock' => "FC:" . $nota->folio ." - Antes: " . $historial->stock_actual . " -> Ahora: " . $product->stock,
                            'laboratorio' => $product->laboratorio,
                            'categoria' => $product->categoria,
                            'subcategoria' => $product->subcategoria,
                        ];

                        HistorialStock::create($historialData);

                        // Opcional: eliminar o marcar el historial de venta como "revertido" si ya no es necesario.
                        $historial->delete();
                    }
                }
            }
        }

        $nota->save();

        Session::flash('success', 'La cancelación ha sido procesada con éxito.');
        return redirect()->back()->with('success', 'Se ha actualizado el estado de la cotización.');

    }
}
