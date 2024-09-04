<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CamNotasController extends Controller
{
    public function index(){

        return view('admin.notas_cam.cam_users.index');
    }
}
