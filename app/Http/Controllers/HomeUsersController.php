<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;

class HomeUsersController extends Controller
{
    public function index(){
        $DateAndTime = date('h:i', time());
        $fechaActual = date('Y-m-d');
        $cursos = Cursos::
        where('fecha_final', '>=', $fechaActual)
        ->where('hora_final', '>=', $DateAndTime)
        ->orderBy('fecha_inicial','ASC')
        ->get();

        return view('user.home', compact('cursos'));
    }
}
