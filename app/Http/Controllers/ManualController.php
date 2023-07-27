<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manual;
use Session;


class ManualController extends Controller
{
    public function index(Request $request)
    {
        $manual = Manual::get();

        return view('admin.manual.index',compact('manual'));
    }


    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/manual');
        }else{
            $ruta_manual = public_path() . '/manual';
        }

        $curso = new Manual;
        $curso->modulo = $request->get('modulo');
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');

        $curso->step1_name = $request->get('step1_name');
        $curso->step2_name = $request->get('step2_name');
        $curso->step3_name = $request->get('step3_name');
        $curso->step4_name = $request->get('step4_name');
        $curso->step5_name = $request->get('step5_name');
        $curso->step6_name = $request->get('step6_name');
        $curso->step7_name = $request->get('step7_name');
        $curso->step8_name = $request->get('step8_name');
        $curso->step9_name = $request->get('step9_name');
        $curso->step10_name = $request->get('step10_name');

        if ($request->hasFile("video")) {
            $file = $request->file('video');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->video = $fileName;
        }

        if ($request->hasFile("imagen_portada")) {
            $file = $request->file('imagen_portada');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->imagen_portada = $fileName;
        }

        if ($request->hasFile("foto1")) {
            $file = $request->file('foto1');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto1 = $fileName;
        }

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto2 = $fileName;
        }

        if ($request->hasFile("foto3")) {
            $file = $request->file('foto3');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto3 = $fileName;
        }

        if ($request->hasFile("foto4")) {
            $file = $request->file('foto4');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto4 = $fileName;
        }

        if ($request->hasFile("foto5")) {
            $file = $request->file('foto5');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto5 = $fileName;
        }

        if ($request->hasFile("foto6")) {
            $file = $request->file('foto6');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto6 = $fileName;
        }

        if ($request->hasFile("foto7")) {
            $file = $request->file('foto7');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto7 = $fileName;
        }

        if ($request->hasFile("foto8")) {
            $file = $request->file('foto8');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto8 = $fileName;
        }

        if ($request->hasFile("foto9")) {
            $file = $request->file('foto9');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto9 = $fileName;
        }

        if ($request->hasFile("foto10")) {
            $file = $request->file('foto10');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto10 = $fileName;
        }

        $curso->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/manual');
        }else{
            $ruta_manual = public_path() . '/manual';
        }

        $curso = Manual::find($id);
        $curso->modulo = $request->get('modulo');
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');

        $curso->step1_name = $request->get('step1_name');
        $curso->step2_name = $request->get('step2_name');
        $curso->step3_name = $request->get('step3_name');
        $curso->step4_name = $request->get('step4_name');
        $curso->step5_name = $request->get('step5_name');
        $curso->step6_name = $request->get('step6_name');
        $curso->step7_name = $request->get('step7_name');
        $curso->step8_name = $request->get('step8_name');
        $curso->step9_name = $request->get('step9_name');
        $curso->step10_name = $request->get('step10_name');

        if ($request->hasFile("video")) {
            $file = $request->file('video');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->video = $fileName;
        }

        if ($request->hasFile("imagen_portada")) {
            $file = $request->file('imagen_portada');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->imagen_portada = $fileName;
        }

        if ($request->hasFile("foto1")) {
            $file = $request->file('foto1');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto1 = $fileName;
        }

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto2 = $fileName;
        }

        if ($request->hasFile("foto3")) {
            $file = $request->file('foto3');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto3 = $fileName;
        }

        if ($request->hasFile("foto4")) {
            $file = $request->file('foto4');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto4 = $fileName;
        }

        if ($request->hasFile("foto5")) {
            $file = $request->file('foto5');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto5 = $fileName;
        }

        if ($request->hasFile("foto6")) {
            $file = $request->file('foto6');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto6 = $fileName;
        }

        if ($request->hasFile("foto7")) {
            $file = $request->file('foto7');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto7 = $fileName;
        }

        if ($request->hasFile("foto8")) {
            $file = $request->file('foto8');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto8 = $fileName;
        }

        if ($request->hasFile("foto9")) {
            $file = $request->file('foto9');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto9 = $fileName;
        }

        if ($request->hasFile("foto10")) {
            $file = $request->file('foto10');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto10 = $fileName;
        }

        $curso->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back();

    }

}
