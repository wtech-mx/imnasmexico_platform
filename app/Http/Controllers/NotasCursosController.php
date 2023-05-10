<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\NotasCursos;
use Illuminate\Http\Request;

class NotasCursosController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = NotasCursos::orderBy('id','DESC')->get();
        $curso = Cursos::where('estatus','=', '1')->orderBy('fecha_inicial','asc')->get();

        return view('admin.notas_cursos.index', compact('notas', 'curso'));
    }

}
