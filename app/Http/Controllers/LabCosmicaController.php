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
        $envases = Envases::get();
        $envases_productos = EnvasesProductos::get();

        $envases_vencer = Envases::where('conteo','<=', 150)->get();
        return view('admin.laboratorio_cosmica.index', compact('products', 'envases', 'envases_productos', 'envases_vencer'));
    }

    public function show($id){
        $product = Envases::find($id);
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
        $envases->save();

        return response()->json([
            'conteo' => $envases->conteo,
        ]);
    }

    public function getStockHistoryEnvases($id){
        $historial = HistorialLabCosmica::where('id_envase', $id)->get();
        return response()->json($historial);
    }

    public function pdf_envases(Request $request){
        $today =  date('d-m-Y');
        $envases_vencer = Envases::where('conteo','<=', 150)->get();
        $envases_productos = EnvasesProductos::get();

        $pdf = \PDF::loadView('admin.laboratorio_cosmica.pdf_vencer', compact('envases_vencer', 'today', 'envases_productos'));
        //return $pdf->stream();
         return $pdf->download('Envases bajo stock / '.$today.'.pdf');
    }

    public function pdf_reporte(Request $request){
        $today =  date('d-m-Y');
        $hoy =  date('Y-m-d');
        $historial = HistorialLabCosmica::where('fecha', $hoy)->get();
        $envases_productos = EnvasesProductos::get();

        Carbon::setLocale('es');
        $fechaFormateada = Carbon::parse($today)->translatedFormat('l j \d\e F');

        $pdf = \PDF::loadView('admin.laboratorio_cosmica.pdf_reporte', compact('historial', 'today', 'envases_productos', 'fechaFormateada'));
        //return $pdf->stream();
         return $pdf->download('Envases bajo stock / '.$today.'.pdf');
    }
    // =============== C O N T E O  G R A N E L ===============================
    public function index_granel(Request $request){
        $products = Products::orderBy('id','ASC')->where('categoria', 'Cosmica')->where('subcategoria', 'Producto')->get();

        return view('admin.laboratorio_cosmica.granel.index', compact('products'));
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
            'conteo_lab' => $product->conteo_lab,
        ]);
    }

    public function getStockHistoryGranel($id){
        $historial = HistorialStock::where('id_producto', $id)->where('tipo_cambio', '=', 'Laboratorio')->get();
        return response()->json($historial);
    }

    // =============== C O N T E O  E T I Q U E T A S ===============================
    public function index_etiqueta(Request $request){
        $products = Products::orderBy('id','ASC')->where('categoria', 'Cosmica')->where('subcategoria', 'Producto')->get();
        $etiqueta_lateral = Products::where('etiqueta_lateral','<=', 150)->get();
        $etiqueta_tapa = Products::where('etiqueta_tapa','<=', 150)->get();
        $etiqueta_frente = Products::where('etiqueta_frente','<=', 150)->get();
        $etiqueta_reversa = Products::where('etiqueta_reversa','<=', 150)->get();

        $suma = $etiqueta_lateral->count() + $etiqueta_tapa->count() + $etiqueta_frente->count() + $etiqueta_reversa->count();
        return view('admin.laboratorio_cosmica.etiqueta.index', compact('products', 'etiqueta_lateral', 'etiqueta_tapa', 'etiqueta_frente', 'etiqueta_reversa'));
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
            'stock_etiqueta' => "Antes lateral: " . $product->etiqueta_lateral . " -> Ahora lateral: " . $cantidad_lateral . " <br> " . "Antes tapa: " . $product->etiqueta_tapa . " -> Ahora tapa: " . $cantidad_tapa . " <br> " . "Antes frente: " . $product->etiqueta_frente . " -> Ahora frente: " . $cantidad_frente . " <br> " . "Antes reversa: " . $product->cantidad_reversa . " -> Ahora reversa: " . $cantidad_reversa,
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
        $product->update();

        return response()->json([
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
}