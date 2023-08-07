<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Tipodocumentos;


class TipodocumentosController extends Controller
{
    public function index(Request $request)
    {
        $tipo_documento = Tipodocumentos::get();

        return view('admin.tipo_documentos.index',compact('tipo_documento'));
    }


    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/tipos_documentos');
        }else{
            $ruta_manual = public_path() . '/tipos_documentos';
        }

        $tipo_documento = new Tipodocumentos;
        $tipo_documento->tipo = $request->get('tipo');
        $tipo_documento->nombre = $request->get('nombre');

        if ($request->hasFile("img_portada")) {
            $file = $request->file('img_portada');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_portada = $fileName;
        }

        if ($request->hasFile("img_reverso")) {
            $file = $request->file('img_reverso');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_reverso = $fileName;
        }

        $tipo_documento->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/tipos_documentos');
        }else{
            $ruta_manual = public_path() . '/tipos_documentos';
        }

        $tipo_documento = Tipodocumentos::find($id);
        $tipo_documento->tipo = $request->get('tipo');
        $tipo_documento->nombre = $request->get('nombre');


        if ($request->hasFile("img_portada")) {
            $file = $request->file('img_portada');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_portada = $fileName;
        }

        if ($request->hasFile("img_reverso")) {
            $file = $request->file('img_reverso');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_reverso = $fileName;
        }

        $tipo_documento->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back();

    }}
