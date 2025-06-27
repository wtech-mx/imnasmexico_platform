<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categorias;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\ProductosBundleId;
use App\Models\ProductosNotasCosmica;
use Carbon\Carbon;
use DB;

class CotizadorController extends Controller
{
    public function index()
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

        return view('cotizador.index_cosmica', compact('categoriasFacial', 'categoriasCorporal'));
    }

    public function index_cotizaciones_cosmica_expo(Request $request){

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();

        $notas = NotasProductosCosmica::orderBy('id','DESC')->where('tipo_nota', '=', 'Cotizacion_Expo')->get();

        return view('admin.cotizacion_cosmica.index_cotizaciones_expo', compact('notas', 'administradores'));
    }

    public function index_cosmica_new(Request $request)
    {
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

    public function mostrarProductosCategoriaCosmica($id)
    {
        $productos = Products::query();

        $productos->where('categoria', 'Cosmica')
                  ->where('subcategoria', 'Producto');

        $productos->where(function ($query) use ($id) {
            $query->where('sublinea', $id);
        });

        $productos = $productos->orderBy('nombre', 'ASC')->get();

        return view('cotizador.productos_categoria', compact('productos'));
    }

    public function buscar(Request $request)
    {
        $query = Str::lower($this->removeAccents($request->get('query', '')));
        $palabras = explode(' ', $query);

        $productos = Products::query();

        $productos->where('categoria', 'NAS')
                  ->where('subcategoria', '=', 'Producto');

        $productos->where(function($subQuery) use ($palabras) {
            foreach ($palabras as $palabra) {
                $variantes = $this->generarVariantesSingularPlural($palabra);

                foreach ($variantes as $variante) {
                    $subQuery->orWhereRaw("
                        LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(nombre, 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u')) LIKE ?
                    ", ["%{$variante}%"]);
                }
            }
        });

        $productos = $productos->limit(40)->get();

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

        return view('cotizador.item_carrito', compact('producto'))->render();
    }

    public function index_recepcion_cosmica_expo(Request $request){

        $primerDiaDelMes = date('Y-m-01');
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

        $primerDiaDelMes = date('Y-m-01');
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
        $primerDia = date('Y-m-01');
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

        public function ventasExpo(Request $request)
    {
        // 1) Validación básica de fechas
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // 2) Capturamos las fechas en formato 'Y-m-d'
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin    = $request->input('fecha_fin');

        $queryBase = NotasProductosCosmica::query()
            ->where('tipo_nota', 'Cotizacion_Expo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin]);

        // 4) Total general de todas las ventas en ese rango
        $totalVentas = $queryBase->sum('total');

        // 5) Total en Efectivo → volvemos a filtrar por metodo_pago
        $totalEfectivo = NotasProductosCosmica::query()
            ->where('tipo_nota', 'Cotizacion_Expo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('metodo_pago', 'Efectivo')
            ->sum('total');

        // 6) Total con Tarjeta
        $totalTarjeta = NotasProductosCosmica::query()
            ->where('tipo_nota', 'Cotizacion_Expo')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('metodo_pago', 'Tarjeta')
            ->sum('total');

        $ventasPorAdmin = NotasProductosCosmica::select(
                'users.id AS admin_id',
                'users.name AS admin_name',
                DB::raw('SUM(notas_productos_cosmica.total) AS total_ventas')
            )
            ->join('users', 'notas_productos_cosmica.id_admin_venta', '=', 'users.id')
            ->where('notas_productos_cosmica.tipo_nota', 'Cotizacion_Expo')
            ->whereBetween('notas_productos_cosmica.fecha', [$fechaInicio, $fechaFin])
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_ventas', 'desc')
            ->get();

        $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_expo', compact('totalVentas', 'totalEfectivo', 'totalTarjeta', 'fechaInicio', 'fechaFin', 'ventasPorAdmin'));
         return $pdf->stream();
       // return $pdf->download('Cotizacion Cosmica'. $folio .'/'.$today.'.pdf');
    }
}
