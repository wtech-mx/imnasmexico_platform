<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\OrdersTickets;
use Session;
use Hash;
use Str;
use Auth;
class ProfesoresController extends Controller
{
    public function index_profesores(Request $request){
        $users =  User::where('cliente','2')->orderBy('id','DESC')->get();
        return view('admin.profesores.index', compact('users'));
    }

    public function index_profesor_single(Request $request){
        $id_profesor = auth::user()->id;

        $cursos = Cursos::where('id_profesor', '=', $id_profesor)->get();
        return view('profesor.single_clase', compact('cursos'));
    }

    public function index_clase($id){
        $id_profesor = auth::user()->id;

        $curso = Cursos::find($id);
        $ordenes = OrdersTickets::where('id_curso', '=', $id)->get();
        $tickets = CursosTickets::where('id_curso', '=', $id)->get();
        return view('profesor.clases', compact('curso', 'ordenes', 'tickets'));
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
