<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcommerceCosmikaController extends Controller
{
    public function home(){

        return view('tienda_cosmica.home');
    }

    public function single_product(){

        return view('tienda_cosmica.single_product');
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


}
