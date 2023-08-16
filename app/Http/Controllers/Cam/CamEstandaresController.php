<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamEstandares;
use Illuminate\Http\Request;

class CamEstandaresController extends Controller
{
    public function index(){

        $estnadares = CamEstandares::get();
        return view('cam.admin.estandares.index', compact('estnadares'));
    }

    public function crear(Request $request){

        $estandares = new CamEstandares;
        $estandares->estandar = $request->get('estandar');
        $estandares->id_usuario = auth()->user()->id;
        $estandares->save();

        return redirect()->route('index.estandares')->with('success', 'Estandar creado con exito.');

    }
}
