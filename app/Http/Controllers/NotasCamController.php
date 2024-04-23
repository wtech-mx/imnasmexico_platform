<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cam\CamEstandares;


class NotasCamController extends Controller
{
    public function index(){

        $estandares_cam = CamEstandares::get();

        return view('admin.notas_cam.index', compact('estandares_cam'));
    }

    public function crear(Request $request){

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
        $celular = $request->get('celular');
        // Obtén las dos primeras letras del nombre
        $primerasDosLetrasNombre = substr($name, 0, 2);
        // Obtén las dos primeras letras del apellido
        $primerasDosLetrasApellido = substr($apellido, 0, 2);
        // Obtén los últimos tres dígitos del número de teléfono
        $ultimosTresDigitosCelular = substr($celular, -3);
        // Concatena las partes para formar la contraseña
        $password = $primerasDosLetrasNombre . $primerasDosLetrasApellido . $ultimosTresDigitosCelular;


        $notas_cam = new CamNotas;
        $notas_cam->id_cliente = $payer->id;
        $notas_cam->tipo = $request->get('tipo');
        $notas_cam->fecha = $request->get('fecha');
        $notas_cam->membresia = $request->get('membresia');
        $notas_cam->monto1 = $request->get('monto1');
        $notas_cam->metodo_pago = $request->get('metodo_pago');
        $notas_cam->nota = $request->get('nota');
        $notas_cam->referencia = $request->get('referencia');
        $notas_cam->id_usuario = auth()->user()->id;
        if ($request->hasFile("comprobante")) {
            $file = $request->file('comprobante');
            $path = $cam_notas;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_cam->comprobante = $fileName;
        }

        $notas_cam->save();

        $estandares = $request->input('estandares');

        for ($count = 0; $count < count($estandares); $count++) {
            $data = array(
                'id_nota' => $notas_cam->id,
                'id_estandar' => $estandares[$count],
                'estatus' => 'Sin estatus',
                'estatus_renovacion' => 'renovo',
                'id_usuario' => auth()->user()->id,
            );
            $insert_data[] = $data;
        }

        CamNotEstandares::insert($insert_data);

        $estandares_operables = $request->input('estandares_operables');

        foreach ($estandares_operables as $estandar_operable) {
            CamNotEstandares::where([
                'id_nota' => $notas_cam->id,
                'id_estandar' => $estandar_operable,
            ])->update(['operables' => '1']);
        }

        $estandares_afines = $request->input('estandares_afines');

        if($estandares_afines != NULL){
            for ($count = 0; $count < count($estandares_afines); $count++) {
                $data3 = array(
                    'id_nota' => $notas_cam->id,
                    'id_estandar' => $estandares_afines[$count],
                    'estatus' => 'Entregado',
                    'estatus_renovacion' => 'renovo',
                    'ya_contaba' => '1',
                    'id_usuario' => auth()->user()->id,
                );
                $insert_data3[] = $data3;
            }
            CamNotEstandares::insert($insert_data3);
        }

        return redirect()->route('index.notas')
            ->with('success', 'Nota CAM creada con exito.');
    }

}
