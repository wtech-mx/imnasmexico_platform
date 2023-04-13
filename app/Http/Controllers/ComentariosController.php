<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Http\Request;
use Session;

class ComentariosController extends Controller
{
    public function index(Request $request)
    {
        $comentarios = Comentarios::orderBy('id','DESC')->get();

        return view('admin.comentarios.index', compact('comentarios'));
    }

    public function create()
    {
        return view('admin.comentarios.create');
    }

    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_comentarios = base_path('../public_html/plataforma.imnasmexico.com/comentarios');
        }else{
            $ruta_comentarios = public_path() . '/comentarios';
        }

        $comentarios = new Comentarios;
        $comentarios->nombre = $request->get('nombre');
        $comentarios->mensaje = $request->get('mensaje');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_comentarios;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $comentarios->foto = $fileName;
        }

        $comentarios->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('comentarios.index')
            ->with('success', 'curso creado con exito.');
    }

    public function edit($id)
    {
        $comentarios = Comentarios::find($id);

        return view('admin.comentarios.edit', compact('comentarios', 'tickets'));
    }

    public function update(Request $request, $id)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_comentarios = base_path('../public_html/plataforma.imnasmexico.com/comentarios');
        }else{
            $ruta_comentarios = public_path() . '/comentarios';
        }

        $comentarios = Comentarios::find($id);
        $comentarios->nombre = $request->get('nombre');
        $comentarios->mensaje = $request->get('mensaje');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_comentarios;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $comentarios->foto = $fileName;
        }

        $comentarios->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('comentarios.index')
            ->with('success', 'curso actualizado con exito.');
    }
}
