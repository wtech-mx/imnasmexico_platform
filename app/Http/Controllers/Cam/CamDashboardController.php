<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamVideos;

use App\Models\User;
use Carbon\Carbon;

use Session;
use Hash;
use DB;

use Illuminate\Http\Request;


class CamDashboardController extends Controller
{
    public function index($code){

        // Verificar si el usuario tiene una sesión activa
        if (!auth()->check()) {
            return redirect()->route('cursos.index_user')->with('warning', 'Inicie sesión para ver su perfil');
        }

        $usuario = User::where('code', $code)->firstOrFail();

    return view('cam.usuario.dashboard',compact('usuario'));

    }
}
