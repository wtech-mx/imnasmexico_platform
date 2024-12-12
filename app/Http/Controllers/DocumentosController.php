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
use App\Models\Orders;
use App\Models\RegistroImnasTemario;

class DocumentosController extends Controller
{
    public function index(){

        $documentos = Documentos::get();
        $alumnos = User::where('cliente', '=', '1')->get();
        $cursos = Cursos::orderBy('nombre','ASC')->pluck('nombre')->unique();
        $cursosArray = $cursos->toArray();
        $tipo_documentos = Tipodocumentos::get();

        $clientes = User::where('cliente','=' ,'1')->orderBy('name','ASC')->get();


        $estados = [
            'Aguascalientes', 'Baja California', 'Baja California Sur','CDMX', 'Campeche', 'Chiapas',
            'Chihuahua', 'Coahuila', 'Colima', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo',
            'Jalisco', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca',
            'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora',
            'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'
        ];

        return view('admin.documentos.index',compact('documentos', 'alumnos','cursosArray','tipo_documentos','estados','clientes'));
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

        $clientes = User::where('cliente','=' ,'1')->orderBy('name','ASC')->get();


        $estados = [
            'Aguascalientes', 'Baja California', 'Baja California Sur','CDMX', 'Campeche', 'Chiapas',
            'Chihuahua', 'Coahuila', 'Colima', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo',
            'Jalisco', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca',
            'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora',
            'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'
        ];

        return view('admin.documentos.index',compact('documentos', 'alumnos','cursosArray','tipo_documentos','estados', 'bitacoras','clientes'));
    }

    public function getCursos($id) {
        $orders = Orders::where('id_usuario', '=', $id)->where('estatus', '=', '1')->get();
        $documentos = Documentos::where('id_usuario', '=', $id)->get();
        $cliente = User::where('id','=',$id)->first();

        $cursos = [];

        foreach ($orders as $order) {
            $order_tickets = OrdersTickets::where('id_order', '=', $order->id)->get();

            foreach ($order_tickets as $ticket) {
                $cursos[] = [
                    'id' => $ticket->Cursos->id,
                    'nombre' => $ticket->Cursos->nombre,
                    'fecha_curso' => $ticket->Cursos->fecha_inicial,
                ];
            }
        }

        // $ine = $documentos->first() ? $documentos->first()->ine : null;
        $curp = $documentos->first() ? $documentos->first()->curp : null;
        $foto_tam_titulo = $documentos->first() ? $documentos->first()->foto_tam_titulo : null;
        $foto_tam_infantil = $documentos->first() ? $documentos->first()->foto_tam_infantil : null;
        $foto_infantil_blanco = $documentos->first() ? $documentos->first()->foto_infantil_blanco : null;
        $firma = $documentos->first() ? $documentos->first()->firma : null;

        $data = [
            'cursos' => $cursos,
            'documentos' => $documentos,
            // 'ine' => $ine,
            'curp' => $curp,
            'foto_tam_titulo' => $foto_tam_titulo,
            'foto_tam_infantil' => $foto_tam_infantil,
            'firma' => $firma,
            'cliente_telefono' => $cliente->telefono,
        ];


        return response()->json($data);
    }

    public function generar(Request $request){

        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos');
        }else{
            $ruta_manual = public_path() . '/utilidades_documentos';
        }

        if ($request->get('id_client') != null) {
            // Obtener datos del request
            $foto_tam_titulo = $request->get('foto_tam_titulo');
            $foto_tam_infantil = $request->get('foto_tam_infantil');
            $firma = $request->get('firma');
            $fecha_curso = $request->get('fecha_curso');
            $duracion_hrs_curso = $request->get('duracion_hrs_curso');

            // Obtener el alumno y el curso de la base de datos
            $alumno = User::find($request->get('id_client'));
            $curso = Cursos::find($request->get('id_curso'));

            // Agrupar todos los datos en un solo array asociativo
            $data = [
                'foto_tam_titulo' => $foto_tam_titulo ?? 'default_value',
                'foto_tam_infantil' => $foto_tam_infantil ?? 'default_value',
                'firma' => $firma ?? 'default_value',
                'fecha_curso' => $fecha_curso ?? 'default_date',
                'duracion_hrs_curso' => $duracion_hrs_curso ?? 0,
                'alumno' => $alumno ?? new User(), // default User object or null
                'curso' => $curso ?? new Cursos(), // default Cursos object or null
            ];
        }

