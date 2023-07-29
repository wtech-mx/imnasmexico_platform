<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\Orders;
use App\Models\OrdersTickets;
use Session;
use Hash;
use Str;
use Auth;
use Carbon\Carbon;

class ProfesoresController extends Controller
{
    public function index_profesores(Request $request){
        $users =  User::where('cliente','2')->orderBy('id','DESC')->get();
        return view('admin.profesores.index', compact('users'));
    }

    public function index_profesor_single($id){
        $id_profesor = auth::user()->id;

        $curso = Cursos::find($id);
        $ordenes = OrdersTickets::where('id_curso', '=', $id)->get();
        $tickets = CursosTickets::where('id_curso', '=', $id)->get();
        $ticketCount = CursosTickets::where('id_curso', '=', $id)->count();
        return view('profesor.single_clase', compact('curso', 'ordenes', 'tickets','ticketCount'));
    }



    public function index_clase(Request $request)
    {
        $id_profesor = auth::user()->id;

        $cursos = Cursos::withCount(['ordersTickets as alumnos_pagados' => function ($query) {
            $query->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                ->where('orders.estatus', 1)
                ->where('cursos.id_profesor', '=', auth::user()->id);
        }])
        ->whereDate('fecha_inicial', '>=', Carbon::yesterday()) // Filtrar por fecha mayor o igual a ayer
        ->orderBy('fecha_inicial', 'ASC') // Ordenar por fecha_curso de forma descendente
        ->get();

        return view('profesor.clases', compact('cursos'));
    }

    public function dashboard(Request $request){
        $id_profesor = auth::user()->id;

        $cursos = Cursos::where('estatus','=', '1')->where('id_profesor', '=', $id_profesor)->count();

        return view('profesor.dashboard', compact('cursos'));
    }

    public function ChangeAsistenciaStatus(Request $request)
    {
        $asistencia = Orders::find($request->id);
        $asistencia->asistencia = $request->asistencia;
        $asistencia->save();

        return response()->json(['success' => 'Asistencia registrada.']);
    }

    public function store_profesores(Request $request){
        $code = Str::random(8);
        $profesor = new User;
        $profesor->name = $request->get('name');
        $profesor->email = $request->get('email');
        $profesor->username = $request->get('telefono');
        $profesor->code = $code;
        $profesor->telefono = $request->get('telefono');
        $profesor->cliente = '2';
        $profesor->password = Hash::make($request->get('telefono'));
        $profesor->save();

        return back()->with('success', 'Profesor agregado');
    }

    public function update_profesores(Request $request, $id){
        $profesor = User::find($id);
        $profesor->name = $request->get('name');
        $profesor->email = $request->get('email');
        $profesor->username = $request->get('telefono');
        $profesor->telefono = $request->get('telefono');
        $profesor->password = Hash::make($request->get('telefono'));
        $profesor->update();

        return back()->with('success', 'Profesor agregado');
    }
}
