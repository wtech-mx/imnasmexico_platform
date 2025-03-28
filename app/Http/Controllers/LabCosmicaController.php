<?php

namespace App\Http\Controllers;

use App\Models\Envases;
use App\Models\EnvasesProductos;
use App\Models\HistorialLabCosmica;
use App\Models\HistorialStock;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class LabCosmicaController extends Controller
{
    public function store(Request $request){
        $envases = new Envases;
        $envases->envase = $request->get('envase');
        $envases->conteo = $request->get('conteo');
        $envases->cama = $request->get('cama');
        $envases->categoria = $request->get('categoria');
        $envases->imagen = $request->get('imagen');
        $envases->descripcion = $request->get('descripcion');
        $envases->tipo = 'Cosmica';
        $envases->save();

        if ($request->has('productos')) {
            $nuevosCampos = $request->input('productos');

            foreach ($nuevosCampos as $campo) {
                $envase_product = new EnvasesProductos;
                $envase_product->id_envase = $envases->id;
                $envase_product->id_producto = $campo;
                $envase_product->save();
            }
        }

        return redirect()->back()->with('success', 'Envase creado exitosamente.');
    }

    public function edit($id){
        $products = Products::orderBy('stock','ASC')->where('categoria', 'Cosmica')->where('subcategoria', 'Producto')->get();
        $envases = Envases::find($id);
        $envases_productos = EnvasesProductos::where('id_envase', '=', $id)->get();

        return view('admin.laboratorio_cosmica.editar', compact('products', 'envases', 'envases_productos'));
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

        if($request->get('cantidad_aumentada') == NULL){
            $suma = $request->get('stock_cosmica');
        }else{
            $suma = $product->stock_cosmica + $request->get('cantidad_aumentada');
        }


        // Guardar los valores anteriores del producto en la tabla historial_stock
        $historialData = [
            'id_producto' => $product->id,
            'user' => $user->name,
            'precio_normal' => $product->precio_normal,
            'precio_rebajado' => $product->precio_rebajado,
            'sku' => $product->sku,
            'stock' => "Antes: " . $product->stock . " -> Ahora: " . $request->get('stock'),
            'stock_nas' => "Antes: " . $product->stock_nas . " -> Ahora: " . $request->get('stock_nas'),
            'stock_cosmica' => "Antes: " . $product->stock_cosmica . " -> Ahora: " . $suma,
            'laboratorio' => $product->laboratorio,
            'categoria' => $product->categoria,
            'subcategoria' => $product->subcategoria,
        ];

        HistorialStock::create($historialData);

        $product->nombre = $request->get('nombre');
        $product->descripcion = $request->get('descripcion');
        $product->precio_rebajado = $request->get('precio_rebajado');
        $product->precio_normal = $request->get('precio_normal');
        $product->imagenes = $request->get('imagenes');
        $product->stock = $request->get('stock');
        $product->stock_nas = $request->get('stock_nas');
        $product->stock_cosmica = $suma;
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

    // =============== E N V A S E S ===============================
    public function index(Request $request){
        $products = Products::orderBy('stock','ASC')->where('categoria', 'Cosmica')->where('subcategoria', 'Producto')->get();
        $envases = Envases::where('tipo', 'Cosmica')->get();
        $envases_productos = EnvasesProductos::get();

        $envases_vencer = Envases::where('conteo','<=', 150)->get();
        return view('admin.laboratorio_cosmica.index', compact('products', 'envases', 'envases_productos', 'envases_vencer'));
    }

    public function show($id){
        $product = Envases::where('tipo', 'Cosmica')->find($id);
        return response()->json($product);
    }

    public function show_update(Request $request, $id){

        $envases = Envases::findOrFail($id);
        if ($request->get('cantidad_uti') === null) {
            $resta = $envases->conteo + $request->get('cantidad_aumentada');
        } else {
            $resta = $envases->conteo - $request->get('cantidad_uti');
        }

        $historial_lab = new HistorialLabCosmica;
        $historial_lab->id_envase = $id;
        $historial_lab->user = auth()->user()->name;
        $historial_lab->stock_viejo = $envases->conteo;
        $historial_lab->ocupado = $request->get('cantidad_aumentada');
        $historial_lab->stock_nuevo = $resta;
        $historial_lab->fecha = date('Y-m-d');
        $historial_lab->save();

        $envases->envase = $request->get('envase');
        $envases->conteo = $resta;
        $envases->descripcion = $request->get('descripcion');
        $envases->update();

        return response()->json([
            'id' => $envases->id,
            'conteo' => $envases->conteo,
        ]);
    }

    public function getStockHistoryEnvases($id){
        $historial = HistorialLabCosmica::where('id_envase', $id)->get();
        return response()->json($historial);
    }

    public function pdf_envases(Request $request){
        $today =  date('d-m-Y');
        $envases_vencer = Envases::where('tipo', 'Cosmica')->where('conteo','<=', 150)->get();
        $envases_productos = EnvasesProductos::get();

        $pdf = \PDF::loadView('admin.laboratorio_cosmica.pdf_vencer', compact('envases_vencer', 'today', 'envases_productos'));
       // return $pdf->stream();
         return $pdf->download('Envases bajo stock / '.$today.'.pdf');
    }

    public function pdf_reporte(Request $request){
        $today =  date('d-m-Y');
        $hoy =  date('Y-m-d');
        $historial = HistorialLabCosmica::where('fecha', $hoy)->get();
        $envases_productos = EnvasesProductos::get();

        Carbon::setLocale('es');
        $fechaFormateada = Carbon::parse($today)->translatedFormat('l j \d\e F');

        $inicioDia = Carbon::today()->startOfDay();
        $finDia = Carbon::today()->endOfDay();

        $historial_granel = HistorialStock::whereBetween('created_at', [$inicioDia, $finDia])
            ->where('tipo_cambio', '=', 'Laboratorio')
            ->get();

        $pdf = \PDF::loadView('admin.laboratorio_cosmica.pdf_reporte', compact('historial', 'today', 'envases_productos', 'fechaFormateada', 'historial_granel'));
        //return $pdf->stream();
         return $pdf->download('Reporte Envases y granel / '.$today.'.pdf');
    }
    // =============== C O N T E O  G R A N E L ===============================
    public function index_granel(Request $request){
        $products = Products::orderBy('id','ASC')->where('categoria', 'Cosmica')->where('subcategoria', 'Producto')->where('visibilidad_granel', '=', '1')->get();
        $bajo_granel = Products::where('conteo_lab','<=', 10)->where('visibilidad_granel', '=', '1')->get();
        $medio_granel = Products::where('conteo_lab','>', 10)->where('conteo_lab','<=', 15)->where('visibilidad_granel', '=', '1')->get();
        $count = $bajo_granel->count() + $medio_granel->count();

        return view('admin.laboratorio_cosmica.granel.index', compact('products', 'bajo_granel', 'medio_granel', 'count'));
    }

    public function show_granel($id){
        $product = Products::find($id);
        return response()->json($product);
    }

    public function show_update_granel(Request $request, $id){
        $product = Products::find($id);

        $user = auth()->user();

        if ($request->get('cantidad_utilizada') === null) {
            $resta = $product->conteo_lab + $request->get('cantidad_aumentada');
        } else {
            $resta = $product->conteo_lab - $request->get('cantidad_utilizada');
        }

        // Guardar los valores anteriores del producto en la tabla historial_stock
        $historialData = [
            'id_producto' => $product->id,
            'user' => $user->name,
            'precio_normal' => $product->precio_normal,
            'precio_rebajado' => $product->precio_rebajado,
            'sku' => $product->sku,
            'stock' => "Antes: " . $product->stock . " -> Ahora: " . $product->stock,
            'stock_nas' => "Antes: " . $product->stock_nas . " -> Ahora: " . $product->stock_nas,
            'stock_cosmica' => "Antes: " . $product->stock_cosmica . " -> Ahora: " . $product->stock_cosmica,
            'stock_laboratorio' => "Antes: " . $product->conteo_lab . " -> Ahora: " . $resta,
            'laboratorio' => $product->laboratorio,
            'categoria' => $product->categoria,
            'subcategoria' => $product->subcategoria,
            'tipo_cambio' => 'Laboratorio',
        ];

        HistorialStock::create($historialData);

        $product->conteo_lab = $resta;
        $product->update();

        return response()->json([
            'id' => $product->id,
            'conteo_lab' => $product->conteo_lab,
        ]);
    }

    public function getStockHistoryGranel($id){
        $historial = HistorialStock::where('id_producto', $id)->where('tipo_cambio', '=', 'Laboratorio')->get();
        return response()->json($historial);
    }

    public function pdf_granel(Request $request){
        $today =  date('d-m-Y');
        $bajo_granel = Products::where('conteo_lab','<=', 10)->get();
        $medio_granel = Products::where('conteo_lab','>', 10)->where('conteo_lab','<=', 15)->get();

        $pdf = \PDF::loadView('admin.laboratorio_cosmica.granel.pdf_granel', compact('bajo_granel', 'today', 'medio_granel'));
        // return $pdf->stream();
        return $pdf->download('Granel bajo stock / '.$today.'.pdf');
    }
    // =============== C O N T E O  E T I Q U E T A S ===============================
    public function index_etiqueta(Request $request){
        $products = Products::orderBy('id', 'ASC')->where('categoria', 'Cosmica')->whereIn('subcategoria', ['Producto', 'Muestras'])->get();
        $etiqueta_lateral = Products::where('etiqueta_lateral','<=', 200)->where('estatus_lateral','=', '1')->get();
        $etiqueta_tapa = Products::where('etiqueta_tapa','<=', 200)->where('estatus_tapa','=', '1')->get();
        $etiqueta_frente = Products::where('etiqueta_frente','<=', 200)->where('estatus_frente','=', '1')->get();
        $etiqueta_reversa = Products::where('etiqueta_reversa','<=', 200)->where('estatus_reversa','=', '1')->get();

        $suma = $etiqueta_lateral->count() + $etiqueta_tapa->count() + $etiqueta_frente->count() + $etiqueta_reversa->count();
        return view('admin.laboratorio_cosmica.etiqueta.index', compact('products', 'etiqueta_lateral', 'etiqueta_tapa', 'etiqueta_frente', 'etiqueta_reversa', 'suma'));
    }

    public function show_etiqueta($id){
        $product = Products::find($id);
        return response()->json($product);
    }

    public function show_update_etiqueta(Request $request, $id){
        $product = Products::find($id);

        $user = auth()->user();

        if($request->get('etiqueta_lateral_uti') == NULL){
            $cantidad_lateral = $product->etiqueta_lateral + $request->get('etiqueta_lateral_comp');
        }else{
            $cantidad_lateral = $product->etiqueta_lateral - $request->get('etiqueta_lateral_uti');
        }

        if($request->get('etiqueta_tapa_uti') == NULL){
            $cantidad_tapa = $product->etiqueta_tapa + $request->get('etiqueta_tapa_comp');
        }else{
            $cantidad_tapa = $product->etiqueta_tapa - $request->get('etiqueta_tapa_uti');
        }

        if($request->get('etiqueta_frente_uti') == NULL){
            $cantidad_frente = $product->etiqueta_frente + $request->get('etiqueta_frente_comp');
        }else{
            $cantidad_frente = $product->etiqueta_frente - $request->get('etiqueta_frente_uti');
        }

        if($request->get('etiqueta_reversa_uti') == NULL){
            $cantidad_reversa = $product->etiqueta_reversa + $request->get('etiqueta_reversa_comp');
        }else{
            $cantidad_reversa = $product->etiqueta_reversa - $request->get('etiqueta_reversa_uti');
        }

        $estatus_lateral = ($request->filled('etiqueta_lateral_comp') || $request->filled('etiqueta_lateral_uti')) ? 1 : $product->estatus_lateral;
        $estatus_tapa = ($request->filled('etiqueta_tapa_comp') || $request->filled('etiqueta_tapa_uti')) ? 1 : $product->estatus_tapa;
        $estatus_frente = ($request->filled('etiqueta_frente_comp') || $request->filled('etiqueta_frente_uti')) ? 1 : $product->estatus_frente;
        $estatus_reversa = ($request->filled('etiqueta_reversa_comp') || $request->filled('etiqueta_reversa_uti')) ? 1 : $product->estatus_reversa;

        // Guardar los valores anteriores del producto en la tabla historial_stock
        $historialData = [
            'id_producto' => $product->id,
            'user' => $user->name,
            'precio_normal' => $product->precio_normal,
            'precio_rebajado' => $product->precio_rebajado,
            'sku' => $product->sku,
            'stock' => "Antes: " . $product->stock . " -> Ahora: " . $product->stock,
            'stock_nas' => "Antes: " . $product->stock_nas . " -> Ahora: " . $product->stock_nas,
            'stock_cosmica' => "Antes: " . $product->stock_cosmica . " -> Ahora: " . $product->stock_cosmica,
            'stock_etiqueta' => "Antes lateral: " . $product->etiqueta_lateral . " -> Ahora lateral: " . $cantidad_lateral . " <br> " . "Antes tapa: " . $product->etiqueta_tapa . " -> Ahora tapa: " . $cantidad_tapa . " <br> " . "Antes frente: " . $product->etiqueta_frente . " -> Ahora frente: " . $cantidad_frente . " <br> " . "Antes reversa: " . $product->etiqueta_reversa . " -> Ahora reversa: " . $cantidad_reversa,
            'laboratorio' => $product->laboratorio,
            'categoria' => $product->categoria,
            'subcategoria' => $product->subcategoria,
            'tipo_cambio' => 'Etiqueta',
        ];

        HistorialStock::create($historialData);

        $product->etiqueta_lateral = $cantidad_lateral;
        $product->etiqueta_tapa = $cantidad_tapa;
        $product->etiqueta_frente = $cantidad_frente;
        $product->etiqueta_reversa = $cantidad_reversa;

        $product->estatus_lateral = $estatus_lateral;
        $product->estatus_tapa = $estatus_tapa;
        $product->estatus_frente = $estatus_frente;
        $product->estatus_reversa = $estatus_reversa;
        $product->update();

        return response()->json([
            'id' => $product->id,
            'etiqueta_lateral' => $product->etiqueta_lateral,
            'etiqueta_tapa' => $product->etiqueta_tapa,
            'etiqueta_frente' => $product->etiqueta_frente,
            'etiqueta_reversa' => $product->etiqueta_reversa,
        ]);
    }

    public function getStockHistoryEtiqueta($id){
        $historial = HistorialStock::where('id_producto', $id)->where('tipo_cambio', '=', 'Etiqueta')->get();
        return response()->json($historial);
    }

    public function pdf_etiquetas(Request $request){
        $today =  date('d-m-Y');
        $etiqueta_lateral = Products::where('etiqueta_lateral','<=', 200)->where('estatus_lateral','=', '1')->get();
        $etiqueta_tapa = Products::where('etiqueta_tapa','<=', 200)->where('estatus_tapa','=', '1')->get();
        $etiqueta_frente = Products::where('etiqueta_frente','<=', 200)->where('estatus_frente','=', '1')->get();
        $etiqueta_reversa = Products::where('etiqueta_reversa','<=', 200)->where('estatus_reversa','=', '1')->get();

        $pdf = \PDF::loadView('admin.laboratorio_cosmica.etiqueta.pdf_etiquetas', compact('etiqueta_lateral', 'etiqueta_tapa', 'etiqueta_frente', 'etiqueta_reversa', 'today'));
        //return $pdf->stream();
         return $pdf->download('Etiquetas bajo stock / '.$today.'.pdf');
    }

    public function pdf_etiquetas_reporte(Request $request){
        $today =  date('d-m-Y');

        Carbon::setLocale('es');
        $fechaFormateada = Carbon::parse($today)->translatedFormat('l j \d\e F');

        $inicioDia = Carbon::today()->startOfDay();
        $finDia = Carbon::today()->endOfDay();

        $historial_etiqueta = HistorialStock::whereBetween('created_at', [$inicioDia, $finDia])
            ->where('tipo_cambio', '=', 'Etiqueta')
            ->get();

        $pdf = \PDF::loadView('admin.laboratorio_cosmica.etiqueta.pdf_reporte', compact('today', 'historial_etiqueta', 'fechaFormateada'));
        //return $pdf->stream();
        return $pdf->download('Reporte etiquetas / '.$today.'.pdf');
    }

    public function pdfProduccionEstimado(){
            $today =  date('d-m-Y');
            $productos = Products::where('categoria', '=', 'Cosmica')->where('subcategoria', '=', 'Producto')->get(); // Obtener todos los productos

            $resultados = [];

            foreach ($productos as $producto) {
                // Cantidad de granel por unidad (en litros)
                $cantidad_granel_por_unidad = $producto->granel_unidad ?? 0;

                // Stock disponible
                $stock_granel = $this->obtenerStockGranel($producto);
                $stock_etiquetas = $this->obtenerStockEtiquetas($producto);
                $stock_envases = $this->obtenerStockEnvases($producto);

                // Calcular máximo de producción posible
                $max_por_granel = $cantidad_granel_por_unidad > 0 ? floor($stock_granel / ($cantidad_granel_por_unidad / 1000)) : INF;
                $max_por_etiquetas = min($stock_etiquetas);
                $max_por_envases = min($stock_envases);

                // La cantidad máxima es el mínimo entre los tres factores
                $max_producible = min($max_por_granel, $max_por_etiquetas, $max_por_envases);

                $resultados[] = [
                    'producto' => $producto->nombre,
                    'max_producible' => $max_producible,
                    'stock_granel' => $stock_granel,
                    'stock_envases' => $this->obtenerStockEnvasesConNombres($producto),
                    'stock_etiquetas' => $this->obtenerStockEtiquetasConNombres($producto)
                ];
                $resultados = collect($resultados)->sortByDesc('max_producible')->values()->all();
            }

        // Generar el PDF
        $today = date('d-m-Y');
        $pdf = \PDF::loadView('admin.laboratorio_cosmica.pdf_produccion_estimado', compact('resultados', 'today'));
        //return $pdf->stream();
        return $pdf->download('Produccion_Estimada_' . $today . '.pdf');
    }

    private function obtenerStockGranel($producto)
    {
        return DB::table('products')
            ->where('id', $producto->id)
            ->sum('conteo_lab');
    }

    private function obtenerStockEtiquetas($producto){
        $etiquetas = [];

        if ($producto->estatus_frente) {
            $etiquetas[] = $producto->etiqueta_frente;
        }
        if ($producto->estatus_lateral) {
            $etiquetas[] = $producto->etiqueta_lateral;
        }
        if ($producto->estatus_tapa) {
            $etiquetas[] = $producto->etiqueta_tapa;
        }
        if ($producto->estatus_reversa) {
            $etiquetas[] = $producto->etiqueta_reversa;
        }

        return $etiquetas ?: [INF]; // Si no requiere etiquetas, devolver infinito
    }

    private function obtenerStockEnvases($producto){
        $envases_ids = DB::table('envases_prosuctos')
            ->where('id_producto', $producto->id)
            ->pluck('id_envase');

        $stock_envases = DB::table('envases')
            ->whereIn('id', $envases_ids)
            ->pluck('conteo')
            ->toArray();

        return $stock_envases ?: [INF]; // Si no requiere envases, devolver infinito
    }

    private function obtenerStockEnvasesConNombres($producto){
        $envases = \DB::table('envases_prosuctos')
            ->join('envases', 'envases.id', '=', 'envases_prosuctos.id_envase')
            ->where('envases_prosuctos.id_producto', $producto->id)
            ->select('envases.envase', 'envases.conteo')
            ->get();

        return $envases->pluck('conteo', 'envase')->toArray();
    }

    private function obtenerStockEtiquetasConNombres($producto){
        $etiquetas = [];

        if ($producto->estatus_frente) {
            $etiquetas['Frente'] = $producto->etiqueta_frente;
        }
        if ($producto->estatus_lateral) {
            $etiquetas['Lateral'] = $producto->etiqueta_lateral;
        }
        if ($producto->estatus_tapa) {
            $etiquetas['Tapa'] = $producto->etiqueta_tapa;
        }
        if ($producto->estatus_reversa) {
            $etiquetas['Reversa'] = $producto->etiqueta_reversa;
        }

        return $etiquetas;
    }
}