        $bitacora = new DocumenotsGenerador;

        if($request->get('curso_name') == null){
            $curso = $request->get('curso');
        }else{
            $curso = $request->get('curso_name');
        }

        $bitacora->cliente = $request->get('nombre');
        $bitacora->curso = $curso;
        $bitacora->id_usuario_bitacora = auth()->user()->id;
        $bitacora->tipo_documento = $request->get('tipo');
        $bitacora->folio = $request->get('folio');
        $bitacora->fecha_inicial = $request->get('fecha');
        $bitacora->duracion_hrs = $request->get('duracion_hrs');
        $bitacora->estatus = 'Generado y descargado';

        if ($request->hasFile("img_infantil")) {
            $file = $request->file('img_infantil');
            $path = $ruta_manual;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $bitacora->foto = $fileName;
        } else {
            $fileName = "";
        }

        if ($request->hasFile("firma")) {
            $file_firma = $request->file('firma');
            $path_firma = $ruta_manual;
            $fileName_firma = uniqid() . $file_firma->getClientOriginalName();
            $file_firma->move($path_firma, $fileName_firma);
            $bitacora->firma = $fileName;
        } else {
            $fileName_firma = "fondo_sf.png";
        }

        $bitacora->save();

        $nombre = $request->get('nombre');
        $fecha = $request->get('fecha');

        $sello = $request->get('sello');
        $duracion_hrs = $request->get('duracion_hrs');
        $tipo = $request->get('tipo');
        $folio = $request->get('folio');
        $curp = $request->get('curp');
        $nacionalidad = $request->get('nacionalidad');

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

        $capitalizar =  $request->get('capitalizar');
        $promedio = $request->get('promedio');
        $clave_rfc ='RIFC680910-879-0013';


        $tipo_documentos = Tipodocumentos::find($tipo);

