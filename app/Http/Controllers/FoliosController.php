<?php

namespace App\Http\Controllers;

use App\Models\DocumenotsGenerador;
use App\Models\OrdersTickets;
use Illuminate\Http\Request;
use App\Models\Tipodocumentos;

class FoliosController extends Controller
{
    public function index(){

        return view('user.folio');
    }

    public function buscador(Request $request){

        $tickets = OrdersTickets::where('folio', '=', $request->get('folio'))->first();
            if (!$tickets) {
                $tickets_generador = DocumenotsGenerador::where('folio', $request->get('folio'))->first();
            }else{
                $tickets_generador = '';
            }
        $folio = $request->get('folio');

        return view('user.folio',compact('tickets', 'folio', 'tickets_generador'));
    }

    public function index_cedula(Request $request, $id){

        $tickets = OrdersTickets::where('id', '=', $id)->first();

        $tipo_documentos = Tipodocumentos::find(2);

        return view('user.components.documentos_imnas.index_cedula',compact('tickets','tipo_documentos'));

    }

    public function index_titulo(){

    }

    public function index_diploma(){

    }

    public function index_crednecial(){

    }

    public function index_tira(){

    }


}
