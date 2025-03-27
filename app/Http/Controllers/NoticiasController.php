<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use Illuminate\Http\Request;
use Session;

class NoticiasController extends Controller
{
    public function index(Request $request)
    {
        $noticias = Noticias::orderBy('id','DESC')->get();

        return view('admin.noticias.index', compact('noticias'));
    }

    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_noticias = base_path('../public_html/plataforma.imnasmexico.com/noticias');
        }else{
            $ruta_noticias = public_path() . '/noticias';
        }

        $noticias = new Noticias;
        $noticias->titulo = $request->get('titulo');
        $noticias->descripcion = $request->get('descripcion');
        $noticias->seccion = $request->get('seccion');
        $noticias->link = $request->get('link');
        $noticias->tipo = $request->get('tipo');
        $noticias->estatus = $request->get('estatus');
        $noticias->orden = $request->get('orden');

        if ($request->hasFile("multimedia")) {
            $file = $request->file('multimedia');
            $path = $ruta_noticias;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $noticias->multimedia = $fileName;
        }

        $noticias->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Creado con exito');
    }

    public function update(Request $request, $id)
    {
        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_noticias = base_path('../public_html/plataforma.imnasmexico.com/noticias');
        }else{
            $ruta_noticias = public_path() . '/noticias';
        }

        $noticias = Noticias::find($id);
        $noticias->titulo = $request->get('titulo');
        $noticias->descripcion = $request->get('descripcion');
        $noticias->seccion = $request->get('seccion');
        $noticias->link = $request->get('link');
        $noticias->tipo = $request->get('tipo');
        $noticias->estatus = $request->get('estatus');
        $noticias->orden = $request->get('orden');

        if ($request->hasFile("multimedia")) {

            $file = $request->file('multimedia');
            $path = $ruta_noticias;
            $fileName = uniqid() . $file->getClientOriginalName();

            // Verifica si la imagen existente ya existe y elimínala si es el caso.
            $imagenExistente = $path . '/' . $noticias->multimedia;
            if (file_exists($imagenExistente)) {
                unlink($imagenExistente);
            }

            $imagenAnterior = $path . '/' . $noticias->multimedia;
            if (file_exists($imagenAnterior)) {
                unlink($imagenAnterior);
            }

            // Mueve la nueva imagen con el mismo nombre de archivo que la imagen anterior.
            $file->move($path, $noticias->multimedia);

            $noticias->multimedia = $noticias->multimedia; // No cambia el nombre.
        }

        $noticias->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Actualziado con exito');
    }

    public function destroy($id){
    $noticia = Noticias::find($id);

    if (!$noticia) {
        return redirect()->back()->with('error', 'La noticia no existe.');
    }

    $dominio = request()->getHost();
    if ($dominio == 'plataforma.imnasmexico.com') {
        $ruta_noticias = base_path('../public_html/plataforma.imnasmexico.com/noticias');
    } else {
        $ruta_noticias = public_path() . '/noticias';
    }

    // Eliminar el archivo multimedia asociado si existe
    $filePath = $ruta_noticias . '/' . $noticia->multimedia;
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Eliminar la noticia
    $noticia->delete();

    return redirect()->back()->with('success', 'Noticia eliminada con éxito.');
}
}