        if($tipo_documentos->tipo == 'Diploma_STPS'){

            $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('clave_rfc','curso','fecha','tipo_documentos','nombre','duracion_hrs','sello'));
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('diploma_stps_'.$nombre.'.pdf');

        }if($tipo_documentos->tipo == 'Diploma Cosmica'){

            $pdf = PDF::loadView('admin.pdf.cosmica_workshop', compact('curso', 'fecha', 'tipo_documentos', 'nombre', 'duracion_hrs', 'sello'));
            // Configuración personalizada de tamaño
            $customPaper = [0, 0, 1279.5, 904.5]; // [x, y, ancho, alto] en puntos
            $pdf->setPaper($customPaper, 'portrait');

            return $pdf->download('diploma_cosmica_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Cedula de indetidad'){

            $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('clave_rfc','capitalizar','tam_letra_foli_cedu_tras','tam_letra_foli_cedu','tam_letra_espec_cedu','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));

            $pdf->setPaper('A4', 'portrait');
            $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Cambiar 'a tamaño oficio 12.7x17.7'

            return $pdf->download('CN-Cedula de identidad papel_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR'){

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('clave_rfc','tam_letra_nombre','capitalizar','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

            $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

            return $pdf->download('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Titulo Honorifico Nuevo'){

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_online_nuevo',compact('clave_rfc','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

            $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

            return $pdf->download('CN-titulo_honorifico_online_nuevo_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR_CFC'){

            $ancho_cm = 33;
            $alto_cm = 48;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('clave_rfc','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));

            //$pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); //  Cambiar 'a tamaño 48x33 super b'

            return $pdf->download('CN-Titulo Honorifico Online QR_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Diploma'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.diploma_imnas',compact('clave_rfc','capitalizar','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)


            return $pdf->download('CN-Doploma_imnas_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Credencial'){

            $ancho_cm = 5.5;
            $alto_cm = 8.5;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.credencial',compact('clave_rfc','tam_letra_esp_cred','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad'));

            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

            return $pdf->download('CN-Credencial_'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_aparatologia'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_aparatologia',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_alasiados'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_alasiados',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosmetologia_fc'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosmetologia_fc',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosmeatria_ea'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosmeatria_ea',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_auxiliar'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_auxiliar',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_masoterapia'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_masoterapia',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

        }elseif($tipo_documentos->tipo == 'Tira_materias_cosme'){
            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_cosme',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
        }elseif($tipo_documentos->tipo == 'Tira_materias_drenaje_linfatico'){

            $ancho_cm = 21.5;
            $alto_cm = 34;

            $ancho_puntos = $ancho_cm * 28.35;
            $alto_puntos = $alto_cm * 28.35;

            $pdf = PDF::loadView('admin.pdf.tira_materias_drenaje',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
            $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

            return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
        }
    }

    public function generar_alumno(Request $request){

        $nombre = $request->get('nombre');
        $fecha = $request->get('fecha');
        $curso = $request->get('curso_name');
        $duracion_hrs = $request->get('duracion_hrs');
        $tipo = $request->get('tipo');
        $sello = 'Si';
        $tipo_documentos = Tipodocumentos::find($tipo);

        $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','duracion_hrs', 'sello'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('diploma_stps_'.$nombre.'.pdf');

    }

    public function generar_alumno_dc(Request $request){

        $nombre = $request->get('nombre');

        $curp = $request->get('curp');
        $curso = $request->get('curso_name');
        $duracion_hrs = $request->get('duracion_hrs');
        $tipo = 'Formato DC-3';
        $costo = '2000';

        $fecha_inicio = $request->get('fecha_inicial');
        $fecha = $request->get('fecha');

        // Unir las dos fechas
        $fecha_inicio_sin_guiones = str_replace('-', '', $fecha_inicio);
        $fecha_sin_guiones = str_replace('-', '', $fecha);

        $fecha_unida = $fecha_inicio_sin_guiones . 'a' . $fecha_sin_guiones;


        $tipo_documentos = Tipodocumentos::where('tipo',$tipo)->first();

        $pdf = PDF::loadView('admin.pdf.documento_dc3',compact('curso','costo','curp','fecha_unida','tipo_documentos','nombre','duracion_hrs'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('documento_dc3_'.$nombre.'.pdf');

    }

    public function generar_enviar(Request $request){

        $cliente = User::where('id', $request->get('id_usuario'))->first();

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_manual = base_path('../public_html/plataforma.imnasmexico.com/utilidades_documentos/');
            $ruta_doc_alumnos = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono  . '/');
        }else{
            $ruta_manual = public_path() . '/utilidades_documentos/';
            $ruta_doc_alumnos = public_path('/documentos/' . $cliente->telefono  . '/');
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

        $horas_default = "24";
        $duracion_hrs = $horas_default;

        $email_user = $request->get('email');
        //$email_user = 'adrianwebtech@gmail.com';
        $email_diplomas = 'imnascenter@naturalesainspa.com';

        $nacionalidad = $request->get('nacionalidad');

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

        $capitalizar =  $request->get('capitalizar');
        $promedio = $request->get('promedio');
        $clave_rfc = 'RIFC680910-879-0013';

        // Si no existe la carpeta del alumno, la creamos
        if (!file_exists($ruta_doc_alumnos)) {
            mkdir($ruta_doc_alumnos, 0777, true);
        }

        if ($request->hasFile("img_infantil")) {
            $file = $request->file('img_infantil');
            $fileName = uniqid() . $file->getClientOriginalName();

            // Guardar en $ruta_manual
            $file->move($ruta_manual, $fileName);

            // Copiar a $ruta_doc_alumnos
            copy($ruta_manual . $fileName, $ruta_doc_alumnos . $fileName);

            // Actualizar en la base de datos
            $DocUser = Documentos::where('id_usuario', '=', $request->get('id_usuario'))->first();
            $DocUser->foto_tam_infantil = $fileName;
            $DocUser->update();

        } else {
            $fileName = 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
        }

        if ($request->hasFile("firma")) {
            $file_firma = $request->file('firma');
            $fileName_firma = uniqid() . $file_firma->getClientOriginalName();

            // Guardar en $ruta_manual
            $file_firma->move($ruta_manual, $fileName_firma);

            // Copiar a $ruta_doc_alumnos
            copy($ruta_manual . $fileName_firma, $ruta_doc_alumnos . $fileName_firma);

            // Actualizar en la base de datos
            $DocUser = Documentos::where('id_usuario', '=', $request->get('id_usuario'))->first();
            $DocUser->firma = $fileName_firma;
            $DocUser->update();

        } else {
            $fileName_firma = 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
        }

        $id_usuario = $request->get('id_usuario');
        $user = User::find($id_usuario);
        $user->curp_escrito = $request->get('curp');
        $user->update();

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

                if($ticket->Cursos->pack_stps == "Si"){
                    $variables = [
                        $ticket->Cursos->p_stps_1,
                        $ticket->Cursos->p_stps_2,
                        $ticket->Cursos->p_stps_3,
                        $ticket->Cursos->p_stps_4,
                        $ticket->Cursos->p_stps_5,
                        $ticket->Cursos->p_stps_6,
                    ];

                    foreach ($variables as $index => $curso) {
                        if (isset($curso) && !empty($curso)) {
                            // Lógica para crear el PDF y enviar el correo aquí
                            $sello = 'Si';
                            $pdf = PDF::loadView('admin.pdf.diploma_stps', compact('curso', 'fecha', 'tipo_documentos', 'nombre','duracion_hrs', 'sello'));
                            $pdf->setPaper('A4', 'portrait');
                            $contenidoPDF = $pdf->output();

                            Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                            // Si solo quieres generar uno, puedes agregar un break después del Mail::send
                            // break;
                        }
                    }
                }else{
                    $sello = 'Si';
                    $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','duracion_hrs', 'sello'));
                    $pdf->setPaper('A4', 'portrait');

                    $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.

                    Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                    //return redirect()->back()->with('success', 'Enviado por email correctamente');

                    //return $pdf->download('diploma_stps_'.$nombre.'.pdf');
                }

            }elseif($tipo_documentos->tipo == 'Cedula de indetidad'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_cedula = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('clave_rfc','capitalizar','tam_letra_foli_cedu_tras','tam_letra_foli_cedu','tam_letra_espec_cedu','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
                $pdf->setPaper('A4', 'portrait');
                $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Cambiar 'a tamaño oficio 12.7x17.7'

                return $pdf->download('CN-Cedula de identidad papel_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_titulo = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('clave_rfc','tam_letra_nombre','capitalizar','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

                $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

                return $pdf->download('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR_CFC'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_titulo = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();
                $ancho_cm = 33;
                $alto_cm = 48;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('clave_rfc','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));

                //$pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); //  Cambiar 'a tamaño 48x33 super b'

                return $pdf->download('CN-Titulo Honorifico Online QR_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Diploma'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_diploma = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.diploma_imnas',compact('clave_rfc','capitalizar','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)


                return $pdf->download('CN-Doploma_imnas_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Credencial'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_credencial = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 5.5;
                $alto_cm = 8.5;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.credencial',compact('clave_rfc','tam_letra_esp_cred','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

                return $pdf->download('CN-Credencial_'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_aparatologia'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_aparatologia',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_alasiados'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_alasiados',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_cosmetologia_fc'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_cosmetologia_fc',compact('clave_rfc','promedio','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_cosmeatria_ea'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_cosmeatria_ea',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_auxiliar'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_auxiliar',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_masoterapia'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_masoterapia',compact('promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

            }elseif($tipo_documentos->tipo == 'Tira_materias_cosme'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_cosme',compact('promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
            }elseif($tipo_documentos->tipo == 'Tira_materias_drenaje_linfatico'){
                $id_ticket = $request->get('id_ticket_orders');
                $ticket = OrdersTickets::find($id_ticket);
                $ticket->estatus_tira = '1';
                $ticket->folio = $request->get('folio');
                $ticket->update();

                $ancho_cm = 21.5;
                $alto_cm = 34;

                $ancho_puntos = $ancho_cm * 28.35;
                $alto_puntos = $alto_cm * 28.35;

                $pdf = PDF::loadView('admin.pdf.tira_materias_drenaje',compact('promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
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

                    if($ticket->Cursos->pack_stps == "Si"){
                        $variables = [
                            $ticket->Cursos->p_stps_1,
                            $ticket->Cursos->p_stps_2,
                            $ticket->Cursos->p_stps_3,
                            $ticket->Cursos->p_stps_4,
                            $ticket->Cursos->p_stps_5,
                            $ticket->Cursos->p_stps_6,
                        ];

                        foreach ($variables as $index => $curso) {
                            if (isset($curso) && !empty($curso)) {
                                $sello = 'Si';
                                // Lógica para crear el PDF y enviar el correo aquí
                                $pdf = PDF::loadView('admin.pdf.diploma_stps', compact('curso', 'fecha', 'tipo_documentos', 'nombre', 'sello'));
                                $pdf->setPaper('A4', 'portrait');
                                $contenidoPDF = $pdf->output();

                                Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                                // Si solo quieres generar uno, puedes agregar un break después del Mail::send
                                // break;
                            }
                        }
                    }else{
                        $sello = 'Si';
                        $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('clave_rfc','curso','fecha','tipo_documentos','nombre', 'sello'));
                        $pdf->setPaper('A4', 'portrait');

                        $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.

                        Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                        //return redirect()->back()->with('success', 'Enviado por email correctamente');

                        //return $pdf->download('diploma_stps_'.$nombre.'.pdf');
                    }

                }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR_CFC'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_doc = '1';
                    $ticket->estatus_cedula = '1';
                    $ticket->estatus_titulo = '1';
                    $ticket->estatus_diploma = '1';
                    $ticket->estatus_credencial = '1';
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 33;
                    $alto_cm = 48;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('clave_rfc','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));

                    //$pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); //  Cambiar 'a tamaño 48x33 super b'

                    return $pdf->download('CN-Titulo Honorifico Online QR_'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR'){

                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_doc = '1';
                    $ticket->estatus_cedula = '1';
                    $ticket->estatus_titulo = '1';
                    $ticket->estatus_diploma = '1';
                    $ticket->estatus_credencial = '1';
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('tam_letra_nombre','capitalizar','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));

                    $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

                    return $pdf->download('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

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

                    if($ticket->Cursos->pack_stps == "Si"){
                        $variables = [
                            $ticket->Cursos->p_stps_1,
                            $ticket->Cursos->p_stps_2,
                            $ticket->Cursos->p_stps_3,
                            $ticket->Cursos->p_stps_4,
                            $ticket->Cursos->p_stps_5,
                            $ticket->Cursos->p_stps_6,
                        ];

                        foreach ($variables as $index => $curso) {
                            if (isset($curso) && !empty($curso)) {
                                $sello = 'Si';
                                // Lógica para crear el PDF y enviar el correo aquí
                                $pdf = PDF::loadView('admin.pdf.diploma_stps', compact('curso', 'fecha', 'tipo_documentos', 'nombre', 'sello'));
                                $pdf->setPaper('A4', 'portrait');
                                $contenidoPDF = $pdf->output();

                                Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
                            }
                        }
                    }else{
                        $sello = 'Si';
                        $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre', 'sello'));
                        $pdf->setPaper('A4', 'portrait');

                        $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.

                        Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
                    }

                }
            }

            if($curso_first->imnas == '1' && $curso_first->titulo_hono == NULL){

                if($tipo_documentos->tipo == 'Diploma_STPS'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_doc = '1';
                    $ticket->update();

                    if($ticket->Cursos->pack_stps == "Si"){
                        $variables = [
                            $ticket->Cursos->p_stps_1,
                            $ticket->Cursos->p_stps_2,
                            $ticket->Cursos->p_stps_3,
                            $ticket->Cursos->p_stps_4,
                            $ticket->Cursos->p_stps_5,
                            $ticket->Cursos->p_stps_6,
                        ];

                        foreach ($variables as $index => $curso) {
                            if (isset($curso) && !empty($curso)) {
                                // Lógica para crear el PDF y enviar el correo aquí
                                $sello = 'Si';
                                $pdf = PDF::loadView('admin.pdf.diploma_stps', compact('curso', 'fecha', 'tipo_documentos', 'nombre','duracion_hrs', 'sello'));
                                $pdf->setPaper('A4', 'portrait');
                                $contenidoPDF = $pdf->output();

                                Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                                // Si solo quieres generar uno, puedes agregar un break después del Mail::send
                                // break;
                            }
                        }
                    }else{
                        $sello = 'Si';
                        $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','duracion_hrs', 'sello'));
                        $pdf->setPaper('A4', 'portrait');

                        $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.

                        Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                        //return redirect()->back()->with('success', 'Enviado por email correctamente');

                        //return $pdf->download('diploma_stps_'.$nombre.'.pdf');
                    }

                }elseif($tipo_documentos->tipo == 'Cedula de indetidad'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_cedula = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $pdf = PDF::loadView('admin.pdf.cedual_identidad_papel',compact('clave_rfc','capitalizar','tam_letra_foli_cedu_tras','tam_letra_foli_cedu','tam_letra_espec_cedu','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
                    $pdf->setPaper('A4', 'portrait');
                    $pdf->setPaper([0, 0, 12.7 * 28.35, 17.7 * 28.35], 'portrait'); // Cambiar 'a tamaño oficio 12.7x17.7'

                    return $pdf->download('CN-Cedula de identidad papel_'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_titulo = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso',compact('clave_rfc','tam_letra_nombre','capitalizar','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    // $pdf->setPaper('letter', 'portrait'); // Cambiar 'a tamaño oficio'

                    $pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'

                    return $pdf->download('CN-Titulo Honorifico con QR_'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Titulo Honorifico con QR_CFC'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_titulo = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();
                    $ancho_cm = 33;
                    $alto_cm = 48;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.titulo_honorifico_qrso2',compact('clave_rfc','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));

                    //$pdf->setPaper([0, 0, 33.0 * 28.35, 48.0 * 28.35], 'portrait'); // Cambiar 'a tamaño 48x33 super b'
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); //  Cambiar 'a tamaño 48x33 super b'

                    return $pdf->download('CN-Titulo Honorifico Online QR_'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Diploma'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_diploma = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.diploma_imnas',compact('clave_rfc','capitalizar','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)


                    return $pdf->download('CN-Doploma_imnas_'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Credencial'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_credencial = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 5.5;
                    $alto_cm = 8.5;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.credencial',compact('clave_rfc','tam_letra_esp_cred','tam_letra_folio','tam_letra_especi','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nombres','apellido_apeterno','apellido_materno','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'landscape');

                    return $pdf->download('CN-Credencial_'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Tira_materias_aparatologia'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.tira_materias_aparatologia',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                    return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Tira_materias_alasiados'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.tira_materias_alasiados',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                    return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Tira_materias_cosmetologia_fc'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.tira_materias_cosmetologia_fc',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                    return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Tira_materias_cosmeatria_ea'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.tira_materias_cosmeatria_ea',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                    return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Tira_materias_auxiliar'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.tira_materias_auxiliar',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                    return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Tira_materias_masoterapia'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.tira_materias_masoterapia',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                    return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');

                }elseif($tipo_documentos->tipo == 'Tira_materias_cosme'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.tira_materias_cosme',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                    return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
                }elseif($tipo_documentos->tipo == 'Tira_materias_drenaje_linfatico'){
                    $id_ticket = $request->get('id_ticket_orders');
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_tira = '1';
                    $ticket->folio = $request->get('folio');
                    $ticket->update();

                    $ancho_cm = 21.5;
                    $alto_cm = 34;

                    $ancho_puntos = $ancho_cm * 28.35;
                    $alto_puntos = $alto_cm * 28.35;

                    $pdf = PDF::loadView('admin.pdf.tira_materias_drenaje',compact('clave_rfc','promedio','curso','fecha','tipo_documentos','nombre','folio','curp','fileName','fileName_firma','nacionalidad'));
                    $pdf->setPaper([0, 0, $ancho_puntos, $alto_puntos], 'portrait'); // Cambiar al tamaño 21.5x34 (cm to points)

                    return $pdf->download('CN-Tira_de_materias'.$nombre.'.pdf');
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
