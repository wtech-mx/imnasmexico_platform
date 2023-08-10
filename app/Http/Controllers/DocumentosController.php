<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Documentos;
use App\Models\OrdersTickets;
use App\Models\User;
use Codexshaper\WooCommerce\Facades\Order;
use Illuminate\Support\Str;
use Hash;
use App\Models\Cursos;
use App\Models\Tipodocumentos;
use Barryvdh\DomPDF\Facade\Pdf;


class DocumentosController extends Controller
{
    public function index(){

        $documentos = Documentos::get();
        $alumnos = User::where('cliente', '=', '1')->get();
        $cursos = Cursos::pluck('nombre')->unique();
        $cursosArray = $cursos->toArray();
        $tipo_documentos = Tipodocumentos::get();


        return view('admin.documentos.index',compact('documentos', 'alumnos','cursosArray','tipo_documentos'));
    }

    public function generar(Request $request){

        $nombre = $request->get('nombre');
        $fecha = $request->get('fecha');
        $curso = $request->get('curso');
        $tipo = $request->get('tipo');
        $folio = $request->get('folio');
        $curp = $request->get('curp');


        $tipo_documentos = Tipodocumentos::find($tipo);

        if($tipo_documentos->tipo== 'Diploma_STPS'){

            $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('diploma_stps_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo== 'Cedula de indetidad'){

            $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('curso','fecha','tipo_documentos','nombre','folio','curp'));
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('CN-Cedula de identidad papel_'.$nombre.'.pdf');
        }



    }

    public function store(Request $request){
        $code = Str::random(8);
        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }
            $payer = $user;
        } else {
            $payer = new User;
            $payer->name = $request->get('name') . $request->get('apellido');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
        }

        $documento = new Documentos;
        $documento->id_usuario = $payer->id;
        $documento->num = $request->get('num_');
        $documento->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function obtenerOrdenes($usuario)
    {
        $ordenesTickets = OrdersTickets::where('id_usuario', $usuario)
        ->whereIn('id_order', function ($query) {
            $query->select('id')
                ->from('orders')
                ->where('estatus', 1); // Cambia el campo y valor según tu estructura
        })
        ->get();

        return response()->json($ordenesTickets);
    }
}
