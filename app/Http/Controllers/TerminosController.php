<?php

namespace App\Http\Controllers;

use App\Models\Terminos;
use Illuminate\Http\Request;

class TerminosController extends Controller
{
    public function store(Request $request)
    {
        $user = new Terminos();
        $user->nombre = $request->get('name');
        $user->save();

        return redirect()->back()
        ->with('success','Acepto los terminos con exito');
    }
}
