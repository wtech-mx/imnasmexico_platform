<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CamNotasController extends Controller
{
    public function index(){

        return view('admin.notas_cam.cam_users.index');
    }

    public function carta_compromiso(){

        return view('admin.notas_cam.cam_users.carta_compromiso');
    }

    public function contrato(){

        return view('admin.notas_cam.cam_users.contrato');
    }

    public function formato(){

        return view('admin.notas_cam.cam_users.formato');
    }

    public function programa(){

        return view('admin.notas_cam.cam_users.programa');
    }
}
