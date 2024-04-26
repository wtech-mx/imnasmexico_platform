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

        $nombres_personas = NotasEstatus::select('nombre_persona')
            ->distinct()
            ->pluck('nombre_persona');

        $celular_personas = NotasEstatus::select('celular')
        ->distinct()
        ->pluck('celular');

        return view('admin.notas_cam.index', compact('estandares_cam', 'nombres_personas', 'celular_personas'));
    }

    public function buscador(Request $request){
        $id_client = $request->nombre_persona;
        $phone = $request->celular_persona;
        $id_estandar = $request->estandar;

        $notas = NotasEstatus::query();
        if ($id_client !== 'null' && $id_client !== null) {
            $notas->where('nombre_persona', '=', $id_client);
        } elseif ($phone !== 'null' && $phone !== null) {
            $notas->where('celular', '=', $phone);
        }
        if ($id_estandar !== 'null' && $id_estandar !== null) {
            $notas->join('notasestandares_estatus', 'notasestatus.id', '=', 'notasestandares_estatus.id_nota')
                 ->where('notasestandares_estatus.id_estandar', '=', $id_estandar)
                 ->select('notasestatus.*');
        }

        $notas = $notas->get();

        $estandares_cam = CamEstandares::get();

        $nombres_personas = NotasEstatus::select('nombre_persona')
            ->distinct()
            ->pluck('nombre_persona');

        $celular_personas = NotasEstatus::select('celular')
        ->distinct()
        ->pluck('celular');

        return view('admin.notas_cam.index',compact('notas', 'estandares_cam', 'nombres_personas', 'celular_personas', 'id_estandar'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'fecha' => 'required',
            'celular' => 'required|numeric|digits:10', // Añadido numeric y digits
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $name = $request->get('name');
        $apellido = $request->get('apellido');
        $nombnre = $name.' '.$apellido;

        $notas = new NotasEstatus;
        $notas->fecha = $request->get('fecha');
        $notas->time = $request->get('time');
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
            );
            $insert_data[] = $data;
        }

        NotasEstandaresEstatus::insert($insert_data);

        return redirect()->route('notascam.index')->with('success', 'Nota creada con exito.');
    }

    public function store_evaluador(Request $request,$id){

        $notas_estandares = NotasEstandaresEstatus::find($id);
        $notas_estandares->evaluador = $request->get('evaluador');

        $notas_estandares->update();


        return redirect()->back()->with('warning', 'Evaluador Actualziada con exito.');
    }

    public function store_estatus(Request $request,$id){
        $fechaActual = date('Y-m-d');

        $notas_estandares = NotasEstandaresEstatus::find($id);
        $notas_estandares->estatus = $request->get('estatus');
            if($request->get('estatus') == '1- Cedula'){
                $notas_estandares->fecha_cedula = $fechaActual;
            }else if($request->get('estatus') == '2- Subir Portafolio'){
                $notas_estandares->fecha_portafolio = $fechaActual;
            }else if($request->get('estatus') == '3- Crear Lote'){
                $notas_estandares->fecha_lote = $fechaActual;
            }else if($request->get('estatus') == '4- Dictamen'){
                $notas_estandares->fecha_dictamen = $fechaActual;
            }else if($request->get('estatus') == '5- Certificacion'){
                $notas_estandares->fecha_certificacion = $fechaActual;
            }
        $notas_estandares->update();

        return redirect()->back()->with('warning', 'Estado Actualziado con exito.');
    }


}
