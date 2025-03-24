<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Models\HistorialVendidos;
use App\Models\Products;
use App\Models\ProductosBundleId;
use App\Models\HistorialStock;
use App\Models\OrderOnlineCosmica;
use App\Models\Categorias;
use App\Models\OrderOnlineNas;
use App\Models\ProductosNotasCosmica;
use App\Models\ProductosNotasId;
use Illuminate\Support\Facades\Artisan;
use Milon\Barcode\DNS1D; // Importamos la clase para generar códigos de barras
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    public function generateBarcodes(Request $request)
    {
        $selectedProductIds = $request->input('selected_products');

        if (empty($selectedProductIds)) {
            return response()->json(['error' => 'No products selected'], 400);
        }

        // Obtenemos los productos
        $products = Products::whereIn('id', $selectedProductIds)->get();

        // Obtener la fecha, hora y usuario
        $fechaHora = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = Auth::user()->name;

        // Generar el PDF con los códigos de barra
        $pdf = PDF::loadView('admin.pdf.barcode', compact('products', 'fechaHora', 'usuario'));

        // Para mostrar el PDF en el navegador
        return $pdf->stream('codigos_barras_'.$fechaHora.'.pdf');
    }

    public function index_categrias(){
        $categorias = Categorias::orderBy('id','DESC')->get();

        return view('admin.products.index_categorias', compact('categorias'));
    }

    public function store_categorias(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_categorias = base_path('../public_html/plataforma.imnasmexico.com/categorias');
        } else {
            $ruta_categorias = public_path() . '/categorias';
        }

        $categoria = new Categorias;
        $categoria->nombre = $request->get('nombre');
        $categoria->linea = $request->get('linea');
        $categoria->fecha_inicio = $request->get('fecha_inicio');
        $categoria->fecha_fin = $request->get('fecha_fin');
        $categoria->descuento = $request->get('descuento');
        $categoria->estatus_descuento = $request->get('estatus_descuento');
        $categoria->estatus_visibilidad = $request->get('estatus_visibilidad');
        $categoria->color = $request->get('color');
        $categoria->frase = $request->get('frase');

        if ($request->hasFile("imagen")) {
            $file = $request->file('imagen');
            $path = $ruta_categorias;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $categoria->imagen = $fileName;
        }

        if ($request->hasFile("portada")) {
            $file = $request->file('portada');
            $path = $ruta_categorias;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $categoria->portada = $fileName;
        }

        // Generar un slug único basado en el nombre
        $slug = Str::slug($request->get('nombre'));
        $existingSlug = Categorias::where('slug', $slug)->first();
        if ($existingSlug) {
            $slug = $slug . '-' . uniqid();
        }
        $categoria->slug = $slug;

        $categoria->save();

        Session::flash('success', 'Se ha guardado sus datos con éxito');
        return redirect()->back()->with('success', 'Categoría creada exitosamente.');
    }

    public function update_categorias(Request $request, $id)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_categorias = base_path('../public_html/plataforma.imnasmexico.com/categorias');
        } else {
            $ruta_categorias = public_path() . '/categorias';
        }

        $categoria = Categorias::findOrFail($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->linea = $request->get('linea');
        $categoria->fecha_inicio = $request->get('fecha_inicio');
        $categoria->fecha_fin = $request->get('fecha_fin');
        $categoria->descuento = $request->get('descuento');
        $categoria->estatus_descuento = $request->get('estatus_descuento');
        $categoria->estatus_visibilidad = $request->get('estatus_visibilidad');
        $categoria->color = $request->get('color');
        $categoria->frase = $request->get('frase');

        if ($request->hasFile("imagen")) {
            $file = $request->file('imagen');
            $path = $ruta_categorias;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $categoria->imagen = $fileName;
        }

        if ($request->hasFile("portada")) {
            $file = $request->file('portada');
            $path = $ruta_categorias;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $categoria->portada = $fileName;
        }

        // Generar un slug único basado en el nombre si el nombre ha cambiado
        if ($categoria->nombre != $request->get('nombre')) {
            $slug = Str::slug($request->get('nombre'));
            $existingSlug = Categorias::where('slug', $slug)->first();
            if ($existingSlug) {
                $slug = $slug . '-' . uniqid();
            }
            $categoria->slug = $slug;
        }

        $categoria->save();

        Session::flash('success', 'Se ha actualizado sus datos con éxito');
        return redirect()->back()->with('success', 'Categoría actualizada exitosamente.');
    }

    public function index(Request $request){
        $products = Products::orderBy('id','DESC')->where('categoria', 'NAS')->where('subcategoria', '=', 'Producto')->orderby('nombre','asc')->get();
        $categorias = Categorias::orderBy('nombre','ASC')->get();

        return view('admin.products.index', compact('products','categorias'));
    }

    public function index_cosmica(Request $request){
        $products = Products::orderBy('id','DESC')->where('categoria', 'Cosmica')->where('subcategoria', '=', 'Producto')->orderby('nombre','asc')->get();

        return view('admin.products.index_cosmica', compact('products'));
    }

    public function index_tiendita(Request $request){
        $productsTiendita = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '=', 'Tiendita')->get();

        return view('admin.products.index_tiendita', compact('productsTiendita'));
    }

    public function index_bundle(Request $request){

        $productsKit = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '=', 'Kit')->orderby('nombre','asc')->get();

        return view('admin.products.index_bundle', compact('productsKit'));
    }

    public function update_estatus(Request $request, $id){

        $product = Products::find($id);
        $product->estatus = $request->get('estatus');
        $product->update();

        return response()->json([
            'id' => $product->id,
            'estatus' => $product->estatus,
        ]);
    }

    public function show($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }

    private function generateUniqueSKU()
    {
        do {
            // Generar un SKU aleatorio de 6 dígitos
            $sku = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Verificar si el SKU ya existe en la base de datos
            $existingSKU = Products::where('sku', $sku)->first();
        } while ($existingSKU); // Si el SKU existe, generar uno nuevo

        return $sku;
    }

    public function store(Request $request)
    {
        $product = new Products;
        $product->nombre = $request->get('nombre');
        $product->descripcion = $request->get('descripcion');
        $product->stock = $request->get('stock');
        $product->precio_rebajado = $request->get('precio_rebajado');
        $product->precio_normal = $request->get('precio_normal');
        $product->categoria = $request->get('categoria');
        $product->subcategoria = $request->get('subcategoria');
        $product->imagenes = $request->get('imagenes');
        $product->save();

        Session::flash('success', 'Se ha guardado sus datos con éxito');

        return redirect()->back()->with('success', 'Producto creado exitosamente.');
    }

    public function create_bundle(Request $request){

        $products = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '!=', 'Kit')->get();

        return view('admin.products.bundle', compact('products'));
    }

    public function store_bundle(Request $request)
    {

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_comentarios = base_path('../public_html/plataforma.imnasmexico.com/products');
        }else{
            $ruta_comentarios = public_path() . '/products';
        }

        $product = new Products;
        $product->nombre = $request->get('nombre');
        $product->subcategoria = 'Kit';
        $product->descripcion = $request->get('descripcion');
        $product->precio_rebajado = $request->get('total');
        $product->precio_normal = $request->get('totalDescuento');
        $product->fecha_fin = $request->get('fecha_fin');
        $product->categoria = $request->get('categoria');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_comentarios;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $product->imagenes = $fileName;
        }

        $product->save();

        if ($request->has('campo')) {
            $nuevosCampos = $request->input('campo');
            $nuevosCampos2 = $request->input('campo4');
            $nuevosCampos3 = $request->input('campo3');
            $nuevosCampos4 = $request->input('descuento_prod');

            foreach ($nuevosCampos as $index => $campo) {
                $producto = Products::where('nombre', $campo)->first();

                $notas_inscripcion = new ProductosBundleId;
                $notas_inscripcion->id_product = $product->id;
                $notas_inscripcion->producto = $campo;
                $notas_inscripcion->price = $nuevosCampos2[$index];
                $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                $notas_inscripcion->id_producto = $producto->id;
                $notas_inscripcion->save();
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');

        return redirect()->back()->with('success', 'Bundle Creado con exito.');

    }

    public function edit_bundle($id){
        $cotizacion = Products::find($id);
        $cotizacion_productos = ProductosBundleId::where('id_product', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.products.edit_bundle', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function update_bundle(Request $request, $id) {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_comentarios = base_path('../public_html/plataforma.imnasmexico.com/products');
        }else{
            $ruta_comentarios = public_path() . '/products';
        }

        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');
        $total = 0;
        $resta = 0;
        $suma = 0;

        // Obtener los productos actuales de la base de datos para esa cotización
        $productosExistentes = ProductosBundleId::where('id_product', $id)->get();

        // Crear un array para almacenar los IDs de los productos enviados
        $productosIdsEnviados = [];

        // Actualizar productos existentes
        for ($count = 0; $count < count($producto); $count++) {
            // Buscar el producto en la base de datos
            $productos = ProductosBundleId::where('producto', $producto[$count])
                ->where('id_product', $id)
                ->firstOrFail();

            $producto_db = Products::where('nombre', $producto[$count])->first();
            $producto_cot = ProductosBundleId::where('producto', $producto[$count])->where('id_product', $id)->first();

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

                $price = $campo4[$count];

                $cleanPrice = floatval(str_replace(['$', ','], '', $price));
                $data = array(
                    'id_product' => $id,
                    'producto' => $campo[$count],
                    'price' => $cleanPrice,
                    'cantidad' => $campo3[$count],
                    'id_producto' => $producto->id,
                );
                ProductosBundleId::create($data);
                $total += $cleanPrice;
            }
        }

        $product = Products::findOrFail($id);

        $product->nombre = $request->get('nombre');
        $product->subcategoria = 'Kit';
        $product->descripcion = $request->get('descripcion');
        $product->precio_rebajado = $total;
        $cleanPriceNormal = floatval(str_replace(['$', ','], '', $request->get('total_final')));
        $product->precio_normal = $cleanPriceNormal;

        $product->fecha_fin = $request->get('fecha_fin');
        $product->categoria = $request->get('categoria');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_comentarios;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $product->imagenes = $fileName;
        }

        $product->save();

        Session::flash('success', 'Bundle actualizado con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');
    }

    public function update(Request $request, $id)
    {
        $product = Products::find($id);

        $user = auth()->user();

        $oldName = $product->nombre;
        if ($oldName !== $request->get('nombre')) {
            DB::table('productos_notas_id')
                ->where('producto', $oldName) // Busca todos los registros con el nombre anterior
                ->update(['producto' => $request->get('nombre')]); // Actualiza el nombre al nuevo

            DB::table('productos_notas_cosmica')
                ->where('producto', $oldName) // Busca todos los registros con el nombre anterior
                ->update(['producto' => $request->get('nombre')]); // Actualiza el nombre al nuevo
        }

        if ($request->get('cantidad_aumentada') == NULL) {
            $suma = $request->get('stock_cosmica');
        } else {
            $suma = $product->stock_cosmica + $request->get('cantidad_aumentada');
            $tipo = 'Caja cosmica suma';
        }

        if ($request->get('cantidad_aumentada_nas') == NULL) {
            $suma_nas = $request->get('stock_nas');
        } else {
            $suma_nas = $product->stock_nas + $request->get('cantidad_aumentada_nas');
            $tipo = 'Lab nas suma';
        }

        if ($request->get('cantidad_aumentada') == NULL && $request->get('cantidad_aumentada_nas') == NULL) {
            $tipo = 'Modificacion manual';
        }

        // Guardar los valores anteriores del producto en la tabla historial_stock
        $historialData = [
            'id_producto' => $product->id,
            'user' => $user->name,
            'precio_normal' => $product->precio_normal,
            'precio_rebajado' => $product->precio_rebajado,
            'sku' => $product->sku,
            'stock' => "Antes: " . $product->stock . " -> Ahora: " . $request->get('stock'),
            'stock_nas' => "Antes: " . $product->stock_nas . " -> Ahora: " . $suma_nas,
            'stock_cosmica' => "Antes: " . $product->stock_cosmica . " -> Ahora: " . $suma,
            'laboratorio' => $product->laboratorio,
            'categoria' => $product->categoria,
            'subcategoria' => $product->subcategoria,
            'linea' => $product->linea,
            'sublinea' => $product->sublinea,
            'modo_empleo' => $product->modo_empleo,
            'beneficios' => $product->beneficios,
            'ingredientes' => $product->ingredientes,
            'precauciones' => $product->precauciones,
            'favorito' => $product->favorito,
            'tipo_cambio' => $tipo,
        ];

        HistorialStock::create($historialData);

        $product->nombre = $request->get('nombre');
        $product->descripcion = $request->get('descripcion');
        $product->precio_rebajado = $request->get('precio_rebajado');
        $product->precio_normal = $request->get('precio_normal');
        $product->imagenes = $request->get('imagenes');
        $product->stock = $request->get('stock');
        $product->stock_nas = $suma_nas;
        $product->stock_cosmica = $suma;
        $product->id_categoria = $request->get('id_categoria'); // Actualizar el id de la categoría

        // Solo actualizar los campos si están presentes en la solicitud
        if ($request->has('linea')) {
            $product->linea = $request->get('linea');
        }
        if ($request->has('sublinea')) {
            $product->sublinea = $request->get('sublinea');
        }
        if ($request->has('modo_empleo')) {
            $product->modo_empleo = $request->get('modo_empleo');
        }
        if ($request->has('beneficios')) {
            $product->beneficios = $request->get('beneficios');
        }
        if ($request->has('ingredientes')) {
            $product->ingredientes = $request->get('ingredientes');
        }
        if ($request->has('precauciones')) {
            $product->precauciones = $request->get('precauciones');
        }
        if ($request->has('favorito')) {
            $product->favorito = $request->get('favorito');
        }

        $product->update();

        return response()->json([
            'id' => $product->id,
            'imagenes' => $product->imagenes,
            'nombre' => $product->nombre,
            'precio_normal' => $product->precio_normal,
            'stock' => $product->stock,
            'stock_nas' => $product->stock_nas,
            'stock_cosmica' => $product->stock_cosmica,
        ]);
    }

    public function getStockHistory($id)
    {
        $historial = HistorialStock::where('id_producto', $id)->get();
        return response()->json($historial);
    }

    public function update_ocultar(Request $request, $id)
    {
        $product = Products::find($id);
        $product->categoria = $request->get('categoria');
        $product->update();

        return response()->json([
            'id' => $product->id,
            'categoria' => $product->categoria,
        ]);

        // Session::flash('success', 'Se ha guardado sus datos con exito');
        // return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function import_products(Request $request){
        Excel::import(new ProductsImport,request()->file('file'));

        return redirect()->back()->with('success', 'Creado con exito');
    }

    public function generateSKUs()
    {
        // Ejecuta el comando de generación de SKUs
        Artisan::call('products:generate-skus');

        return back()->with('success', 'SKUs generados correctamente para todos los productos.');
    }

    public function generateAllProductsPDF()
    {
        // Obtener todos los productos de la base de datos
        // $products = Products::all();

        // $products = Products::where('laboratorio','=','NAS')->where('subcategoria', 'Producto')->get();
        $products = Products::where('laboratorio','=','Cosmica')->get();


        // Generar el PDF usando la vista y pasar los datos
        $pdf = PDF::loadView('admin.products.all_products_barcode', [
            'products' => $products
        ]);

        // Descargar el PDF
        return $pdf->setPaper('letter')->stream("all_products_barcode.pdf");

    }

    public function productsHistorialVendidos(){

        $HistorialVendidos = HistorialVendidos::whereDate('created_at', Carbon::today())
        ->whereHas('Products', function ($query) {
            $query->where('subcategoria', 'Producto');
        })
        ->orderBy('id', 'ASC')
        ->get()
        ->groupBy('id_producto');

        return view('admin.products.historial_prodcutsvendidados', compact('HistorialVendidos'));

    }

    public function filtro(Request $request){
        $fechaInicialDe = \Carbon\Carbon::parse($request->fecha_inicial_de)->startOfDay();
        $fechaInicialA = \Carbon\Carbon::parse($request->fecha_inicial_a)->endOfDay();

        $HistorialVendidos = HistorialVendidos::orderBy('created_at', 'ASC')
        ->whereHas('Products', function ($query) {
            $query->where('subcategoria', 'Producto');
        });

        if ($request->fecha_inicial_de && $request->fecha_inicial_a) {
            $HistorialVendidos = $HistorialVendidos->where('created_at', '>=', $fechaInicialDe)
                ->where('created_at', '<=', $fechaInicialA);
        }

        $HistorialVendidos = $HistorialVendidos->get()->groupBy('id_producto');

        return view('admin.products.historial_prodcutsvendidados', compact('HistorialVendidos'));
    }

    public function historial_pdf(Request $request)
    {
        $today =  date('d-m-Y');
        $fechaInicialDe = \Carbon\Carbon::parse($request->fecha_inicial_de)->startOfDay();
        $fechaInicialA = \Carbon\Carbon::parse($request->fecha_inicial_a)->endOfDay();

        $HistorialVendidos = HistorialVendidos::orderBy('created_at', 'ASC')
        ->whereHas('Products', function ($query) {
            $query->where('subcategoria', 'Producto');
        });


        if ($request->fecha_inicial_de && $request->fecha_inicial_a) {
            $HistorialVendidos = $HistorialVendidos->where('created_at', '>=', $fechaInicialDe)
                                    ->where('created_at', '<=', $fechaInicialA);
        }

        $HistorialVendidos = $HistorialVendidos->get()->groupBy('id_producto');

        $pdf = \PDF::loadView('admin.products.pdf_historial', compact('HistorialVendidos', 'today'));
        return $pdf->stream();
         //return $pdf->download('Nota cotizacion'. $folio .'/'.$today.'.pdf');

    }

    public function producto_pdf(Request $request){
        $today =  date('d-m-Y');

        $productos_notas_id = ProductosNotasId::join('notas_productos', 'productos_notas_id.id_notas_productos', '=', 'notas_productos.id')
        ->where('notas_productos.estatus_cotizacion', '=', 'Aprobada')
        ->whereNotNull('notas_productos.fecha_aprobada')
        ->whereNotNull('notas_productos.fecha_preparacion')
        ->groupBy('productos_notas_id.producto')
        ->selectRaw('productos_notas_id.producto, SUM(productos_notas_id.cantidad) as total_cantidad')
        ->get();

        $notas_cosmica_preparacion = ProductosNotasCosmica::join('notas_productos_cosmica', 'productos_notas_cosmica.id_notas_productos', '=', 'notas_productos_cosmica.id')
        ->where('notas_productos_cosmica.estatus_cotizacion', '=', 'Aprobada')
        ->where('notas_productos_cosmica.fecha_preparacion', '!=', NULL)
        ->groupBy('productos_notas_cosmica.producto')
        ->selectRaw('productos_notas_cosmica.producto, SUM(productos_notas_cosmica.cantidad) as total_cantidad')
        ->get();

        $order_online_cosmica = OrderOnlineCosmica::where('estatus', NULL)
        ->groupBy('nombre')
        ->selectRaw('nombre as producto, SUM(cantidad) as total_cantidad')
        ->get();

        $order_online_nas = OrderOnlineNas::where('estatus', NULL)
        ->groupBy('nombre')
        ->selectRaw('nombre as producto, SUM(cantidad) as total_cantidad')
        ->get();

        // Combinar todos los resultados en una colección
        $productos_combined = collect()
        ->merge($productos_notas_id)
        ->merge($notas_cosmica_preparacion)
        ->merge($order_online_cosmica)
        ->merge($order_online_nas);

        // Agrupar por producto y sumar las cantidades
        $productos_agrupados = $productos_combined
        ->groupBy('producto')
        ->map(function ($items) {
            return [
                'producto' => $items->first()->producto,
                'total_cantidad' => $items->sum('total_cantidad'),
            ];
        })
        ->values();

        $pdf = \PDF::loadView('admin.products.pdf_faltantes', compact('productos_agrupados', 'today'));
        return $pdf->stream();
         //return $pdf->download('Nota cotizacion'. $folio .'/'.$today.'.pdf');

    }

}
