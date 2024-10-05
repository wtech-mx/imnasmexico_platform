<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Models\Products;
use App\Models\HistorialStock;

use DB;
use Session;

class ProductsController extends Controller
{
    public function index(Request $request){
        $products = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '=', 'Producto')->get();
        $productsTiendita = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '=', 'Tiendita')->get();
        $productsKit = Products::orderBy('id','DESC')->where('categoria', '!=', 'Ocultar')->where('subcategoria', '=', 'Kit')->get();

        return view('admin.products.index', compact('products','productsTiendita','productsKit'));
    }

    public function show($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {

        $product = new Products;
        $product->nombre = $request->get('nombre');
        $product->descripcion = $request->get('descripcion');
        $product->precio_rebajado = $request->get('precio_rebajado');
        $product->precio_normal = $request->get('precio_normal');
        $product->imagenes = $request->get('imagenes');

        $product->save();
        Session::flash('success', 'Se ha guardado sus datos con exito');

        return redirect()->back()->with('success', 'Envio de correo exitoso.');

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

        // Guardar los valores anteriores del producto en la tabla historial_stock
        $historialData = [
            'id_producto' => $product->id,
            'user' => $user->name,
            'precio_normal' => $product->precio_normal,
            'precio_rebajado' => $product->precio_rebajado,
            'sku' => $product->sku,
            'stock' => "Antes: " . $product->stock . " -> Ahora: " . $request->get('stock'),
            'stock_nas' => "Antes: " . $product->stock_nas . " -> Ahora: " . $request->get('stock_nas'),
            'stock_cosmica' => "Antes: " . $product->stock_cosmica . " -> Ahora: " . $request->get('stock_cosmica'),
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
        $product->stock_cosmica = $request->get('stock_cosmica');
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
}
