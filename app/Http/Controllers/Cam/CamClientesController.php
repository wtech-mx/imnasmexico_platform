<?php

namespace App\Http\Controllers\Cam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
