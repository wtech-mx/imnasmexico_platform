<?php

namespace App\Http\Controllers;

use App\Models\Recursos;
use Illuminate\Http\Request;
use Session;

class RecursosController extends Controller
{
    public function index(Request $request){
        $recursos_buscador = Recursos::orderBy('id','DESC')->get();

        return view('admin.recursos.index', compact('recursos_buscador'));
    }

    public function buscador(Request $request){
        $recursos_buscador = Recursos::orderBy('id','DESC')->get();
        $recursos = Recursos::query();

        if( $request->nombre != NULL){
            $recursos = $recursos->where('nombre', '=', $request->nombre);
        }
        $recursos = $recursos->get();

        return view('admin.recursos.index', compact('recursos', 'recursos_buscador'));
    }

    public function store(Request $request){
        $dominio = $request->getHost();

        $recursos = new Recursos;
        $recursos->nombre = $request->get('nombre');
        $recursos->tipo = $request->get('tipo');

        if ($request->hasFile("foto")) {
            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/curso');
            }else{
                $ruta_recursos = public_path() . '/curso';
            }

            $file = $request->file('foto');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $recursos->foto = $fileName;
        }

        if ($request->hasFile("material")) {
            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/materiales');
            }else{
                $ruta_recursos = public_path() . '\materiales';
            }

            $file = $request->file('material');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $recursos->material = $fileName;
        }

        if ($request->hasFile("pdf")) {
            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/pdf');
            }else{
                $ruta_recursos = public_path() . '/pdf';
            }

            $file = $request->file('pdf');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $recursos->pdf = $fileName;
        }

        $recursos->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Creado con exito');
    }

    public function update(Request $request, $id){
        $dominio = $request->getHost();

        $recursos = Recursos::find($id);
        $recursos->nombre = $request->get('nombre');
        $recursos->tipo = $request->get('tipo');

        if ($request->hasFile("foto")) {
            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/curso');
            } else {
                $ruta_recursos = public_path() . '/curso';
            }

            $file = $request->file('foto');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();

            // Verifica si la imagen existente ya existe y elimínala si es el caso.
            $imagenExistente = $path . '/' . $recursos->foto;
            if (file_exists($imagenExistente)) {
                unlink($imagenExistente);
            }

            $imagenAnterior = $path . '/' . $recursos->foto;
            if (file_exists($imagenAnterior)) {
                unlink($imagenAnterior);
            }

            // Mueve la nueva imagen con el mismo nombre de archivo que la imagen anterior.
            $file->move($path, $recursos->foto);

            $recursos->foto = $recursos->foto; // No cambia el nombre.
        }

        if ($request->hasFile("material")) {
            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/materiales');
            } else {
                $ruta_recursos = public_path() . '/materiales';
            }

            $file = $request->file('material');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();

            // Verifica si la imagen existente ya existe y elimínala si es el caso.
            $imagenExistente = $path . '/' . $recursos->material;
            if (file_exists($imagenExistente)) {
                unlink($imagenExistente);
            }

            $imagenAnterior = $path . '/' . $recursos->material;
            if (file_exists($imagenAnterior)) {
                unlink($imagenAnterior);
            }

            // Mueve la nueva imagen con el mismo nombre de archivo que la imagen anterior.
            $file->move($path, $recursos->material);

            $recursos->material = $recursos->material; // No cambia el nombre.
        }

        if ($request->hasFile("pdf")) {
            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/pdf');
            } else {
                $ruta_recursos = public_path() . '/pdf';
            }

            $file = $request->file('pdf');
            $path = $ruta_recursos;
            $fileName = uniqid() . $file->getClientOriginalName();

            // Verifica si la imagen existente ya existe y elimínala si es el caso.
            $imagenExistente = $path . '/' . $recursos->pdf;
            if (file_exists($imagenExistente)) {
                unlink($imagenExistente);
            }

            $imagenAnterior = $path . '/' . $recursos->pdf;
            if (file_exists($imagenAnterior)) {
                unlink($imagenAnterior);
            }

            // Mueve la nueva imagen con el mismo nombre de archivo que la imagen anterior.
            $file->move($path, $recursos->pdf);

            $recursos->pdf = $recursos->pdf; // No cambia el nombre.
        }

        $recursos->update();



        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Actualziado con exito');
    }
}
