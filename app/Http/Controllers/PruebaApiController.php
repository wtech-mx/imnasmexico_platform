<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PruebaApiController extends Controller
{
    public function index_preparacion(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $usuarios = Http::get('https://paradisus.mx/api/enviar-notas-pedidos');

        }else{
            $usuarios = Http::get('http://paradisus.test/api/enviar-notas-pedidos');
        }
        // Convertir la respuesta a un array
        $usuarioArray = $usuarios->json();

        // Filtrar los datos con estatus "Aprobada" y limitar a los últimos 100
        $usuarioFiltrado = collect($usuarioArray['data'])
            ->where('estatus', 'Aprobada')
            ->sortByDesc('id')
            ->take(100)
            ->values()
            ->all();

        // Retornar la vista con los datos filtrados
        return view('admin.api.index', compact('usuarioFiltrado'));
    }

}
