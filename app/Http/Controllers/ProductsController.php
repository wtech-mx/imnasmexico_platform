<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Models\Products;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Products::orderBy('id','DESC')->get();

        return view('admin.products.index', compact('products'));
    }

    public function import_products(Request $request)
    {
        Excel::import(new ProductsImport,request()->file('file'));

        return redirect()->back()->with('success', 'Creado con exito');
    }

}
