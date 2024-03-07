<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Event;
use App\Models\RecordatoriosCursos;
use App\Models\CursosTickets;
use App\Models\Orders;
use App\Models\OrdersTickets;
use App\Models\User;
use Session;
use App\Mail\PlantillaTicket;
use App\Models\Carpetas;
use App\Models\CarpetasEstandares;
use App\Models\MaterialClase;
use App\Models\CursosEstandares;
use App\Models\Recursos;
use Illuminate\Support\Facades\Mail;
use Str;
use App\Models\Estandar;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DB;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use App\Models\Tipodocumentos;


class CursosController extends Controller
{
    public function index(Request $request)
    {
        // $cursos = Cursos::orderBy('id','DESC')->get();
        $cursos = Cursos::select('id', 'nombre', 'foto', 'fecha_inicial', 'fecha_final', 'recurso', 'modalidad', 'slug', 'clase_grabada', 'clase_grabada2', 'clase_grabada3', 'clase_grabada4', 'clase_grabada5')
                ->orderBy('fecha_inicial', 'DESC')
                ->with('orderTicket')
                ->get();

        return view('admin.cursos.index', compact('cursos'));
    }

    public function filtro(Request $request){
        $cursos = Cursos::orderBy('fecha_inicial', 'DESC');

        if( $request->fecha_inicial_de && $request->fecha_inicial_a ){
            $cursos = $cursos->where('fecha_inicial', '>=', $request->fecha_inicial_de)
                                     ->where('fecha_inicial', '<=', $request->fecha_inicial_a);
        }
        $cursos = $cursos->get();

        return view('admin.cursos.index_dia', compact('cursos'));
    }

    public function index_dia(Request $request)
    {
        $fechaActual = date('Y-m-d');
        $cursos = Cursos::where('fecha_inicial', '<=', $fechaActual)
        ->where('fecha_final', '>=', $fechaActual)
        ->orWhere(function ($query) use ($fechaActual) {
            $query->where('fecha_inicial', '<=', $fechaActual)
                ->where('fecha_final', '>=', $fechaActual);
        })
        ->where('estatus', '=', '1')
        ->orderBy('fecha_inicial', 'DESC')
        ->with('orderTicket')
        ->get();

        return view('admin.cursos.index_dia', compact('cursos'));
    }

