<?php

namespace App\Http\Controllers;

use App\Models\Bitacora_cosmikausers;
use App\Models\Cosmikausers;
use App\Models\HistorialVendidos;
use App\Models\NotasProductosCosmica;
use App\Models\ProductosBundleId;
use App\Models\ProductosNotasCosmica;
use App\Models\Products;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Session;


class CotizacionCosmicaController extends Controller
{

    public function index(Request $request) {
        $this->checkMembresia();

        // Obtener las fechas para el filtro
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));

        $inicioMesAnterior = Carbon::now()->subMonth()->startOfMonth();
        $finMesActual = Carbon::now()->endOfMonth();
        // Administradores
        $administradores = User::where('cliente', '=', NULL)->orWhere('cliente', '=', '5')->get();

        // Filtrar notas con estatus específicos
        $notas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estatus_cotizacion', '=', NULL)
            ->orderBy('id', 'DESC')
            ->where('tipo_nota', '=', 'Cotizacion')
            ->get();

        // Pasar datos a la vista
        return view('admin.cotizacion_cosmica.index', compact('notas', 'administradores','fechaInicio', 'fechaFin'));
    }

    public function index_aprobadas(Request $request) {
        $this->checkMembresia();

        // Obtener las fechas para el filtro
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));

        $inicioMesAnterior = Carbon::now()->subMonth()->startOfMonth();
        $finMesActual = Carbon::now()->endOfMonth();
        // Administradores
        $administradores = User::where('cliente', '=', NULL)->orWhere('cliente', '=', '5')->get();

        // Filtrar notas con estatus específicos

        $notas_aprobadas = NotasProductosCosmica::whereBetween('fecha', [$inicioMesAnterior, $finMesActual])
            ->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado'])
            ->where('tipo_nota', '=', 'Cotizacion')
            ->orderBy('id', 'DESC')
            ->get();

        // Pasar datos a la vista
        return view('admin.cotizacion_cosmica.index_aprobadas', compact( 'administradores', 'notas_aprobadas', 'fechaInicio', 'fechaFin'));
    }

    public function index_canceladas(Request $request) {
        $this->checkMembresia();

        // Obtener las fechas para el filtro
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));

        $inicioMesAnterior = Carbon::now()->subMonth()->startOfMonth();
        $finMesActual = Carbon::now()->endOfMonth();
        // Administradores
        $administradores = User::where('cliente', '=', NULL)->orWhere('cliente', '=', '5')->get();

        // Filtrar notas con estatus específicos
        $notas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estatus_cotizacion', '=', NULL)
            ->orderBy('id', 'DESC')
            ->where('tipo_nota', '=', 'Cotizacion')
            ->get();

        $notas_aprobadas = NotasProductosCosmica::whereBetween('fecha', [$inicioMesAnterior, $finMesActual])
            ->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado'])
            ->where('tipo_nota', '=', 'Cotizacion')
            ->orderBy('id', 'DESC')
            ->get();

        $notas_canceladas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estatus_cotizacion', '=', 'Cancelada')
            ->orderBy('id', 'DESC')
            ->get();

        // Pasar datos a la vista
        return view('admin.cotizacion_cosmica.index_canceladas', compact('notas', 'administradores', 'notas_aprobadas', 'notas_canceladas', 'fechaInicio', 'fechaFin'));
    }

    public function index_protocolo(Request $request, $id)
    {
        // Obtén el distribuidora
        $distribuidora = Cosmikausers::find($id);

        // Verifica si hay una cookie con la clave de acceso
        $claveAcceso = Cookie::get('claves_protocolo' . $id);

        // Si la cookie existe, muestra el iframe
        if ($claveAcceso) {
            return view('user.revista', ['distribuidora' => $distribuidora, 'show_iframe' => true]);
        }

        // Si no, muestra el formulario para ingresar la clave
        return view('user.revista', ['distribuidora' => $distribuidora, 'show_iframe' => false]);
    }

    public function validate_protocolo(Request $request, $id)
    {
        // Obtén el distribuidora
        $distribuidora = Cosmikausers::find($id);

        // Verifica si la membresía está activa
        if ($distribuidora->membresia_estatus !== 'Activa') {
            return redirect()->route('distribuidoras.index_protocolo', $id)->withErrors(['claves_protocolo' => 'Tu membresía ha vencido.']);
        }else{
            // Verifica la clave de acceso
            $inputClave = $request->input('claves_protocolo');

            // Si la clave es correcta, guarda una cookie por 24 horas
            if ($inputClave == $distribuidora->claves_protocolo) {
                Cookie::queue('claves_protocolo' . $id, $inputClave, 1440); // 1440 minutos = 24 horas
                return redirect()->route('distribuidoras.index_protocolo', $id)->with('show_iframe', true);
            }

            // Si la clave es incorrecta, redirige de vuelta al formulario con un mensaje de error
            return redirect()->route('distribuidoras.index_protocolo', $id)->withErrors(['claves_protocolo' => 'Clave incorrecta']);
        }


    }

    public function buscador(Request $request){
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $admin = $request->administradores;

        $query = NotasProductosCosmica::query();
        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $fechaInicio = $request->input('fecha_inicio');
            $fechaFin = $request->input('fecha_fin');

            $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $notas = $query->get();

        return view('admin.cotizacion_cosmica.index',compact('notas', 'administradores'));
    }

    public function create(){
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $products = Products::where('categoria', '=', 'Cosmica')->orderBy('nombre','ASC')->get();

        return view('admin.cotizacion_cosmica.create', compact('products', 'clientes'));
    }

    public function store(request $request){

        // Creacion de user
        $code = Str::random(8);

        $notas_productos = new NotasProductosCosmica;

        if($request->get('id_cliente') == NULL){
            $notas_productos->nombre = $request->get('name');
            $notas_productos->telefono = $request->get('telefono');
            $notas_productos->id_usuario = NULL;
        }else{
            $notas_productos->id_usuario = $request->get('id_cliente');
        }

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pagos';
        }

        if($request->get('id_cliente') == NULL){
            if ($request->get('envio') !== NULL) {
                $envio = 180;
            }else{
                $envio = 0;
            }
        }else{
            //C o s t o  d e  E n v i o
            $cliente = Cosmikausers::where('id_cliente', '=', $request->get('id_cliente'))->first();
            $total = $request->input('totalDescuento');

            $envio = 0;
            if ($request->get('envio') !== NULL) {
                // Si el cliente tiene membresía activa, calcular el costo de envío basado en la membresía
                if ($cliente && $cliente->membresia_estatus === 'Activa') {
                    if ($cliente->membresia === 'Cosmos') {
                        $envio = $total >= 1500 ? 90 : 126;
                    } elseif ($cliente->membresia === 'Estelar') {
                        $envio = $total >= 2500 ? 0 : 90;
                    }
                } else {
                    // Si el cliente no tiene membresía activa, el costo de envío es 180
                    $envio = 180;
                }
            }
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
        $notas_productos->dinero_recibido = $envio;
        $notas_productos->metodo_pago = $request->get('metodo_pago');
        $notas_productos->fecha = $request->get('fecha');
        $notas_productos->subtotal = $sumaCampo4;
        $notas_productos->restante = $request->get('descuento');
        $notas_productos->total = $totalConDescuento;
        $notas_productos->nota = $request->get('nota');
        $notas_productos->metodo_pago2 = $request->get('metodo_pago2');
        $notas_productos->monto = $request->get('monto');
        $notas_productos->monto2 = $request->get('monto2');

        if($request->get('tipo_cotizacion') == 'Expo'){
            $notas_productos->tipo_nota = 'Expo';
        }else{
            $notas_productos->tipo_nota = 'Cotizacion';
        }

        $tipoNota = $notas_productos->tipo_nota;

        // Obtener todos los folios del tipo de nota específico
        $folios = NotasProductosCosmica::where('tipo_nota', $tipoNota)->pluck('folio');

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
            if ($request->hasFile("situacion_fiscal")) {
                $file = $request->file('situacion_fiscal');
                $path = $pago_fuera;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $notas_productos->situacion_fiscal = $fileName;
            }
            $notas_productos->factura = $request->get('factura');
            $notas_productos->razon_social = $request->get('razon_social');
            $notas_productos->rfc = $request->get('rfc');
            $notas_productos->cfdi = $request->get('cfdi');
            $notas_productos->correo_fac = $request->get('correo_fac');
            $notas_productos->telefono_fac = $request->get('telefono_fac');
            $notas_productos->direccion_fac = $request->get('direccion_fac');
        }
        $notas_productos->save();

        if ($request->has('campo')) {
            $nuevosCampos = $request->input('campo');
            $nuevosCampos2 = $request->input('campo4');
            $nuevosCampos3 = $request->input('campo3');
            $nuevosCampos4 = [];

            // Si descuento_prod no es NULL, asigna los valores a $nuevosCampos4
            if ($request->has('descuento_prod')) {
                $nuevosCampos4 = $request->input('descuento_prod');
            }

            $contadorKits = 1;
            foreach ($nuevosCampos as $index => $campo) {
                $producto = Products::where('id', $campo)->where('categoria', '!=', 'Ocultar')->first();
                if ($producto && $producto->subcategoria == 'Kit') {
                        $productos_bundle = ProductosBundleId::where('id_product', $producto->id)->get();

                        for ($i = 1; $i <= $nuevosCampos3[$index]; $i++) {
                            foreach ($productos_bundle as $producto_bundle) {
                                $notas_inscripcion = new ProductosNotasCosmica;
                                $notas_inscripcion->id_notas_productos = $notas_productos->id;
                                $notas_inscripcion->id_producto = $producto_bundle->id_producto;
                                $notas_inscripcion->producto = $producto_bundle->producto;
                                $notas_inscripcion->price = '0';
                                $notas_inscripcion->cantidad = $producto_bundle->cantidad;
                                $notas_inscripcion->save();
                            }
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
                }elseif($producto->subcategoria == 'Tiendita'){
                    $notas_inscripcion = new ProductosNotasCosmica;
                    $notas_inscripcion->id_notas_productos = $notas_productos->id;
                    $notas_inscripcion->producto = $producto->nombre;
                    $notas_inscripcion->id_producto = $producto->id;
                    $notas_inscripcion->price = $nuevosCampos2[$index];
                    $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                    $notas_inscripcion->descuento = isset($nuevosCampos4[$index]) ? $nuevosCampos4[$index] : 0;
                    $notas_inscripcion->estatus = 1;
                    $notas_inscripcion->save();
                }else{
                    $notas_inscripcion = new ProductosNotasCosmica;
                    $notas_inscripcion->id_notas_productos = $notas_productos->id;
                    $notas_inscripcion->producto = $producto->nombre;
                    $notas_inscripcion->id_producto = $producto->id;
                    $notas_inscripcion->price = $nuevosCampos2[$index];
                    $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                    $notas_inscripcion->descuento = isset($nuevosCampos4[$index]) ? $nuevosCampos4[$index] : 0;
                    $notas_inscripcion->save();
                }
            }
            $notas_productos->save();
        }

        if($request->get('tipo_cotizacion') == 'Expo'){
            return response()->json([
                'success' => true,
                'message' => 'Se ha creado su cotización con éxito',
                'tipo_cotizacion' => 'Expo',
                'id' => $notas_productos->id
            ]);
        }else{
            return redirect()->route('cotizacion_cosmica.index')
            ->with('success', 'Se ha creado su cotizacion con exito');
        }

    }

    public function edit($id){
        $cotizacion = NotasProductosCosmica::find($id);
        $cotizacion_productos = ProductosNotasCosmica::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::where('categoria', '=', 'Cosmica')->orderBy('nombre','ASC')->get();

        return view('admin.cotizacion_cosmica.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function update(Request $request, $id){
        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');
        $total = 0;

        // Obtener los productos actuales de la base de datos para esa cotización
        $productosExistentes = ProductosNotasCosmica::where('id_notas_productos', $id)->get();

        // Crear un array para almacenar los IDs de los productos enviados
        $productosIdsEnviados = [];
        // Actualizar productos existentes
        for ($count = 0; $count < count($producto); $count++) {
            // Buscar el producto en la base de datos
            $productos = ProductosNotasCosmica::where('producto', $producto[$count])
                ->where('id_notas_productos', $id)
                ->firstOrFail();

            // Guardar el ID del producto en el array de productos enviados
            $productosIdsEnviados[] = $productos->id;

            // Limpiar el precio y preparar los datos para la actualización
            $precio = $price[$count];
            $cleanPrice2 = floatval(str_replace(['$', ','], '', $precio));
            $data = array(
                'price' => $cleanPrice2,
                'cantidad' => $cantidad[$count],
                'descuento' => $descuento[$count],
            );

            // Actualizar el producto en la base de datos
            $productos->update($data);
            $total += $cleanPrice2;
        }

        // Eliminar los productos que ya no están en la solicitud
        foreach ($productosExistentes as $productoExistente) {
            if (!in_array($productoExistente->id, $productosIdsEnviados)) {
                $productoExistente->delete();
            }
        }

        $campo = $request->input('campo');
        if(!empty(array_filter($campo, fn($value) => !is_null($value)))){
            $campo4 = $request->input('campo4');
            $campo3 = $request->input('campo3');
            $descuento_prod = $request->input('descuento_prod');

            // Agregar nuevos productos
            for ($count = 0; $count < count($campo); $count++) {
                $producto_first = Products::where('id', $campo)->where('categoria', '!=', 'Ocultar')->first();
                $price = $campo4[$count];
                $cleanPrice = floatval(str_replace(['$', ','], '', $price));
                $data = array(
                    'id_notas_productos' => $id,
                    'producto' => $producto_first->nombre,
                    'id_producto' => $producto_first->id,
                    'price' => $cleanPrice,
                    'cantidad' => $campo3[$count],
                    'descuento' => $descuento_prod[$count],
                );
                ProductosNotasCosmica::create($data);
                $total += $cleanPrice;
            }
        }


        if($request->get('envio') == 'No'){
            $envio = 0;
            $envio_check = 'No';
        }else{
            if($request->get('id_cliente') == NULL){
                $envio = 180;
            }else{
                //C o s t o  d e  E n v i o
                $cliente = Cosmikausers::where('id_cliente', '=', $request->get('id_cliente'))->first();
                $total = $request->input('totalDescuento');

                $envio = 0;
                if ($request->get('envio') !== NULL) {
                    // Si el cliente tiene membresía activa, calcular el costo de envío basado en la membresía
                    if ($cliente && $cliente->membresia_estatus === 'Activa') {
                        if ($cliente->membresia === 'Cosmos') {
                            $envio = $total >= 1500 ? 90 : 126;
                        } elseif ($cliente->membresia === 'Estelar') {
                            $envio = $total >= 2500 ? 0 : 90;
                        }
                    } else {
                        // Si el cliente no tiene membresía activa, el costo de envío es 180
                        $envio = 180;
                    }
                }
            }
            $envio_check = 'Si';
        }

        $total_envio = $total + $envio;
        $nota = NotasProductosCosmica::findOrFail($id);
        $cleanPrice4 = floatval(str_replace(['$', ','], '', $request->get('subtotal_final')));
        $nota->subtotal = $cleanPrice4;
        $nota->total = $total_envio;
        $nota->envio = $envio_check;
        $nota->save();

        return redirect()->back()->with('success', 'Se ha actualizado con exito');
    }

    public function imprimir($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasProductosCosmica::find($id);

        $nota_productos = ProductosNotasCosmica::where('id_notas_productos', $nota->id)->get();

        $usercosmika = Cosmikausers::where('id_cliente','=', $nota->id_usuario)->first();

        $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_nota', compact('nota', 'today', 'nota_productos', 'usercosmika'));
        if($nota->folio == null){
            $folio = $nota->id;
        }else{
            $folio = $nota->folio;
        }
        return $pdf->stream();
       //  return $pdf->download('Cotizacion Cosmica'. $folio .'/'.$today.'.pdf');
    }

    public function update_estatus(Request $request, $id){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera/');
        }else{
            $pago_fuera = public_path() . '/pago_fuera/';
        }

        $nota = NotasProductosCosmica::find($id);

        $nota->estatus_cotizacion =  $request->get('estatus_cotizacion');
        $nota->estadociudad =  $request->get('estado');
            if($request->get('estatus_cotizacion') == 'Preparado'){
                $nota->fecha_preparado  = date("Y-m-d H:i:s");
                $producto_bodega = ProductosNotasCosmica::where('id_notas_productos', $id)->get();

                foreach ($producto_bodega as $campo) {
                    $product_first = Products::where('id', $campo->id_producto)->where('categoria', '!=', 'Ocultar')->first();
                    if ($product_first && $campo->cantidad > 0) {
                        $producto_historial = new HistorialVendidos;
                        $producto_historial->id_producto = $product_first->id;
                        $producto_historial->stock_viejo = $product_first->stock;
                        $producto_historial->cantidad_restado = $campo->cantidad;
                        $producto_historial->stock_actual = $product_first->stock - $campo->cantidad;
                        $producto_historial->id_cotizacion_cosmica = $id;
                        $producto_historial->save();

                        $product_first->stock -= $campo->cantidad;
                        $product_first->save();
                    }
                }
            }else if($request->get('estatus_cotizacion') == 'Enviado'){
                $nota->fecha_envio  = date("Y-m-d H:i:s");
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
            }else if($request->get('estatus_cotizacion') == 'Aprobar Duo y Amor'){
                $nota->estatus_cotizacion  = 'Enviado';
                $nota->fecha_aprobada  = date("Y-m-d");
                $nota->fecha_preparacion  = date("Y-m-d H:i:s");
                $nota->fecha_preparado  = date("Y-m-d H:i:s");
                $nota->fecha_envio  = date("Y-m-d H:i:s");
            }else if($request->get('estatus_cotizacion') == 'Aprobada Expo'){
                $nota->estatus_cotizacion  = 'Enviado';
                $nota->fecha_aprobada  = date("Y-m-d");
                $nota->fecha_preparacion  = date("Y-m-d H:i:s");
                $nota->fecha_preparado  = date("Y-m-d H:i:s");
                $nota->fecha_envio  = date("Y-m-d H:i:s");
            }

        $nota->update();

        if($nota->id_usuario){
            if(Cosmikausers::where('id_cliente', $nota->id_usuario)->exists()){
                $distribuidora = Cosmikausers::where('id_cliente', $nota->id_usuario)->first();
                $suma = $distribuidora->puntos_acomulados + $nota->total;

                // Obtener solo los múltiplos de 1000
                $puntos_sumar = floor($suma / 1000) * 1000;

                // Solo sumar si puntos_sumar es mayor o igual a 1000
                if ($puntos_sumar >= 1000) {
                    $distribuidora->puntos_acomulados = $puntos_sumar;
                    $distribuidora->consumido_totalmes = $suma; // Si esta columna debe contener el valor completo de $suma
                    $distribuidora->update();
                }
            }
        }

        if($request->get('estatus_cotizacion') == 'Aprobada Expo'){
            return redirect()->route('corizacion_expo.index')
            ->with('success', 'Se ha actualizado con exito');

        }else{
            return redirect()->route('index_preparacion.bodega')
            ->with('success', 'Creado exitosamente.');
        }

    }

    public function update_guia(Request $request, $id){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera/');
        }else{
            $pago_fuera = public_path() . '/pago_fuera/';
        }

        $nota = NotasProductosCosmica::findOrFail($id);
        $nota->fecha_preparacion  = date("Y-m-d H:i:s");
        if ($request->hasFile("doc_guia")) {
            $file = $request->file('doc_guia');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->doc_guia = $fileName;
        }
        $nota->save();

        return redirect()->back()->with('success', 'Se ha actualizada');

    }

    public function update_pago(Request $request, $id){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera/');
        }else{
            $pago_fuera = public_path() . '/pago_fuera/';
        }

        $nota = NotasProductosCosmica::findOrFail($id);
        $nota->fecha_preparacion  = date("Y-m-d H:i:s");
        if ($request->hasFile("foto_pago")) {
            $file = $request->file('foto_pago');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->foto_pago = $fileName;
        }
        $nota->save();

        return redirect()->back()->with('success', 'Se ha actualizada');

    }

    public function update_protocolo(Request $request, $id){

        $distribuidora = Cosmikausers::find($id);
        $distribuidora->claves_protocolo = $request->input('claves_protocolo');
        $distribuidora->update();

        return redirect()->back()->with('success', 'Se ha actualizado con exito');
    }

    protected function checkMembresia()
    {
        $users = Cosmikausers::all();

        foreach ($users as $user) {
            $this->handleUserMembresia($user);
            $user->save();
        }
    }

    protected function handleUserMembresia($user)
    {
        $membresiaFin = Carbon::parse($user->membresia_fin);
        $diasRestantes = Carbon::now()->diffInDays($membresiaFin, false);
        $meta = $user->membresia === 'Cosmos' ? 1500 : ($user->membresia === 'Estelar' ? 2500 : 0);

        if ($diasRestantes == 0 && $user->consumido_totalmes >= $meta) {
            $this->createBitacora($user);
            $user->membresia_fin = $membresiaFin->addMonth()->format('Y-m-d');
            $user->consumido_totalmes = 0;
            $user->meses_acomulados += 1;
        } elseif ($diasRestantes < 0 && $diasRestantes >= -5) {
            if ($user->consumido_totalmes < $meta && $diasRestantes == -5) {
                $this->createBitacora($user);
                $user->puntos_acomulados = 0;
                $user->meses_acomulados = 0;
                $user->membresia_estatus = 'Inactiva';
            }
        } elseif ($diasRestantes < -5) {
            $this->createBitacora($user);
            $user->puntos_acomulados = 0;
            $user->meses_acomulados = 0;
            $user->membresia_estatus = 'Inactiva';
        }
    }

    protected function createBitacora($user)
    {
        $bitacora = new Bitacora_cosmikausers();
        $bitacora->id_cliente = $user->id_cliente;
        $bitacora->membresia = $user->membresia;
        $bitacora->puntos_acomulados = $user->puntos_acomulados;
        $bitacora->membresia_inicio = $user->membresia_inicio;
        $bitacora->membresia_fin = $user->membresia_fin;
        $bitacora->meses_acomulados = $user->meses_acomulados;
        $bitacora->consumido_totalmes = $user->consumido_totalmes;
        $bitacora->claves_protocolo = $user->claves_protocolo;
        $bitacora->save();
    }

    public function getDescuento($id){
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

    public function imprimir_reporte(Request $request){

        $this->checkMembresia();

        // Configuración de fechas de filtro
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));

        // Administradores
        $administradores = User::where('cliente', '=', NULL)
            ->orWhere('cliente', '=', '5')
            ->get();

        // Filtrar cotizaciones
        $notas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estatus_cotizacion', '=', NULL)
            ->orderBy('id', 'DESC')
            ->where('tipo_nota', '=', 'Cotizacion')
            ->get();

        $notas_aprobadas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estatus_cotizacion', '=', 'Aprobada')
            ->where('tipo_nota', '=', 'Cotizacion')
            ->orderBy('id', 'DESC')
            ->get();

        $notas_canceladas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estatus_cotizacion', '=', 'Cancelada')
            ->orderBy('id', 'DESC')
            ->get();

            $today =  date('d-m-Y');

        if ($request->input('action') === 'Generar PDF') {

            $query = NotasProductosCosmica::query();

            if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');

                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            }

            $query->orderBy('id', 'DESC')->where('tipo_nota', 'Cotizacion')->where('estatus_cotizacion', NULL);
            $totalSum = $query->sum('total');
            $cotizaciones = $query->get();

            // 2. Obtener los IDs de las cotizaciones filtradas
            $cotizacionIds = $cotizaciones->pluck('id');

            // 3. Obtener y sumar las cantidades por producto de esas cotizaciones
            $productosMasCotizados = ProductosNotasCosmica::whereIn('id_notas_productos', $cotizacionIds)
                ->select('producto', DB::raw('SUM(cantidad) as total_cantidad'))
                ->groupBy('producto')
                ->orderBy('total_cantidad', 'DESC')
                ->limit(10)
                ->get();

                $labels = $productosMasCotizados->pluck('producto')->toArray();
                $data = $productosMasCotizados->pluck('total_cantidad')->toArray();
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

                $chartData = json_encode($chartData);

                $chartURL = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData);

                $chartData = file_get_contents($chartURL);

                $chart = 'data:image/png;base64, '.base64_encode($chartData);

                //productos menos cotizados

                $productosMenosCotizados = ProductosNotasCosmica::whereIn('id_notas_productos', $cotizacionIds)
                ->select('producto', DB::raw('SUM(cantidad) as total_cantidad'))
                ->groupBy('producto')
                ->orderBy('total_cantidad', 'ASC')
                ->limit(10)
                ->get();

                $labelsmenoscot = $productosMenosCotizados->pluck('producto')->toArray();
                $data_menoscot = $productosMenosCotizados->pluck('total_cantidad')->toArray();
                $chartData_menoscot = [
                    "type" => 'bar', // Cambiar de 'bar' a 'pie' para una gráfica de pastel
                    "data" => [
                        "labels" => $labelsmenoscot, // Etiquetas para los productos
                        "datasets" => [
                            [
                                "label" => "Productos menos Cotizados",
                                "data" => $data_menoscot, // Cantidades correspondientes a cada producto
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

                $chartData_menoscot = json_encode($chartData_menoscot);

                $chartURL_menoscot = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData_menoscot);

                $chartData_menoscot = file_get_contents($chartURL_menoscot);

                $chart_menoscot = 'data:image/png;base64, '.base64_encode($chartData_menoscot);

            $query2 = NotasProductosCosmica::query();

            if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');

                $query2->whereBetween('fecha_aprobada', [$fechaInicio, $fechaFin]);
            }

            $query2->orderBy('id', 'DESC')->where('tipo_nota', 'Cotizacion')->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado']);
            $totalSum2 = $query2->sum('total');
            $ventas = $query2->get();

            $nota_productos = ProductosNotasCosmica::get();

            // 2. Obtener los IDs de las cotizaciones filtradas
            $ventasIds = $ventas->pluck('id');

            // 3. Obtener y sumar las cantidades por producto de esas cotizaciones
            $productosMasVendidos = ProductosNotasCosmica::whereIn('id_notas_productos', $ventasIds)
                ->select('producto', DB::raw('SUM(cantidad) as total_cantidad'))
                ->groupBy('producto')
                ->orderBy('total_cantidad', 'DESC')
                ->limit(10)
                ->get();

                $labels2 = $productosMasVendidos->pluck('producto')->toArray();
                $data2 = $productosMasVendidos->pluck('total_cantidad')->toArray();

                $chartData2 = [
                    "type" => 'bar', // Cambiar de 'bar' a 'pie' para una gráfica de pastel
                    "data" => [
                        "labels" => $labels2, // Etiquetas para los productos
                        "datasets" => [
                            [
                                "label" => "Productos mas Vendidos",
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

                $chartData2 = json_encode($chartData2);

                $chartURL2 = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData2);

                $chartData2 = file_get_contents($chartURL2);
                $chart2 = 'data:image/png;base64, '.base64_encode($chartData2);

                // menos productos

                $productosMenosVendidos = ProductosNotasCosmica::whereIn('id_notas_productos', $ventasIds)
                ->select('producto', DB::raw('SUM(cantidad) as total_cantidad'))
                ->groupBy('producto')
                ->orderBy('total_cantidad', 'ASC')
                ->limit(10)
                ->get();

                $labels3 = $productosMenosVendidos->pluck('producto')->toArray();
                $data3 = $productosMenosVendidos->pluck('total_cantidad')->toArray();

                $chartData3 = [
                    "type" => 'bar', // Cambiar de 'bar' a 'pie' para una gráfica de pastel
                    "data" => [
                        "labels" => $labels3, // Etiquetas para los productos
                        "datasets" => [
                            [
                                "label" => "Productos menos Vendidos",
                                "data" => $data3, // Cantidades correspondientes a cada producto
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

                $chartData3 = json_encode($chartData3);

                $chartURL3 = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData3);

                $chartData3 = file_get_contents($chartURL3);
                $chart3 = 'data:image/png;base64, '.base64_encode($chartData3);

                //estados grafica

                // $ciudadesGrafica = NotasProductosCosmica::select('estadociudad', DB::raw('COUNT(*) as total_compras'))
                // ->groupBy('estadociudad')
                // ->orderBy('total_compras', 'desc')
                // ->limit(10) // Ajusta este límite si deseas mostrar más o menos ciudades
                // ->get();

                $ciudadesData = NotasProductosCosmica::whereNotNull('estadociudad') // Filtra los registros donde estadociudad no es null
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


            $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_reporte', compact('cotizaciones', 'today', 'ventas', 'chart_menoscot','chart', 'chart2','chart3','chartGrafica', 'totalSum', 'totalSum2', 'fechaInicio', 'fechaFin'));

            //  return $pdf->stream();
            return $pdf->download('Reporte Cosmica / '.$today.'.pdf');
        }else if($request->input('action') === 'Generar PDF Global'){
            $fechaInicioAnio = '2024-01-01';
            $fechaFinAnio = '2024-12-31';

            // Query
            $productosVendidos = DB::table('notas_productos_cosmica')
                ->join('productos_notas_cosmica', 'notas_productos_cosmica.id', '=', 'productos_notas_cosmica.id_notas_productos')
                ->join('products', 'productos_notas_cosmica.id_producto', '=', 'products.id') // Relación con productos
                ->whereNotNull('notas_productos_cosmica.estatus_cotizacion') // Estatus diferente de null
                ->where('notas_productos_cosmica.estatus_cotizacion', '!=', 'Cancelada') // Estatus diferente de Cancelada
                ->whereBetween('notas_productos_cosmica.fecha', [$fechaInicioAnio, $fechaFinAnio]) // Rango de fechas del año
                ->where('products.precio_normal', '!=', 0)
                ->select('products.nombre as producto', DB::raw('COUNT(productos_notas_cosmica.id_producto) as vendidos'))
                ->groupBy('products.nombre') // Agrupamos por nombre del producto
                ->orderBy('vendidos', 'desc') // Opcional, para ordenar por mayor cantidad vendida
                ->get();

            $query = NotasProductosCosmica::query();

            if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');

                $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            }
            //productos menos cotizados

            $query2 = NotasProductosCosmica::query();

            if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');

                $query2->whereBetween('fecha_aprobada', [$fechaInicioAnio, $fechaFinAnio]);
            }

                $query2->orderBy('id', 'DESC')->where('tipo_nota', 'Cotizacion')->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado']);
                $totalSum2 = $query2->sum('total');
                $ventas = $query2->get();

                $nota_productos = ProductosNotasCosmica::get();

                // 2. Obtener los IDs de las cotizaciones filtradas
                $ventasIds = $ventas->pluck('id');

                // 3. Obtener y sumar las cantidades por producto de esas cotizaciones
                $productosMasVendidos = DB::table('notas_productos_cosmica')
                    ->join('productos_notas_cosmica', 'notas_productos_cosmica.id', '=', 'productos_notas_cosmica.id_notas_productos')
                    ->join('products', 'productos_notas_cosmica.id_producto', '=', 'products.id') // Relación con productos
                    ->whereNotNull('notas_productos_cosmica.estatus_cotizacion') // Estatus diferente de null
                    ->where('notas_productos_cosmica.estatus_cotizacion', '!=', 'Cancelada') // Estatus diferente de Cancelada
                    ->whereBetween('notas_productos_cosmica.fecha', [$fechaInicioAnio, $fechaFinAnio]) // Rango de fechas del año
                    ->where('products.precio_normal', '!=', 0)
                    ->select('products.nombre as producto', DB::raw('SUM(productos_notas_cosmica.cantidad) as total_vendidos'))
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
                $productosMenosVendidos = DB::table('notas_productos_cosmica')
                ->join('productos_notas_cosmica', 'notas_productos_cosmica.id', '=', 'productos_notas_cosmica.id_notas_productos')
                ->join('products', 'productos_notas_cosmica.id_producto', '=', 'products.id') // Relación con productos
                ->whereNotNull('notas_productos_cosmica.estatus_cotizacion') // Estatus diferente de null
                ->where('notas_productos_cosmica.estatus_cotizacion', '!=', 'Cancelada') // Estatus diferente de Cancelada
                ->whereBetween('notas_productos_cosmica.fecha', [$fechaInicioAnio, $fechaFinAnio]) // Rango de fechas del año
                ->where('products.precio_normal', '!=', 0)
                ->select('products.nombre as producto', DB::raw('SUM(productos_notas_cosmica.cantidad) as total_vendidos'))
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

                $ciudadesData = NotasProductosCosmica::whereNotNull('estadociudad') // Filtra los registros donde estadociudad no es null
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

                $ventasPorMes = DB::table('notas_productos_cosmica')
                    ->select(
                        DB::raw("DATE_FORMAT(fecha, '%Y-%m') as mes"), // Formato Año-Mes
                        DB::raw("SUM(total) as total_mensual")        // Suma de los totales
                    )
                    ->whereNotNull('estatus_cotizacion')             // Excluir los que son null
                    ->where('estatus_cotizacion', '!=', 'Cancelada') // Excluir los que están cancelados
                    ->groupBy(DB::raw("DATE_FORMAT(fecha, '%Y-%m')")) // Agrupar por Año-Mes
                    ->orderBy('mes', 'asc')                           // Ordenar por fecha ascendente
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

            $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_reporte_global', compact('productosVendidos', 'resultado','today', 'ventas',  'chart2','chart3','chartGrafica', 'totalSum2', 'fechaInicio', 'fechaFin'));

            return $pdf->stream();
            //  return $pdf->download('Reporte Cosmica Ventas Global/ '.$today.'.pdf');

        }

        // Si no se solicita PDF, mostrar los resultados en la vista
        return view('admin.cotizacion_cosmica.index_filtro', compact(
            'notas', 'administradores', 'notas_aprobadas', 'notas_canceladas', 'fechaInicio', 'fechaFin'
        ));
    }

    public function index_expo(Request $request) {
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));

        // Filtrar notas con estatus específicos
        $notas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->orderBy('id', 'DESC')
            ->where('tipo_nota', '=', 'Expo')
            ->get();

        // Pasar datos a la vista
        return view('admin.cotizacion_cosmica.expo.index', compact('notas'));
    }

    public function create_expo(){
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $products = Products::where('categoria', '=', 'Cosmica')->orderBy('nombre','ASC')->get();

        return view('admin.cotizacion_cosmica.expo.crear', compact('products', 'clientes'));
    }

    public function edit_expo($id){
        $cotizacion = NotasProductosCosmica::find($id);
        $cotizacion_productos = ProductosNotasCosmica::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::where('categoria', '=', 'Cosmica')->orderBy('nombre','ASC')->get();

        return view('admin.cotizacion_cosmica.expo.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function buscador_expo(Request $request){
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));

        $notas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->orderBy('id', 'DESC')
        ->where('tipo_nota', '=', 'Expo')
        ->get();

        $item = NotasProductosCosmica::where('id', '=' , $request->get('folio'))->first();

        return view('admin.cotizacion_cosmica.expo.index',compact('item', 'notas'));
    }
}
