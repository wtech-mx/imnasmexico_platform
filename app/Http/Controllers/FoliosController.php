<?php

namespace App\Http\Controllers;

use App\Models\DocumenotsGenerador;
use App\Models\OrdersTickets;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Tipodocumentos;
use App\Models\RegistroImnas;
use App\Models\RegistroImnasEscuela;
use App\Models\RegistroImnasEspecialidad;
use App\Models\RegistroImnasTemario;

class FoliosController extends Controller
{
    public function index(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->Orderby('id','ASC')->get();


        return view('cam.auth.login',compact('registros_imnas'));
    }

    public function index_registro(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->Orderby('id','ASC')->get();

        return view('cam.auth.login',compact('registros_imnas'));
    }

    public function buscador(Request $request){

        $tickets = OrdersTickets::where('folio', '=', $request->get('folio'))->first();

            if (!$tickets) {

                $tickets_generador = RegistroImnas::where('folio', $request->get('folio'))->first();

                // Si tampoco se encuentra en RegistroImnas, busca en DocumentosGenerador
                if (!$tickets_generador) {
                    $tickets_externo = DocumenotsGenerador::where('folio', $request->get('folio'))->first();
                }else{
                    $tickets_externo = '';
                }

            }else{
                $tickets_generador = '';
                $tickets_externo = '';

            }

            $folio = $request->get('folio');

            $registros_imnas = Orders::where('registro_imnas', '=', '1')->get();


        return view('user.folio',compact('tickets', 'folio', 'tickets_generador','tickets_externo','registros_imnas'));
    }

    public function buscador_registro(Request $request){
        $tickets = OrdersTickets::where('folio', '=', $request->get('folio'))->first();

            if (!$tickets) {

                $tickets_generador = RegistroImnas::where('folio', $request->get('folio'))->first();

                // Si tampoco se encuentra en RegistroImnas, busca en DocumentosGenerador
                if (!$tickets_generador) {
                    $tickets_externo = DocumenotsGenerador::where('folio', $request->get('folio'))->first();
                }else{
                    $tickets_externo = '';
                }

            }else{
                $tickets_generador = '';
                $tickets_externo = '';

            }

        $folio = $request->get('folio');
        $registros_imnas = Orders::where('registro_imnas', '=', '1')->get();

        return view('admin.registro_imnas.resultado_registro',compact('tickets', 'folio', 'tickets_generador','tickets_externo','registros_imnas'));
    }

    public function update_docDigital(Request $request, $id){

        $registroimnas = RegistroImnas::where('id', $id)->first();
        $registroimnas->tam_letra_especialidad_th = $request->get('tam_letra_especialidad_th');
        $registroimnas->tam_letra_credencial_especialidad = $request->get('tam_letra_credencial_especialidad');
        $registroimnas->tam_letra_nombre_th = $request->get('tam_letra_nombre_th');
        $registroimnas->tam_letra_folio_th = $request->get('tam_letra_folio_th');
        $registroimnas->tam_letra_especialidad_cedula = $request->get('tam_letra_especialidad_cedula');
        $registroimnas->tam_letra_folio_cedula = $request->get('tam_letra_folio_cedula');
        $registroimnas->tam_letra_folioTrasero_cedula = $request->get('tam_letra_folioTrasero_cedula');
        $registroimnas->tam_letra_lista_tira_materias = $request->get('tam_letra_lista_tira_materias');
        $registroimnas->capitalizar_nombre = $request->get('capitalizar_nombre');
        $registroimnas->texto_director = $request->get('texto_director');
        $registroimnas->firma_director = $request->get('firma_director');
        $registroimnas->promedio = $request->get('promedio');
        $registroimnas->curp_escrito = $request->get('curp');
        $registroimnas->fecha_curso = $request->get('fecha');

        $registroimnas->update();

        return redirect()->back()->with('success', 'datos actualizado con exito.');

    }

    public function index_cedula(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(2);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }

        return view('user.components.documentos_imnas.index_cedula',compact('tickets','tipo_documentos','tickets_externo'));

    }

    public function index_titulo(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(3);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }


        return view('user.components.documentos_imnas.index_titulo',compact('tickets','tipo_documentos','tickets_externo'));

    }

    public function index_diploma(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(4);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }


        return view('user.components.documentos_imnas.index_diploma',compact('tickets','tipo_documentos','tickets_externo'));

    }

    public function index_crednecial(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(5);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        if($tickets_externo != null){
            $tickets_externo = DocumenotsGenerador::where('folio', $id)->first();
        }


        return view('user.components.documentos_imnas.index_crednecial',compact('tickets','tipo_documentos','tickets_externo'));

    }

    public function index_tira(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(18);

        $tickets = RegistroImnas::where('folio', $id)->first();

        $idMateria = RegistroImnasEspecialidad::where('especialidad', $tickets->nom_curso)->where('id_cliente', $tickets->id_usuario)->first();

            $subtemas = RegistroImnasTemario::
            where('id_materia', $idMateria->id)
            ->orderBy('id')
            ->get();

        return view('user.components.documentos_imnas.index_tira',compact('tickets','tipo_documentos','subtemas'));

    }

}


