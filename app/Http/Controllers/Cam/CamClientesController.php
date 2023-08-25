<?php

namespace App\Http\Controllers\Cam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cam\CamCedulas;
use App\Models\Cam\CamCertificados;
use App\Models\Cam\CamCitas;
use App\Models\Cam\CamDocuemntos;
use App\Models\Cam\CamNombramiento;
use App\Models\Cam\CamNotas;
use App\Models\Cam\CamVideosUser;
use Illuminate\Support\Facades\Auth;

class CamClientesController extends Controller
{
    public function index($code){

        return view('cam.usuario.evaluador');
    }

    public function videos($code){
        $video = CamVideosUser::where('id_cliente', '=', auth()->user()->id)->first();

        return view('cam.videos.evaluador', compact('video'));
    }

    public function update_videos(Request $request, $id)
    {

        $video = CamVideosUser::find($id);
        if($request->get('check1') != NULL){
            $video->check1 = $request->get('check1');
        }
        if($request->get('check2') != NULL){
            $video->check2 = $request->get('check2');
        }
        if($request->get('check3') != NULL){
            $video->check3 = $request->get('check3');
        }
        if($request->get('check4') != NULL){
            $video->check4 = $request->get('check4');
        }
        $video->check5 = $request->get('check5');
        $video->update();

        return redirect()->back()->with('success', 'Video Finalizado');
    }

    public function index_expediente($code){
        $expediente = CamNotas::where('id_cliente', auth()->user()->id)->first();

        return view('cam.usuario.expediente', compact('expediente'));
    }

    public function crear_certificado(Request $request){
        $dominio = $request->getHost();

            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam_doc_general');
            }else{
                $ruta_recursos = public_path() . '/cam_doc_general';
            }

            $id_nota = $request->get('id_nota');
            $id_cliente = $request->get('id_cliente');
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                foreach ($foto as $archivo) {
                    $path = $ruta_recursos;
                    $fileName = uniqid() . $archivo->getClientOriginalName();
                    $archivo->move($path, $fileName);
                    $nomb = new CamCertificados();
                    $nomb->nombre = $fileName;
                    $nomb->id_nota = $id_nota;
                    $nomb->id_cliente = $id_cliente;
                    $nomb->save();
                }
            }
        $nomb->save();

        return redirect()->back()->with('success', 'Archivo subido exitosamente');
    }

    public function crear_cedulas(Request $request){
        $dominio = $request->getHost();

            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_recursos = base_path('../public_html/plataforma.imnasmexico.com/cam_doc_general');
            }else{
                $ruta_recursos = public_path() . '/cam_doc_general';
            }

            $id_nota = $request->get('id_nota');
            $id_cliente = $request->get('id_cliente');
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                foreach ($foto as $archivo) {
                    $path = $ruta_recursos;
                    $fileName = uniqid() . $archivo->getClientOriginalName();
                    $archivo->move($path, $fileName);
                    $nomb = new CamCedulas();
                    $nomb->nombre = $fileName;
                    $nomb->id_nota = $id_nota;
                    $nomb->id_cliente = $id_cliente;
                    $nomb->save();
                }
            }
        $nomb->save();

        return redirect()->back()->with('success', 'Archivo subido exitosamente');
    }

    public function obtenerArchivosPorCategoria(Request $request){
        $categoria = $request->input('categoria');
        $expedienteId = intval($request->input('expediente_id'));
        if($categoria == 'certificado'){
            $archivos = CamCertificados::where('id_cliente', auth()->user()->id)->get();
        }elseif($categoria == 'cedula'){
            $archivos = CamCedulas::where('id_cliente', auth()->user()->id)->get();
        }elseif($categoria == 'nombramiento'){
            $archivos = CamNombramiento::where('id_cliente', auth()->user()->id)->get();
        }else{
            $archivos = CamDocuemntos::where('id_carpdoc', $categoria)->get();
        }

        return response()->json($archivos);
    }
}
