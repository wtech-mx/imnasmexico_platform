<?php

namespace App\Http\Controllers;

use App\Models\HistorialVendidos;
use App\Models\Products;
use App\Models\HistorialStock;
use Carbon\Carbon;
use DB;
use Session;

use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index(){

        return view('admin.scanner.index');
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

    public function buscador_ajax_palabra(Request $request){
        if ($request->ajax()) {

            $now = Carbon::now();
            $mesActual = $now->month;

            $codigo = $request->input('search');
            $product = Products::where('nombre', 'LIKE', "%{$codigo}%")->orderby('nombre','ASC')->get();

            return view('admin.scanner.producto_info',compact('product'));
        }
    }

}
