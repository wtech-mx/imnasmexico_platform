<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamVideos;
use Session;

use Illuminate\Http\Request;

class CamVideosController extends Controller
{
    public function index(Request $request)
    {
        $videos = CamVideos::orderBy('orden','DESC')->get();

        return view('cam.admin.videos.index', compact('videos'));
    }

    public function store(Request $request)
    {

        $camvideo = new CamVideos;

        $camvideo->nombre = $request->get('nombre');
        $camvideo->video_url = $request->get('link');
        $camvideo->orden = $request->get('orden');
        $camvideo->tipo = $request->get('tipo');
        $camvideo->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');

        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function update(Request $request, $id)
    {

        $camvideo = CamVideos::find($id);

        $camvideo->nombre = $request->get('nombre');
        $camvideo->video_url = $request->get('link');
        $camvideo->orden = $request->get('orden');
        $camvideo->tipo = $request->get('tipo');

        $camvideo->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }
}
