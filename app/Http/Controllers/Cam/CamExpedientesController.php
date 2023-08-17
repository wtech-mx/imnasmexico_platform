<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamCitas;
use App\Models\Cam\CamNotEstandares;
use Illuminate\Http\Request;

class CamExpedientesController extends Controller
{

    public function index_ind(){

        $expedientes = CamCitas::get();
        return view('cam.admin.expedientes.index', compact('expedientes'));
    }

    public function edit($id_nota){
        $expediente = CamCitas::where('id_nota', $id_nota)->firstOrFail();
        $estandares_usuario = CamNotEstandares::where('id_nota', $id_nota)->get();

        return view('cam.admin.expedientes.exp_ind', compact('expediente', 'estandares_usuario'));
    }

}
