<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Documentos;
use App\Models\OrdersTickets;
use App\Models\User;
use Codexshaper\WooCommerce\Facades\Order;
use Illuminate\Support\Str;
use Hash;
use App\Models\Cursos;
use App\Models\Tipodocumentos;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\PlantillaDocumentoStps;
use App\Models\CursosTickets;
use App\Models\DocumenotsGenerador;
use DB;

class DocumentosController extends Controller
{
    public function index(){

        $documentos = Documentos::get();
        $alumnos = User::where('cliente', '=', '1')->get();
        $cursos = Cursos::orderBy('nombre','ASC')->pluck('nombre')->unique();
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

    public function faltantes(Request $request){
        // $cursos = Cursos::orderBy('id','DESC')->get();
        $cursos = Cursos::where('fecha_inicial', '>=', '2023-11-01')
        ->where('precio', '>', 0)
        ->where('nombre', '!=', 'Diplomado en Cosmiatría Estética UNAM')
        ->where('nombre', '!=', 'Diplomado en medicina estetica UNAM')
        ->where('nombre', '!=', 'Diplomado en Cosmetología y Cosmiatría SEP Facial y Corporal')
        ->where('nombre', '!=', 'Diplomado en Cosmetología SEP y Cosmiatría UNAM Facial y Corporal')
        ->whereHas('orderTicket', function($query) {
            $query->where('estatus_doc', '=', NULL)
                  ->orWhere('estatus_cedula', '=', NULL)
                  ->orWhere('estatus_titulo', '=', NULL)
                  ->orWhere('estatus_diploma', '=', NULL)
                  ->orWhere('estatus_credencial', '=', NULL)
                  ->orWhere('estatus_tira', '=', NULL);
        })
        ->orderBy('fecha_inicial', 'DESC')
        ->with('orderTicket')
        ->get();

        return view('admin.documentos.doc_faltante', compact('cursos'));
    }

    public function buscador(Request $request){

        $bitacoras = DocumenotsGenerador::query();

        if( $request->fecha != NULL && $request->fecha2 != NULL){
            $bitacoras = $bitacoras->whereDate('created_at', '>=', $request->fecha)
                                ->whereDate('created_at', '<=', $request->fecha2);
        }
        $bitacoras = $bitacoras->get();

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

        return view('admin.documentos.index',compact('documentos', 'alumnos','cursosArray','tipo_documentos','estados', 'bitacoras'));
    }

    public function generar(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos');
        }else{
            $ruta_manual = public_path() . '/utilidades_documentos';
        }

        $bitacora = new DocumenotsGenerador;
        $bitacora->cliente = $request->get('nombre');
        $bitacora->curso = $request->get('curso');
        $bitacora->id_usuario_bitacora = auth()->user()->id;
        $bitacora->tipo_documento = $request->get('tipo');
        $bitacora->folio = $request->get('folio');
        $bitacora->estatus = 'Generado y descargado';
        $bitacora->save();

        $nombre = $request->get('nombre');
        $fecha = $request->get('fecha');
        $curso = $request->get('curso');
        $tipo = $request->get('tipo');
        $folio = $request->get('folio');
        $curp = $request->get('curp');
        $nacionalidad = $request->get('nacionalidad');

        $nombres = $request->get('nombres');
        $apellido_apeterno = $request->get('apellido_apeterno');
        $apellido_materno = $request->get('apellido_materno');


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
        } else {
            $fileName_firma = "fondo_sf.png";
        }

        $tipo_documentos = Tipodocumentos::find($tipo);

