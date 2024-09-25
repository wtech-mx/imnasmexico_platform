<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PruebaApiController extends Controller
{
    public function index_preparacion()
    {
        // Hacer la petición HTTP a la API de Paradisus

        $usuarios= Http::get('http://paradisus.test/api/enviar-notas-pedidos');
        $usuarioArray = $usuarios->json();

        // Retornar la vista y pasar los datos obtenidos
        return view('admin.api.index', compact('usuarioArray'));
    }
}
