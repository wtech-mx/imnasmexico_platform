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
use DB;

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
        $id = 2111;

        $total = DB::table('notas_productos_cosmica')
        ->whereNotNull('fecha_aprobada')
        ->where(function($q) use ($id) {
            $q->where('id_kit',  $id)
                ->orWhere('id_kit2', $id)
                ->orWhere('id_kit3', $id)
                ->orWhere('id_kit4', $id)
                ->orWhere('id_kit5', $id)
                ->orWhere('id_kit6', $id);
            })
            ->get();

        $ordenes_basico = ProductosNotasCosmica::where('id_producto', 2111)
        ->whereHas('Nota', function($query) {
            $query->whereNotNull('fecha_aprobada');
        })
        ->get();

        $ordenes_basico_sum = ProductosNotasCosmica::where('id_producto', 2111)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $ordenes_nas_basico = ProductosNotasId::where('id_producto', 2111)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->get();

        $ordenes_nas_basico_sum = ProductosNotasId::where('id_producto', 2111)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $totalPersonas = $ordenes_basico_sum + $ordenes_nas_basico_sum;
        $totalRegistros = $ordenes_nas_basico->count() + $ordenes_basico->count();

        $asistencia = ProductosNotasCosmica::where('id_producto', 2111)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '!=', NULL)
            ->sum('asistencia');

        $asistencia_nas = ProductosNotasId::where('id_producto', 2111)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '!=', NULL)
            ->sum('asistencia');

        $inasistencia_basico = ProductosNotasCosmica::where('id_producto', 2111)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad');

        $inasistencia_nas_basico = ProductosNotasId::where('id_producto', 2111)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad');

        $inasistencia = $inasistencia_basico + $inasistencia_nas_basico;

        return view('admin.cotizacion_cosmica.expo.asistencia_expo', compact('ordenes_basico',
            'ordenes_nas_basico', 'totalPersonas', 'totalRegistros', 'asistencia', 'asistencia_nas', 'inasistencia_basico',
            'inasistencia_nas_basico', 'inasistencia'));
    }

    public function asistencia_expo_domingo() {
        $id = 2121;

        $total = DB::table('notas_productos_cosmica')
        ->whereNotNull('fecha_aprobada')
        ->where(function($q) use ($id) {
            $q->where('id_kit',  $id)
                ->orWhere('id_kit2', $id)
                ->orWhere('id_kit3', $id)
                ->orWhere('id_kit4', $id)
                ->orWhere('id_kit5', $id)
                ->orWhere('id_kit6', $id);
            })
            ->get();

        $ordenes_basico = ProductosNotasCosmica::where('id_producto', 2121)
        ->whereHas('Nota', function($query) {
            $query->whereNotNull('fecha_aprobada');
        })
        ->get();

        $ordenes_basico_sum = ProductosNotasCosmica::where('id_producto', 2121)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $ordenes_nas_basico = ProductosNotasId::where('id_producto', 2121)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->get();

        $ordenes_nas_basico_sum = ProductosNotasId::where('id_producto', 2121)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->sum('cantidad');

        $totalPersonas = $ordenes_basico_sum + $ordenes_nas_basico_sum;
        $totalRegistros = $ordenes_nas_basico->count() + $ordenes_basico->count();

        $asistencia = ProductosNotasCosmica::where('id_producto', 2121)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '!=', NULL)
            ->sum('asistencia');

        $asistencia_nas = ProductosNotasId::where('id_producto', 2121)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '!=', NULL)
            ->sum('asistencia');

        $inasistencia_basico = ProductosNotasCosmica::where('id_producto', 2121)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad');

        $inasistencia_nas_basico = ProductosNotasId::where('id_producto', 2121)
            ->whereHas('Nota', function($query) {
                $query->whereNotNull('fecha_aprobada');
            })
            ->where('asistencia', '=', NULL)
            ->sum('cantidad');

        $inasistencia = $inasistencia_basico + $inasistencia_nas_basico;

        return view('admin.cotizacion_cosmica.expo.asistencia_expo_domingo', compact('ordenes_basico',
            'ordenes_nas_basico', 'totalPersonas', 'totalRegistros', 'asistencia', 'asistencia_nas', 'inasistencia_basico',
            'inasistencia_nas_basico', 'inasistencia'));
    }


    public function ticket_brunch($nombre)
    {
        return view('admin.cotizacion_cosmica.ticker_brunch', compact('nombre'));
    }

    public function ticket_brunch_domingo($nombre)
    {
        return view('admin.cotizacion_cosmica.ticker_brunch_domingo', compact('nombre'));
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
