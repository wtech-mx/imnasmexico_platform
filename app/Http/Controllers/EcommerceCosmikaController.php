<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class EcommerceCosmikaController extends Controller
{
    public function home(){

        return view('tienda_cosmica.home');
    }

    public function single_product($sku){
        $product = Products::where('sku', $sku)->first();

        $products_interesar = Products::
        where('linea', $product->linea)
        ->inRandomOrder()
        ->take(6)
        ->get();

        $products_popular = Products::
        where('categoria', 'Cosmica')
        ->where('subcategoria', 'Producto')
        ->inRandomOrder()
        ->take(15)
        ->get();

        return view('tienda_cosmica.single_product', compact('product', 'products_interesar', 'products_popular'));
    }

    public function cart(){

        return view('tienda_cosmica.cart');
    }

    public function categories(){

        return view('tienda_cosmica.categories');
    }

    public function filter(){

        return view('tienda_cosmica.filter');
    }

    public function about(){

        return view('tienda_cosmica.about');
    }

    public function afiliadas(){

        return view('tienda_cosmica.afiliadas');
    }

    public function productos(){

        $products = Products::orderBy('id','DESC')->where('categoria', '=', 'Cosmica')->where('subcategoria', '=', 'Producto')->orderby('nombre','asc')->get();
        $products_facial = Products::orderBy('id','DESC')->where('categoria', '=', 'Cosmica')->where('linea', '=', 'Facial')->where('subcategoria', '=', 'Producto')->orderby('nombre','asc')->get();
        $products_corporal = Products::orderBy('id','DESC')->where('categoria', '=', 'Cosmica')->where('linea', '=', 'Corporal')->where('subcategoria', '=', 'Producto')->orderby('nombre','asc')->get();

        return view('tienda_cosmica.productos', compact('products','products_facial','products_corporal'));
    }

    public function productos_faciales(){

        return view('tienda_cosmica.productos_faciales');
    }


    public function productos_corporales(){

        return view('tienda_cosmica.productos_corporales');
    }


}
