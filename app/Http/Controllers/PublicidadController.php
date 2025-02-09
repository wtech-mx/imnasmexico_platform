<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use Session;
use Illuminate\Http\Request;

class PublicidadController extends Controller
{
    public function index(Request $request)
    {
        $publicidad = Publicidad::orderBy('id','DESC')->get();

        return view('admin.marketing.index_publicidad', compact('publicidad'));
    }

    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_publicidad = base_path('../public_html/plataforma.imnasmexico.com/archivos');
        }else{
            $ruta_publicidad = public_path() . '/archivos';
        }

        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            foreach ($archivos as $archivo) {
                $path = $ruta_publicidad;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $publicidad = new Publicidad;
                $publicidad->nombre = $fileName;
                $publicidad->save();
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Creado con exito');
    }

    public function destroy($id)
    {
        $archivo = Publicidad::findOrFail($id);
        $archivo->delete();
        return redirect()->back()->with('success', 'El archivo ha sido eliminado correctamente.');
    }
}
