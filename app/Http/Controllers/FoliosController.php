<?php

namespace App\Http\Controllers;

use App\Models\DocumenotsGenerador;
use App\Models\OrdersTickets;
use Illuminate\Http\Request;
use App\Models\Tipodocumentos;
use App\Models\RegistroImnas;
use App\Models\RegistroImnasEscuela;
use App\Models\RegistroImnasEspecialidad;
use App\Models\RegistroImnasTemario;

class FoliosController extends Controller
{
    public function index(){

        return view('user.folio');
    }

    public function buscador(Request $request){

        $tickets = OrdersTickets::where('folio', '=', $request->get('folio'))->first();
        $externos = DocumenotsGenerador::where('folio', '=', $request->get('folio'))->first();

            if ($tickets != NULL) {
                $registro = RegistroImnas::where('folio', $request->get('folio'))->first();
                $tickets_generador = [
                    'nombre' => $registro->nombre,
                    'nom_curso' => $registro->nom_curso,
                    'escuela' => $registro->User->escuela,
                    'fecha' => $registro->fecha_curso,
                ];
            }else if($externos != NULL){
                $tickets_generador = [
                    'nombre' => $externos->cliente,
                    'nom_curso' => $externos->curso,
                    'escuela' => null, // No hay escuela en esta tabla, puedes dejarlo como null o manejarlo como necesites
                    'fecha' => $externos->fecha_inicial,
                ];
            }else{
                $tickets_generador = '';
            }
            
        $folio = $request->get('folio');

        return view('user.folio',compact('tickets', 'folio', 'tickets_generador'));
    }

    public function index_cedula(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(2);

        $tickets = RegistroImnas::where('folio', $id)->first();

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        return view('user.components.documentos_imnas.index_cedula',compact('tickets','tipo_documentos'));

    }

    public function index_titulo(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(3);

        $tickets = RegistroImnas::where('folio', $id)->first();

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }
        return view('user.components.documentos_imnas.index_titulo',compact('tickets','tipo_documentos'));

    }

    public function index_diploma(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(4);

        $tickets = RegistroImnas::where('folio', $id)->first();

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        return view('user.components.documentos_imnas.index_diploma',compact('tickets','tipo_documentos'));

    }

    public function index_crednecial(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(5);

        $tickets = RegistroImnas::where('folio', $id)->first();

        if($tickets == null){
            $tickets = OrdersTickets::where('id', '=', $id)->first();
        }

        return view('user.components.documentos_imnas.index_crednecial',compact('tickets','tipo_documentos'));

    }

    public function index_tira(Request $request, $id){

        $tipo_documentos = Tipodocumentos::find(18);

        $tickets = RegistroImnas::where('folio', $id)->first();


            $idMateria = RegistroImnasEspecialidad::where('id_cliente', $tickets->id_usuario)->first();

            $subtemas = RegistroImnasTemario::
            where('id_materia', $idMateria->id)
            ->orderBy('id')
            ->get();

        return view('user.components.documentos_imnas.index_tira',compact('tickets','tipo_documentos','subtemas'));

    }

}


