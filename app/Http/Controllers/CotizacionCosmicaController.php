<?php

namespace App\Http\Controllers;

use App\Models\Bitacora_cosmikausers;
use App\Models\Cosmikausers;
use App\Models\HistorialVendidos;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\ProductosBundleId;
use App\Models\ProductosNotasCosmica;
use App\Models\Products;
use App\Models\ProductosNotasId;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\Meli;
use Illuminate\Support\Facades\Http;
use App\Models\Factura;
use App\Models\OrdersCosmica;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use MercadoPago\{Exception, SDK, Preference, Item};

class CotizacionCosmicaController extends Controller
{

    private $accessToken;
    private $sellerId;

    public function __construct()
    {
        // Obtener los datos dinámicos del modelo
        $meliData = Meli::first(); // Asumiendo que siempre hay un registro
        if ($meliData) {
            $this->accessToken = $meliData->autorizacion ?? 'APP_USR-4791982421745244-120619-6e5686be00416a46416e810056b082a8-2084225921'; // Proporciona un valor predeterminado si es nulo
            $this->sellerId = $meliData->sellerId ?? '2084225921';
        } else {
            // Opcional: manejar el caso donde no exista un registro
            abort(500, 'No se encontraron datos de configuración en la tabla Meli.');
        }
    }

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
        $query = NotasProductosCosmica::with('User')
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->where('estatus_cotizacion', '=', NULL)
        ->where('tipo_nota', '=', 'Cotizacion');

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                $q->where('folio', 'LIKE', "%{$search}%")
                  ->orWhere('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('telefono', 'LIKE', "%{$search}%");
            });
        }

        $orderColumn = $request->input('order.0.column', 'id');
        $orderDir = $request->input('order.0.dir', 'desc');
        $columns = $request->input('columns', []);
        $orderColumnName = $columns[$orderColumn]['data'] ?? 'id';

        $query->orderBy($orderColumnName, $orderDir);

        $notas = $query->paginate($request->input('length', 10), ['*'], 'page', ($request->input('start', 0) / $request->input('length', 10)) + 1);

        // Agregar columnas estatus y acciones manualmente
        $notas->getCollection()->transform(function ($nota) {
            $nota->estatus = $nota->estatus_cotizacion == 'Aprobada' ? 'Aprobada' : 'Pendiente';
            $nota->acciones = view('admin.cotizacion_cosmica.partials.acciones', compact('nota'))->render();
            $nota->cliente = $nota->id_usuario == NULL
            ? $nota->nombre . '<br>' . ($nota->telefono ?? 'Teléfono no disponible')
            : ($nota->User ? ($nota->User->name . '<br>' . ($nota->User->telefono ?? 'Teléfono no disponible')) : 'Usuario no encontrado');
            $nota->estatus_boton = view('admin.cotizacion_cosmica.partials.estatus_boton', compact('nota'))->render();
            return $nota;
        });

        // Pasar datos a la vista
        if ($request->ajax()) {
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $notas->total(),
                'recordsFiltered' => $notas->total(),
                'data' => $notas->items(),
            ]);
        }


        return view('admin.cotizacion_cosmica.index', compact('notas', 'administradores', 'fechaInicio', 'fechaFin'));
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
        $query = NotasProductosCosmica::whereBetween('fecha', [$inicioMesAnterior, $finMesActual])
            ->whereIn('estatus_cotizacion', ['Aprobada', 'Preparado', 'Enviado'])
            ->where('tipo_nota', '=', 'Cotizacion');

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                $q->where('folio', 'LIKE', "%{$search}%")
                  ->orWhere('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('telefono', 'LIKE', "%{$search}%");
            });
        }

        $orderColumn = $request->input('order.0.column', 'id');
        $orderDir = $request->input('order.0.dir', 'desc');
        $columns = $request->input('columns', []);
        $orderColumnName = $columns[$orderColumn]['data'] ?? 'id';

        $query->orderBy($orderColumnName, $orderDir);

        $notas_aprobadas = $query->paginate($request->input('length', 10), ['*'], 'page', ($request->input('start', 0) / $request->input('length', 10)) + 1);

        // Agregar columnas estatus y acciones manualmente
        $notas_aprobadas->getCollection()->transform(function ($nota) {
            $nota->estatus = $nota->estatus_cotizacion == 'Aprobada' ? 'Aprobada' : 'Pendiente';
            $nota->acciones = view('admin.cotizacion_cosmica.partials.acciones', compact('nota'))->render();
            $nota->cliente = $nota->id_usuario == NULL ? $nota->nombre . '<br>' . $nota->telefono : $nota->User->name;
            $nota->estatus_boton = view('admin.cotizacion_cosmica.partials.estatus_boton', compact('nota'))->render();
            return $nota;
        });

        // Pasar datos a la vista
        if ($request->ajax()) {
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $notas_aprobadas->total(),
                'recordsFiltered' => $notas_aprobadas->total(),
                'data' => $notas_aprobadas->items(),
            ]);
        }

        return view('admin.cotizacion_cosmica.index_aprobadas', compact('administradores', 'notas_aprobadas', 'fechaInicio', 'fechaFin'));
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
        $query = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estatus_cotizacion', '=', 'Cancelada')
            ->where('tipo_nota', '=', 'Cotizacion');

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                $q->where('folio', 'LIKE', "%{$search}%")
                  ->orWhere('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('telefono', 'LIKE', "%{$search}%");
            });
        }

        $orderColumn = $request->input('order.0.column', 'id');
        $orderDir = $request->input('order.0.dir', 'desc');
        $columns = $request->input('columns', []);
        $orderColumnName = $columns[$orderColumn]['data'] ?? 'id';

        $query->orderBy($orderColumnName, $orderDir);

        $notas_canceladas = $query->paginate($request->input('length', 10), ['*'], 'page', ($request->input('start', 0) / $request->input('length', 10)) + 1);

        // Agregar columnas estatus y acciones manualmente
        $notas_canceladas->getCollection()->transform(function ($nota) {
            $nota->estatus = $nota->estatus_cotizacion == 'Cancelada' ? 'Cancelada' : 'Pendiente';
            $nota->acciones = view('admin.cotizacion_cosmica.partials.acciones', compact('nota'))->render();
            $nota->cliente = $nota->id_usuario == NULL ? $nota->nombre . '<br>' . $nota->telefono : $nota->User->name;
            $nota->estatus_boton = view('admin.cotizacion_cosmica.partials.estatus_boton', compact('nota'))->render();
            return $nota;
        });

        // Pasar datos a la vista
        if ($request->ajax()) {
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $notas_canceladas->total(),
                'recordsFiltered' => $notas_canceladas->total(),
                'data' => $notas_canceladas->items(),
            ]);
        }

        return view('admin.cotizacion_cosmica.index_canceladas', compact('administradores', 'notas_canceladas', 'fechaInicio', 'fechaFin'));
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
        $clientes = User::where('cliente', '=', '1')->orderBy('id', 'DESC')->get();
        $products = Products::where('categoria', '=', 'Cosmica')
                            ->where(function($query) {
                                $query->whereNull('fecha_fin')
                                      ->orWhere('fecha_fin', '>', Carbon::now());
                            })
                            ->orderBy('nombre', 'ASC')
                            ->get();

        return view('admin.cotizacion_cosmica.create', compact('products', 'clientes'));
    }

    public function store(request $request){
        // Creacion de user
        $code = Str::random(8);

        $notas_productos = new NotasProductosCosmica;

        if($request->get('id_cliente') == NULL){
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

            $notas_productos->factura = '1';
            $notas_productos->save();
            $facturas = new Factura;

            $facturas->id_usuario = auth()->user()->id;
            $facturas->id_notas_cosmica = $notas_productos->id;
            $estado = 'Por Facturar';
            $facturas->estatus = $estado;
            $facturas->save();

        }else{
            $notas_productos->save();
        }

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
                if ($producto && $producto->subcategoria == 'Kit' || $producto->subcategoria == 'kit') {
                    $productos_bundle = ProductosBundleId::where('id_product', $producto->id)->get();

                    for ($i = 1; $i <= $nuevosCampos3[$index]; $i++) {
                        foreach ($productos_bundle as $producto_bundle) {
                            $notas_inscripcion = ProductosNotasCosmica::where('id_notas_productos', $notas_productos->id)
                                ->where('id_producto', $producto_bundle->id_producto)
                                ->first();
                            // Si no existe, crea un nuevo registro
                            $notas_inscripcion = new ProductosNotasCosmica;
                            $notas_inscripcion->id_notas_productos = $notas_productos->id;
                            $notas_inscripcion->id_producto = $producto_bundle->id_producto;
                            $notas_inscripcion->producto = $producto_bundle->producto;
                            $notas_inscripcion->price = '0';
                            $notas_inscripcion->cantidad = $producto_bundle->cantidad;
                            $notas_inscripcion->kit = '1';
                            $notas_inscripcion->num_kit = $producto_bundle->id_product;
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
                        $descuentoCampo = $request->input('descuento_prod')[$contadorKits - 1] ?? null; // Obtener la cantidad del kit actual
                        if ($descuentoCampo) {
                            $columnaDescuentoKit = "descuento_kit" . ($contadorKits > 1 ? $contadorKits : "");
                            $notas_productos->$columnaDescuentoKit = $descuentoCampo;
                        }
                        $notas_productos->save();
                        $contadorKits++;
                    }
                } elseif ($producto->subcategoria == 'Tiendita') {
                    $notas_inscripcion = ProductosNotasCosmica::where('id_notas_productos', $notas_productos->id)
                        ->where('id_producto', $producto->id)
                        ->first();

                        // Si no existe, crea un nuevo registro
                        $notas_inscripcion = new ProductosNotasCosmica;
                        $notas_inscripcion->id_notas_productos = $notas_productos->id;
                        $notas_inscripcion->producto = $producto->nombre;
                        $notas_inscripcion->id_producto = $producto->id;
                        $notas_inscripcion->price = $nuevosCampos2[$index];
                        $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                        $notas_inscripcion->escaneados = $nuevosCampos3[$index];
                        $notas_inscripcion->descuento = isset($nuevosCampos4[$index]) ? $nuevosCampos4[$index] : 0;
                        $notas_inscripcion->estatus = 1;
                        $notas_inscripcion->save();
                } else {
                    $notas_inscripcion = ProductosNotasCosmica::where('id_notas_productos', $notas_productos->id)
                        ->where('id_producto', $producto->id)
                        ->first();
                        // Si no existe, crea un nuevo registro
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

        }

        if($request->get('tipo_cotizacion') == 'Perfil Alumno'){
            return redirect()->back()->with('success', 'Se ha creado su cotizacion con exito');
        }else{
            return redirect()->route('cotizacion_cosmica.index')
            ->with('success', 'Se ha creado su cotizacion con exito');
        }

    }

    public function edit($id){
        $cotizacion = NotasProductosCosmica::find($id);
        $cotizacion_productos = ProductosNotasCosmica::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();

        $products = Products::where('categoria', '!=', 'Ocultar')
        ->where(function($query) {
            $query->whereNull('fecha_fin')
                  ->orWhere('fecha_fin', '>', Carbon::now());
        })
        ->orderBy('nombre', 'ASC')
        ->get();

        return view('admin.cotizacion_cosmica.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
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

        ProductosNotasCosmica::where('id_notas_productos', $id)
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
                $producto_nota = ProductosNotasCosmica::where('id_notas_productos', $id)
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

            $nota = NotasProductosCosmica::findOrFail($id);

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
                    $ya_existe_kit = ProductosNotasCosmica::where('id_notas_productos', $id)
                        ->where('num_kit', $producto_first->id)
                        ->exists();

                    if (!$ya_existe_kit) {
                        $productos_bundle = ProductosBundleId::where('id_product', $producto_first->id)->get();

                        foreach ($productos_bundle as $producto_bundle) {
                            ProductosNotasCosmica::create([
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
                }
                 else {
                    ProductosNotasCosmica::create([
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

        $nota = NotasProductosCosmica::findOrFail($id);

        $cleanPrice4 = floatval(str_replace(['$', ','], '', $request->get('subtotal_final')));
        $cleanPriceTotal = floatval(str_replace(['$', ','], '', $request->get('total_final')));
        $nota->subtotal = $cleanPrice4;
        $nota->total = $cleanPriceTotal;
        $nota->envio = $request->get('envio');
        $nota->dinero_recibido = $request->get('costo_envio');

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
            $facturas->id_notas_cosmica = $nota->id;
            $estado = 'Por Facturar';
            $facturas->estatus = $estado;
            $facturas->save();
        }else{
            $nota->save();
        }



        return redirect()->route('cotizacion_cosmica.index')
        ->with('success', 'Se ha actualizado su cotizacion con exito');
    }

    public function eliminarKit($kitId, $notaId)
    {
        // Elimina productos del kit
        ProductosNotasCosmica::where('id_notas_productos', $notaId)
            ->where('num_kit', $kitId)
            ->delete();

        // Limpia campos del kit en la tabla notas
        $nota = NotasProductosCosmica::findOrFail($notaId);
        for ($i = 1; $i <= 6; $i++) {
            $colKit = 'id_kit' . ($i == 1 ? '' : $i);
            if ($nota->$colKit == $kitId) {
                $nota->$colKit = null;
                $nota->{'cantidad_kit' . ($i == 1 ? '' : $i)} = null;
                $nota->{'descuento_kit' . ($i == 1 ? '' : $i)} = null;
            }
        }
        $nota->save();

        return response()->json(['success' => true]);
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
       // return $pdf->download('Cotizacion Cosmica'. $folio .'/'.$today.'.pdf');
    }

    public function link_pago($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasProductosCosmica::find($id);

        $nota_productos = ProductosNotasCosmica::where('id_notas_productos', $nota->id)->get();

        $usercosmika = Cosmikausers::where('id_cliente','=', $nota->id_usuario)->first();

        return view('admin.cotizacion_cosmica.link_pago',compact('nota', 'today', 'nota_productos', 'usercosmika'));

    }

    public function update_estatus(Request $request, $id){
        $nota = NotasProductosCosmica::find($id);

        if ($request->estatus_cotizacion == 'Cancelada') {
            if ($nota->item_id_meli) {
                try {
                    $itemId = $nota->item_id_meli;
                    $endpoint = "https://api.mercadolibre.com/items/{$itemId}";

                    $response = Http::withHeaders([
                        'Authorization' => "Bearer {$this->accessToken}",
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ])->put($endpoint, [
                        'status' => 'closed',
                    ]);

                    if ($response->successful()) {
                        // Opcional: marcar localmente como cerrada si tienes un campo para eso
                        // $nota->update(['publicacion_meli_estatus' => 'closed']);

                        \Log::info("Publicación {$itemId} cancelada exitosamente en Mercado Libre.");
                    } else {
                        \Log::error("Error al cancelar publicación Meli ({$itemId}):", $response->json());
                    }
                } catch (\Exception $e) {
                    \Log::error("Excepción al cancelar publicación Meli: " . $e->getMessage());
                }
            }
        }

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera/');
        }else{
            $pago_fuera = public_path() . '/pago_fuera/';
        }

        if($request->get('estatus_cotizacion') == 'Preparado'){
            if($nota->estatus_cotizacion == 'Aprobada'){
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
        // }else if($request->get('estatus_cotizacion') == 'Aprobar Linea Lumina'){
        //     $nota->estatus_cotizacion  = 'Aprobada';
        //     if ($request->hasFile("foto_pago")) {
        //         $file = $request->file('foto_pago');
        //         $path = $pago_fuera;
        //         $fileName = uniqid() . $file->getClientOriginalName();
        //         $file->move($path, $fileName);
        //         $nota->foto_pago = $fileName;
        //     }

        //     if ($request->hasFile("doc_guia")) {
        //         $file = $request->file('doc_guia');
        //         $path = $pago_fuera;
        //         $fileName = uniqid() . $file->getClientOriginalName();
        //         $file->move($path, $fileName);
        //         $nota->doc_guia = $fileName;
        //     }

        //     if ($request->hasFile("guia_rep")) {
        //         $file = $request->file('guia_rep');
        //         $path = $pago_fuera;
        //         $fileName = uniqid() . $file->getClientOriginalName();
        //         $file->move($path, $fileName);
        //         $nota->doc_guia = $fileName;
        //     }
        //     $nota->fecha_aprobada  = date("Y-m-d");
        //     $nota->fecha_preparacion  = date("Y-m-d H:i:s");
        //     $nota->id_admin_venta  = auth()->user()->id;
        //     $nota->metodo_pago  = $request->get('metodo_pago');
        }else if($request->get('estatus_cotizacion') == 'Aprobada Workshop'){
            $nota->estatus_cotizacion  = 'Aprobada';

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

            $nota->fecha_aprobada  = date("Y-m-d");
            $nota->fecha_preparacion  = date("Y-m-d H:i:s");
        }else if($request->get('estatus_cotizacion') == 'Aprobada Expo'){
            $nota->estatus_cotizacion  = 'Enviado';
            $nota->fecha_aprobada  = date("Y-m-d");
            $nota->fecha_preparacion  = date("Y-m-d H:i:s");
            $nota->fecha_preparado  = date("Y-m-d H:i:s");
            $nota->fecha_envio  = date("Y-m-d H:i:s");
        } else if($request->get('estatus_cotizacion') == 'Aprobado por tiendita'){
            // Copiar datos a NotasProductos
            $nuevaNota = new NotasProductos();
            $nuevaNota->fill($nota->toArray());
            $nuevaNota->tipo_nota = 'Venta Presencial';
            $nuevaNota->estatus_cotizacion = 'Aprobada';
            $nuevaNota->id_admin = auth()->user()->id;
            $nuevaNota->metodo_pago = $request->get('metodo_pago2');
            $nuevaNota->foto_pago = $request->get('foto_pago2');

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
            $nuevaNota->folio = $folio;
            $nuevaNota->save();

            // Copiar productos a ProductosNotasCosmica
            $productosCosmica = ProductosNotasCosmica::where('id_notas_productos', $id)->get();
            foreach ($productosCosmica as $productoCosmica) {
                $nuevoProducto = new ProductosNotasCosmica();
                $nuevoProducto->fill($productoCosmica->toArray());
                $nuevoProducto->id_notas_productos = $nuevaNota->id;
                $nuevoProducto->save();
            }

            // Eliminar la nota y productos originales si es necesario
            ProductosNotasCosmica::where('id_notas_productos', $id)->delete();
            $nota->delete();
        }

        $nota->estatus_cotizacion =  $request->get('estatus_cotizacion');
        $nota->estadociudad =  $request->get('estado');
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

        if($request->get('estatus_cotizacion') == 'Preparado'){
            return redirect()->route('index_preparacion.bodega')
            ->with('success', 'Se ha actualizado con exito');
         } else {
            return redirect()->back()->with('success', 'Se ha actualizado con exito');
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
        if ($nota->estatus_cotizacion == NULL) {
            $nota->estatus_cotizacion = 'Aprobada';
            $nota->fecha_aprobada = date("Y-m-d");
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

    public function imprimir_reporte(Request $request)
    {
        $this->checkMembresia();

        // Configuración de fechas de filtro
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));


        // Formatear las fechas
        $fechaInicioFormatted = \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y');
        $fechaFinFormatted = \Carbon\Carbon::parse($fechaFin)->format('d/m/Y');


        // Administradores
        $administradores = User::where('cliente', '=', NULL)
            ->orWhere('cliente', '=', '5')
            ->get();

        // Filtrar cotizaciones
        $query = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('tipo_nota', '=', 'Cotizacion');

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function($q) use ($search) {
                $q->where('folio', 'LIKE', "%{$search}%")
                  ->orWhere('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('telefono', 'LIKE', "%{$search}%");
            });
        }

        $orderColumn = $request->input('order.0.column', 'id');
        $orderDir = $request->input('order.0.dir', 'desc');
        $columns = $request->input('columns', []);
        $orderColumnName = $columns[$orderColumn]['data'] ?? 'id';

        $query->orderBy($orderColumnName, $orderDir);

        $notas = $query->paginate($request->input('length', 10), ['*'], 'page', ($request->input('start', 0) / $request->input('length', 10)) + 1);

        // Agregar columnas estatus y acciones manualmente
        $notas->getCollection()->transform(function ($nota) {
            $nota->estatus = $nota->estatus_cotizacion == 'Aprobada' ? 'Aprobada' : 'Pendiente';
            $nota->acciones = view('admin.cotizacion_cosmica.partials.acciones', compact('nota'))->render();
            $nota->cliente = $nota->id_usuario == NULL ? $nota->nombre . '<br>' . $nota->telefono : $nota->User->name;
            $nota->estatus_boton = view('admin.cotizacion_cosmica.partials.estatus_boton', compact('nota'))->render();
            return $nota;
        });

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
            $fechaInicioAnio = $fechaInicio;
            $fechaFinAnio =  $fechaFin;

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

                // Agrega esta línea antes de la consulta
                $anioActual = Carbon::now()->year;

                $ventasPorMes = DB::table('notas_productos_cosmica')
                    ->select(
                        DB::raw("DATE_FORMAT(fecha, '%Y-%m') as mes"),
                        DB::raw("SUM(total) as total_mensual")
                    )
                    ->whereYear('fecha', $anioActual) // ← Aquí filtramos solo el año actual
                    ->whereNotNull('estatus_cotizacion')
                    ->where('estatus_cotizacion', '!=', 'Cancelada')
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

                $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_reporte_global', compact(
                    'productosVendidos', 'resultado','today', 'ventas',
                    'chart2','chart3','chartGrafica', 'totalSum2',
                    'fechaInicioAnio', 'fechaFinAnio' // <- agrega estas variables
                ));

            return $pdf->stream();
            //  return $pdf->download('Reporte Cosmica Ventas Global/ '.$today.'.pdf');

        }

        // Pasar datos a la vista
        if ($request->ajax()) {
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $notas->total(),
                'recordsFiltered' => $notas->total(),
                'data' => $notas->items(),
            ]);
        }

        return view('admin.cotizacion_cosmica.index_filtro', compact('notas', 'administradores', 'fechaInicio', 'fechaFin', 'fechaInicioFormatted', 'fechaFinFormatted'));
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

    public function pdf_expo(Request $request){
        $today =  date('d-m-Y');
        $fechaInicio = $request->input('fecha_inicio', date('Y-m-01'));
        $fechaFin = $request->input('fecha_fin', date('Y-m-t'));

        $notas = NotasProductosCosmica::whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->orderBy('id', 'DESC')
        ->where('tipo_nota', '=', 'Expo')
        ->get();

        $total = $notas->sum('total');

        $pdf = \PDF::loadView('admin.cotizacion_cosmica.expo.pdf_expo', compact('notas', 'today', 'total'));
        return $pdf->stream();
       //  return $pdf->download('Etiquetas bajo stock nas / '.$today.'.pdf');
    }

    public function processPayment(Request $request){
        // Configurar el SDK de Mercado Pago con las credenciales de API
       SDK::setAccessToken(config('services.mercadopago.token'));

        // Crear un objeto de preferencia de pago
        $preference = new Preference();
        $code = Str::random(8);

        $item = new Item();
        $item->title = 'Link de pago cosmica '.$request->get('folio');
        $item->quantity = 1;
        $item->unit_price = $request->get('total');
        $ticketss = array($item);

        // Crear un objeto de preferencias de pago
        $preference = new \MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => route('link_pago.pay'),
            "pending" => route('link_pago.pay'),
            "failure" => "https://plataforma.imnasmexico.com/",
        );

        $preference->auto_return = "approved";
        $preference->external_reference = $code;
        $preference->items = $ticketss;


        try {
            // Crear la preferencia en Mercado Pago
            $preference->save();

            // Redirigir al usuario al proceso de pago de Mercado Pago
            return Redirect::to($preference->init_point);
        } catch (Exception $e) {
            // Manejar errores de Mercado Pago
            return Redirect::back()->withErrors(['message' => $e->getMessage()]);
        } catch (Throwable $e) {
            // Manejar errores de PHP
            return Redirect::back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function pay(OrdersCosmica $order, Request $request)
    {
        $payment_id = $request->get('payment_id');
        $external_reference = $request->get('external_reference');

        $dominio = $request->getHost();
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-8901800557603427-041420-99b569dfbf4e6ce9160fc673d9a47b1e-1115271504");

        $response = json_decode($response);
        if (isset($response->error)) {
            return redirect()->route('return.link_pago')->with('error', 'Hubo un problema al verificar el pago.');
        }
        $status = $response->status ?? null;
        $external_reference_api = $response->external_reference ?? null;
        $external_reference = $external_reference_api ?: $external_reference;

        // Si no se encuentra el external_reference, redirige con error
        if (!$external_reference) {
            return redirect()->route('return.link_pago')->with('error', 'No se pudo verificar el pago. Falta external_reference.');
        }

        return redirect()->route('return.link_pago');
    }

    public function return(){

        return view('admin.cotizacion_cosmica.link_pago_success');
    }
    public function fangos(Request $request){
        $idsProductos = [1666, 1668, 1670, 1672, 1675];

        // Si además quieres filtrar por rango de fecha, por ejemplo:
        $fechaInicio = '2025-05-30';
        $fechaFin    = '2025-06-01';

        $notas = NotasProductosCosmica::select('notas_productos_cosmica.*')
            ->join('productos_notas_cosmica', 'notas_productos_cosmica.id', '=', 'productos_notas_cosmica.id_notas_productos')
            ->whereIn('productos_notas_cosmica.id_producto', $idsProductos)
            ->whereBetween('notas_productos_cosmica.fecha', [$fechaInicio, $fechaFin])  // si aplica
            ->distinct()    // para evitar duplicados si una nota tiene varios de esos productos
            ->get();

                $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_fangos', compact( 'notas'));
                return $pdf->stream();
            // return $pdf->download('Cotizacion Cosmica'. $folio .'/'.$today.'.pdf');
    }
}
