<?php

namespace App\Http\Controllers;

use App\Models\CarpetaDocumentosEstandares;
use App\Models\CarpetasEstandares;
use Illuminate\Http\Request;
use Session;

class CarpetasEstandaresController extends Controller
{
    public function index(Request $request)
    {
        $carpetas = CarpetasEstandares::orderBy('id','DESC')->get();

        return view('admin.carpetas_estandares.index', compact('carpetas'));
    }

    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_recursos_carpeta = base_path('../public_html/plataforma.imnasmexico.com/carpetasestandares');
        }else{
            $ruta_recursos_carpeta = public_path() . '/carpetasestandares';
        }

        $carpeta = new CarpetasEstandares();
        $carpeta->nombre = $request->get('nombre');
        $carpeta->save();

        $folder = $carpeta->id;
        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            foreach ($archivos as $archivo) {
                $path = $ruta_recursos_carpeta . '/' . $carpeta->nombre;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $carpeta_recursos = new CarpetaDocumentosEstandares;
                $carpeta_recursos->nombre = $fileName;
                $carpeta_recursos->id_carpeta = $folder;
                $carpeta_recursos->guia = $request->get('guia');;
                $carpeta_recursos->save();
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Creado con exito');
    }

    public function edit($id)
    {
        $carpetas = CarpetasEstandares::find($id);
        $carpeta_recursos = CarpetaDocumentosEstandares::where('id_carpeta', '=', $id)->get();

        return view('admin.carpetas.edit', compact('carpetas', 'carpeta_recursos'));
    }

    public function update(Request $request, $id)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_recursos_carpeta = base_path('../public_html/plataforma.imnasmexico.com/carpetasestandares');
        }else{
            $ruta_recursos_carpeta = public_path() . '/carpetasestandares';
        }

        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            foreach ($archivos as $archivo) {
                $path = $ruta_recursos_carpeta . '/' . $request->nombre;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $carpeta_recursos = new CarpetaDocumentosEstandares;
                $carpeta_recursos->nombre = $fileName;
                $carpeta_recursos->id_carpeta = $id;
                $carpeta_recursos->guia = $request->get('guia');;
                $carpeta_recursos->save();
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Actualziado con exito');
    }

    public function destroy($id)
    {
        $archivo = CarpetaDocumentosEstandares::findOrFail($id);
        $archivo->delete();
        return redirect()->back()->with('success', 'El archivo ha sido eliminado correctamente.');
    }
}
