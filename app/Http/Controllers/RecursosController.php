<?php

namespace App\Http\Controllers;

use App\Models\Recursos;
use Illuminate\Http\Request;
use Session;

class RecursosController extends Controller
{
    public function index(Request $request){
        $recursos = Recursos::orderBy('id','DESC')->get();

        return view('admin.recursos.index', compact('recursos'));
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
                $ruta_recursos = public_path() . '/materiales';
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
                $ruta_recursos = public_path() . '/materiales';
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

        $recursos->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Actualziado con exito');
    }
}