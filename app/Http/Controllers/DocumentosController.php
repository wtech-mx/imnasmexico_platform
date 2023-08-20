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

        $estados = [
            'Aguascalientes', 'Baja California', 'Baja California Sur','CDMX', 'Campeche', 'Chiapas',
            'Chihuahua', 'Coahuila', 'Colima', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo',
            'Jalisco', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca',
            'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora',
            'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'
        ];


        return view('admin.documentos.index',compact('documentos', 'alumnos','cursosArray','tipo_documentos','estados'));
    }

    public function generar(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos');
        }else{
            $ruta_manual = public_path() . '/utilidades_documentos';
        }

        $nombre = $request->get('nombre');
        $fecha = $request->get('fecha');
        $curso = $request->get('curso');
        $tipo = $request->get('tipo');
        $folio = $request->get('folio');
        $curp = $request->get('curp');


        if ($request->hasFile("img_infantil")) {
            $file = $request->file('img_infantil');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
        }


        if ($request->hasFile("firma")) {
            $file_firma = $request->file('firma');
            $path_firma = $ruta_manual;
            $fileName_firma = uniqid() . $file_firma->getClientOriginalName();
            $file_firma->move($path_firma, $fileName_firma);
        }

        $tipo_documentos = Tipodocumentos::find($tipo);

        if($tipo_documentos->tipo == 'Diploma_STPS'){

            $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('diploma_stps_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Cedula de indetidad'){
            $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
            $pdf->setPaper('A4', 'portrait');
            // $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Cambiar 'a tamaño oficio 12.7x17.7'

            return $pdf->download('CN-Cedula de identidad papel_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR'){

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
            // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

            $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

            return $pdf->download('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Diploma'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.diploma_imnas',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)


            return $pdf->download('CN-Doploma_imnas_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Credencial'){

            $ancho_cm = 5.5;
            $alto_cm = 8.5;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.credencial',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

            return $pdf->download('CN-Credencial_'.$nombre.'.pdf');
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
