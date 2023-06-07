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

    public function votar(Request $request)
    {
        $concursanteId = $request->input('concursanteId');

        $concursante = Votos::findOrFail($concursanteId);
        $concursante->increment('votos');

        // Obtener el número total de votos para el concursante
        $totalVotos = Votos::where('id', $concursanteId)->value('votos');

        // Retornar la respuesta como JSON con el número total de votos
        return response()->json(['votos' => $totalVotos]);
    }


}
