<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\OrdersTickets;
use Session;
use Str;
use Illuminate\Http\Request;

class CursoUsersController extends Controller
{
    public function index_user()
    {
        $DateAndTime = date('h:i', time());
        $fechaActual = date('Y-m-d');
        $cursos = Cursos::where('fecha_final','>=', $fechaActual)->where('estatus','=', '1')->get();
        $cursos_slide = Cursos::where('fecha_final','>=', $fechaActual)->where('estatus','=', '1')->get();

        $tickets = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();

        return view('user.calendar', compact('cursos', 'tickets', 'cursos_slide', 'fechaActual'));
    }

    public function show($slug)
    {
        $fechaActual = date('Y-m-d');
        $curso = Cursos::where('slug','=', $slug)->firstOrFail();
        $tickets = CursosTickets::where('id_curso','=', $curso->id)->where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();

        // $user_tickets = OrdersTickets::where('id_user','<=', auth()->user()->id)->first();

        return view('user.single_course', compact('curso', 'tickets'));
    }

    public function advance(Request $request, Cursos $cursos) {
        $fechaActual = date('Y-m-d');
        $tickets = CursosTickets::where('fecha_final','>=', $fechaActual)->get();
        $cursos_slide = Cursos::where('fecha_final','>=', $fechaActual)->where('estatus','=', '1')->get();

        if( $request->modalidad){
            $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('modalidad', 'LIKE', "%" . $request->modalidad . "%");
        }

        if( $request->nombre){
            $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('nombre', 'LIKE', "%" . $request->nombre . "%");
        }

        if( $request->categoria){
            $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('categoria', 'LIKE', "%" . $request->categoria . "%");
        }

        if($request->tipo){
            if($request->tipo == 'sep'){
                $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('sep', '=', '1');
            }elseif($request->tipo == 'unam'){
                $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('unam', '=', '1');
            }elseif($request->tipo == 'stps'){
                $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('stps', '=', '1');
            }elseif($request->tipo == 'redconocer'){
                $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('redconocer', '=', '1');
            }elseif($request->tipo == 'imnas'){
                $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('imnas', '=', '1');
            }
        }

        if( $request->fecha_inicial){
            $cursos = $cursos->where('estatus','=', '1')->where('fecha_final','>=', $fechaActual)->where('fecha_inicial', '=', $request->fecha_inicial);
        }

        $cursos = $cursos->paginate(10);

        return view('user.calendar', compact('cursos', 'tickets', 'cursos_slide', 'fechaActual'));
    }
}