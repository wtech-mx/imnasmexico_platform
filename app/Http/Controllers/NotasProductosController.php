<?php

namespace App\Http\Controllers;


use App\Models\ProductosNotasId;
use App\Models\NotasProductos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use App\Models\Products;
use Illuminate\Support\Str;
use Session;
use Hash;
use DB;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Carbon\Carbon;


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

        $products = Products::orderBy('nombre','ASC')->get();

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
        $products = Products::orderBy('nombre','ASC')->where('categoria', '!=', 'Ocultar')->get();

        return view('admin.notas_productos.create', compact('products', 'clientes'));
    }

    public function store(request $request){
        // Creacion de user
        $code = Str::random(8);

        $notas_productos = new NotasProductos;
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
            $nuevosCampos4 = $request->input('descuento_prod');

            foreach ($nuevosCampos as $index => $campo) {
                $resta = 0;
                $producto = Products::where('nombre', $campo)->first();
                $resta = $producto->stock - $nuevosCampos3[$index];
                $producto->stock = $resta;
                $producto->update();

                $notas_inscripcion = new ProductosNotasId;
                $notas_inscripcion->id_notas_productos = $notas_productos->id;
                $notas_inscripcion->producto = $campo;
                $notas_inscripcion->price = $nuevosCampos2[$index];
                $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                $notas_inscripcion->descuento = $nuevosCampos4[$index];
                $notas_inscripcion->save();
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('notas_productos.index')
        ->with('success', 'Creado exitosamente.');
    }

    public function edit($id){
        $cotizacion = NotasProductos::find($id);
        $cotizacion_productos = ProductosNotasId::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.notas_productos.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function update(Request $request, $id){

        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');
        $total = 0;
        $resta = 0;
        $suma = 0;
        // Obtener los productos actuales de la base de datos para esa cotización
        $productosExistentes = ProductosNotasId::where('id_notas_productos', $id)->get();

        // Crear un array para almacenar los IDs de los productos enviados
        $productosIdsEnviados = [];

        // Actualizar productos existentes
        for ($count = 0; $count < count($producto); $count++) {
            // Buscar el producto en la base de datos
            $productos = ProductosNotasId::where('producto', $producto[$count])
                ->where('id_notas_productos', $id)
                ->firstOrFail();


            $producto_db = Products::where('nombre', $producto[$count])->first();
            $producto_cot = ProductosNotasId::where('producto', $producto[$count])->where('id_notas_productos', $id)->first();

            if ($producto_db && $producto_cot) {
                if ($producto_cot->cantidad != $cantidad[$count]) {
                    $suma = $producto_db->stock + $producto_cot->cantidad;
                    $resta = $suma - $cantidad[$count];
                    $producto_db->stock = $resta;
                    $producto_db->update();
                }
            }

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
            $resta = 0;
            // Agregar nuevos productos
            for ($count = 0; $count < count($campo); $count++) {
                $producto = Products::where('nombre', $campo[$count])->first();
                $resta = $producto->stock - $campo3[$count];
                $producto->stock = $resta;
                $producto->update();

                $price = $campo4[$count];
                $cleanPrice = floatval(str_replace(['$', ','], '', $price));
                $data = array(
                    'id_notas_productos' => $id,
                    'producto' => $campo[$count],
                    'price' => $cleanPrice,
                    'cantidad' => $campo3[$count],
                    'descuento' => $descuento_prod[$count],
                );
                ProductosNotasId::create($data);
                $total += $cleanPrice;
            }
        }

        $nota = NotasProductos::findOrFail($id);

        if($request->get('envio') == 'No'){
            $envio = 0;
            $envio_check = 'No';
        }else{
            $envio = 250;
            $envio_check = 'Si';
        }

        $total_envio = $total + $envio;

        $nota->tipo = $total_envio;
        $nota->total = $total;
        $nota->envio = $envio_check;
        $nota->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');
    }

    public function imprimir($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasProductos::find($id);

        $nota_productos = ProductosNotasId::where('id_notas_productos', $nota->id)->get();

        $pdf = \PDF::loadView('admin.notas_productos.pdf_nota', compact('nota', 'today', 'nota_productos'));
       // return $pdf->stream();
       if($nota->folio == null){
            $folio = $nota->id;
        }else{
            $folio = $nota->folio;
        }

        // return $pdf->stream();
        return $pdf->download('Nota remision'. $folio .'/'.$today.'.pdf');
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
        $nota->estatus_cotizacion  = $request->get('estatus_cotizacion');

        if($nota->estatus_cotizacion != 'Cancelada'){
            $producto = ProductosNotasId::where('id_notas_productos', $id)->get();
            foreach ($producto as $campo) {
                $resta = 0;
                $producto = Products::where('nombre', $campo->producto)->first();
                $resta = $producto->stock + $campo->cantidad;
                $producto->stock = $resta;
                $producto->update();
            }
        }
        $nota->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');

    }
}
