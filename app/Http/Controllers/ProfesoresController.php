<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Hash;
use Str;

class ProfesoresController extends Controller
{
    public function index_profesores(Request $request){
        $users =  User::where('cliente','2')->orderBy('id','DESC')->get();
        return view('admin.profesores.index', compact('users'));
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
