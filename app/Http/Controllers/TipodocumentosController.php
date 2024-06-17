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

        $tipo_documento->leyenda1_cp = $request->get('leyenda1_cp');
        $tipo_documento->fecha_expedicion_cp = $request->get('fecha_expedicion_cp');
        $tipo_documento->leyenda2_cp = $request->get('leyenda2_cp');
        $tipo_documento->tipo_vigencia_cp = $request->get('tipo_vigencia_cp');
        $tipo_documento->tipo_vigencia_abrev_cp = $request->get('tipo_vigencia_abrev_cp');
        $tipo_documento->aviso_privacidad_cp = $request->get('aviso_privacidad_cp');
        $tipo_documento->leyenda_auth_qr_cp = $request->get('leyenda_auth_qr_cp');

        if ($request->hasFile("logo_cp")) {
            $file = $request->file('logo_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_cp = $fileName;
        }

        if ($request->hasFile("logo_otra_institucion_cp")) {
            $file = $request->file('logo_otra_institucion_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->logo_otra_institucion_cp = $fileName;
        }

        if ($request->hasFile("firma1_cp")) {
            $file = $request->file('firma1_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma1_cp = $fileName;
        }

        if ($request->hasFile("firma2_cp")) {
            $file = $request->file('firma2_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->firma2_cp = $fileName;
        }

        if ($request->hasFile("img_izq_cp")) {
            $file = $request->file('img_izq_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_izq_cp = $fileName;
        }

        if ($request->hasFile("img_der_cp")) {
            $file = $request->file('img_der_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->img_der_cp = $fileName;
        }


        // Termina cedula de papel

        if ($request->hasFile("fondo_cp")) {
            $file = $request->file('fondo_cp');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $tipo_documento->fondo_cp = $fileName;
        }


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
