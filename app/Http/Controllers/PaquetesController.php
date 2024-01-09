<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Paquetes;
use App\Models\PaquetesIncluye;
use Illuminate\Http\Request;

class PaquetesController extends Controller
{
    public function index(){
        $paquete = Paquetes::first();
        $cursos = Cursos::where('precio', '>', 0)->orderBy('nombre','ASC')->pluck('nombre')->unique();
        $paquete_incluye = PaquetesIncluye::get();
        $cursosArray = $cursos->toArray();

        return view('admin.paquetes.index', compact('paquete', 'cursosArray', 'paquete_incluye'));
    }
    public function update(Request $request, $id){

        $paquete = Paquetes::find($id);
        $paquete->visible_1 = $request->get('visible_1');
        $paquete->precio_1 = $request->get('precio_1');
        $paquete->precio_rebajado_1 = $request->get('precio_rebajado_1');
            $precio1_curso = $paquete->precio_rebajado_1 / 4;
        $paquete->precio_curso_1 = $precio1_curso;

        $paquete->visible_2 = $request->get('visible_2');
        $paquete->precio_2 = $request->get('precio_2');
        $paquete->precio_rebajado_2 = $request->get('precio_rebajado_2');
            $precio2_curso = $paquete->precio_rebajado_2 / 4;
        $paquete->precio_curso_2 = $precio2_curso;

        $paquete->visible_3 = $request->get('visible_3');
        $paquete->precio_3 = $request->get('precio_3');
        $paquete->precio_rebajado_3 = $request->get('precio_rebajado_3');
            $precio3_curso = $paquete->precio_rebajado_3 / 4;
        $paquete->precio_curso_3 = $precio3_curso;

        $paquete->visible_4 = $request->get('visible_4');
        $paquete->precio_4 = $request->get('precio_4');
        $paquete->precio_rebajado_4 = $request->get('precio_rebajado_4');
            $precio4_curso = $paquete->precio_rebajado_4 / 4;
        $paquete->precio_curso_4 = $precio4_curso;

        $paquete->visible_5 = $request->get('visible_5');
        $paquete->precio_5 = $request->get('precio_5');
        $paquete->precio_rebajado_5 = $request->get('precio_rebajado_5');
            $precio5_curso = $paquete->precio_rebajado_5 / 4;
        $paquete->precio_curso_5 = $precio5_curso;
        $paquete->update();

        $paquete_incluye1 = $request->input('cursos1');

        if($paquete_incluye1 != NULL){
            for ($count = 0; $count < count($paquete_incluye1); $count++) {
                $data1 = array(
                    'nombre_curso' => $paquete_incluye1[$count],
                    'num_paquete' => 1,
                );
                $insert_data1[] = $data1;
            }
            PaquetesIncluye::insert($insert_data1);
        }

        $paquete_incluye2 = $request->input('cursos2');

        if($paquete_incluye2 != NULL){
            for ($count = 0; $count < count($paquete_incluye2); $count++) {
                $data2 = array(
                    'nombre_curso' => $paquete_incluye2[$count],
                    'num_paquete' => 2,
                );
                $insert_data2[] = $data2;
            }
            PaquetesIncluye::insert($insert_data2);
        }

        $paquete_incluye3 = $request->input('cursos3');

        if($paquete_incluye3 != NULL){
            for ($count = 0; $count < count($paquete_incluye3); $count++) {
                $data3 = array(
                    'nombre_curso' => $paquete_incluye3[$count],
                    'num_paquete' => 3,
                );
                $insert_data3[] = $data3;
            }
            PaquetesIncluye::insert($insert_data3);
        }

        $paquete_incluye4 = $request->input('cursos4');

        if($paquete_incluye4 != NULL){
            for ($count = 0; $count < count($paquete_incluye4); $count++) {
                $data4 = array(
                    'nombre_curso' => $paquete_incluye4[$count],
                    'num_paquete' => 4,
                );
                $insert_data4[] = $data4;
            }
            PaquetesIncluye::insert($insert_data4);
        }

        $paquete_incluye5 = $request->input('cursos5');

        if($paquete_incluye5 != NULL){
            for ($count = 0; $count < count($paquete_incluye5); $count++) {
                $data5 = array(
                    'nombre_curso' => $paquete_incluye5[$count],
                    'num_paquete' => 5,
                );
                $insert_data5[] = $data5;
            }
            PaquetesIncluye::insert($insert_data5);
        }

        return redirect()->back()->with('success', 'Paquete(s) editado con exito');
    }
}
