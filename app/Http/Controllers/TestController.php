<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        return view('user.test.index');
    }

    public function index_medio(){

        return view('user.test.test_medio');
    }

    public function index_avanzado(){
        return view('user.test.test_avanzado');
    }

    public function index_especializado(){
        return view('user.test.espezializado.basico1');
    }

    public function index_especializadomedio(){
        return view('user.test.espezializado.medio1');
    }

    public function index_especializadoavanzado(){
        return view('user.test.espezializado.avanzado1');
    }
}