        if($tipo_documentos->tipo == 'Diploma_STPS'){

            $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('diploma_stps_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Cedula de indetidad'){
            $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
            $pdf->setPaper('A4', 'portrait');
            $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Cambiar 'a tamaño oficio 12.7x17.7'

            return $pdf->download('CN-Cedula de identidad papel_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR'){

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

            $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

            return $pdf->download('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR_CFC'){

            $ancho_cm = 33;
            $alto_cm = 48;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));

            //$pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); //  Cambiar 'a tamaño 48x33 super b'

            return $pdf->download('CN-Titulo Honorifico Online QR_'.$nombre.'.pdf');

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

            $pdf = PDF::loadView('admin.pdf.credencial',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

            return $pdf->download('CN-Credencial_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_aparatologia'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_aparatologia',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_alasiados'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_alasiados',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosmetologia_fc'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosmetologia_fc',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosmeatria_ea'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosmeatria_ea',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_auxiliar'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_auxiliar',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_masoterapia'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_masoterapia',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosme'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosme',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
        }elseif($tipo_documentos->tipo == 'Tira_materias_drenaje_linfatico'){

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_drenaje',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
        }

    }

    public function generar_enviar(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos');
        }else{
            $ruta_manual = public_path() . '/utilidades_documentos';
        }

        $bitacora = new DocumenotsGenerador;
        $bitacora->id_usuario = $request->get('id_usuario');
        $bitacora->id_curso = $request->get('id_curso');
        $bitacora->id_curso_ticket = $request->get('id_ticket');
        $bitacora->id_usuario_bitacora = auth()->user()->id;
        $bitacora->tipo_documento = $request->get('tipo');
        $bitacora->folio = $request->get('folio');

        $nombre = $request->get('nombre');
        $datos = $request->get('nombre');
        $fecha = $request->get('fecha');
        $curso = $request->get('curso');
        $tipo = $request->get('tipo');
        $folio = $request->get('folio');
        $curp = $request->get('curp');

        $email_user = $request->get('email');
        //$email_user = 'adrianwebtech@gmail.com';
        $email_diplomas = 'diplomas_imnas@naturalesainspa.com';

        $nacionalidad = $request->get('nacionalidad');

        $nombres = $request->get('nombres');
        $apellido_apeterno = $request->get('apellido_apeterno');
        $apellido_materno = $request->get('apellido_materno');

        if ($request->hasFile("img_infantil")) {
            $file = $request->file('img_infantil');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
        }else{
            $fileName = 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
        }

        if ($request->hasFile("firma")) {
            $file_firma = $request->file('firma');
            $path_firma = $ruta_manual;
            $fileName_firma = uniqid() . $file_firma->getClientOriginalName();
            $file_firma->move($path_firma, $fileName_firma);
        }else{
            $fileName_firma = 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
        }

        $destinatario = [ $email_user  , $email_diplomas];

        $tipo_documentos = Tipodocumentos::find($tipo);

        if($tipo_documentos == 'Diploma_STPS'){
            $bitacora->estatus = 'Enviado X email';
        }else{
            $bitacora->estatus = 'Generado y Descargado';
        }

        $bitacora->save();

        $curso_first = Cursos::where('id', '=', $bitacora->id_curso)->first();

        if($curso_first->CursosTickets->contains('descripcion', 'Con opción a Documentos de certificadora IMNAS')){
            if($tipo_documentos->tipo == 'Diploma_STPS'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_doc = '1';
                $ticket->update();

                $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
                $pdf->setPaper('A4', 'portrait');

                $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
                $pdf->setPaper('A4', 'portrait');

                $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.

                Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                //return redirect()->back()->with('success', 'Enviado por email correctamente');

                //return $pdf->download('diploma_stps_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Cedula de indetidad'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_cedula = '1';
                $ticket->update();

                $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
                $pdf->setPaper('A4', 'portrait');
                $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Cambiar 'a tamaño oficio 12.7x17.7'

                return $pdf->download('CN-Cedula de identidad papel_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_titulo = '1';
                $ticket->update();

                $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

                $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

                return $pdf->download('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR_CFC'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_titulo = '1';
                $ticket->update();
                $ancho_cm = 33;
                $alto_cm = 48;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));

                //$pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); //  Cambiar 'a tamaño 48x33 super b'

                return $pdf->download('CN-Titulo Honorifico Online QR_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Diploma'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_diploma = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.diploma_imnas',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)


                return $pdf->download('CN-Doploma_imnas_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Credencial'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_credencial = '1';
                $ticket->update();

                $ancho_cm = 5.5;
                $alto_cm = 8.5;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.credencial',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

                return $pdf->download('CN-Credencial_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_aparatologia'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_aparatologia',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_alasiados'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_alasiados',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_cosmetologia_fc'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_cosmetologia_fc',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_cosmeatria_ea'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_cosmeatria_ea',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_auxiliar'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_auxiliar',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_masoterapia'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_masoterapia',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_cosme'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_cosme',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
            }elseif($tipo_documentos->tipo == 'Tira_materias_drenaje_linfatico'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_drenaje',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
            }
        }else{
            if($curso_first->stps == '1' && $curso_first->titulo_hono == '1'){
                if($tipo_documentos->tipo == 'Diploma_STPS'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_doc = '1';
                    $ticket->estatus_cedula = '1';
                    $ticket->estatus_diploma = '1';
                    $ticket->estatus_credencial = '1';
                    $ticket->estatus_tira = '1';
                    $ticket->update();

                    $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
                    $pdf->setPaper('A4', 'portrait');

                    $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
                    $pdf->setPaper('A4', 'portrait');

                    $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.

                    Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                    //return redirect()->back()->with('success', 'Enviado por email correctamente');

                    //return $pdf->download('diploma_stps_'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR_CFC'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_doc = '1';
                    $ticket->estatus_cedula = '1';
                    $ticket->estatus_titulo = '1';
                    $ticket->estatus_diploma = '1';
                    $ticket->estatus_credencial = '1';
                    $ticket->estatus_tira = '1';
                    $ticket->update();

                    $ancho_cm = 33;
                    $alto_cm = 48;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));

                    //$pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); //  Cambiar 'a tamaño 48x33 super b'

                    return $pdf->download('CN-Titulo Honorifico Online QR_'.$nombre.'.pdf');

                }
            }
            if($curso_first->stps == '1' && $curso_first->titulo_hono == NULL){
                if($tipo_documentos->tipo == 'Diploma_STPS'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_doc = '1';
                    $ticket->estatus_cedula = '1';
                    $ticket->estatus_titulo = '1';
                    $ticket->estatus_diploma = '1';
                    $ticket->estatus_credencial = '1';
                    $ticket->estatus_tira = '1';
                    $ticket->update();

                    $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
                    $pdf->setPaper('A4', 'portrait');

                    $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
                    $pdf->setPaper('A4', 'portrait');

                    $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.

                    Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                    //return redirect()->back()->with('success', 'Enviado por email correctamente');

                    //return $pdf->download('diploma_stps_'.$nombre.'.pdf');

                }
            }
        }

        return redirect()->back()->with('success', 'Generado Exitosamente');

    }

    public function bitacora_documentos_estatus(Request $request , $id){

        $bitacora = DocumenotsGenerador::find( $id);
        $bitacora->estatus = $request->get('estatus');
        $bitacora->update();

        return redirect()->back()->with('success', 'Estatus actualizado.');

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
