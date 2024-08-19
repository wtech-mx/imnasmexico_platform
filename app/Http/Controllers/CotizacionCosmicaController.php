<?php

namespace App\Http\Controllers;

use App\Models\Bitacora_cosmikausers;
use App\Models\Cosmikausers;
use App\Models\NotasProductosCosmica;
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
    public function index(){

        $this->checkMembresia();

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();

        $notas = NotasProductosCosmica::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('fecha','DESC')->where('tipo_nota','=' , 'Cotizacion')->get();

        return view('admin.cotizacion_cosmica.index', compact('notas', 'administradores'));
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
        $products = Products::where('descripcion', '=', 'Cosmica')->orderBy('nombre','ASC')->get();

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

        $notas_productos->tipo_nota = 'Cotizacion';
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

            foreach ($nuevosCampos as $index => $campo) {
                $notas_inscripcion = new ProductosNotasCosmica;
                $notas_inscripcion->id_notas_productos = $notas_productos->id;
                $notas_inscripcion->producto = $campo;
                $notas_inscripcion->price = $nuevosCampos2[$index];
                $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                $notas_inscripcion->descuento = isset($nuevosCampos4[$index]) ? $nuevosCampos4[$index] : 0;
                $notas_inscripcion->save();
            }
        }

        return redirect()->route('cotizacion_cosmica.index')
        ->with('success', 'Se ha creado su cotizacion con exito');
    }

    public function edit($id){
        $cotizacion = NotasProductosCosmica::find($id);
        $cotizacion_productos = ProductosNotasCosmica::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::where('descripcion', '=', 'Cosmica')->orderBy('nombre','ASC')->get();

        return view('admin.cotizacion_cosmica.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function update(Request $request, $id){
        $campo = $request->input('campo');
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
            ProductosNotasCosmica::create($data);
        }

        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');

        for ($count = 0; $count < count($producto); $count++) {
            $productos = ProductosNotasCosmica::where('producto', $producto[$count])
            ->where('id_notas_productos', $id)
            ->firstOrFail();

            $precio = $price[$count];
            $cleanPrice2 = floatval(str_replace(['$', ','], '', $precio));
            $data = array(
                'price' => $cleanPrice2,
                'cantidad' => $cantidad[$count],
                'descuento' => $descuento[$count],
            );
            $productos->update($data);
        }

        $nota = NotasProductosCosmica::findOrFail($id);
        $total_final = $request->get('total_final');
        $cleanPrice3 = floatval(str_replace(['$', ','], '', $total_final));
        $cleanPrice4 = floatval(str_replace(['$', ','], '', $request->get('subtotal_final')));
        $nota->subtotal = $cleanPrice4;
        $nota->total = $cleanPrice3;
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

        $nota = NotasProductosCosmica::find($id);
        $nota->estatus_cotizacion = 'Aprobada';
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

        return redirect()->back()->with('success', 'Se ha actualizado con exito');
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
        $today =  date('d-m-Y');

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
            ->limit(5)
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

        $query2 = NotasProductosCosmica::query();

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $fechaInicio = $request->input('fecha_inicio');
            $fechaFin = $request->input('fecha_fin');

            $query2->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $query2->orderBy('id', 'DESC')->where('tipo_nota', 'Cotizacion')->where('estatus_cotizacion', 'Aprobada');
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
            ->limit(5)
            ->get();

            $labels2 = $productosMasVendidos->pluck('producto')->toArray();
            $data2 = $productosMasVendidos->pluck('total_cantidad')->toArray();
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

            $chartData2 = json_encode($chartData2);

            $chartURL2 = "https://quickchart.io/chart?width=500&height=500&c=".urlencode($chartData2);

            $chartData2 = file_get_contents($chartURL2);
            $chart2 = 'data:image/png;base64, '.base64_encode($chartData2);

        $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_reporte', compact('cotizaciones', 'today', 'ventas', 'chart', 'chart2', 'totalSum', 'totalSum2', 'fechaInicio', 'fechaFin'));

         //  return $pdf->stream();
        return $pdf->download('Reporte Cosmica / '.$today.'.pdf');
    }
}
