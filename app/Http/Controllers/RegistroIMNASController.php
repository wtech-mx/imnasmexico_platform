<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\DocumenotsGenerador;
use App\Models\Orders;
use App\Models\RegistroImnas;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Tipodocumentos;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistroIMNASController extends Controller
{
    public function index(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->get();

        return view('admin.registro_imnas.index', compact('registros_imnas'));
    }

    public function index_clientes($code){
        $cliente = User::where('code', $code)->firstOrFail();
        $registros_imnas = RegistroImnas::where('id_usuario', '=', $cliente->id)->where('nombre', '!=', NULL)->get();
        $recien_comprados = RegistroImnas::join('orders', 'registro_imnas_doc.id_order', '=', 'orders.id')
        ->where('registro_imnas_doc.id_usuario', $cliente->id)
        ->whereNull('registro_imnas_doc.nombre')
        ->where('orders.estatus', '1')
        ->select('registro_imnas_doc.*') // Asegúrate de seleccionar solo las columnas necesarias
        ->get();

        $curso = Cursos::where('id', '=', 647)->first();
        $cursos_tickets = CursosTickets::where('id_curso', $curso->id)->get();
        $cursos_tickets = $cursos_tickets->slice(1);

        return view('user.registro_imnas', compact('registros_imnas', 'cliente', 'recien_comprados', 'cursos_tickets', 'curso'));
    }

    public function update_clientes(Request $request, $id)
    {
        $cliente = User::where('id', $request->id_usuario)->first();

        $registro = RegistroImnas::find($id);
        $registro->nombre = $request->get('nombre');
        $registro->nom_curso = $request->get('nom_curso');
        $registro->fecha_curso = $request->get('fecha_curso');
        $registro->comentario_cliente = $request->get('comentario_cliente');
        $registro->fecha_compra = date('Y-m-d');

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos_registro/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos_registro/' . $cliente->telefono;
        }
        if($request->hasFile("ine")){
            $file = $request->file('ine');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registro->ine = $fileName;
        }

        if($request->hasFile("curp")){
            $file = $request->file('curp');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registro->curp = $fileName;
        }

        if($request->hasFile("foto_cuadrada")){
            $file = $request->file('foto_cuadrada');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registro->foto_cuadrada = $fileName;
        }

        if($request->hasFile("firma")){
            $file = $request->file('firma');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registro->firma = $fileName;
        }

        if($request->hasFile("logo")){
            $file = $request->file('logo');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registro->logo = $fileName;
        }
        $registro->update();

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }

    public function show_cliente($code){

        $cliente = User::where('code', $code)->firstOrFail();
        $registros_imnas = RegistroImnas::join('orders', 'registro_imnas_doc.id_order', '=', 'orders.id')
        ->where('registro_imnas_doc.id_usuario', $cliente->id)
        ->where('orders.estatus', '1')
        ->select('registro_imnas_doc.*') // Asegúrate de seleccionar solo las columnas necesarias
        ->get();

        $curso = Cursos::where('id', '=', 647)->first();
        $cursos_tickets = CursosTickets::where('id_curso', '=', $curso)->get();

        return view('admin.registro_imnas.show', compact('registros_imnas', 'cliente', 'curso', 'cursos_tickets'));
    }

    public function generar_registro(Request $request){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos');
        }else{
            $ruta_manual = public_path() . '/utilidades_documentos';
        }

        $nombre = $request->get('nombre');
        $datos = $request->get('nombre');
        $fecha = $request->get('fecha');
        $curso = $request->get('curso');
        $tipo = $request->get('tipo');
        $folio = $request->get('folio');
        $curp = $request->get('curp');

        $bitacora = new DocumenotsGenerador;
        $bitacora->cliente = $request->get('nombre');
        $bitacora->curso = $request->get('curso');
        $bitacora->id_usuario_bitacora = auth()->user()->id;
        $bitacora->tipo_documento = $request->get('tipo');
        $bitacora->folio = $request->get('folio');
        $bitacora->fecha_inicial = $request->get('fecha');
        $bitacora->duracion_hrs = '24';
        $bitacora->estatus = 'Generado y descargado' . ' Registro IMNAS';
        $bitacora->save();

        $horas_default = "24";
        $duracion_hrs = $horas_default;

        $email_user = $request->get('email');
        //$email_user = 'adrianwebtech@gmail.com';
        $email_diplomas = 'imnascenter@naturalesainspa.com';

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

        if ($request->hasFile("logo")) {
            $file_logo = $request->file('logo');
            $path_logo = $ruta_manual;
            $fileName_logo = uniqid() . $file_logo->getClientOriginalName();
            $file_logo->move($path_logo, $fileName_logo);
        }else{
            $fileName_logo = 'Sin Logo';
        }

        $destinatario = [ $email_user  , $email_diplomas];

        $tipo_documentos = Tipodocumentos::find($tipo);

        if($tipo_documentos->tipo == 'Cedula de indetidad'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_cedula = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_logo'));
            $pdf->setPaper('A4', 'portrait');
            $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Cambiar 'a tamaño oficio 12.7x17.7'

            return $pdf->download('CN-Cedula de identidad papel_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_titulo = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

            $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

            return $pdf->download('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR_CFC'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_titulo = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 33;
            $alto_cm = 48;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));

            //$pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); //  Cambiar 'a tamaño 48x33 super b'

            return $pdf->download('CN-Titulo Honorifico Online QR_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Diploma'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_diploma = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.diploma_imnas',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)


            return $pdf->download('CN-Doploma_imnas_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Credencial'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_credencial = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 5.5;
            $alto_cm = 8.5;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.credencial',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

            return $pdf->download('CN-Credencial_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_aparatologia'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_tira = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_aparatologia',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_alasiados'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_tira = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_alasiados',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosmetologia_fc'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_tira = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosmetologia_fc',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosmeatria_ea'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_tira = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosmeatria_ea',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_auxiliar'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_tira = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_auxiliar',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_masoterapia'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_tira = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_masoterapia',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosme'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_tira = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosme',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
        }elseif($tipo_documentos->tipo == 'Tira_materias_drenaje_linfatico'){
            $id_ticket = $request->get('id_registro');
            $ticket = RegistroImnas::find($id_ticket);
            $ticket->estatus_tira = '1';
            $ticket->folio = $request->get('folio');
            $ticket->update();

            if($ticket->estatus_cedula == 1 && $ticket->estatus_titulo == 1 && $ticket->estatus_diploma == 1 && $ticket->estatus_credencial == 1 && $ticket->estatus_tira == 1){
                $ticket->fecha_realizados = date('Y-m-d');
                $ticket->update();
            }

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_drenaje',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
        }

    }

    public function update_guia(Request $request){
        $registro_imnas = RegistroImnas::where('id', $request->id_registro)->firstOrFail();
        $registro_imnas->num_guia = $request->get('num_guia');
        $registro_imnas->fecha_enviados = date('Y-m-d');
        $registro_imnas->update();

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }
}
