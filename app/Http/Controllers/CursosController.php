<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\Orders;
use App\Models\OrdersTickets;
use Session;
use App\Mail\PlantillaTicket;
use Illuminate\Support\Facades\Mail;
use Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CursosController extends Controller
{
    public function index(Request $request)
    {
        $cursos = Cursos::orderBy('id','DESC')->get();

        return view('admin.cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('admin.cursos.create');
    }

    public function store(Request $request)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_materiales = base_path('../public_html/plataforma.imnasmexico.com/materiales');
            $ruta_curso = base_path('../public_html/plataforma.imnasmexico.com/curso');
        }else{
            $ruta_materiales = public_path() . '/materiales';
            $ruta_curso = public_path() . '/curso';
        }
        $curso = new Cursos;
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');

        if ($request->hasFile("materiales")) {
            $file = $request->file('materiales');
            $path = $ruta_materiales;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->materiales = $fileName;
        }

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_curso;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto = $fileName;
        }

        $curso->clase_grabada = $request->get('clase_grabada');
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


        $valorAleatorio = uniqid();
        $curso->slug = Str::of($request->get('nombre'))->slug("-")->limit(300 - mb_strlen($valorAleatorio) - 1, "")->trim("-")->append("-", $valorAleatorio);

        $curso->save();

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
        return redirect()->route('cursos.index')
            ->with('success', 'curso creado con exito.');
    }

    public function edit($id)
    {
        $curso = Cursos::find($id);
        $tickets = CursosTickets::where('id_curso', '=', $id)->get();

        return view('admin.cursos.edit', compact('curso', 'tickets'));
    }

    public function update(Request $request, $id)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_materiales = base_path('../public_html/plataforma.imnasmexico.com/materiales');
            $ruta_curso = base_path('../public_html/plataforma.imnasmexico.com/curso');
            $ruta_video = base_path('../public_html/plataforma.imnasmexico.com/clase_grabada');
        }else{
            $ruta_materiales = public_path() . '/materiales';
            $ruta_curso = public_path() . '/curso';
            $ruta_video = public_path() . '/clase_grabada';
        }

        $fechaHoraActual = date('Y-m-d H:i:s');
        $curso = Cursos::find($id);
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');

        if ($request->hasFile("materiales")) {
            $file = $request->file('materiales');
            $path = $ruta_materiales;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->materiales = $fileName;
        }

        // if ($request->hasFile("clase_grabada")) {
        //     $file = $request->file('clase_grabada');
        //     $path = $ruta_video;
        //     $fileName2 = uniqid() . $file->getClientOriginalName();
        //     $file->move($path, $fileName2);
        //     $curso->clase_grabada = $fileName2;
        //     $curso->video_cad = 1;
        //     $curso->fecha_video = $fechaHoraActual;
        // }

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $ruta_curso;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto = $fileName;
        }

        $curso->clase_grabada = $request->get('clase_grabada');
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

        $curso->update();

        // G U A R D A R  T I C K E T
        $nombre_ticket = $request->get('nombre_ticket');
        $descripcion_ticket = $request->get('descripcion_ticket');
        $precio_ticket = $request->get('precio');
        $fecha_inicial_ticket = $request->get('fecha_inicial_ticket');
        $fecha_final_ticket = $request->get('fecha_final_ticket');
        $descuento = $request->get('descuento');

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('cursos.index')
            ->with('success', 'curso actualizado con exito.');
    }

    public function listas($id)
    {
        $curso = Cursos::find($id);
        $ordenes = OrdersTickets::where('id_curso', '=', $id)->get();
        $tickets = CursosTickets::where('id_curso', '=', $id)->get();

        return view('admin.cursos.listas', compact('ordenes', 'tickets', 'curso'));
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
}
