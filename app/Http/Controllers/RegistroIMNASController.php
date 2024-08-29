<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\DocumenotsGenerador;
use App\Models\Documentos;
use App\Models\Orders;
use App\Models\RegistroImnas;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Tipodocumentos;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Models\RegistroImnasEspecialidad;
use App\Models\OrdersTickets;
use App\Models\RegistroImnasEscuela;
use App\Models\RegistroImnasRelacionMat;
use App\Models\RegistroImnasTemario;
use Hash;
use Illuminate\Support\Facades\DB;

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
        ->where('registro_imnas_doc.tipo', '1')
        ->select('registro_imnas_doc.*') // Asegúrate de seleccionar solo las columnas necesarias
        ->get();

        $curso = Cursos::where('id', '=', 647)->first();
        $cursos_tickets = CursosTickets::where('id_curso', $curso->id)->get();
        $cursos_tickets = $cursos_tickets->slice(1);

        $curso_envio = Cursos::where('id', '=', 109)->first();
        $tickets_envio = CursosTickets::where('id_curso', $curso_envio->id)->get();

        $especialidades = RegistroImnasEspecialidad::where('id_cliente', $cliente->id)->get();

        $recien_comprados_especialidad = RegistroImnas::join('orders', 'registro_imnas_doc.id_order', '=', 'orders.id')
        ->where('registro_imnas_doc.id_usuario', $cliente->id)
        ->whereNull('registro_imnas_doc.nombre')
        ->where('orders.estatus', '1')
        ->where('registro_imnas_doc.tipo', '2')
        ->where('registro_imnas_doc.num_guia', NULL)
        ->select('registro_imnas_doc.*') // Asegúrate de seleccionar solo las columnas necesarias
        ->get();
        return view('user.registro_imnas_new', compact('registros_imnas', 'recien_comprados_especialidad','cliente', 'recien_comprados', 'cursos_tickets', 'curso', 'especialidades', 'curso_envio', 'tickets_envio'));
    }

    public function buscador_registro(Request $request, $code){
        $cliente = User::where('code', $code)->firstOrFail();
        $registros_imnas = RegistroImnas::where('id_usuario', '=', $cliente->id)->where('nombre', '!=', NULL)->get();
        $recien_comprados = RegistroImnas::join('orders', 'registro_imnas_doc.id_order', '=', 'orders.id')
        ->where('registro_imnas_doc.id_usuario', $cliente->id)
        ->whereNull('registro_imnas_doc.nombre')
        ->where('orders.estatus', '1')
        ->where('registro_imnas_doc.tipo', '1')
        ->select('registro_imnas_doc.*') // Asegúrate de seleccionar solo las columnas necesarias
        ->get();

        $curso = Cursos::where('id', '=', 647)->first();
        $cursos_tickets = CursosTickets::where('id_curso', $curso->id)->get();
        $cursos_tickets = $cursos_tickets->slice(1);

        $curso_envio = Cursos::where('id', '=', 109)->first();
        $tickets_envio = CursosTickets::where('id_curso', $curso_envio->id)->get();

        $especialidades = RegistroImnasEspecialidad::where('id_cliente', $cliente->id)->get();

        $recien_comprados_especialidad = RegistroImnas::join('orders', 'registro_imnas_doc.id_order', '=', 'orders.id')
        ->where('registro_imnas_doc.id_usuario', $cliente->id)
        ->whereNull('registro_imnas_doc.nombre')
        ->where('orders.estatus', '1')
        ->where('registro_imnas_doc.tipo', '2')
        ->where('registro_imnas_doc.num_guia', NULL)
        ->select('registro_imnas_doc.*') // Asegúrate de seleccionar solo las columnas necesarias
        ->get();

        $tickets = OrdersTickets::where('folio', '=', $request->get('folio'))->first();

            if (!$tickets) {
                $tickets_generador = RegistroImnas::where('folio', $request->get('folio'))->first();
            }else{
                $tickets_generador = '';
            }

        $folio = $request->get('folio');

        return view('user.registro_imnas_new', compact('registros_imnas', 'recien_comprados_especialidad','cliente', 'recien_comprados', 'cursos_tickets', 'curso', 'especialidades', 'curso_envio', 'tickets_envio','tickets', 'folio', 'tickets_generador'));
    }

    public function update_especialidad(Request $request, $id)
    {
        $cliente = User::where('id', $request->id_usuario)->first();

        $reg = RegistroImnas::where('id', $id)->first();
        $reg->num_guia = '1';
        $reg->update();

        $especialidad = new RegistroImnasEspecialidad;
        $especialidad->id_cliente = $cliente->id;
        $especialidad->especialidad = $request->get('especialidad');
        $especialidad->estatus = '1';
        $especialidad->id_documento = '0';
        $especialidad->save();

        $idMateria = $especialidad->id;
        for ($i = 1; $i <= 12; $i++) {
            $subtema = $request->input("subtema_$i");

            // Verifica si el subtema tiene algún valor
            if (!empty($subtema)) {
                // Crea un nuevo registro en la tabla registro_imnas_temario
                DB::table('registro_imnas_temario')->insert([
                    'id_materia' => $idMateria,
                    'subtema' => $subtema,
                ]);
            }
        }

        $relaciones = new RegistroImnasRelacionMat;
        $relaciones->id_materia = $especialidad->id;
        $relaciones->id_user = $cliente->id;
        $relaciones->save();

        DB::table('registro_imnas_temario')->where('id_materia', $idMateria)->delete();

        // Guardar los nuevos subtemas
        for ($i = 1; $i <= 12; $i++) {
            $subtema = $request->input("subtema_$i");

            if (!empty($subtema)) {
                DB::table('registro_imnas_temario')->insert([
                    'id_materia' => $idMateria,
                    'subtema' => $subtema,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Se creo con exito.');
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
        $tam_letra_especi = $request->get('tam_letra_especi');
        $tam_letra_folio = $request->get('tam_letra_folio');

        $tam_letra_espec_cedu  = $request->get('tam_letra_espec_cedu');
        $tam_letra_foli_cedu = $request->get('tam_letra_foli_cedu');
        $tam_letra_foli_cedu_tras = $request->get('tam_letra_foli_cedu_tras');

        $tam_letra_tira_afi = $request->get('tam_letra_tira_afi');

        $tam_letra_esp_cred = $request->get('tam_letra_esp_cred');

        if ($request->hasFile("img_infantil")) {
            $file = $request->file('img_infantil');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
        }else{
            $fileName = 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
        }

        if ($request->hasFile("firma_director")) {
            $file_firma_director = $request->file('firma_director');
            $path_firma_director = $ruta_manual;
            $fileName_firma_director = uniqid() . $file_firma_director->getClientOriginalName();
            $file_firma_director->move($path_firma_director, $fileName_firma_director);
        }else{
            $fileName_firma_director = 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
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

            $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('tam_letra_foli_cedu_tras','tam_letra_foli_cedu','tam_letra_espec_cedu','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_firma_director','nacionalidad', 'fileName_logo'));
            // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

            $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
            // return $pdf->stream();
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

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_firma_director','nacionalidad', 'fileName_logo'));

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

            $pdf = PDF::loadView('admin.pdf.diploma_imnas',compact('curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_firma_director', 'fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.credencial',compact('tam_letra_esp_cred','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad', 'fileName_logo'));
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

        }elseif($tipo_documentos->tipo == 'Tira materias Afiliados'){

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

            $idMateria = RegistroImnasEspecialidad::where('especialidad', $ticket->nom_curso)->first();

            $subtemas = RegistroImnasTemario::
            where('id_materia', $idMateria->id)
            ->orderBy('id')
            ->get();

            $pdf = PDF::loadView('admin.pdf.tira_materias_afiliados',compact('tam_letra_tira_afi','subtemas','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

             // return $pdf->stream();
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

    public function show_especialidades($id){

        $cliente = User::where('id', $id)->firstOrFail();
        $especialidades = RegistroImnasEspecialidad::where('id_cliente', $id)->get();
        $idMaterias = $especialidades->pluck('id');
        $temario = RegistroImnasTemario::whereIn('id_materia', $idMaterias)->get();

        return view('admin.registro_imnas.show_especialidades', compact('especialidades', 'cliente', 'temario'));
    }

    public function update_guia(Request $request){
        $registro_imnas = RegistroImnas::where('id', $request->id_registro)->firstOrFail();
        $registro_imnas->num_guia = $request->get('num_guia');
        $registro_imnas->fecha_enviados = date('Y-m-d');
        $registro_imnas->update();

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }

    public function store(Request $request){
        $code = Str::random(8);
        $fechaActual = date('Y-m-d');
        $dominio = $request->getHost();

        if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $request->telefono .'/');
            }else{
                $ruta_manual = public_path() . '/documentos'.'/'. $request->telefono;
            }
            if (!file_exists($ruta_manual)) {
                mkdir($ruta_manual, 0777, true);
            }

            if (User::where('telefono', $request->telefono)->exists()) {
                $user = User::where('telefono', $request->telefono)->first();
                $user->name = $request->get('name') . " " . $request->get('apellido');
                $user->registro_imnas = '1';
                if ($request->hasFile("logo")) {
                    $file = $request->file('logo');
                    $path = $ruta_manual;
                    $fileName = uniqid() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $user->logo = $fileName;
                }
                $user->escuela = $request->get('escuela');
                $user->update();
            } else {
                $user = User::where('email', $request->email)->first();
                $user->name = $request->get('name') . " " . $request->get('apellido');
                $user->registro_imnas = '1';
                if ($request->hasFile("logo")) {
                    $file = $request->file('logo');
                    $path = $ruta_manual;
                    $fileName = uniqid() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $user->logo = $fileName;
                }
                $user->escuela = $request->get('escuela');
                $user->update();
            }
            $payer = $user;
        } else {
            if($dominio == 'plataforma.imnasmexico.com'){
                $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $request->telefono .'/');
            }else{
                $ruta_manual = public_path() . '/documentos'.'/'. $request->telefono;
            }
            if (!file_exists($ruta_manual)) {
                mkdir($ruta_manual, 0777, true);
            }

            $payer = new User();
            $payer->name = $request->get('name') . " " . $request->get('apellido');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->registro_imnas = '1';
            $payer->password = Hash::make($request->get('telefono'));
            if ($request->hasFile("logo")) {
                $file = $request->file('logo');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $payer->logo = $fileName;
            }
            $payer->escuela = $request->get('escuela');
            $payer->save();
        }

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $payer->telefono);
        }else{
            $ruta_manual = public_path() . '/documentos'.'/'. $request->telefono;
        }

        if (!file_exists($ruta_manual)) {
            mkdir($ruta_manual, 0777, true);
        }
        $documentos_id = Documentos::where('id_usuario','=',$payer->id)->first();

        if($documentos_id == null){
            $doc = new Documentos;
            $doc->id_usuario = $payer->id;
            if ($request->hasFile("img_infantil")) {
                $file = $request->file('img_infantil');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->foto_tam_infantil = $fileName;
            }

            if ($request->hasFile("ine")) {
                $file = $request->file('ine');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->ine = $fileName;
            }

            if ($request->hasFile("ine_atras_registro")) {
                $file = $request->file('ine_atras_registro');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->ine_atras_registro = $fileName;
            }

            if ($request->hasFile("curp")) {
                $file = $request->file('curp');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->curp = $fileName;
            }

            if ($request->hasFile("acta_nacimiento_registro")) {
                $file = $request->file('acta_nacimiento_registro');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->acta_nacimiento_registro = $fileName;
            }

            if ($request->hasFile("domicilio")) {
                $file = $request->file('domicilio');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->domicilio = $fileName;
            }
            $doc->save();

        }elseif($documentos_id->id_usuario == $payer->id){
            $documento = Documentos::find($documentos_id->id);
            if ($request->hasFile("img_infantil")) {
                $file = $request->file('img_infantil');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->foto_tam_infantil = $fileName;
            }

            if ($request->hasFile("ine")) {
                $file = $request->file('ine');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->ine = $fileName;
            }

            if ($request->hasFile("ine_atras_registro")) {
                $file = $request->file('ine_atras_registro');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->ine_atras_registro = $fileName;
            }

            if ($request->hasFile("curp")) {
                $file = $request->file('curp');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->curp = $fileName;
            }

            if ($request->hasFile("acta_nacimiento_registro")) {
                $file = $request->file('acta_nacimiento_registro');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->acta_nacimiento_registro = $fileName;
            }

            if ($request->hasFile("domicilio")) {
                $file = $request->file('domicilio');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->domicilio = $fileName;
            }
            $documento->update();
        }

        $order = new Orders;
        $order->id_usuario = $payer->id;
        $order->pago = $request->get('pago');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $order->foto = $request->get('foto');
        }

        $order->forma_pago = $request->get('forma_pago');
        $order->pago2 = $request->get('pago2');

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $order->foto2 = $request->get('foto2');
        }

        $order->forma_pago2 = $request->get('forma_pago2');
        $order->fecha = $fechaActual;
        $order->estatus = 1;
        $order->registro_imnas = 1;
        $order->code = $code;
        $order->save();

        $order_ticket = new OrdersTickets;
        $order_ticket->id_order = $order->id;
        $order_ticket->id_usuario = $payer->id;
        $order_ticket->id_tickets = 1007;
        $order_ticket->id_curso = 647;
        $order_ticket->save();

        $registro_imnas = new RegistroImnas;
        $registro_imnas->id_order = $order->id;
        $registro_imnas->id_usuario = $payer->id;
        $registro_imnas->tipo = 1;
        $registro_imnas->save();

        $registro_imnas_esp = new RegistroImnasEspecialidad;
        $registro_imnas_esp->id_cliente = $payer->id;
        $registro_imnas_esp->especialidad = $request->get('especialidad');
        $registro_imnas_esp->estatus = 1;
        $registro_imnas_esp->id_documento = 0;
        $registro_imnas_esp->save();

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }

    public function update_registro(Request $request, $id){

        $user = User::where('id', $id)->first();
        $user->name = $request->get('name');
        $user->telefono = $request->get('telefono');
        $user->email = $request->get('email');
        $user->habilitar_btn = $request->get('habilitar_btn');
        $user->password = Hash::make($request->get('telefono'));
        $user->update();


        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }

    public function contrato(Request $request,$code){
        $user = User::where('code', $code)->firstOrFail();

        $idMateria = RegistroImnasEspecialidad::where('id_cliente', $user->id)->first();
        $escuela = RegistroImnasEscuela::where('id_user', $user->id)->first();

        $subtemas = RegistroImnasTemario::
        where('id_materia', $idMateria->id)
        ->orderBy('id')
        ->get();

        $documentos = Documentos::where('id_usuario', $user->id)->first();

        return view('admin.registro_imnas.contrato', compact('user', 'subtemas', 'idMateria', 'documentos', 'escuela'));
    }

    public function contrato_afiliacion(Request $request,$code){

        $registros_imnas = Orders::where('id', '=', $code)->first();

        return view('admin.registro_imnas.contrato_afiliacion', compact('registros_imnas'));
    }

    public function update_contrato(Request $request, $id){

        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $request->get('telefono') .'/');
        }else{
            $ruta_estandar = public_path() . '/documentos/' .$request->get('telefono').'/';
        }

        if (!file_exists($ruta_estandar)) {
            mkdir($ruta_estandar, 0777, true);
        }

        $docmuentos = Documentos::where('id_usuario','=',$id)->first();


        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $signature = uniqid() . '.'.$image_type;
        $file = $ruta_estandar . $signature;

        file_put_contents($file, $image_base64);

        $docmuentos->firma = $signature;
        $docmuentos->update();


        return redirect()->back()->with('success', 'datos actualizado con exito.');

    }

    public function contrato_update(Request $request, $id){

        $user = User::where('id', $id)->firstOrFail();
        $user->name = $request->get('name');
        $user->direccion = $request->get('direccion');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->postcode = $request->get('postcode');
        $user->country = $request->get('country');
        $user->telefono = $request->get('telefono');
        $user->email = $request->get('email');
        $user->habilitar_btn = 'No';
        $user->escuela = $request->get('escuela');

        $user->facebook = $request->get('facebook_escuela');
        $user->instagram = $request->get('instagram_escuela');
        $user->pagina_web = $request->get('pagina_escuela');
        $user->celular_casa = $request->get('telefono_escuela');


        $dominio = $request->getHost();

        // if($dominio == 'plataforma.imnasmexico.com'){
        //     $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $user->telefono .'/');
        // }else{
        //     $ruta_manual = public_path() . '/documentos/' . $user->telefono . '/';

        // }

        if ($dominio == 'plataforma.imnasmexico.com') {
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $user->telefono .'/');
            $ruta_manual_logo = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos/');
        } else {
            $ruta_manual = public_path() . '/documentos/' . $user->telefono . '/';
            $ruta_manual_logo = public_path() . '/utilidades_documentos/';
        }

        // if ($request->hasFile("logo")) {
        //     $file = $request->file('logo');
        //     $path = $ruta_manual;
        //     $fileName = uniqid() . $file->getClientOriginalName();
        //     $file->move($path, $fileName);
        //     $user->logo = $fileName;
        // }

        if ($request->hasFile("logo")) {
            $file = $request->file('logo');
            $fileName = uniqid() . $file->getClientOriginalName();

            // Guardar en la primera ruta
            $file->move($ruta_manual, $fileName);
            $user->logo = $fileName;

            // Copiar el archivo a la segunda ruta
            $filePathOriginal = $ruta_manual . $fileName;
            $filePathCopy = $ruta_manual_logo . $fileName;
            copy($filePathOriginal, $filePathCopy);
        }

        $user->update();

        $documentos_id = Documentos::where('id_usuario','=',$user->id)->first();

        if($documentos_id == null){
            $doc = new Documentos;
            $doc->id_usuario = $user->id;
            if ($request->hasFile("img_infantil")) {
                $file = $request->file('img_infantil');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->foto_tam_infantil = $fileName;
            }

            if ($request->hasFile("ine")) {
                $file = $request->file('ine');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->ine = $fileName;
            }

            if ($request->hasFile("ine_atras_registro")) {
                $file = $request->file('ine_atras_registro');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->ine_atras_registro = $fileName;
            }

            if ($request->hasFile("curp")) {
                $file = $request->file('curp');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->curp = $fileName;
            }

            if ($request->hasFile("acta_nacimiento_registro")) {
                $file = $request->file('acta_nacimiento_registro');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->acta_nacimiento_registro = $fileName;
            }

            if ($request->hasFile("domicilio")) {
                $file = $request->file('domicilio');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $doc->domicilio = $fileName;
            }

            if($request->signed != NULL){
                $folderPath = $ruta_manual; // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->signed);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.'.$image_type;
                $file = $folderPath . $signature;
                file_put_contents($file, $image_base64);
                $doc->firma = $signature;
            }
            $doc->save();

        }elseif($documentos_id->id_usuario == $user->id){

            $documento = Documentos::find($documentos_id->id);
            if($request->signed != NULL){
                $folderPath = $ruta_manual; // create signatures folder in public directory
                $image_parts = explode(";base64,", $request->signed);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $signature = uniqid() . '.'.$image_type;
                $file = $folderPath . $signature;
                file_put_contents($file, $image_base64);
                $documento->firma = $signature;
            }

            if ($request->hasFile("img_infantil")) {
                $file = $request->file('img_infantil');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->foto_tam_infantil = $fileName;
            }

            if ($request->hasFile("ine")) {
                $file = $request->file('ine');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->ine = $fileName;
            }

            if ($request->hasFile("ine_atras_registro")) {
                $file = $request->file('ine_atras_registro');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->ine_atras_registro = $fileName;
            }

            if ($request->hasFile("curp")) {
                $file = $request->file('curp');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->curp = $fileName;
            }

            if ($request->hasFile("acta_nacimiento_registro")) {
                $file = $request->file('acta_nacimiento_registro');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->acta_nacimiento_registro = $fileName;
            }

            if ($request->hasFile("domicilio")) {
                $file = $request->file('domicilio');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documento->domicilio = $fileName;
            }
            $documento->update();
        }

        $registro = new RegistroImnasEscuela;
        $registro->id_user = $user->id;
        $registro->direccion_escuela = $request->get('direccion_escuela');
        $registro->city_escuela = $request->get('city_escuela');
        $registro->state_escuela = $request->get('state_escuela');
        $registro->postcode_escuela = $request->get('postcode_escuela');
        $registro->country_escuela = $request->get('country_escuela');
        $registro->nombre_referencia = $request->get('nombre_referencia');
        $registro->direccion_referencia = $request->get('direccion_referencia');
        $registro->city_referencia = $request->get('city_referencia');
        $registro->state_referencia = $request->get('state_referencia');
        $registro->postcode_referencia = $request->get('postcode_referencia');
        $registro->country_referencia = $request->get('country_referencia');
        $registro->telefono_referencia = $request->get('telefono_referencia');
        $registro->email_referencia = $request->get('email_referencia');

        if ($request->hasFile("firma_escuela")) {
            $file = $request->file('firma_escuela');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registro->firma = $fileName;
        }
        $registro->save();

        $especialidad = RegistroImnasEspecialidad::where('id_cliente','=',$user->id)->first();
        $especialidad->id_cliente = $user->id;
        $especialidad->especialidad = $request->get('especialidad');
        $especialidad->estatus = '1';
        $especialidad->id_documento = '0';
        $especialidad->save();

        $idMateria = $especialidad->id;
        for ($i = 1; $i <= 12; $i++) {
            $subtema = $request->input("subtema_$i");

            // Verifica si el subtema tiene algún valor
            if (!empty($subtema)) {
                // Crea un nuevo registro en la tabla registro_imnas_temario
                DB::table('registro_imnas_temario')->insert([
                    'id_materia' => $idMateria,
                    'subtema' => $subtema,
                ]);
            }
        }

        $relaciones = new RegistroImnasRelacionMat;
        $relaciones->id_materia = $especialidad->id;
        $relaciones->id_user = $user->id;
        $relaciones->save();

        DB::table('registro_imnas_temario')->where('id_materia', $idMateria)->delete();

        // Guardar los nuevos subtemas
        for ($i = 1; $i <= 12; $i++) {
            $subtema = $request->input("subtema_$i");

            if (!empty($subtema)) {
                DB::table('registro_imnas_temario')->insert([
                    'id_materia' => $idMateria,
                    'subtema' => $subtema,
                ]);
            }
        }

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }
}
