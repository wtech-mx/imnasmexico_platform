<?php

namespace App\Http\Controllers\Cam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cam\CamCarpetaDocumentos;
use App\Models\Cam\CamDocuemntos;

class CamDocuemntosController extends Controller
{
    public function index(){
        $carpeta_docs = CamCarpetaDocumentos::get();

        return view('cam.admin.document.index', compact('carpeta_docs'));
    }

    public function edit($id){
        $carpeta = CamCarpetaDocumentos::where('id', $id)->first();
        $documentos = CamDocuemntos::where('id_carpdoc', $id)->get();

        return view('cam.admin.document.edit', compact('carpeta', 'documentos'));
    }

    public function crear(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $cam_doc = base_path('../public_html/plataforma.imnasmexico.com/cam_doc');
        }else{
            $cam_doc = public_path() . '/cam_doc';
        }

        $carpeta = $request->get('id_carpdoc');
        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            foreach ($archivos as $archivo) {
                $path = $cam_doc;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $carpeta_recursos = new CamDocuemntos;
                $carpeta_recursos->nombre = $fileName;
                $carpeta_recursos->id_carpdoc = $carpeta;
                $carpeta_recursos->id_usuario = auth()->user()->id;
                $carpeta_recursos->save();
            }
        }

        return redirect()->back()->with('success', 'Archivos agregados.');
    }

    public function crear_carpeta(Request $request){

        $carpeta = new CamCarpetaDocumentos();
        $carpeta->nombre = $request->get('nombre');
        $carpeta->categoria = $request->get('nombre');
        $carpeta->id_usuario = auth()->user()->id;
        $carpeta->save();

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $cam_doc = base_path('../public_html/plataforma.imnasmexico.com/cam_doc_general');
        }else{
            $cam_doc = public_path() . '/cam_doc_general';
        }

        $id_carpeta = $carpeta->id;
        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            foreach ($archivos as $archivo) {
                $path = $cam_doc;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $carpeta_recursos = new CamDocuemntos;
                $carpeta_recursos->nombre = $fileName;
                $carpeta_recursos->id_carpdoc = $id_carpeta;
                $carpeta_recursos->id_usuario = auth()->user()->id;
                $carpeta_recursos->save();
            }
        }

        return redirect()->back()->with('success', 'Archivos agregados.');
    }
}
