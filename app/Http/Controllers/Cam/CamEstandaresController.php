<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamCarpetaDocumentos;
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

        $documentos = new CamCarpetaDocumentos;
        $documentos->nombre = $request->get('estandar');
        $documentos->categoria = 'FORMATOS ESTANDARES';
        $documentos->id_usuario = auth()->user()->id;
        $documentos->save();

        return redirect()->route('index.estandares')->with('success', 'Estandar creado con exito.');

    }
}
