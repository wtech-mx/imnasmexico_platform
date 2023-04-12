<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\OrdersTickets;
use Session;
use Str;
use Illuminate\Support\Facades\Auth;
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
        $cursos = Cursos::where('fecha_final','>=', $fechaActual)->where('estatus','=', '1')->get();
        $tickets = CursosTickets::where('id_curso','=', $curso->id)->where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();

        $usuarioId = Auth::id(); // Obtén el ID del usuario logueado
        // Verifica si el usuario ha comprado un ticket para el curso
        $usuario_compro = OrdersTickets::where('id_usuario', $usuarioId)
                        ->where('id_curso','=', $curso->id)
                        ->first();

        return view('user.single_course', compact('curso', 'tickets', 'usuario_compro','cursos'));
    }

    public function paquetes()
    {
        $fechaActual = date('Y-m-d');
        $curso = Cursos::where('precio','<=', 600)->where('modalidad','=', 'Online')->get();

        $tickets = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
        ->where('cursos_tickets.precio','<=', 600)
        ->where('cursos_tickets.fecha_inicial','<=', $fechaActual)
        ->where('cursos_tickets.fecha_final','>=', $fechaActual)
        ->where('cursos.modalidad','=', 'Online')
        ->select('cursos_tickets.*')
        ->get();
        // dd(session()->all());
        return view('user.paquetes', compact('curso', 'tickets'));
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

    public function enviarFormulario(Request $request){
        // Obtener los datos del formulario
        $nombre = $request->input('nombre');
        $correo = $request->input('correo');
        $mensaje = $request->input('mensaje');
        $curso = $request->input('curso');
        $fecha = $request->input('fecha');
        $modalidad = $request->input('modalidad');

        // Crear el enlace de WhatsApp con los datos del formulario 5531167046
        $url = 'https://api.whatsapp.com/send?phone=+525529291962&text=Hola%20buen%20d%C3%ADa%2C%20me%20interesa%20el%20curso%20de%20'.$curso.'%20'.$modalidad.'%20para%20la%20fecha%20del%20'.$fecha.'.%0A%0AMis%20datos:%0A'.$nombre.'%0A'.$correo.'%0A%0ATengo%20dudas%20y%2Fo%20preguntas%3A%0A'.$mensaje;

        // Redireccionar al enlace de WhatsApp
        return redirect($url);
    }
}
