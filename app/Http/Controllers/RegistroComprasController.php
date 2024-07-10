<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroComprasController extends Controller
{
    public function index(){

        return view('admin.notas_productos.index');
    }

    public function create(){

        return view('user.registro_compras');
    }
}
