<?php

namespace App\Http\Controllers;

use App\Models\ProductosNotasId;
use App\Models\NotasProductos;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Str;
use Session;
use Hash;
use DB;
use Carbon\Carbon;

class CotizacionController extends Controller
{
    public function index(){

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $notas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('estatus_cotizacion','=' , null)->get();

        $notasAprobadas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->where('estatus_cotizacion','=' , 'Aprobada')->get();

        $notasPendientes = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->where('estatus_cotizacion','=' , 'Pendiente')->get();

        $notasCandeladas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->where('estatus_cotizacion','=' , 'Cancelada')->get();

        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.cotizacion.index', compact('notas', 'products', 'clientes', 'administradores','notasAprobadas','notasPendientes','notasCandeladas'));
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

        return view('admin.cotizacion.index', compact('notas', 'products', 'clientes', 'administradores', 'notasAprobadas', 'notasPendientes', 'notasCandeladas'));
    }

    public function create(){
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.cotizacion.create', compact('products', 'clientes'));
    }

    public function edit($id){
        $cotizacion = NotasProductos::find($id);
        $cotizacion_productos = ProductosNotasId::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.cotizacion.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
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

            foreach ($nuevosCampos as $index => $campo) {
                $notas_inscripcion = new ProductosNotasId;
                $notas_inscripcion->id_notas_productos = $notas_productos->id;
                $notas_inscripcion->producto = $campo;
                $notas_inscripcion->price = $nuevosCampos2[$index];
                $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                $notas_inscripcion->save();
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('notas_cotizacion.index')
        ->with('success', 'Creado exitosamente.');
    }

    public function update(Request $request, $id){

        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');
        $total = 0;

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
        $nota->total = $total_envio;
        $nota->envio = $envio_check;
        $nota->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');
    }

    public function update_estatus(Request $request, $id){

        $nota = NotasProductos::findOrFail($id);
        $nota->estatus_cotizacion  = $request->get('estatus_cotizacion');
        $nota->estadociudad  = $request->get('estado');

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
            $producto = Products::where('nombre', $producto_nota->producto)->first();

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
        $today =  date('d-m-Y');

        $query = NotasProductos::query();

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

            $query2->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $query2->orderBy('id', 'DESC')->where('tipo_nota', 'Cotizacion')->where('estatus_cotizacion', 'Aprobada');
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
    }
}
