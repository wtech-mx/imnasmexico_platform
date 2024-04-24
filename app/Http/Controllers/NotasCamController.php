<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cam\CamEstandares;
use App\Models\NotasEstatus;


class NotasCamController extends Controller
{
    public function index(){

        $estandares_cam = CamEstandares::get();

        return view('admin.notas_cam.index', compact('estandares_cam'));
    }

    public function store(Request $request){
dd( $request);
        $validator = Validator::make($request->all(), [
            'fecha' => 'required',
            'tipo' => 'required',
            'celular' => 'required|numeric|digits:10', // Añadido numeric y digits
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $name = $request->get('name');
        $apellido = $request->get('apellido');
        $nombnre = $name.$apellido;

        $notas = new NotasEstatus;
        $notas->fecha = $request->get('fecha');
        $notas->time = $request->get('time');
        $notas->num_portafolio = $request->get('num_portafolio');
        $notas->tipo = $request->get('tipo');
        $notas->tipo_modalidad = $request->get('tipo_modalidad');
        $notas->tipo_alumno = $request->get('tipo_alumno');
        $notas->nombre_centro = $request->get('nombre_centro');
        $notas->nombre_persona = $nombnre
        $notas->celular = $request->get('celular');
        $notas->email = $request->get('email');

        $notas->save();

        return redirect()->route('notascam.index')->with('success', 'Nota creada con exito.');
    }

}
