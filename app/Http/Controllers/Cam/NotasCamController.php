<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotasCamController extends Controller
{
    public function index(){

        return view('cam.notas.index');
    }

    public function crear(Request $request){

        return view('cam.notas.crear');
    }

    public function store(Request $request){

        return view('cam.notas.crear');
    }
}