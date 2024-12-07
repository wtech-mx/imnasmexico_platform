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
        $cursos = Cursos::where('precio', '>', 0)->where('diplomado_colores', '=', null)->orderBy('nombre','ASC')->pluck('nombre')->unique();
        $cursosArray = $cursos->toArray();
        $paquete_incluye = PaquetesIncluye::get();

        return view('admin.paquetes.index', compact('paquete', 'cursosArray', 'paquete_incluye'));
    }

    public function update(Request $request, $id){
        $paquete_incluye1 = $request->input('cursos1');
        $paquete_incluye2 = $request->input('cursos2');
        $paquete_incluye3 = $request->input('cursos3');
        $paquete_incluye4 = $request->input('cursos4');
        $paquete_incluye5 = $request->input('cursos5');
        $paquete_incluye6 = $request->input('cursos6');

        $paquete = Paquetes::find($id);
        if($paquete_incluye1 != NULL){
            $paquete->visible_1 = $request->get('visible_1');
            $paquete->precio_1 = $request->get('precio_1');
            $paquete->precio_rebajado_1 = $request->get('precio_rebajado_1');
                $precio1_curso = $paquete->precio_rebajado_1 / count($paquete_incluye1);
            $paquete->precio_curso_1 = $precio1_curso;
        }

        if($paquete_incluye2 != NULL){
            $paquete->visible_2 = $request->get('visible_2');
            $paquete->precio_2 = $request->get('precio_2');
            $paquete->precio_rebajado_2 = $request->get('precio_rebajado_2');
                $precio2_curso = $paquete->precio_rebajado_2 / count($paquete_incluye2);
            $paquete->precio_curso_2 = $precio2_curso;
        }

        if($paquete_incluye3 != NULL){
            $paquete->visible_3 = $request->get('visible_3');
            $paquete->precio_3 = $request->get('precio_3');
            $paquete->precio_rebajado_3 = $request->get('precio_rebajado_3');
                $precio3_curso = $paquete->precio_rebajado_3 / count($paquete_incluye3);
            $paquete->precio_curso_3 = $precio3_curso;
        }

        if($paquete_incluye4 != NULL){
            $paquete->visible_4 = $request->get('visible_4');
            $paquete->precio_4 = $request->get('precio_4');
            $paquete->precio_rebajado_4 = $request->get('precio_rebajado_4');
                $precio4_curso = $paquete->precio_rebajado_4 / count($paquete_incluye4);
            $paquete->precio_curso_4 = $precio4_curso;
        }

        if($paquete_incluye5 != NULL){
            $paquete->visible_5 = $request->get('visible_5');
            $paquete->precio_5 = $request->get('precio_5');
            $paquete->precio_rebajado_5 = $request->get('precio_rebajado_5');
                $precio5_curso = $paquete->precio_rebajado_5 / count($paquete_incluye5);
            $paquete->precio_curso_5 = $precio5_curso;
        }

        if($paquete_incluye6 != NULL){
            $paquete->visible_6 = $request->get('visible_6');
            $paquete->precio_6 = $request->get('precio_6');
            $paquete->precio_rebajado_6 = $request->get('precio_rebajado_6');
                $precio6_curso = $paquete->precio_rebajado_6 / count($paquete_incluye6);
            $paquete->precio_curso_6 = $precio6_curso;
        }
        $paquete->update();


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

        if($paquete_incluye6 != NULL){
            for ($count = 0; $count < count($paquete_incluye6); $count++) {
                $data6 = array(
                    'nombre_curso' => $paquete_incluye6[$count],
                    'num_paquete' => 6,
                );
                $insert_data6[] = $data6;
            }
            PaquetesIncluye::insert($insert_data6);
        }

        return redirect()->route('paquetes.index')->with('success', 'Paquete(s) editado con exito');
    }
}
