<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\OrdersTickets;
use Session;
use Str;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    public function index()
    {
        $cursos = Cursos::orderBy('id','DESC')->get();

        return view('admin.cursos.index', compact('cursos'));
    }

    public function show($slug)
    {
        $fechaActual = date('Y-m-d');
        $curso = Cursos::where('slug','=', $slug)->firstOrFail();
        $tickets = CursosTickets::where('id_curso','=', $curso->id)->where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();

        // $user_tickets = OrdersTickets::where('id_user','<=', auth()->user()->id)->first();

        return view('user.single_course', compact('curso', 'tickets'));
    }

    public function create()
    {
        return view('admin.cursos.create');
    }

    public function store(Request $request)
    {
        $curso = new Cursos;
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/curso';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto = $fileName;
        }
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
            ->with('success', 'curso created successfully.');
    }

    public function edit($id)
    {
        $curso = Cursos::find($id);
        $tickets = CursosTickets::where('id_curso', '=', $id)->get();

        return view('admin.cursos.edit', compact('curso', 'tickets'));
    }

    public function update(Request $request, $id)
    {

        $curso = Cursos::find($id);
        $curso->nombre = $request->get('nombre');
        $curso->descripcion = $request->get('descripcion');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/curso';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $curso->foto = $fileName;
        }
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
        $curso->clase_grabada = $request->get('clase_grabada');

        $curso->update();

        // G U A R D A R  T I C K E T
        $nombre_ticket = $request->get('nombre_ticket');
        $descripcion_ticket = $request->get('descripcion_ticket');
        $precio_ticket = $request->get('precio');
        $fecha_inicial_ticket = $request->get('fecha_inicial_ticket');
        $fecha_final_ticket = $request->get('fecha_final_ticket');
        $descuento = $request->get('descuento');

        // if ($request->get('nombre_ticket') != NULL) {
        //     for ($count = 0; $count < count($nombre_ticket); $count++) {
        //         $data = array(
        //             'id_curso' => $curso->id,
        //             'nombre' => $nombre_ticket[$count],
        //             'descripcion' => $descripcion_ticket[$count],
        //             'precio' => $precio_ticket[$count],
        //             'fecha_inicial' => $fecha_inicial_ticket[$count],
        //             'fecha_final' => $fecha_final_ticket[$count],
        //             'descuento' => $descuento[$count],
        //         );
        //         $insert_data[] = $data;
        //     }
        //     CursosTickets::insert($insert_data);
        // }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('cursos.index')
            ->with('success', 'curso created successfully.');
    }

    public function index_user()
    {
        $DateAndTime = date('h:i', time());
        $fechaActual = date('Y-m-d');
        $cursos = Cursos::get();

        $tickets = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->get();

        return view('user.calendar', compact('cursos', 'tickets'));
    }
}
