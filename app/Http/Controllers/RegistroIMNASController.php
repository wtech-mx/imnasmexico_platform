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
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mtownsend\RemoveBg\RemoveBg;

class RegistroIMNASController extends Controller
{
    public function index(){

        $registros_imnas = Orders::where('registro_imnas', '=', '1')->orderby('id','DESC')->get();
        $curso = Cursos::where('id', '=', 647)->first();
        $cursos_tickets = CursosTickets::where('id_curso', $curso->id)->where('nombre', 'Emisión por alumno')->get();

        return view('admin.registro_imnas.index', compact('registros_imnas', 'cursos_tickets'));
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

    public function update_especialidad(Request $request, $id){
        $cliente = User::where('id', $request->id_usuario)->first();

        $reg = RegistroImnas::where('id', $id)->first();
        $reg->num_guia = '1';
        $reg->update();

        $especialidad = new RegistroImnasEspecialidad;
        $especialidad->id_cliente = $cliente->id;
        $especialidad->especialidad = $request->get('especialidad');
        $especialidad->estatus = '1';
        $especialidad->estatus_imnas = 1;
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

    public function update_clientes(Request $request, $id){
        $cliente = User::where('id', $request->id_usuario)->first();

        $registro = RegistroImnas::find($id);
        $registro->nombre = $request->get('nombre');
        $registro->nom_curso = $request->get('nom_curso');
        $registro->fecha_curso = $request->get('fecha_curso');
        $registro->comentario_cliente = $request->get('comentario_cliente');
        $registro->fecha_compra = date('Y-m-d');
        $registro->curp_escrito = $request->get('curp_escrito');

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

        if ($dominio == 'plataforma.imnasmexico.com') {
            $ruta_manual_foto = base_path('../public_html/plataforma.imnasmexico.com/documentos_registro/' . $request->get('telefono_escuela') .'/');
            $ruta_manual_logo = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $request->get('telefono_escuela') .'/');
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos/');

        } else {
            $ruta_manual_foto = public_path() . '/documentos_registro/' . $request->get('telefono_escuela') . '/';
            $ruta_manual_logo = public_path() . '/documentos/' . $request->get('telefono_escuela') . '/';
            $ruta_manual = public_path() . '/utilidades_documentos/';
        }

        $removeBg = new RemoveBg('kfNprpY8MrAbrZFkjriRBDFq');

        $nombre = $request->get('nombre');
        $datos = $request->get('nombre');
        $fecha = $request->get('fecha');
        $curso = $request->get('curso');
        $tipo = $request->get('tipo');
        $folio = $request->get('folio');
        $curp = $request->get('curp');
        $id_usuario = $request->get('id_usuario');
        $id_ticket = $request->get('id_registro');
        $clave_rfc = !empty($request->get('clave_rfc')) ? $request->get('clave_rfc') : 'RIFC680910-879-0013';

        $registro = RegistroImnas::find($id_ticket);
        $registro->nombre = $nombre;
        $registro->nom_curso = $curso;
        $registro->fecha_curso = $fecha;
        $registro->update();

        if($curp != null){
            $registro->curp_escrito = $request->get('curp');
            $registro->update();
        }

        if($fecha != null){
            $registro->fecha_curso = $request->get('fecha');
            $registro->update();
        }

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
        $director = $request->get('director');

        $nombres = $request->get('nombres');
        $apellido_apeterno = $request->get('apellido_apeterno');
        $apellido_materno = $request->get('apellido_materno');
        $tam_letra_nombre = $request->get('tam_letra_nombre');
        $tam_letra_especi = $request->get('tam_letra_especi');

        $tam_letra_folio = $request->get('tam_letra_folio');

        $tam_letra_espec_cedu  = $request->get('tam_letra_espec_cedu');
        $tam_letra_foli_cedu = $request->get('tam_letra_foli_cedu');
        $tam_letra_foli_cedu_tras = $request->get('tam_letra_foli_cedu_tras');

        $tam_letra_tira_afi = $request->get('tam_letra_tira_afi');

        $tam_letra_esp_cred = $request->get('tam_letra_esp_cred');
        $promedio = $request->get('promedio');
        $rbg_foto = $request->get('rbg_foto');
        $rbg_logo = $request->get('rbg_logo');
        $rbg_signature = $request->get('rbg_signature');
        $rbg_signatureOtra = $request->get('rbg_signatureOtra');

        $capitalizar =  $request->get('capitalizar');

        $firma_directora =  $request->get('firma_directora');
        $firma_directora2 =  $request->get('firma_directora');

        if($firma_directora == 'Personalizado'){
            $firma_directora = $request->get('texto_firma_personalizada');
            $firma_directora2 = $request->get('texto_firma_personalizada2');

            $registro->texto_firma_personalizada = $firma_directora;
            $registro->texto_firma_personalizada2 = $firma_directora2;
            $registro->update();
        }

        if ($request->hasFile("img_infantil")) {

            if($rbg_foto == 'si'){

                $file = $request->file('img_infantil');
                $fileName = uniqid() . $file->getClientOriginalName();

                // Ruta donde se guardará la imagen sin fondo
                $filePathOriginal = $ruta_manual . $fileName;
                $filePathCopy = $ruta_manual_foto . $fileName;


                try {
                    // Quitar el fondo de la imagen y obtener la imagen procesada
                    $noBgImage = $removeBg->file($file->getRealPath())->get();

                    // Guardar la imagen sin fondo en el primer path
                    file_put_contents($filePathOriginal, $noBgImage);

                    // Copiar la imagen sin fondo al segundo path
                    copy($filePathOriginal, $filePathCopy);

                    // Guardar el nombre de la imagen en el registro
                    $registro->foto_cuadrada = $fileName;

                } catch (\Exception $e) {
                    \Log::error("Error al quitar el fondo de la imagen: " . $e->getMessage());

                    // En caso de fallo, guardar la imagen original en ambas rutas
                    $file->move($ruta_manual, $fileName);
                    copy($filePathOriginal, $filePathCopy);

                    // Guardar el nombre de la imagen original en el registro
                    $registro->foto_cuadrada = $fileName;
                }

                // Actualizar registro
                $registro->update();

            }else{

                $file = $request->file('img_infantil');
                $path = $ruta_manual;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);

                $registro->foto_cuadrada = $fileName;

                $filePathOriginal = $ruta_manual . $fileName ;
                $filePathCopy = $ruta_manual_foto . $fileName ;
                copy($filePathOriginal, $filePathCopy);

                $registro->update();

            }

        } else {
            $fileName = 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
        }

        if ($request->hasFile("firma_director")) {

            if($rbg_signature == 'si'){

                $file_firma_director = $request->file('firma_director');
                $fileName_firma_director = uniqid() . $file_firma_director->getClientOriginalName();
                $filePathOriginal = $ruta_manual . $fileName_firma_director;

                // Mover el archivo a la ruta manual
                $file_firma_director->move($ruta_manual, $fileName_firma_director);

                try {
                    // Quitar el fondo de la imagen de la firma del director
                    $noBgImage = $removeBg->file($filePathOriginal)->get();

                    // Guardar la imagen sin fondo en la ruta manual
                    file_put_contents($filePathOriginal, $noBgImage);

                    // Copiar la imagen sin fondo a la segunda ruta
                    $filePathCopy = $ruta_manual_logo . $fileName_firma_director;
                    file_put_contents($filePathCopy, $noBgImage);

                    // Guardar el nombre de la imagen en el registro de la escuela
                    $escuela = RegistroImnasEscuela::where('id_user', $request->get("Id_escuela"))->firstOrFail();
                    $escuela->firma = $fileName_firma_director;

                } catch (\Exception $e) {
                    \Log::error("Error al quitar el fondo de la imagen firma_director: " . $e->getMessage());

                    // En caso de fallo, copiar la imagen original a la segunda ruta
                    $filePathCopy = $ruta_manual_logo . $fileName_firma_director;
                    copy($filePathOriginal, $filePathCopy);

                    // Guardar el nombre de la imagen original en el registro de la escuela
                    $escuela = RegistroImnasEscuela::where('id_user', $request->get("Id_escuela"))->firstOrFail();
                    $escuela->firma = $fileName_firma_director;
                }

                // Guardar cambios en el registro de la escuela
                $escuela->update();

            }else{
                $file_firma_director   = $request->file('firma_director');
                $fileName_firma_director  = uniqid() . $file_firma_director ->getClientOriginalName();
                $file_firma_director->move($ruta_manual, $fileName_firma_director );

                $escuela = RegistroImnasEscuela::where('id_user', $request->get("Id_escuela"))->firstOrFail();
                // Guardar en la primera ruta
                $escuela->firma = $fileName_firma_director ;

                // Copiar el archivo a la segunda ruta
                $filePathOriginal = $ruta_manual . $fileName_firma_director ;
                $filePathCopy = $ruta_manual_logo . $fileName_firma_director ;
                copy($filePathOriginal, $filePathCopy);
                $escuela->update();
            }

        }else{
            $fileName_firma_director = 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
        }

        if ($request->hasFile("otra_firma_director")) {

            if($rbg_signatureOtra == 'si'){

                $file_firma_directorOtra = $request->file('otra_firma_director');
                $fileName_firma_directorOtra = uniqid() . $file_firma_directorOtra->getClientOriginalName();
                $filePathOriginal = $ruta_manual . $fileName_firma_directorOtra;

                // Mover el archivo a la ruta manual
                $file_firma_directorOtra->move($ruta_manual, $fileName_firma_directorOtra);

                try {
                    // Quitar el fondo de la imagen de la firma del director
                    $noBgImage = $removeBg->file($filePathOriginal)->get();

                    // Guardar la imagen sin fondo en la ruta manual
                    file_put_contents($filePathOriginal, $noBgImage);

                    // Copiar la imagen sin fondo a la segunda ruta
                    $filePathCopy = $ruta_manual_logo . $fileName_firma_directorOtra;
                    file_put_contents($filePathCopy, $noBgImage);

                    // Guardar el nombre de la imagen en el registro de la escuela
                    $escuela = RegistroImnasEscuela::where('id_user', $request->get("Id_escuela"))->firstOrFail();
                    $escuela->otra_firma_director = $fileName_firma_directorOtra;


                } catch (\Exception $e) {
                    \Log::error("Error al quitar el fondo de la imagen firma_director: " . $e->getMessage());

                    // En caso de fallo, copiar la imagen original a la segunda ruta
                    $filePathCopy = $ruta_manual_logo . $fileName_firma_directorOtra;
                    copy($filePathOriginal, $filePathCopy);

                    // Guardar el nombre de la imagen original en el registro de la escuela
                    $escuela = RegistroImnasEscuela::where('id_user', $request->get("Id_escuela"))->firstOrFail();
                    $escuela->otra_firma_director = $fileName_firma_directorOtra;
                }

                // Guardar cambios en el registro de la escuela
                $escuela->update();

            }else{
                $file_firma_directorOtra   = $request->file('otra_firma_director');
                $fileName_firma_directorOtra  = uniqid() . $file_firma_directorOtra ->getClientOriginalName();
                $file_firma_directorOtra->move($ruta_manual, $fileName_firma_directorOtra );

                $escuela = RegistroImnasEscuela::where('id_user', $request->get("Id_escuela"))->firstOrFail();
                // Guardar en la primera ruta
                $escuela->otra_firma_director = $fileName_firma_directorOtra ;

                // Copiar el archivo a la segunda ruta
                $filePathOriginal = $ruta_manual . $fileName_firma_directorOtra ;
                $filePathCopy = $ruta_manual_logo . $fileName_firma_directorOtra ;
                copy($filePathOriginal, $filePathCopy);
                $escuela->update();
            }

        }else{
            $fileName_firma_directorOtra = $fileName_firma_director ;
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

            if($rbg_logo == 'si'){

                $file_logo = $request->file('logo');
                $fileName_logo = uniqid() . $file_logo->getClientOriginalName();
                $filePathOriginal = $ruta_manual . $fileName_logo;

                // Mover el archivo a la ruta manual
                $file_logo->move($ruta_manual, $fileName_logo);

                try {
                    // Quitar el fondo de la imagen del logo
                    $noBgImage = $removeBg->file($filePathOriginal)->get();

                    // Guardar la imagen sin fondo en la ruta estándar (ruta_manual)
                    file_put_contents($filePathOriginal, $noBgImage);

                    // Copiar la imagen sin fondo a la segunda ruta
                    $filePathCopy = $ruta_manual_logo . $fileName_logo;
                    file_put_contents($filePathCopy, $noBgImage);

                    // Actualizar el registro del usuario con el nombre del archivo
                    $user = User::where('id', $request->get("Id_escuela"))->firstOrFail();
                    $user->logo = $fileName_logo;

                } catch (\Exception $e) {
                    \Log::error("Error al quitar el fondo de la imagen logo: " . $e->getMessage());

                    // Si la API falla, copiar la imagen original a la segunda ruta
                    $filePathCopy = $ruta_manual_logo . $fileName_logo;
                    copy($filePathOriginal, $filePathCopy);

                    // Actualizar el registro del usuario con el nombre del archivo original
                    $user = User::where('id', $request->get("Id_escuela"))->firstOrFail();
                    $user->logo = $fileName_logo;
                }

                // Guardar cambios en el registro del usuario
                $user->update();

            }else{
                $file_logo = $request->file('logo');
                $fileName_logo = uniqid() . $file_logo->getClientOriginalName();
                $file_logo->move($ruta_manual, $fileName_logo);

                $user = User::where('id', $request->get("Id_escuela"))->firstOrFail();
                // Guardar en la primera ruta
                $user->logo = $fileName_logo;

                // Copiar el archivo a la segunda ruta
                $filePathOriginal = $ruta_manual . $fileName_logo;
                $filePathCopy = $ruta_manual_logo . $fileName_logo;
                copy($filePathOriginal, $filePathCopy);
                $user->update();
            }

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


            if($request->get('documentos_design') == 'si'){
                $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('clave_rfc','capitalizar','tam_letra_foli_cedu_tras','tam_letra_foli_cedu','tam_letra_espec_cedu','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_logo'));
            }else{
                $pdf = PDF::loadView('admin.pdf.nuevos.cedula',compact('clave_rfc','capitalizar','tam_letra_foli_cedu_tras','tam_letra_foli_cedu','tam_letra_espec_cedu','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_logo'));
            }

            $pdf->setPaper('A4', 'portrait');
            $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Cambiar 'a tamaño oficio 12.7x17.7'

            return $pdf->stream('CN-Cedula de identidad papel_'.$nombre.'.pdf');

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

            if($request->get('documentos_design') == 'si'){
                $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('clave_rfc','fileName_firma_directorOtra','firma_directora2','firma_directora','tam_letra_nombre','capitalizar','director','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_firma_director','nacionalidad', 'fileName_logo'));
            }else{
                $pdf = PDF::loadView('admin.pdf.nuevos.titulo',compact('clave_rfc','fileName_firma_directorOtra','firma_directora2','firma_directora','tam_letra_nombre','capitalizar','director','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_firma_director','nacionalidad', 'fileName_logo'));
            }

            // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

            $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
            // return $pdf->stream();
             return $pdf->stream('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

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

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('clave_rfc','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_firma_director','nacionalidad', 'fileName_logo'));

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

            if($request->get('documentos_design') == 'si'){
                $pdf = PDF::loadView('admin.pdf.diploma_imnas',compact('clave_rfc','firma_directora2','firma_directora','capitalizar','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_firma_director', 'fileName_logo', 'director'));
            }else{
                $pdf = PDF::loadView('admin.pdf.nuevos.diploma',compact('clave_rfc','firma_directora2','firma_directora','capitalizar','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','fileName_firma_director', 'fileName_logo', 'director'));
            }

            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)


            return $pdf->stream('CN-Doploma_imnas_'.$nombre.'.pdf');

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

            if($request->get('documentos_design') == 'si'){
                $pdf = PDF::loadView('admin.pdf.credencial',compact('clave_rfc','tam_letra_esp_cred','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad', 'fileName_logo'));
            }else{
                $pdf = PDF::loadView('admin.pdf.nuevos.credencial',compact('clave_rfc','tam_letra_esp_cred','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad', 'fileName_logo'));
            }

            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

            return $pdf->stream('CN-Credencial_'.$nombre.'.pdf');

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

            $pdf = PDF::loadView('admin.pdf.tira_materias_aparatologia',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

            $idMateria = RegistroImnasEspecialidad::where('especialidad', $ticket->nom_curso)->where('id_cliente', $request->id_usuario)->first();

            $subtemas = RegistroImnasTemario::
            where('id_materia', $idMateria->id)
            ->orderBy('id')
            ->get();

            $pdf = PDF::loadView('admin.pdf.tira_materias_afiliados',compact('clave_rfc','promedio','tam_letra_tira_afi','subtemas','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.tira_materias_alasiados',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosmetologia_fc',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosmeatria_ea',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.tira_materias_auxiliar',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.tira_materias_masoterapia',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosme',compact('clave_rfc','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

            $pdf = PDF::loadView('admin.pdf.tira_materias_drenaje',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad', 'fileName_logo'));
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

    public function update_especialidades(Request $request, $id){
        $registro_imnas_especialidad = RegistroImnasEspecialidad::where('id', $id)->first();
        $registro_imnas_especialidad->especialidad = $request->get('especialidad');
        $registro_imnas_especialidad->update();

        $registro_imnas_temario = RegistroImnasTemario::where('id_materia', $id)->get();
        foreach ($registro_imnas_temario as $materia) {
            $inputName = 'subtema_' . $materia->id; // El nombre del input en el form

            if ($request->has($inputName)) {
                // Actualizar el subtema correspondiente
                $materia->subtema = $request->input($inputName);
                $materia->save();
            }
        }

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }

    public function update_guia(Request $request){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_guias = base_path('../public_html/plataforma.imnasmexico.com/guias');
        }else{
            $ruta_guias = public_path() . '/guias';
        }

        $registro_imnas = RegistroImnas::where('id', $request->id_registro)->firstOrFail();

        if ($request->hasFile("num_guia")) {
            $file = $request->file('num_guia');
            $path = $ruta_guias;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $registro_imnas->num_guia = $fileName;
        }

        $registro_imnas->fecha_enviados = date('Y-m-d');
        $registro_imnas->update();

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }

    public function store(Request $request){

        $clave = $request->clave_clasificacion === 'Otra Clave'
        ? $request->otra_clave
        : $request->clave_clasificacion;


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
                $user->clave_clasificacion = $clave;
                $user->costos_diferentes = $request->get('costos_diferentes');
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
                $user->clave_clasificacion = $clave;
                $user->costos_diferentes = $request->get('costos_diferentes');
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
            $payer->clave_clasificacion = $clave;
            $payer->costos_diferentes = $request->get('costos_diferentes');
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
            $order->foto = $fileName;
        }

        $order->forma_pago = $request->get('forma_pago');
        $order->pago2 = $request->get('pago2');

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $order->foto2 = $fileName;
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
        $registro_imnas_esp->estatus_imnas = 1;
        $registro_imnas_esp->id_documento = 0;
        $registro_imnas_esp->save();

        return redirect()->back()->with('success', 'datos actualizado con exito.');
    }

    public function update_registro(Request $request, $id){
        $user = User::findOrFail($id);

        $user->name = $request->get('name');
        $user->telefono = $request->get('telefono');
        $user->email = $request->get('email');
        $user->habilitar_btn = $request->get('habilitar_btn');
        $user->clave_clasificacion = $request->get('clave_clasificacion') === 'Otra'
            ? $request->get('otra_clave')
            : $request->get('clave_clasificacion');

        if ($request->has('telefono')) {
            $user->password = Hash::make($request->get('telefono'));
        }

        $user->update();
        return redirect()->back()->with('success', 'Datos actualizados con éxito.');
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

    public function reporte(){

        $registros_imnas = DocumenotsGenerador::where('estatus', '=', 'Generado y descargado Registro IMNAS')
        ->whereDate('created_at', Carbon::today())
        ->get();

        return view('admin.registro_imnas.reporte', compact('registros_imnas'));
    }

    public function buscador(Request $request){
        $query = DocumenotsGenerador::query();
        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $fechaInicio = $request->input('fecha_inicio') . ' 00:00:00';
            $fechaFin = $request->input('fecha_fin') . ' 23:59:59';

            $query->whereBetween('created_at', [$fechaInicio, $fechaFin]);
        }

        $registros_imnas = $query->get();

        return view('admin.registro_imnas.reporte',compact('registros_imnas'));
    }

    public function reporte_pdf(Request $request)
    {
        $today =  date('d-m-Y');
        $fechaInicialDe = \Carbon\Carbon::parse($request->fecha_inicial_de)->startOfDay();
        $fechaInicialA = \Carbon\Carbon::parse($request->fecha_inicial_a)->endOfDay();

        $query = DocumenotsGenerador::query();
        if ($request->has('fecha_inicial') && $request->has('fecha_fin')) {

            $fechaInicio = $request->input('fecha_inicial') . ' 00:00:00';
            $fechaFin = $request->input('fecha_fin') . ' 23:59:59';

            $query->whereBetween('created_at', [$fechaInicio, $fechaFin]);
        }


        $registros_imnas = $query->get();

        $pdf = \PDF::loadView('admin.registro_imnas.pdf_reporte', compact('registros_imnas', 'today'));

        return $pdf->download('pdf_reporte'.$today.'.pdf');

    }

    public function imprimir_especialidad($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $especialidad = RegistroImnasEspecialidad::find($id);
        $temario = RegistroImnasTemario::where('id_materia', $especialidad->id)->get();


        $pdf = \PDF::loadView('admin.tabs_registro.pdf_especialidad', compact('especialidad', 'today', 'temario'));
        return $pdf->stream();
       //  return $pdf->download('Cotizacion Cosmica'. $folio .'/'.$today.'.pdf');
    }

    public function actualizarEstatus(Request $request){
        $especialidad = RegistroImnasEspecialidad::find($request->id);
        if ($especialidad) {
            $especialidad->estatus_imnas = $request->estatus;
            $especialidad->save();

            return response()->json(['success' => 'Estatus actualizado correctamente.']);
        }

        return response()->json(['error' => 'Registro no encontrado.'], 404);
    }

    public function actualizarEstatusEnvio(Request $request){
        $especialidad = OrdersTickets::find($request->id);
        if ($especialidad) {
            $especialidad->estatus_imnas = $request->estatus;
            $especialidad->save();

            return response()->json(['success' => 'Estatus actualizado correctamente.']);
        }

        return response()->json(['error' => 'Registro no encontrado.'], 404);
    }
}
