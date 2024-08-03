<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\OrdersTickets;
use Session;
use Str;
use App\Models\WebPage;
use App\Models\Noticias;
use App\Models\Paquetes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CursoUsersController extends Controller
{
    public function index_user()
    {
        $DateAndTime = date('h:i', time());
        $fechaActual = date('Y-m-d');
        $cursos = Cursos::where('estatus','=', '1')->orderBy('fecha_inicial','asc')->get();
        $cursos_slide = Cursos::where('estatus','=', '1')->orderBy('fecha_inicial','asc')->get();

        $tickets = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();


        $titulo = 'Calendario General Online y Presencial';

        return view('user.calendar', compact('cursos', 'tickets', 'cursos_slide', 'fechaActual', 'titulo'));
    }

    public function show($slug)
    {
        $fechaActual = date('Y-m-d');

        $noticias_gallery = Noticias::orderBy('id','DESC')->where('seccion','=','Galeria Cursos')->get();

        $curso = Cursos::where('slug','=', $slug)->firstOrFail();
        $cursos = Cursos::where('fecha_final','>=', $fechaActual)->where('estatus','=', '1')->get();
        $tickets = CursosTickets::where('id_curso','=', $curso->id)->where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();

        $usuarioId = Auth::id(); // Obtén el ID del usuario logueado
        // Verifica si el usuario ha comprado un ticket para el curso
        $usuario_compro = OrdersTickets::where('id_usuario', $usuarioId)
                        ->where('id_curso','=', $curso->id)
                        ->first();

        return view('user.single_coursenew', compact('curso', 'tickets', 'usuario_compro','cursos','noticias_gallery'));
    }

    public function paquetes()
    {
        $fechaActual = date('Y-m-d');
        $curso = Cursos::where('precio','<=', 690)->where('modalidad','=', 'Online')->get();
        $webpage = WebPage::first();
        $paquete = Paquetes::first();
        $tickets = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
        ->where('cursos_tickets.precio','<=', 690)
        ->where('cursos_tickets.precio','>', 0)
        ->where('cursos_tickets.fecha_inicial','<=', $fechaActual)
        ->where('cursos_tickets.fecha_final','>=', $fechaActual)
        ->where('cursos.modalidad','=', 'Online')
        ->select('cursos_tickets.*')
        ->orderBy('cursos.fecha_inicial','ASC')
        ->get();
        // dd(session()->all());
        return view('user.paquetes', compact('curso', 'tickets','webpage', 'paquete'));
    }

    public function advance(Request $request) {


        $fechaActual = date('Y-m-d');
        $tickets = CursosTickets::get();
        $cursos_slide = Cursos::where('estatus', '1')->orderBy('fecha_inicial','asc')->get();
        // Consulta los cursos activos
        $cursos = Cursos::where('estatus', '1')->orderBy('fecha_inicial','asc');

        // Obtén los valores de búsqueda del formulario
        $nombre = $request->input('nombre');
        $modalidad = $request->input('modalidad');

        // Determina el título para la vista
        $titulo = '';
        if ($modalidad == 'Online') {
            $titulo = 'Calendario General Online';
        } elseif ($modalidad == 'Presencial') {
            $titulo = 'Calendario General Presencial';
        } else {
            $titulo = 'Calendario General Online y Presencial';
        }

        // Aplica los filtros de búsqueda si se proporcionaron
        if ($nombre) {
            // $cursos->where('nombre', 'LIKE', "%$nombre%");
            // $cursos->where('nombre', 'REGEXP', implode('|', explode(' ', $nombre)));
            $palabras = explode(" ", $nombre);
            foreach($palabras as $palabra) {
                if ($palabra != 'curso') {
                    $cursos->where('nombre', 'LIKE', "%$palabra%");
                }
            }
        }
        if ($modalidad) {
            $cursos->where('modalidad', $modalidad);
        }

        // Obtén los resultados de la búsqueda
        $cursos = $cursos->get();

        if ($request->ajax()) {
            // Devuelve una vista parcial para la solicitud AJAX
            return view('user.calendar_search', compact('cursos', 'tickets', 'cursos_slide', 'fechaActual', 'titulo'))->render();
        }

        // return view('user.calendar', compact('cursos', 'tickets', 'cursos_slide', 'fechaActual', 'titulo'));
    }

    public function enviarFormulario(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'mensaje' => 'nullable|string',
            'token' => 'required|string',
        ]);

        $recaptchaSecret = '6LflbR0qAAAAAF-I8wYNasutQ9NS-nL6alWy5jCa';
        $token = $request->input('token');

        $cu = curl_init();
        curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($cu, CURLOPT_POST, 1);
        curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $recaptchaSecret, 'response' => $token)));
        curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cu);
        curl_close($cu);

        $responseData = json_decode($response, true);
        if ($responseData['success'] && $responseData['score'] >= 0.5) {
            // Obtener los datos del formulario
            $nombre = $request->input('nombre');
            $mensaje = $request->input('mensaje');
            $curso = $request->input('curso');
            $fecha = $request->input('fecha');
            $modalidad = $request->input('modalidad');

            // Crear el enlace de WhatsApp con los datos del formulario
            $url = 'https://api.whatsapp.com/send?phone=+525531167046&text=Hola%20buen%20d%C3%ADa%2C%20me%20interesa%20el%20curso%20de%20'.$curso.'%20'.$modalidad.'%20para%20la%20fecha%20del%20'.$fecha.'.%0A%0AMis%20datos:%0A'.$nombre.'%0A%0ATengo%20dudas%20y%2Fo%20preguntas%3A%0A'.$mensaje;

            // Redireccionar al enlace de WhatsApp
            return redirect($url);
        } else {
            return back()->withErrors(['captcha' => 'ERES UN ROBOT']);
        }
    }



}
