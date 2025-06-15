<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        return view('user.test.index');
    }

        public function index_especializado(){
        return view('user.test.test_especializado');
    }
}
