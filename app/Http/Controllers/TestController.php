<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'nivel'     => 'required|string',
            'score'     => 'required|integer|min:0',
            'passed'    => 'required|boolean',
        ]);

        // si tienes auth:
        $data['user_id'] = Auth::check() ? Auth::id() : null;

        $result = TestResult::create($data);

        return response()->json([
            'ok'      => true,
            'message' => 'Resultado guardado',
            'data'    => $result
        ]);
    }
}
