<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\NotasProductos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use Illuminate\Support\Str;
use Session;
use Hash;
use Codexshaper\WooCommerce\Facades\Product;


class NotasProductosController extends Controller
{
    public function index(){
        $notas = NotasProductos::orderBy('id','DESC')->get();

        return view('admin.notas_productos.index', compact('notas'));
    }

    public function store(){

    }

}
