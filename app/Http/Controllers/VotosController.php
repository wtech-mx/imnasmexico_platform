<?php

namespace App\Http\Controllers;

use App\Models\Votos;
use Illuminate\Http\Request;

class VotosController extends Controller
{
    public function index(Request $request)
    {
        $votos = Votos::orderBy('id','DESC')->get();

        return view('admin.marketing.index_publicidad', compact('publicidad'));
    }

    public function votar(Request $request){
        $concursanteId = $request->input('concursanteId');

        // Crear un nuevo registro de voto en la base de datos
        Votos::create([
            'concursante_id' => $concursanteId,
        ]);

        // Obtener el número total de votos para el concursante
        $totalVotos = Votos::where('concursante_id', $concursanteId)->count();

        // Retornar la respuesta como JSON con el número total de votos
        return response()->json(['votos' => $totalVotos]);
    }

}