    public function index_mes(Request $request)
    {
        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $cursos = Cursos::whereBetween('fecha_inicial', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('fecha_inicial', 'DESC')
        ->get();

        foreach ($cursos as $curso) {
            $curso->userCount = $curso->uniqueOrderTicketCount();
        }

        return view('admin.cursos.index_mes', compact('cursos'));
    }

    public function create()
    {
        $profesores = User::where('cliente', '2')
        ->orWhere('cliente', '5')
        ->orderBy('id', 'DESC')
        ->get();
        $estandares = CarpetasEstandares::orderBy('nombre','asc')->get();
        $fotos_online = Recursos::where('tipo', '=', 'Online')->get();
        $fotos_presencial = Recursos::where('tipo', '=', 'Presencial')->get();
        $fotos_pdf = Recursos::where('tipo', '=', 'PDF')->get();
        $fotos_materialeso = DB::table('recursos')
        ->select('material', 'nombre')
        ->where('tipo', '=', 'Online')
        ->where('material', '!=', NULL)
        ->get();

        $fotos_materialesp = DB::table('recursos')
        ->select('material', 'nombre')
        ->where('tipo', '=', 'Presencial')
        ->where('material', '!=', NULL)
        ->get();

        $fotos_pdf = DB::table('recursos')
        ->select('pdf', 'nombre')
        ->where('pdf', '!=', NULL)
        ->get();

        $carpetas = Carpetas::get();

        return view('admin.cursos.create', compact('fotos_online','fotos_presencial','fotos_pdf', 'fotos_materialeso', 'fotos_materialesp','estandares', 'carpetas','profesores'));
    }

    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_materiales = base_path('../public_html/plataforma.imnasmexico.com/materiales');
            $ruta_curso = base_path('../public_html/plataforma.imnasmexico.com/curso');
            $pdf = base_path('../public_html/plataforma.imnasmexico.com/pdf');
        }else{
            $ruta_materiales = public_path() . '/materiales';
            $ruta_curso = public_path() . '/curso';
            $pdf = public_path() . '/pdf';
        }
        $curso = new Cursos;
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');
        $curso->btn_cotizacion = $request->get('btn_cotizacion');
        $curso->foto = $request->get('foto');
        $curso->pdf = $request->get('pdf');
        $curso->materiales = $request->get('materiales');
        $curso->id_estandar = $request->get('id_estandar');
        $curso->texto_rvoe = $request->get('texto_rvoe');
        $curso->sin_fin = $request->get('sin_fin');
        $curso->fecha_inicial = $request->get('fecha_inicial');
        $curso->hora_inicial = $request->get('hora_inicial');
        $curso->fecha_final = $request->get('fecha_final');
        $curso->hora_final = $request->get('hora_final');
        $curso->categoria = $request->get('categoria');
        $curso->modalidad = $request->get('modalidad');
        $curso->objetivo = $request->get('objetivo');
        $curso->temario = $request->get('temario');
        $curso->sep = $request->get('sep');
        $curso->unam = $request->get('unam');
        $curso->stps = $request->get('stps');
        $curso->redconocer = $request->get('redconocer');
        $curso->imnas = $request->get('imnas');
        $curso->recurso = $request->get('recurso');
        $curso->informacion = $request->get('informacion');
        $curso->destacado = $request->get('destacado');
        $curso->estatus = $request->get('estatus');
        $curso->seccion_unam = $request->get('seccion_unam');
        $curso->titulo_hono = $request->get('titulo_hono');

        $curso->pack_stps = $request->get('pack_stps');
        $curso->p_stps_1 = $request->get('p_stps_1');
        $curso->p_stps_2 = $request->get('p_stps_2');
        $curso->p_stps_3 = $request->get('p_stps_3');
        $curso->p_stps_4 = $request->get('p_stps_4');
        $curso->p_stps_5 = $request->get('p_stps_5');
        $curso->p_stps_6 = $request->get('p_stps_6');

        $curso->direccion = $request->get('direccion');
        $curso->mapa_iframe = $request->get('mapa_iframe');

        $curso->texto_conocer = $request->get('texto_conocer');
        $curso->carpeta = $request->get('carpeta');
        $curso->id_profesor = $request->get('id_profesor');
        $curso->visibilidad_productos = $request->get('visibilidad_productos');
        $curso->visibilidad_liga_clase = $request->get('visibilidad_liga_clase');
        $curso->visibilidad_metodos_pago = $request->get('visibilidad_metodos_pago');
        $curso->visibilidad_faqs = $request->get('visibilidad_faqs');
        $curso->visibilidad_contactanos = $request->get('visibilidad_contactanos');
        $curso->visibilidad_carusel = $request->get('visibilidad_carusel');
        $curso->sin_fin_fecha = $request->get('sin_fin_fecha');
        $curso->mensaje = $request->get('mensaje');
        $valorAleatorio = uniqid();
        $curso->slug = Str::of($request->get('nombre'))->slug("-")->limit(300 - mb_strlen($valorAleatorio) - 1, "")->trim("-")->append("-", $valorAleatorio);

        $curso->save();

        $id_estandar = $request->get('id_estandar');
        $carpeta_est_id = $request->input('carpeta_est_id');

        if($id_estandar != NULL){
            for ($count = 0; $count < count($id_estandar); $count++) {
                $data = array(
                    'id_curso' => $curso->id,
                    'id_carpeta' => $id_estandar[$count],
                );
                    CursosEstandares::create($data);
            }
        }

        $evento = new Event;
        $evento->title = $curso->nombre;
        $evento->start = $curso->fecha_inicial;
        $evento->end = $curso->fecha_final;
        $evento->id_profesor = $request->get('id_profesor');
        $evento->id_curso = $curso->id;
        $evento->save();

