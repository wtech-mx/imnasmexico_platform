<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\NotasCursos;
use App\Models\NotasInscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use App\Mail\PlantillaPedidoRecibido;
use App\Mail\PlantillaTicketPresencial;
use App\Mail\PlantillaTicket;
use Illuminate\Support\Str;
use Session;
use Hash;

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
        $cursos = Cursos::where('estatus','=', '1')->orderBy('fecha_inicial','asc')->get();

        return view('admin.notas_cursos.index', compact('notas', 'cursos'));
    }

    public function store(request $request){

        // Creacion de user
        $code = Str::random(8);

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }
            $payer = $user;
        } else {
            $payer = new User;
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
            Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        $nuevosCampos = $request->input('campo');
        $notas_cursos = new NotasCursos;
        $notas_cursos->fecha = $request->get('fecha');
        $notas_cursos->id_usuario = $payer->id;
        $notas_cursos->save();

        if ($nuevosCampos) {
            foreach ($nuevosCampos as $campo) {
                // Realizar las operaciones necesarias con cada campo adicional
                // por ejemplo, guardar en la base de datos
                $notas_inscripcion = new NotasInscripcion;
                $notas_inscripcion->id_nota = $notas_cursos->id;
                $notas_inscripcion->id_curso = $campo;
                $notas_inscripcion->save();
            }
        }



        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

}
