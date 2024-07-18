<?php

namespace App\Http\Controllers;

use App\Models\RegistroCompras;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegistroComprasController extends Controller
{
    public function index(){

        return view('admin.registro_compras.index');
    }

    public function create(){

        return view('user.registro_compras');
    }

    public function store(Request $request)
    {
        $curso = new RegistroCompras;
        $curso->nombre = $request->get('nombre');
        $curso->telefono = $request->get('telefono');
        $curso->correo = $request->get('correo');
        $curso->ciudad = $request->get('ciudad');
        $curso->monto = $request->get('monto');
        $curso->distribucion = $request->get('flexRadio');
        $curso->conociste = $request->get('flexRadioConociste');
        $curso->sugerencia = $request->get('sugerencia');
        $curso->save();

        return redirect()->back()->with('success', 'Guardado con exito.');
    }

    public function buscador(Request $request){
        $fecha = $request->input('fecha');

        if ($fecha) {
            $fechaInicio = Carbon::parse($fecha)->startOfDay();
            $fechaFin = Carbon::parse($fecha)->endOfDay();

            $compras = RegistroCompras::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();
        } else {
            $compras = RegistroCompras::all();
        }

        return view('admin.registro_compras.index',compact('compras'));
    }
}
