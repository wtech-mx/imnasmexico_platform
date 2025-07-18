<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categorias;
use App\Models\Cosmikausers;
use App\Models\Factura;
use App\Models\NotasExpo;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\ProductosBundleId;
use App\Models\ProductosNotasCosmica;
use App\Models\ProductosNotasId;
use Carbon\Carbon;
use DB;
use Hash;

class CotizadorController extends Controller
{
    public function index_nas()
    {
        // Traemos las categorías
        $categoriasFacial = Categorias::where('linea', '=', 'facial')->orderBy('id','DESC')->get();
        $categoriasCorporal = Categorias::where('linea', '=', 'corporal')->orderBy('id','DESC')->get();

        // Añadimos un atributo dinámico para contar los productos de cada categoría
        foreach ($categoriasFacial as $cat) {
            $cat->productos_count = Products::where('id_categoria', $cat->id)->orWhere('id_categoria2', $cat->id)->count();
        }

        foreach ($categoriasCorporal as $cat) {
            $cat->productos_count = Products::where('id_categoria', $cat->id)->orWhere('id_categoria2', $cat->id)->count();
        }

        return view('cotizador.index', compact('categoriasFacial', 'categoriasCorporal'));
    }

    public function index_cosmica(Request $request)
    {
        // Determinar ruta según entorno
        $dominio = $request->getHost();
        if ($dominio == 'plataforma.imnasmexico.com') {
            $ruta_imgs = base_path('../public_html/plataforma.imnasmexico.com/cosmika/lineas/lineas/');
            $ruta_asset = 'cosmika/INICIO/lineas/';
        } else {
            $ruta_imgs = public_path('cosmika/INICIO/lineas/');
            $ruta_asset = 'cosmika/INICIO/lineas/';
        }

        // Función para verificar y asignar imagen de sublínea
        $asignarImagen = function ($sublinea) use ($ruta_imgs, $ruta_asset) {
            $nombre_archivo = Str::slug($sublinea, '_') . '.png';
            $ruta_completa = $ruta_imgs . $nombre_archivo;

            return File::exists($ruta_completa) ? $ruta_asset . $nombre_archivo : 'default.jpg';
        };

        // Faciales
        $faciales = Products::where('linea', 'Facial')
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->get()
            ->groupBy('sublinea');

        $categoriasFacial = $faciales->map(function ($productos, $sublinea) use ($asignarImagen) {
            return (object) [
                'id' => Str::slug($sublinea),
                'nombre' => $sublinea,
                'imagen' => $asignarImagen($sublinea),
                'productos_count' => $productos->count(),
            ];
        })->values();

        // Corporales
        $corporales = Products::where('linea', 'Corporal')
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->get()
            ->groupBy('sublinea');

        $categoriasCorporal = $corporales->map(function ($productos, $sublinea) use ($asignarImagen) {
            return (object) [
                'id' => Str::slug($sublinea),
                'nombre' => $sublinea,
                'imagen' => $asignarImagen($sublinea),
                'productos_count' => $productos->count(),
            ];
        })->values();


        $productsKit = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '=', 'Kit')->orderby('nombre','asc')->get();

