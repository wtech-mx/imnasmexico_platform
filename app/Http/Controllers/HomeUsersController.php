<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;

class HomeUsersController extends Controller
{
    public function index(){
        $fechaActual = date('Y-m-d');
        $cursos = Cursos::
        where('fecha_inicial', '>=', $fechaActual)
        ->orderBy('fecha_inicial','ASC')
        ->get();

        return view('user.home', compact('cursos'));
    }
}
