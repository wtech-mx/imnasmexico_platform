<?php

namespace App\Http\Controllers;

use App\Models\RegistroLlegada;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegistroLlegadaController extends Controller
{
    public function index(){

        return view('admin.registro_llegada.index');
    }

    public function create(){

        return view('user.registro_llegada');
    }

    public function store(Request $request)
    {
        $curso = new RegistroLlegada;
        $curso->nombre = $request->get('nombre');
        $curso->telefono = $request->get('telefono');
        $curso->correo = $request->get('correo');
        $curso->ciudad = $request->get('ciudad');
        $curso->conociste = $request->get('flexRadio');
        $curso->espectativa = $request->get('espectativa');
        $curso->save();

        return redirect()->back()->with('success', 'Guardado con exito.');
    }

    public function buscador(Request $request){
        $fecha = $request->input('fecha');

        if ($fecha) {
            $fechaInicio = Carbon::parse($fecha)->startOfDay();
            $fechaFin = Carbon::parse($fecha)->endOfDay();

            $compras = RegistroLlegada::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();
        } else {
            $compras = RegistroLlegada::all();
        }

        return view('admin.registro_llegada.index',compact('compras'));
    }
}