        return view('cotizador.index_cosmica', compact('categoriasFacial', 'categoriasCorporal','productsKit'));
    }

    public function index_cotizaciones_cosmica_expo(Request $request){

        $primerDiaDelMes = '2025-06-30';
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();

        $notas = NotasExpo::orderBy('id','DESC')->where('fecha', '=', $primerDiaDelMes)->where('tipo_nota', '=', 'Cotizacion_Expo')->get();

        return view('admin.cotizacion_cosmica.index_cotizaciones_expo', compact('notas', 'administradores'));
    }

    public function index_cosmica_new(Request $request)
    {
        // 1) Productos “normales”
        $productos = Products::query()
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->get()
            ->map(function($producto) {
                // Determinamos extensión
                $ext = pathinfo($producto->imagenes, PATHINFO_EXTENSION) ?: 'jpg';
                $producto->local_img = "storage/productos/{$producto->id}.{$ext}";
                return $producto;
            });

        // 2) Agruparlos por sublínea
        $productosPorSublinea = $productos->groupBy('sublinea');

        // 3) Kits
        $kits = Products::query()
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Kit')
            ->where('estatus', 'publicado')
            ->orderBy('nombre', 'asc')
            ->with('bundleItems')
            ->get()
            ->map(function($kit) {
                $ext = pathinfo($kit->imagenes, PATHINFO_EXTENSION) ?: 'jpg';
                $kit->local_img = "storage/productos/{$kit->id}.{$ext}";
                return $kit;
            });

        $personal = User::whereNull('cliente')
            ->where('visibilidad', '!=', '0')
            ->orderBy('name','ASC')
            ->get();

        return view('cotizador.index_cosmica_new', compact('productosPorSublinea', 'kits', 'personal'));
    }

    public function cotizador_cosmica(Request $request){
        // 1) Productos “normales”
        $productos = Products::query()
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->get();

        // 2) Agruparlos por sublínea
        $productosPorSublinea = $productos->groupBy('sublinea');

        // 3) Ahora traemos los kits
        $kits = Products::query()
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', operator: 'Kit')
            ->where('estatus', 'publicado')
            ->orderBy('nombre', 'asc')
            ->with('bundleItems')   // <-- cargar la relación
            ->get();

        $personal = User::where('cliente','=' , null)->where('visibilidad', '!=', '0')->orderBy('name','ASC')->get();

        return view('cotizador.index_cosmica_cotizador', compact('productosPorSublinea', 'kits', 'personal'));
    }

    public function store(Request $request)
    {
        // 1) Validar
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'telefono'    => 'required|string|max:50',
            'cantidad'    => 'required|array',
            'cantidad.*'  => 'integer|min:0',
        ]);

        // 2) Buscar o crear usuario
        $user = User::where('telefono', $data['telefono'])
                    ->orWhere('email', $data['telefono'].'@example.com')
                    ->first();

        $notas = new NotasProductosCosmica;
        if ($user) {
            $notas->id_usuario = $user->id;
        } else {
            $notas->nombre   = $data['name'];
            $notas->telefono = $data['telefono'];
        }

        // 3) Generar folio “E” + padding 3 dígitos
        $numeros = NotasProductosCosmica::where('tipo_nota','Cotizacion_Expo')
        ->where('folio','like','E%')->pluck('folio')->map(fn($f)=> intval(substr($f,1)));
        $next = ($numeros->max() ?: 0) + 1;
        $notas->tipo_nota = 'Cotizacion_Expo';
        $notas->folio     = 'E'.str_pad($next, 3, '0', STR_PAD_LEFT);
        $notas->id_admin = $request->input('id_cosme');
        $notas->id_admin_venta = $request->input('id_cosme');
        $notas->envio = $request->input('envio');
        $notas->metodo_pago = $request->input('metodo_pago');
        $notas->reposicion = $request->input('reposicion');
        $notas->fecha = now();
        $notas->nota  = '';
        $notas->save();

        // 4) Recorrer cantidades, calcular totales de línea y acumular gran total
        $grandTotal = 0;
        foreach ($data['cantidad'] as $prodId => $qty) {


            if ($qty <= 0) continue;
            $prod = Products::find($prodId);

            if (! $prod) continue;

            // precio unitario desde stock
            $precio = $prod->precio_rebajado;
            $lineTotal = $precio * $qty;
            $grandTotal += $lineTotal;

            ProductosNotasCosmica::create([
                'id_notas_productos' => $notas->id,
                'id_producto'        => $prod->id,
                'producto'           => $prod->nombre,
                'price'              => $precio,
                'cantidad'           => $qty,
                'descuento'          => 0,
                'total'              => $lineTotal,
                'estatus'            => 1,
            ]);
        }

        // 5) Guardar el total general en la nota (si tienes esa columna)
        $notas->total = $grandTotal;
        $notas->save();

        return response()->json([
            'id'    => $notas->id,
            'folio' => $notas->folio,
            'total' => $grandTotal,
        ], 200);
    }

    public function store_cosmica_cotizacion(Request $request)
    {
        // 1) Validar
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'telefono'    => 'required|string|max:50',
            'cantidad'    => 'required|array',
            'cantidad.*'  => 'integer|min:0',
        ]);

        // 2) Buscar o crear usuario
        $user = User::where('telefono', $data['telefono'])
                    ->orWhere('email', $data['telefono'].'@example.com')
                    ->first();

        $notas = new NotasProductosCosmica;
        if ($user) {
            $notas->id_usuario = $user->id;
        } else {
            $notas->nombre   = $data['name'];
            $notas->telefono = $data['telefono'];
        }

        // 3) Generar folio “E” + padding 3 dígitos
        $numeros = NotasProductosCosmica::where('tipo_nota','Cotizacion')
        ->where('folio','like','E%')->pluck('folio')->map(fn($f)=> intval(substr($f,1)));
        $next = ($numeros->max() ?: 0) + 1;
        $notas->tipo_nota = 'Cotizacion';
        $notas->folio     = 'E'.str_pad($next, 3, '0', STR_PAD_LEFT);
        $notas->id_admin_venta = $request->input('id_cosme');
        $notas->envio = $request->input('envio');
        $notas->metodo_pago = $request->input('metodo_pago');
        $notas->fecha = now();
        $notas->nota  = '';
        $notas->save();

        // 4) Recorrer cantidades, calcular totales de línea y acumular gran total
        $grandTotal = 0;
        $subtotal = 0;
        foreach ($data['cantidad'] as $prodId => $qty) {


            if ($qty <= 0) continue;
            $prod = Products::find($prodId);

            if (! $prod) continue;

            // precio unitario desde stock
            $precio = $prod->precio_normal;
            $lineTotal = $precio * $qty;
            $subtotal += $lineTotal; // este es el subtotal
            $grandTotal += $lineTotal;

            ProductosNotasCosmica::create([
                'id_notas_productos' => $notas->id,
                'id_producto'        => $prod->id,
                'producto'           => $prod->nombre,
                'price'              => $precio,
                'cantidad'           => $qty,
                'descuento'          => 0,
                'total'              => $lineTotal,
                'estatus'            => 1,
            ]);
        }

        // 5) Guardar el total general en la nota (si tienes esa columna)
        $notas->total = $grandTotal;
        $notas->subtotal = $subtotal; // nuevo campo
        $notas->save();

        return response()->json([
            'id'    => $notas->id,
            'folio' => $notas->folio,
            'total' => $grandTotal,
        ], 200);
    }

    public function mostrarProductosCategoria($id)
    {
        $productos = Products::query();

        $productos->where('categoria', 'NAS')
                  ->where('subcategoria', 'Producto');

        $productos->where(function ($query) use ($id) {
            $query->where('id_categoria', $id)
                  ->Where('id_categoria2', $id);
        });

        $productos = $productos->orderBy('nombre', 'ASC')->get();

        return view('cotizador.productos_categoria', compact('productos'));
    }

    public function mostrarProductosPorCategoria($tipo, $sublinea)
    {
        // 1) Base de la consulta
        $query = Products::query()
            ->where('subcategoria','Producto')
            ->where('sublinea', $sublinea);

        // 2) Filtra categorías según el tipo
        if ($tipo === 'nas') {
            // NAS ve productos de NAS y también de Cosmica
            $query->whereIn('categoria',['NAS','Cosmica']);
        } else {
            // Cosmica o por defecto
            $query->where('categoria','Cosmica');
        }

        // 3) Orden y obtención
        $productos = $query->orderBy('nombre','ASC')->get();

        // 4) Misma vista parcial que ya usas
        return view('cotizador.productos_categoria', compact('productos'));
    }

    public function buscar(Request $request)
    {
        $tipo   = $request->get('tipo', 'cosmica');
        $query  = Str::lower($this->removeAccents($request->get('query','')));
        $palabras = explode(' ', $query);

        $productos = Products::query();

        // 1) Defino el filtro de categorías según tipo
        if ($tipo === 'nas') {
            $cats = ['Nas','Cosmica'];
            if (! empty($cats)) {
                $productos->whereIn('categoria', $cats);
            }
        } else {
            $productos->where('categoria','Cosmica');
        }

        // 2) tu resto de filtros de subcategoría
        $productos->where(function($q) {
            $q->where('subcategoria','Producto')
            ->orWhere(function($q2) {
                $q2->where('subcategoria','Kit')
                    ->whereNull('estatus');
            })
            ->orWhere('subcategoria','Tiendita');
        });

        // 3) búsqueda por nombre
        $productos->where(function($sub) use ($palabras) {
            foreach ($palabras as $palabra) {
                $var = Str::lower($palabra);
                $sub->orWhereRaw("
                    LOWER(
                    REPLACE(
                        REPLACE(
                        REPLACE(
                            REPLACE(
                            REPLACE(nombre,'á','a'),
                            'é','e'),
                        'í','i'),
                        'ó','o'),
                    'ú','u')
                    ) LIKE ?
                ", ["%{$var}%"]);
            }
        });

        $productos = $productos->limit(40)->get();

        return view('cotizador.productos_categoria', compact('productos'));
    }

    public function mostrarKits(string $tipo)
    {
        $q = Products::query()
            ->where('subcategoria', 'Kit')
            ->where('estatus', 'publicado');

        if ($tipo === 'nas') {
            // NAS ve kits de NAS y de Cosmica
            $q->whereIn('categoria', ['NAS','Cosmica']);
        } else {
            // Cosmica (y por defecto) solo kits de Cosmica
            $q->where('categoria', 'Cosmica');
        }

        // si en el futuro Tiendita tuviera kits, añade su lógica igual que arriba

        $productos = $q->orderBy('nombre','asc')->get();

        // reutiliza tu vista parcial habitual
        return view('cotizador.productos_categoria', compact('productos'));
    }

    private function removeAccents($string)
    {
        return strtr($string, [
            'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u',
            'Á'=>'A', 'É'=>'E', 'Í'=>'I', 'Ó'=>'O', 'Ú'=>'U',
            'ñ'=>'n', 'Ñ'=>'N', 'ü'=>'u', 'Ü'=>'U'
        ]);
    }

    private function generarVariantesSingularPlural($palabra)
    {
        $variantes = [$palabra];

        // Muy básico pero funcional para español (puedes mejorarlo)
        if (Str::endsWith($palabra, 'es')) {
            $singular = substr($palabra, 0, -2);
            $variantes[] = $singular;
        } elseif (Str::endsWith($palabra, 's')) {
            $singular = substr($palabra, 0, -1);
            $variantes[] = $singular;
        } else {
            $variantes[] = $palabra . 's';
            $variantes[] = $palabra . 'es';
        }

        return array_unique($variantes);
    }

    public function renderizarItemCarrito(Request $request)
    {
        $producto = $request->input('producto'); // Este será un array con los datos

        // 2. Si es un Kit, carga sus componentes
        $bundleItems = [];

        if ($producto['subcategoria'] === 'Kit') {
            $bundleItems = ProductosBundleId::where('id_product', $producto['id'])
                ->whereNotNull('price')
                ->get();  // Obtén aquí los campos que necesites
            return view('cotizador.item_carrito', compact('producto','bundleItems'));

        }else{
            return view('cotizador.item_carrito', compact('producto'))->render();
        }
    }

    public function index_recepcion_cosmica_expo(Request $request){

        $primerDiaDelMes = '2025-06-30';
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' , null)->orderBy('id','DESC')->get();

        $notas = NotasProductosCosmica::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion_Expo')->get();

        return view('admin.cotizacion_cosmica.recepcion_expo', compact('notas', 'clientes', 'administradores'));
    }

    public function index_recepcion_update_expo(Request $request, $id) {

        $nota = NotasProductosCosmica::findOrFail($id);
        $nota->estatus_cotizacion = $request->get('estatus_cotizacion');
        $nota->save();

        return redirect()->route('index_recepcion_cosmica_expo.cotizador')
        ->with('success', 'Se ha actualizado su cotizacion con exito');
    }

    public function index_pagos_cosmica_expo(Request $request){

        $primerDiaDelMes = '2025-06-30';
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $notas = NotasProductosCosmica::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion_Expo')->get();

        return view('admin.cotizacion_cosmica.pagos_expo', compact('notas', 'clientes', 'administradores'));
    }

    public function togglePago(Request $request){
        $servicio = NotasProductosCosmica::find($request->id);
        $servicio->pago = $request->abono;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    public function apiEstatus(Request $r){
        $ids = explode(',', $r->query('ids',''));
        $notas = NotasProductosCosmica::whereIn('id',$ids)
            ->pluck('pago','id')
            ->map(fn($pago,$id) => ['id'=>$id,'pago'=>(int)$pago])
            ->values();
        return response()->json($notas);
    }

    public function streamPagos(Request $r)
    {
        $primerDia = '2025-06-30';
        $ultimoDia = date('Y-m-t');
        $notas = NotasProductosCosmica::with('User')
            ->where('tipo_nota', '=', 'Cotizacion_Expo')
            ->whereBetween('fecha', [$primerDia, $ultimoDia])
            ->get()
            ->map(function($n){
                return [
                    'id'             => $n->id,
                    'folio'          => $n->folio ?? $n->id,
                    'id_usuario'     => $n->id_usuario,
                    'nombre'         => $n->id_usuario ? null : $n->nombre,
                    'user_name'      => optional($n->User)->name,
                    'user_telefono'  => optional($n->User)->telefono,
                    'fecha'          => $n->fecha,
                    'total'          => $n->total,
                ];
            });
        return response()->json($notas);
    }

    public function ventasExpo(Request $request){
        // 1) Validación básica de fechas
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // 2) Capturamos las fechas en formato 'Y-m-d'
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin    = $request->input('fecha_fin');

        $queryBase = NotasExpo::query()
            ->where('tipo_nota', 'Cotizacion_Expo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin]);

        // 4) Total general de todas las ventas en ese rango
        $totalVentas = $queryBase->sum('total');

        // 5) Total en Efectivo → volvemos a filtrar por metodo_pago
        $totalEfectivo = NotasExpo::query()
            ->where('tipo_nota', 'Cotizacion_Expo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('metodo_pago', 'Efectivo')
            ->sum('total');

        // 6) Total con Tarjeta
        $totalTarjeta = NotasExpo::query()
            ->where('tipo_nota', 'Cotizacion_Expo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('metodo_pago', 'Tarjeta')
            ->sum('total');

        $ventasPorAdmin = NotasExpo::select(
                'users.id AS admin_id',
                'users.name AS admin_name',
                DB::raw('SUM(notas_expo.total) AS total_ventas')
            )
            ->join('users', 'notas_expo.id_admin_venta', '=', 'users.id')
            ->where('notas_expo.tipo_nota', 'Cotizacion_Expo')
            ->whereBetween('notas_expo.fecha', [$fechaInicio, $fechaFin])
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_ventas', 'desc')
            ->get();

        $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_expo', compact('totalVentas', 'totalEfectivo', 'totalTarjeta', 'fechaInicio', 'fechaFin', 'ventasPorAdmin'));
         return $pdf->stream();
       // return $pdf->download('Cotizacion Cosmica'. $folio .'/'.$today.'.pdf');
    }

    public function search(Request $request){
        $q = $request->get('q', '');

        $results = User::query()
            ->where('name', 'like', "%{$q}%")
            ->orWhere('telefono', 'like', "%{$q}%")
            ->select(
                'id',
                'name',
                'telefono',
                'reconocimiento',
                'postcode',
                'state',
                'city',
                'direccion',
                'referencia',
                'country'
            )
            ->limit(10)
            ->get()
            ->map(function($u) {
                return [
                    'id'             => $u->id,
                    'label'          => "{$u->name} — {$u->telefono}",
                    'value'          => $u->name,
                    'reconocimiento' => $u->reconocimiento,
                    'postcode'       => $u->postcode,
                    'state'          => $u->state,
                    'city'           => $u->city,
                    'direccion'      => $u->direccion,
                    'referencia'     => $u->referencia,
                    'country'        => $u->country,
                ];
            });

        return response()->json($results);
    }

    public function membershipStatus($cliente){
        $registro = Cosmikausers::where('id_cliente', $cliente)->first();
        if ($registro && $registro->membresia_estatus === 'Activa') {
            return response()->json([
                'activa'    => true,
                'membresia' => $registro->membresia,
            ]);
        }

        return response()->json(['activa' => false]);
    }

    public function store_new(Request $request)
    {
        // 1) Valida lo esencial
        $data = $request->validate([
            'tipo'            => 'required|in:cosmica,nas,tiendita'
        ]);
        $code = Str::random(8);

        // 2) Selecciona el modelo de cabecera según el tipo
        switch ($data['tipo']) {
            case 'cosmica':
                $OrderModel     = NotasProductosCosmica::class;
                $OrderItemModel = ProductosNotasCosmica::class;
                break;
            case 'nas':
                $OrderModel     = NotasProductos::class;
                $OrderItemModel = ProductosNotasId::class;
                break;
            case 'tiendita':
                $OrderModel     = NotasProductos::class;
                $OrderItemModel = ProductosNotasId::class;
                break;
        }

        // 3) Cliente
        $payer = $this->syncClient($request);

        // 4) Crea la orden
        $order = new $OrderModel();
        $order->id_usuario         = $payer->id;
        $order->subtotal        = $request->subtotal_final;
        $order->restante   = $request->descuento_total ?? 0;
        $order->envio_cost      = $request->envio_final;
        $order->iva_cost        = $request->iva_final;
        $order->total     = $request->total_final;
        $order->nota     = $request->observaciones;
        $order->tipo_nota     = $request->tipo_nota;
        $order->id_admin = auth()->user()->id;
        $order->fecha = date('Y-m-d');
        $tipoNota = $request->tipo_nota;
        $order->envio = $request->envio_final > 0 ? 'Si' : 'No';

        $modelClass = $order instanceof NotasProductosCosmica ? NotasProductosCosmica::class : NotasProductos::class;
        $order->folio = $this->generateFolio($order->tipo_nota, $modelClass);

        if($request->get('factura') != NULL){
            $order->factura = '1';
            $order->save();
            $facturas = new Factura;

            $facturas->id_usuario = $payer->id;
            $facturas->fecha = $request->get('fecha');
            $facturas->id_notas_cosmica = $order->id;
            $estado = 'Por Facturar';
            $facturas->estatus = $estado;
            $facturas->save();
        }

        // Campos de dirección
        $order->save();

        $this->syncItemsAndKits(
            $order,
            $request->get('productos'),
            'id_notas_productos'
        );

        return response()->json([
        'success' => true,
        'message' => "Pedido {$data['tipo']} guardado {$order->folio}.",
        'order_id'=> $order->id
        ]);
    }

    public function edit_cosmica(Request $request, $id){
        $cotizacion = NotasProductosCosmica::find($id);
        $cotizacion_productos = ProductosNotasCosmica::where('id_notas_productos', '=', $id)->get();

        // Determinar ruta según entorno
        $dominio = $request->getHost();
        if ($dominio == 'plataforma.imnasmexico.com') {
            $ruta_imgs = base_path('../public_html/plataforma.imnasmexico.com/cosmika/lineas/lineas/');
            $ruta_asset = 'cosmika/INICIO/lineas/';
        } else {
            $ruta_imgs = public_path('cosmika/INICIO/lineas/');
            $ruta_asset = 'cosmika/INICIO/lineas/';
        }

        // Función para verificar y asignar imagen de sublínea
        $asignarImagen = function ($sublinea) use ($ruta_imgs, $ruta_asset) {
            $nombre_archivo = Str::slug($sublinea, '_') . '.png';
            $ruta_completa = $ruta_imgs . $nombre_archivo;

            return File::exists($ruta_completa) ? $ruta_asset . $nombre_archivo : 'default.jpg';
        };

        // Faciales
        $faciales = Products::where('linea', 'Facial')
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->get()
            ->groupBy('sublinea');

        $categoriasFacial = $faciales->map(function ($productos, $sublinea) use ($asignarImagen) {
            return (object) [
                'id' => Str::slug($sublinea),
                'nombre' => $sublinea,
                'imagen' => $asignarImagen($sublinea),
                'productos_count' => $productos->count(),
            ];
        })->values();

        // Corporales
        $corporales = Products::where('linea', 'Corporal')
            ->where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->get()
            ->groupBy('sublinea');

        $categoriasCorporal = $corporales->map(function ($productos, $sublinea) use ($asignarImagen) {
            return (object) [
                'id' => Str::slug($sublinea),
                'nombre' => $sublinea,
                'imagen' => $asignarImagen($sublinea),
                'productos_count' => $productos->count(),
            ];
        })->values();

        return view('cotizador.edit.index_cosmica', compact('categoriasFacial', 'categoriasCorporal', 'cotizacion', 'cotizacion_productos'));
    }

    public function edit_nas(Request $request, $id){
        $cotizacion = NotasProductos::find($id);
        $cotizacion_productos = ProductosNotasId::where('id_notas_productos', '=', $id)->get();

        // Determinar ruta según entorno
        $dominio = $request->getHost();
        if ($dominio == 'plataforma.imnasmexico.com') {
            $ruta_imgs = base_path('../public_html/plataforma.imnasmexico.com/categorias/');
            $ruta_asset = 'categorias/';
        } else {
            $ruta_imgs = public_path('categorias/');
            $ruta_asset = 'categorias/';
        }

        // Función para verificar y asignar imagen de sublínea
        $asignarImagen = function ($sublinea) use ($ruta_imgs, $ruta_asset) {
            $nombre_archivo = Str::slug($sublinea, '_') . '.png';
            $ruta_completa = $ruta_imgs . $nombre_archivo;

            return File::exists($ruta_completa) ? $ruta_asset . $nombre_archivo : 'default.jpg';
        };

        // Faciales
        $faciales = Products::where('linea', 'Facial')
            ->where('subcategoria', 'Producto')
            ->get()
            ->groupBy('sublinea');

        $categoriasFacial = $faciales->map(function ($productos, $sublinea) use ($asignarImagen) {
            return (object) [
                'id' => Str::slug($sublinea),
                'nombre' => $sublinea,
                'imagen' => $asignarImagen($sublinea),
                'productos_count' => $productos->count(),
            ];
        })->values();

        // Corporales
        $corporales = Products::where('linea', 'Corporal')
            ->where('subcategoria', 'Producto')
            ->get()
            ->groupBy('sublinea');

        $categoriasCorporal = $corporales->map(function ($productos, $sublinea) use ($asignarImagen) {
            return (object) [
                'id' => Str::slug($sublinea),
                'nombre' => $sublinea,
                'imagen' => $asignarImagen($sublinea),
                'productos_count' => $productos->count(),
            ];
        })->values();

        return view('cotizador.edit.index_nas', compact('categoriasFacial', 'categoriasCorporal', 'cotizacion', 'cotizacion_productos'));
    }

    public function edit_renderizarItemCarrito(Request $request){
        $producto = $request->input('producto'); // Este será un array con los datos

        return view('cotizador.edit.item_carrito', compact('producto'))->render();
    }

    public function update_new(Request $request, $id){
        // 1) Validación básica
        $data = $request->validate([
            'tipo'            => 'required|in:cosmica,nas,tiendita',
            'id_usuario'      => 'required|exists:users,id',
            'subtotal_final'            => 'required|numeric',
            'total_final'               => 'required|numeric',
            'observaciones'             => 'nullable|string',
            'tipo_nota'                 => 'required|string',
        ]);

        // 2) Selección de modelos según tipo
        switch ($data['tipo']) {
            case 'cosmica':
                $OrderModel     = NotasProductosCosmica::class;
                $OrderItemModel = ProductosNotasCosmica::class;
                $fkOrder        = 'id_notas_productos';
                break;
            case 'nas':
            case 'tiendita':
                $OrderModel     = NotasProductos::class;
                $OrderItemModel = ProductosNotasId::class;
                $fkOrder        = 'id_notas_productos';
                break;
        }

        $payer = $this->syncClient($request, $data['id_usuario']);

        // 3) Recupera la orden
        /** @var \Illuminate\Database\Eloquent\Model $order */
        $order = $OrderModel::findOrFail($id);
        // 4) Actualiza campos de cabecera
        $order->id_usuario       = $payer->id;
        $order->subtotal         = $data['subtotal_final'];
        $order->total            = $data['total_final'];
        $order->nota             = $data['observaciones'] ?? '';
        $order->tipo_nota        = $data['tipo_nota'];
        $order->restante         = $request->descuento_total ?? 0;
        $order->envio_cost       = $request->envio_final;
        $order->iva_cost         = $request->iva_final;
        $order->envio            = $request->envio_final > 0 ? 'Si' : 'No';
        $order->save();

        // 5) Sincroniza los ítems
        // a) Obtén los IDs en request
        $requestedIds = collect($request->productos)->pluck('id')->all();

        // b) Elimina los items que ya no vienen
        $OrderItemModel::where($fkOrder, $order->id)
            ->whereNotIn('id_producto', $requestedIds)
            ->delete();

        // c) Recorre cada producto enviado
        for ($i = 1; $i <= 6; $i++) {
            $idk     = 'id_kit' . ($i > 1 ? $i : '');
            $cantk   = 'cantidad_kit' . ($i > 1 ? $i : '');
            $desck   = 'descuento_kit' . ($i > 1 ? $i : '');
            $order->$idk   = null;
            $order->$cantk = null;
            $order->$desck = null;
        }
        $order->save();

        // 3) Borra todos los ítems asociados
        $OrderItemModel::where('id_notas_productos', $order->id)->delete();

        // 4) Vuelve a insertar
        $this->syncItemsAndKits(
            $order,
            $request->input('productos'),
            'id_notas_productos'
        );

        return response()->json([
            'success'  => true,
            'message'  => "Pedido {$data['tipo']} actualizado correctamente ({$order->folio}).",
            'order_id' => $order->id,
        ]);
    }

    protected function syncItemsAndKits($order, array $productos, string $fkOrder, string $subcategoriaField = 'subcategoria')
    {
        // 1) Resetea campos de kits en la cabecera
        for ($i = 1; $i <= 6; $i++) {
            $suffix = $i > 1 ? $i : '';
            $order->{"id_kit{$suffix}"}        = null;
            $order->{"cantidad_kit{$suffix}"}  = null;
            $order->{"descuento_kit{$suffix}"} = null;
        }
        $order->save();

        // 2) Elimina todos los ítems previos
        $order->items()->where($fkOrder, $order->id)->delete();

        // 3) Inserta nuevamente según el array
        $kitCounter = 1;
        foreach ($productos as $p) {
            $prod = Products::find($p['id']);
            $isKit = strtolower($prod->{$subcategoriaField}) === 'kit';

            if ($isKit && $kitCounter <= 6) {
                // 3a) Graba la info de kit en la cabecera
                $suffix   = $kitCounter > 1 ? $kitCounter : '';
                $order->{"id_kit{$suffix}"}        = $prod->id;
                $order->{"cantidad_kit{$suffix}"}  = $p['cantidad'];
                $order->{"descuento_kit{$suffix}"} = $p['descuentoPct'] ?? 0;
                $order->save();

                // 3b) Guarda cada componente del bundle
                $bundles = ProductosBundleId::where('id_product', $prod->id)->get();
                foreach ($bundles as $b) {
                    $order->items()->create([
                        $fkOrder   => $order->id,
                        'id_producto'     => $b->id_producto,
                        'cantidad'        => $b->cantidad * $p['cantidad'],
                        'precio_uni'      => 0,
                        'descuento'       => 0,
                        'price'           => 0,
                        'kit'             => 1,
                        'num_kit'         => $prod->id,
                    ]);
                }

                $kitCounter++;
            } else {
                // 3c) Guarda producto normal
                $order->items()->create([
                    $fkOrder   => $order->id,
                    'id_producto'     => $p['id'],
                    'cantidad'        => $p['cantidad'],
                    'precio_uni'      => $p['precio'],
                    'descuento'       => $p['descuentoPct'] ?? 0,
                    'price'           => $p['precio'] * $p['cantidad'] * (1 - (($p['descuentoPct'] ?? 0)/100)),
                    'kit'             => 0,
                    'num_kit'         => null,
                ]);
            }
        }
    }

    protected function syncClient(Request $request)
    {
        // Si no viene ID, lo creamos
        if ($request->id_usuario == NULL) {
            $code = Str::random(8);
            $payer = new User();
            $payer->name       = $request->get('name');
            $payer->email      = $request->get('telefono') . '@imnas.com';
            $payer->username   = $request->get('telefono');
            $payer->code       = $code;
            $payer->telefono   = $request->get('telefono');
            $payer->cliente    = '1';
            $payer->password   = Hash::make($request->get('telefono'));
            $payer->postcode   = $request->get('postcode');
            $payer->state      = $request->get('state');
            $payer->city       = $request->get('city');
            $payer->direccion  = $request->get('direccion');
            $payer->referencia = $request->get('referencia');
            $payer->country    = $request->get('country');

            if ($request->hasFile('reconocimiento_new')) {
                $file      = $request->file('reconocimiento_new');
                $timestamp = time();
                $ext       = $file->getClientOriginalExtension();
                $fileName  = "{$payer->id}_{$timestamp}.{$ext}";
                $destPath  = public_path('reconocimientos');
                if (! is_dir($destPath)) {
                    mkdir($destPath, 0755, true);
                }
                $file->move($destPath, $fileName);
                $payer->reconocimiento = $fileName;
            }
        }
        // Si viene ID, lo actualizamos
        else {
            $payer = User::findOrFail($request->id_usuario );
            $payer->postcode   = $request->get('postcode');
            $payer->state      = $request->get('state');
            $payer->city       = $request->get('city');
            $payer->direccion  = $request->get('direccion');
            $payer->referencia = $request->get('referencia');
            $payer->country    = $request->get('country');

            // Si subieron reconocimiento, lo procesamos
            if ($request->hasFile('reconocimiento')) {
                $file      = $request->file('reconocimiento');
                $timestamp = time();
                $ext       = $file->getClientOriginalExtension();
                $fileName  = "{$payer->id}_{$timestamp}.{$ext}";
                $destPath  = public_path('reconocimientos');
                if (! is_dir($destPath)) {
                    mkdir($destPath, 0755, true);
                }
                $file->move($destPath, $fileName);
                $payer->reconocimiento = $fileName;
            }
        }

        $payer->save();
        return $payer;
    }

    protected function generateFolio(string $tipoNota, string $modelClass): string
    {
        // 1) Recoge todos los folios existentes para ese tipo
        $folios = $modelClass::where('tipo_nota', $tipoNota)
                             ->pluck('folio');

        // 2) Extrae la parte numérica tras la inicial del tipo
        $maxNumero = $folios
            ->map(fn($folio) => (int) substr($folio, 1))
            ->max();

        // 3) Siguiente número (si no hay ninguno, empieza en 1)
        $next = $maxNumero ? $maxNumero + 1 : 1;

        // 4) El folio es la primera letra de tipo + número
        return strtoupper($tipoNota[0]) . $next;
    }
}
