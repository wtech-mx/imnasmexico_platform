<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cursos;
use App\Models\CursosTickets;
use App\Models\Orders;
use App\Models\OrdersTickets;
use App\Models\ProductosNotasCosmica;
use App\Models\ProductosNotasId;
use Session;
use Hash;
use Str;
use Auth;
use Carbon\Carbon;

class ProfesoresController extends Controller
{
    public function index_profesores(Request $request){
        $users =  User::where('cliente','2')->orWhere('cliente', '5')->orderBy('id','DESC')->get();
        return view('admin.profesores.index', compact('users'));
    }

    public function index_profesor_single($id){

        $id_profesor = auth::user()->id;

        $curso = Cursos::find($id);

        $profesor =  User::where('id','=',$curso->id_profesor)->first();

        $ordenes = OrdersTickets::where('id_curso', '=', $id)->get();
        $tickets = CursosTickets::where('id_curso', '=', $id)->get();
        $ticketCount = CursosTickets::where('id_curso', '=', $id)->count();

        return view('profesor.single_clase', compact('curso', 'ordenes', 'tickets','ticketCount','profesor'));
    }



    public function index_clase(Request $request)
    {
        $id_profesor = auth::user()->id;
        $tipo_profesor = auth::user()->cliente;

        if($tipo_profesor == '2'){

            $cursos = Cursos::where('id_profesor', $id_profesor)
            ->withCount(['ordersTickets as alumnos_pagados' => function ($query) {
                $query->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                    ->where('orders.estatus', 1);
            }])
            ->whereDate('fecha_inicial', '>=', Carbon::yesterday())
            ->orderBy('fecha_inicial', 'ASC')
            ->get();

        }else if($tipo_profesor == '5'){

            $cursos = Cursos::withCount(['ordersTickets as alumnos_pagados' => function ($query) {
                $query->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                    ->where('orders.estatus', 1);
            }])

            ->whereDate('fecha_inicial', '>=', Carbon::yesterday())
            ->orderBy('fecha_inicial', 'ASC')
            ->get();
        }

        return view('profesor.clases', compact('cursos'));
    }


    public function dashboard(Request $request){
        $id_profesor = auth::user()->id;

        $tipo_profesor = auth::user()->cliente;

        if($tipo_profesor == '2'){

            $cursos = Cursos::where('estatus','=', '1')->where('id_profesor', '=', $id_profesor)->count();

        }else if($tipo_profesor == '5'){

            $cursos = Cursos::where('estatus','=', '1')->count();
        }

        return view('profesor.dashboard', compact('cursos'));
    }

    public function ChangeAsistenciaStatus(Request $request)
    {
        $asistencia = Orders::find($request->id);
        $asistencia->asistencia = $request->asistencia;
        $asistencia->save();

        return response()->json(['success' => 'Asistencia registrada.']);
    }

    public function store_profesores(Request $request){
        $code = Str::random(8);
        $profesor = new User;
        $profesor->name = $request->get('name');
        $profesor->email = $request->get('email');
        $profesor->username = $request->get('telefono');
        $profesor->code = $code;
        $profesor->telefono = $request->get('telefono');
        $profesor->cliente = '2';
        $profesor->password = Hash::make($request->get('telefono'));
        $profesor->save();

        return back()->with('success', 'Profesor agregado');
    }

    public function update_profesores(Request $request, $id){
        $profesor = User::find($id);
        $profesor->name = $request->get('name');
        $profesor->email = $request->get('email');
        $profesor->username = $request->get('telefono');
        $profesor->telefono = $request->get('telefono');
        $profesor->password = Hash::make($request->get('telefono'));
        $profesor->update();

        return back()->with('success', 'Profesor agregado');
    }


