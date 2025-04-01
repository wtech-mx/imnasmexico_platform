<?php

namespace App\Http\Controllers;

use App\Models\HistorialVendidos;
use App\Models\Products;
use App\Models\HistorialStock;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use Carbon\Carbon;
use DB;
use Session;

use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index(){

        return view('admin.scanner.index');
    }

    public function scanner_notas(){

        return view('admin.bodega.index_scaner');
    }

    public function actualizarEstatus(Request $request)
    {
        $table = $request->input('table');
        $id = $request->input('id');

        // Verificar la tabla y buscar el registro
        if ($table === 'NotasProductos') {
            $nota = NotasProductos::find($id);
        } elseif ($table === 'NotasProductosCosmica') {
            $nota = NotasProductosCosmica::find($id);
        } else {
            return response()->json(['error' => 'Tabla no válida'], 400);
        }

        if (!$nota) {
            return response()->json(['error' => 'Nota no encontrada'], 404);
        }

        // Actualizar el estatus
        $nota->estatus_cotizacion = 'Enviado'; // Cambia al estatus deseado
        $nota->save();

        return response()->json(['success' => true, 'message' => 'Estatus actualizado correctamente']);
    }

    public function buscador_ajax(Request $request){

        if ($request->ajax()) {

            $now = Carbon::now();
            $mesActual = $now->month;

            $codigo = $request->input('search');
            $product = Products::where('sku','=',$codigo)->get();

            $productId = Products::where('sku','=',$codigo)->first();
            $extraccionID = $productId->id;

            $historialMods = HistorialStock::where('sku', $codigo)->get();

            $HistorialVendidos = HistorialVendidos::where('id_producto','=',$extraccionID)->get();

            return view('admin.scanner.producto_info',compact('product','historialMods','HistorialVendidos'));
        }
    }

    public function buscador_ajax_palabra(Request $request)
    {
        if ($request->ajax()) {

            $codigo = $request->input('search');

            // Busca los productos cuyo nombre coincida con la palabra clave
            $products = Products::where('nombre', 'LIKE', "%{$codigo}%")
                        ->orderby('nombre', 'ASC')
                        ->get();

            // Inicializa colecciones vacías para los historiales
            $historialMods = collect();
            $historialVendidos = collect();

            // Por cada producto encontrado, obtiene los historiales relacionados
            foreach ($products as $product) {
                $historialModsForProduct = HistorialStock::where('sku', $product->sku)->get();
                $historialVendidosForProduct = HistorialVendidos::where('id_producto', $product->id)->get();

                // Agrega los historiales a las colecciones
                $historialMods = $historialMods->merge($historialModsForProduct);
                $historialVendidos = $historialVendidos->merge($historialVendidosForProduct);
            }

            return view('admin.scanner.product_info_palabras', compact('products', 'historialMods', 'historialVendidos'));
        }
    }

    public function salon_index(){

        return view('admin.bodega.scanner_salon.index');
    }

    public function salon_buscador_ajax(Request $request){
        if ($request->ajax()) {
            $now = Carbon::now();
            $mesActual = $now->month;

            $codigo = $request->input('search');
            $product = Products::where('sku','=',$codigo)->get();

            $productId = Products::where('sku','=',$codigo)->first();
            $extraccionID = $productId->id;

            $historialMods = HistorialStock::where('sku', $codigo)->get();

            $HistorialVendidos = HistorialVendidos::where('id_producto','=',$extraccionID)->get();

            return view('admin.bodega.scanner_salon.producto_info',compact('product','historialMods','HistorialVendidos'));
        }
    }

    public function salon_update(Request $request, $id){

        $product = Products::find($id);
        $product->stock_salon -= $request->get('cantidad');
        $product->stock += $request->get('cantidad');
        $product->update();

        return redirect()->back()->with('success', 'Se ha solicitado correctamente.');
    }
}
