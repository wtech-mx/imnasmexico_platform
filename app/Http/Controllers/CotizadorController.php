<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotizadorController extends Controller
{
    public function index()
    {
        return view('cotizador.index');
    }
}