    public function asistencia_expo() {
        $ordenes = ProductosNotasCosmica::whereIn('id_producto', [1952, 1881, 1882])
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->with('Nota') // Cargar la relación Nota
            ->get();

        $ordenes_acompañante = ProductosNotasCosmica::where('id_producto', 1881)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $ordenes_sin_acompañante = ProductosNotasCosmica::where('id_producto', 1882)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $ordenes_basico = ProductosNotasCosmica::where('id_producto', 1952)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $multi = $ordenes_acompañante * 2;

        $ordenes_nas = ProductosNotasId::whereIn('id_producto', [1952, 1881, 1882])
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->with('Nota') // Cargar la relación Nota
            ->get();

        $ordenes_nas_acompañante = ProductosNotasId::where('id_producto', 1881)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $ordenes_nas_sin_acompañante = ProductosNotasId::where('id_producto', 1882)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $ordenes_nas_basico = ProductosNotasId::where('id_producto', 1952)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $multi_nas = $ordenes_nas_acompañante * 2;

        $totalPersonas = $multi_nas + $ordenes_nas_sin_acompañante + $ordenes_nas_basico + $multi + $ordenes_sin_acompañante + $ordenes_basico;
        $totalRegistros = $ordenes->count() + $ordenes_nas->count();

        $asistencia = ProductosNotasCosmica::whereIn('id_producto', [1952, 1881, 1882])
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '!=', NULL)
            ->sum('asistencia');

        $asistencia_nas = ProductosNotasId::whereIn('id_producto', [1952, 1881, 1882])
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '!=', NULL)
            ->sum('asistencia');

        $inasistencia_acompañante = ProductosNotasCosmica::where('id_producto', 1881)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad') * 2;

        $inasistencia_sin_acompañante = ProductosNotasCosmica::where('id_producto', 1882)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad');

        $inasistencia_basico = ProductosNotasCosmica::where('id_producto', 1952)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad');

        $inasistencia_nas_acompañante = ProductosNotasId::where('id_producto', 1881)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad') * 2;

        $inasistencia_nas_sin_acompañante = ProductosNotasId::where('id_producto', 1882)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad');

        $inasistencia_nas_basico = ProductosNotasId::where('id_producto', 1952)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad');

        $inasistencia = $inasistencia_acompañante + $inasistencia_sin_acompañante + $inasistencia_basico + $inasistencia_nas_acompañante + $inasistencia_nas_sin_acompañante + $inasistencia_nas_basico;

        return view('admin.cotizacion_cosmica.expo.asistencia_expo', compact('ordenes', 'totalPersonas', 'multi', 'ordenes_sin_acompañante',
            'ordenes_basico', 'totalRegistros', 'asistencia', 'inasistencia',
            'ordenes_nas', 'ordenes_nas_acompañante', 'ordenes_nas_sin_acompañante', 'ordenes_nas_basico', 'multi_nas', 'asistencia_nas'));
    }

    public function updateAsistencia(Request $request)
    {
        $table = $request->table;
        $id = $request->id;
        $asistencia = $request->asistencia;

        if ($table == 'cosmica') {
            $orden = ProductosNotasCosmica::find($id);
        } else if ($table == 'nas') {
            $orden = ProductosNotasId::find($id);
        } else {
            return response()->json(['error' => 'Tabla no válida.'], 400);
        }

        if ($orden) {
            $orden->asistencia = $asistencia;
            $orden->save();
            return response()->json(['success' => 'Asistencia actualizada.']);
        } else {
            return response()->json(['error' => 'Orden no encontrada.'], 404);
        }
    }

    public function updateConfirmacion(Request $request)
    {
        $id = $request->id;

        // Primero intenta encontrar el registro en la tabla ProductosNotasCosmica
        $orden = ProductosNotasCosmica::find($id);

        if ($orden) {
            // Si se encuentra en ProductosNotasCosmica, actualiza la confirmación
            $orden->confirmacion = 1;
            $orden->save();
        } else {
            // Si no se encuentra en ProductosNotasCosmica, intenta encontrarlo en ProductosNotasId
            $orden = ProductosNotasId::find($id);

            if ($orden) {
                // Si se encuentra en ProductosNotasId, actualiza la confirmación
                $orden->confirmacion = 1;
                $orden->save();
            } else {
                // Si no se encuentra en ninguna tabla, devuelve un error
                return response()->json(['error' => 'Orden no encontrada.'], 404);
            }
        }

        return response()->json(['success' => 'Confirmación actualizada.']);
    }
}
