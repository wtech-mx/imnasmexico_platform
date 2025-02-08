<?php

namespace App\Http\Controllers;

use App\Models\Cosmikausers;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilClienteController extends Controller
{
    public function index(){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        return view('admin.clientes.perfil.index',compact('clientes'));
    }

    public function buscador(Request $request){
        $id_client = $request->id_client;
        $phone = $request->phone;

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        if ($id_client !== null) {
            $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id_client)->first();
        } elseif ($phone !== null) {
            $cliente = User::where('cliente','=' ,'1')->where('id', '=', $phone)->first();
        }

        $distribuidora = Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id','DESC')->first();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora'));
    }

    public function cursos(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora'));
    }
}