        // G U A R D A R  T I C K E T
        $nombre_ticket = $request->get('nombre_ticket');
        $descripcion_ticket = $request->get('descripcion_ticket');
        $precio_ticket = $request->get('precio');
        $fecha_inicial_ticket = $request->get('fecha_inicial_ticket');
        $fecha_final_ticket = $request->get('fecha_final_ticket');

        for ($count = 0; $count < count($nombre_ticket); $count++) {
            $data = array(
                'id_curso' => $curso->id,
                'nombre' => $nombre_ticket[$count],
                'descripcion' => $descripcion_ticket[$count],
                'precio' => $precio_ticket[$count],
                'fecha_inicial' => $fecha_inicial_ticket[$count],
                'fecha_final' => $fecha_final_ticket[$count],
                'imagen' => $curso->foto,
            );
            $insert_data[] = $data;
        }

        CursosTickets::insert($insert_data);

        $ticket = CursosTickets::orderBy('id','DESC')->first();
        $curso = Cursos::find($curso->id);
        $curso->precio = $ticket->precio;
        $curso->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('cursos.index_mes')
            ->with('success', 'curso creado con exito.');
    }

    public function edit($id)
    {
        $profesores = User::where('cliente', '2')
        ->orWhere('cliente', '5')
        ->orderBy('id', 'DESC')
        ->get();

        $carpetas_estandares = CarpetasEstandares::orderBy('nombre','asc')->get();
        $curso = Cursos::find($id);
        $tickets = CursosTickets::where('id_curso', '=', $id)->get();
        $fotos_online = Recursos::where('tipo', '=', 'Online')->get();
        $fotos_presencial = Recursos::where('tipo', '=', 'Presencial')->get();
        $fotos_materialeso = DB::table('recursos')
        ->select('material', 'nombre')
        ->where('tipo', '=', 'Online')
        ->where('material', '!=', NULL)
        ->get();

        $fotos_materialesp = DB::table('recursos')
        ->select('material', 'nombre')
        ->where('tipo', '=', 'Presencial')
        ->where('material', '!=', NULL)
        ->get();

        $fotos_pdf = DB::table('recursos')
        ->select('pdf', 'nombre')
        ->where('pdf', '!=', NULL)
        ->get();

        $carpetas = Carpetas::get();

        return view('admin.cursos.edit', compact('curso', 'tickets', 'fotos_online','fotos_presencial','fotos_pdf', 'fotos_materialeso', 'fotos_materialesp','carpetas_estandares', 'carpetas','profesores'));
    }

    public function update(Request $request, $id)
    {
        $fechaHoraActual = date('Y-m-d H:i:s');
        $curso = Cursos::find($id);
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');
        $curso->btn_cotizacion = $request->get('btn_cotizacion');
        $curso->foto = $request->get('foto');
        $curso->pdf = $request->get('pdf');
        $curso->materiales = $request->get('materiales');
        $curso->id_profesor = $request->get('id_profesor');

        if ($request->get('clase_grabada')) {
            $curso->clase_grabada = $request->get('clase_grabada');
            $curso->video_cad = 1;
            $curso->fecha_video = $fechaHoraActual;
        }

        $curso->clase_grabada2 = $request->get('clase_grabada2');
        $curso->clase_grabada3 = $request->get('clase_grabada3');
        $curso->clase_grabada4 = $request->get('clase_grabada4');
        $curso->clase_grabada5 = $request->get('clase_grabada5');

        $curso->sin_fin = $request->get('sin_fin');
        $curso->texto_rvoe = $request->get('texto_rvoe');
        $curso->fecha_inicial = $request->get('fecha_inicial');
        $curso->hora_inicial = $request->get('hora_inicial');
        $curso->fecha_final = $request->get('fecha_final');
        $curso->hora_final = $request->get('hora_final');
        $curso->categoria = $request->get('categoria');
        $curso->modalidad = $request->get('modalidad');
        $curso->objetivo = $request->get('objetivo');
        $curso->temario = $request->get('temario');
        $curso->sep = $request->get('sep');
        $curso->unam = $request->get('unam');
        $curso->stps = $request->get('stps');
        $curso->redconocer = $request->get('redconocer');
        $curso->imnas = $request->get('imnas');
        $curso->recurso = $request->get('recurso');
        $curso->informacion = $request->get('informacion');
        $curso->destacado = $request->get('destacado');
        $curso->estatus = $request->get('estatus');
        $curso->seccion_unam = $request->get('seccion_unam');
        $curso->titulo_hono = $request->get('titulo_hono');

        $curso->direccion = $request->get('direccion');
        $curso->mapa_iframe = $request->get('mapa_iframe');

        $curso->pack_stps = $request->get('pack_stps');
        $curso->p_stps_1 = $request->get('p_stps_1');
        $curso->p_stps_2 = $request->get('p_stps_2');
        $curso->p_stps_3 = $request->get('p_stps_3');
        $curso->p_stps_4 = $request->get('p_stps_4');
        $curso->p_stps_5 = $request->get('p_stps_5');
        $curso->p_stps_6 = $request->get('p_stps_6');

        $curso->texto_conocer = $request->get('texto_conocer');
        $curso->precio = $request->get('precio_curso');
        $curso->carpeta = $request->get('carpeta');
        $curso->visibilidad_productos = $request->get('visibilidad_productos');
        $curso->visibilidad_liga_clase = $request->get('visibilidad_liga_clase');
        $curso->visibilidad_metodos_pago = $request->get('visibilidad_metodos_pago');
        $curso->visibilidad_faqs = $request->get('visibilidad_faqs');
        $curso->visibilidad_contactanos = $request->get('visibilidad_contactanos');
        $curso->visibilidad_carusel = $request->get('visibilidad_carusel');
        $curso->sin_fin_fecha = $request->get('sin_fin_fecha');
        $curso->mensaje = $request->get('mensaje');
        $curso->update();

        // G U A R D A R  EVENTOS Y ACTUALZ
        $evento_single = Event::where('id_curso','=',$curso->id)->first();
        if($evento_single == null){
            $evento = new Event;
            $evento->title = $curso->nombre;
            $evento->start = $curso->fecha_inicial;
            $evento->end = $curso->fecha_final;
            $evento->id_profesor = $request->get('id_profesor');
            $evento->id_curso = $curso->id;
            $evento->save();
        }else{
        $evento_single2 = Event::where('id_curso','=',$curso->id)->first();
            if ($evento_single2) {
                $evento_single2->title = $curso->nombre;
                $evento_single2->start = $curso->fecha_inicial;
                $evento_single2->end = $curso->fecha_final;
                $evento_single2->id_profesor = $request->get('id_profesor');
                $evento_single2->id_curso = $curso->id;
                $evento_single2->update();
            }
        }

        // G U A R D A R  T I C K E T
        $nombre_ticket = $request->input('nombre_ticket');
        $descripcion_ticket = $request->input('descripcion_ticket');
        $precio_ticket = $request->input('precio');
        $fecha_inicial_ticket = $request->input('fecha_inicial_ticket');
        $fecha_final_ticket = $request->input('fecha_final_ticket');
        $descuento = $request->get('descuento');
        $ticket_ids = $request->input('ticket_id');

        for ($count = 0; $count < count($nombre_ticket); $count++) {
            $data = array(
                'id_curso' => $curso->id,
                'nombre' => $nombre_ticket[$count],
                'descripcion' => $descripcion_ticket[$count],
                'precio' => $precio_ticket[$count],
                'fecha_inicial' => $fecha_inicial_ticket[$count],
                'fecha_final' => $fecha_final_ticket[$count],
                'descuento' => $descuento[$count],
                'imagen' => $curso->foto,
            );

            if (isset($ticket_ids[$count])) {
                // Actualizar el ticket existente
                $ticket = CursosTickets::findOrFail($ticket_ids[$count]);
                $ticket->update($data);
            } elseif($nombre_ticket[$count] != NULL) {
                // Crear un nuevo ticket
                CursosTickets::create($data);

            }
        }

        $id_estandar = $request->get('id_estandar');
        $carpeta_est_id = $request->input('carpeta_est_id');

        if($id_estandar != NULL){
            for ($count = 0; $count < count($id_estandar); $count++) {
                $data = array(
                    'id_curso' => $curso->id,
                    'id_carpeta' => $id_estandar[$count],
                );
                    CursosEstandares::create($data);
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'curso actualizado con exito.');
    }

    public function update_meet(Request $request, $id){

        $fechaHoraActual = date('Y-m-d H:i:s');

        $curso = Cursos::find($id);

        if ($request->get('clase_grabada')) {
            $curso->clase_grabada = $request->get('clase_grabada');
            $curso->video_cad = 1;
            $curso->fecha_video = $fechaHoraActual;
        }
        $curso->clase_grabada2 = $request->get('clase_grabada2');
        $curso->clase_grabada3 = $request->get('clase_grabada3');
        $curso->clase_grabada4 = $request->get('clase_grabada4');
        $curso->clase_grabada5 = $request->get('clase_grabada5');
        $curso->recurso = $request->get('recurso');

        if($request->get('video_cad') == 1){
            $curso->video_cad = $request->get('video_cad');
            $curso->fecha_video = $fechaHoraActual;
        }

        $curso->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'curso actualizado con exito.');
    }

    public function update_materialclase(Request $request, $id){

        $dominio = $request->getHost();
        if ($dominio == 'plataforma.imnasmexico.com') {
            $archivo = base_path('../public_html/plataforma.imnasmexico.com/material_clase');
        } else {
            $archivo = public_path() . '/material_clase';
        }

            $nuevosCampos = $request->input('campo');
            $nuevosCampos2 = $request->input('campo1');

            foreach ($nuevosCampos as $index => $campo) {
                $material_clase = new MaterialClase;
                $material_clase->id_curso = $id;
                $material_clase->nombre = $campo;

                if (isset($nuevosCampos2[$index])) {
                    $file = $nuevosCampos2[$index];
                    $path = $archivo;
                    $fileName = uniqid() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $material_clase->file = $fileName;
                }

                $material_clase->save();
            }

        Session::flash('success', 'Se ha guardado sus datos con éxito');
        return redirect()->route('cursos.index')->with('success', 'curso actualizado con éxito.');


    }

    public function listas($id)
    {
        $curso = Cursos::find($id);
        $ordenes = OrdersTickets::where('id_curso', $id)->get();
        $tickets = CursosTickets::where('id_curso', '=', $id)->get();
        $tipo_documentos = Tipodocumentos::get();

        $estados = [
            'Aguascalientes', 'Baja California', 'Baja California Sur','CDMX', 'Campeche', 'Chiapas',
            'Chihuahua', 'Coahuila', 'Colima', 'Durango', 'Guanajuato', 'Guerrero', 'Hidalgo',
            'Jalisco', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca',
            'Puebla', 'Querétaro', 'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora',
            'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz', 'Yucatán', 'Zacatecas'
        ];

        return view('admin.cursos.listas', compact('ordenes', 'tickets', 'curso','tipo_documentos','estados'));
    }

    public function correo($id, Request $request)
    {
        $email = $request->get('email');
        $ticket = $request->get('ticket');
        $curso = $request->get('curso');
        $id_usuario = $request->get('id_usuario');

        $ordenes = OrdersTickets::where('id_curso', '=', $curso)
        ->where('id_usuario', '=', $id_usuario)
        ->get();

        foreach ($ordenes as $details) {
            Mail::to($email)->send(new PlantillaTicket($details));
        }

        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function recordatorios_store(Request $request){

        $estatus = "No enviado";

        $recordatorios = new RecordatoriosCursos;
        $recordatorios->id_curso = $request->get('id_curso');
        $recordatorios->nombre = $request->get('nombre');
        $recordatorios->email = $request->get('email');
        $recordatorios->telefono = $request->get('telefono');
        $recordatorios->estatus = $estatus;
        $recordatorios->nota = $request->get('nota');
        $recordatorios->save();

        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function duplicar($id, Request $request){

        $cursoExistente = Cursos::findOrFail($id);

        $nuevoCurso = $cursoExistente->replicate();

        // Modifica cualquier campo necesario para el nuevo curso
        $nuevoCurso->nombre = $nuevoCurso->nombre;
        $valorAleatorio = uniqid();
        $nuevoCurso->slug = Str::of($nuevoCurso->nombre)->slug("-")->limit(300 - mb_strlen($valorAleatorio) - 1, "")->trim("-")->append("-", $valorAleatorio);
        unset($nuevoCurso->recurso);
        unset($nuevoCurso->clase_grabada);
        unset($nuevoCurso->clase_grabada2);
        unset($nuevoCurso->clase_grabada3);
        unset($nuevoCurso->clase_grabada4);
        unset($nuevoCurso->clase_grabada5);

        $nuevoCurso->fecha_inicial = $request->input('fecha_inicio');
        $nuevoCurso->hora_inicial = $request->input('hora_inicio');
        $nuevoCurso->fecha_final = $request->input('fecha_final');
        $nuevoCurso->hora_final = $request->input('hora_final');
        $nuevoCurso->sin_fin = $request->input('sin_fin');
        $nuevoCurso->recurso = $request->input('recurso');

        $nuevoCurso->save();

        // ============ Agregar a calendario ============
        $evento = new Event;
        $evento->title = $nuevoCurso->nombre;
        $evento->start = $nuevoCurso->fecha_inicial;
        $evento->end = $nuevoCurso->fecha_final;
        $evento->id_profesor = $cursoExistente->id_profesor;
        $evento->id_curso = $nuevoCurso->id;
        $evento->save();

        // ============ Duplica Tickets ============
        $cursoExistente->CursosTickets->each(function ($ticket) use ($nuevoCurso) {
                $fechaActual = date('Y-m-d');
                $nuevoTicket = $ticket->replicate();
                $nuevoTicket->id_curso = $nuevoCurso->id;
                $nuevoTicket->fecha_inicial = $fechaActual;
                $nuevoTicket->fecha_final = $nuevoCurso->fecha_final;
                unset($nuevoTicket->descuento);
                $nuevoTicket->save();
        });

        // ============ Duplica Estandar ============
        $cursoExistente->CursosEstandares->each(function ($estandar) use ($nuevoCurso) {
            $nuevoEstandar = $estandar->replicate();
            $nuevoEstandar->id_curso = $nuevoCurso->id;
            $nuevoEstandar->save();
        });

        return redirect()->back()->with('success', 'El curso se ha duplicado correctamente');
    }

    public function estatus_doc(Request $request, $id){

        $order = OrdersTickets::find($id);

        if($request->estatus_redconocer == 1){
            $order->estatus_doc = '1';
            $order->estatus_cedula = '1';
            $order->estatus_titulo = '1';
            $order->estatus_diploma = '1';
            $order->estatus_credencial = '1';
            $order->estatus_tira = '1';
            $order->estatus_redconocer = '1';
        }elseif($order->CursosTickets->descripcion == 'Con opción a Documentos de certificadora IMNAS'){
            $order->estatus_doc = '1';
            $order->estatus_cedula = $request->get('estatus_cedula');
            $order->estatus_titulo = $request->get('estatus_titulo_imnas');
            $order->estatus_diploma = $request->get('estatus_diploma');
            $order->estatus_credencial = $request->get('estatus_credencial');
            $order->estatus_tira = $request->get('estatus_tira');
            $order->estatus_redconocer = '1';
        }elseif($request->estatus_titulo == '1' ){
            $order->estatus_doc = '1';
            $order->estatus_cedula = '1';
            $order->estatus_titulo = '1';
            $order->estatus_diploma = '1';
            $order->estatus_credencial = '1';
            $order->estatus_tira = '1';
            $order->estatus_redconocer = '1';
        }





        $order->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'curso actualizado con exito.');
    }
}
