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
}
