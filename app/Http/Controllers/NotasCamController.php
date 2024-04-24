<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cam\CamEstandares;
use App\Models\NotasEstandaresEstatus;

use App\Models\NotasEstatus;
use Illuminate\Support\Facades\Validator;

class NotasCamController extends Controller
{
    public function index(){

        $estandares_cam = CamEstandares::get();
        $notas = NotasEstatus::get();

        return view('admin.notas_cam.index', compact('estandares_cam','notas'));
    }

    public function store(Request $request){

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
        $notas->nombre_persona = $nombnre;
        $notas->celular = $request->get('celular');
        $notas->email = $request->get('email');

        $notas->save();

        $estandares = $request->input('estandares');

        for ($count = 0; $count < count($estandares); $count++) {
            $data = array(
                'id_nota' => $notas->id,
                'id_estandar' => $estandares[$count],
                'estatus' => 'Sin estatus',
                'estatus_renovacion' => 'renovo',
                'id_usuario' => auth()->user()->id,
            );
            $insert_data[] = $data;
        }


        $camnotas = NotasEstandaresEstatus::insert($insert_data);

        NotasEstandaresEstatus::insert($insert_data);

        $estandares_operables = $request->input('estandares_operables');

        foreach ($estandares_operables as $estandar_operable) {
            NotasEstandaresEstatus::where([
                'id_nota' => $notas->id,
                'id_estandar' => $estandar_operable,
            ])->update(['operables' => '1']);
        }

        return redirect()->route('notascam.index')->with('success', 'Nota creada con exito.');
    }

    public function store_evaluador(Request $request,$id){

        $notas_estandares = NotasEstandaresEstatus::find($id);
        $notas_estandares->evaluador = $request->get('evaluador');

        $notas_estandares->update();


        return redirect()->route('notascam.index')->with('warning', 'Evaluador Actualziada con exito.');
    }

    public function store_estatus(Request $request,$id){

        $notas_estandares = NotasEstandaresEstatus::find($id);
        $notas_estandares->estatus = $request->get('estatus');

        $notas_estandares->update();

        return redirect()->route('notascam.index')->with('warning', 'Estado Actualziado con exito.');
    }


}
