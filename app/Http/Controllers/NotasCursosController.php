<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\NotasCursos;
use App\Models\NotasInscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use App\Mail\PlantillaPedidoRecibido;
use App\Mail\PlantillaTicketPresencial;
use App\Mail\PlantillaTicket;
use App\Models\CursosTickets;
use App\Models\NotasPagos;
use App\Models\Orders;
use App\Models\OrdersTickets;
use Illuminate\Support\Str;
use Session;
use Hash;

class NotasCursosController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $fechaActual = date('Y-m-d');
        $notas = NotasCursos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])->orderBy('id','DESC')->get();
        $notas_pagos = NotasPagos::whereBetween('created_at', [$primerDiaDelMes, $ultimoDiaDelMes])->get();

        $cursos = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->orderBy('fecha_inicial','asc')->get();

        $cursos_paquetes = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
        ->where('cursos_tickets.precio','<=', 600)
        ->where('cursos_tickets.fecha_inicial','<=', $fechaActual)
        ->where('cursos_tickets.fecha_final','>=', $fechaActual)
        ->where('cursos.modalidad','=', 'Online')
        ->select('cursos_tickets.*')
        ->get();

        $client = User::get();

        return view('admin.notas_cursos.index', compact('notas', 'cursos', 'notas_pagos', 'cursos_paquetes', 'client'));
    }

    public function create()
    {
        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $fechaActual = date('Y-m-d');
        $notas = NotasCursos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])->orderBy('id','DESC')->get();
        $notas_pagos = NotasPagos::whereBetween('created_at', [$primerDiaDelMes, $ultimoDiaDelMes])->get();

        $cursos = Cursos::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->orderBy('fecha_inicial','asc')->get();

        $cursos_paquetes = CursosTickets::join('cursos', 'cursos_tickets.id_curso', '=', 'cursos.id')
        ->where('cursos_tickets.precio','<=', 600)
        ->where('cursos_tickets.fecha_inicial','<=', $fechaActual)
        ->where('cursos_tickets.fecha_final','>=', $fechaActual)
        ->where('cursos.modalidad','=', 'Online')
        ->select('cursos_tickets.*')
        ->get();

        $client = User::get();

        return view('admin.notas_cursos.create', compact('notas', 'cursos', 'notas_pagos', 'cursos_paquetes', 'client'));
    }


    public function store(request $request){

        $code = Str::random(8);

        if($request->id_client == NULL){
            if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
                if (User::where('telefono', $request->telefono)->exists()) {
                    $user = User::where('telefono', $request->telefono)->first();
                } else {
                    $user = User::where('email', $request->email)->first();
                }
                $payer = $user;
            } else {
                $payer = new User;
                $payer->name = $request->get('name');
                $payer->email = $request->get('email');
                $payer->username = $request->get('telefono');
                $payer->code = $code;
                $payer->telefono = $request->get('telefono');
                $payer->cliente = '1';
                $payer->password = Hash::make($request->get('telefono'));
                $payer->save();
                $cliente = $payer->id;
            }
        }else{
            $cliente = $request->id_client;
        }

        $notas_cursos = new NotasCursos;
        $notas_cursos->id_usuario = $cliente;
        $notas_cursos->fecha = $request->get('fecha');
        $notas_cursos->subtotal = $request->get('total');
        $notas_cursos->descuento = $request->get('descuento');
        $notas_cursos->total = $request->get('totalDescuento');
        $notas_cursos->nota = $request->get('nota');
        $notas_cursos->save();

        $code = Str::random(8);
        $order = new Orders;
        $order->id_usuario = $cliente;
        $order->pago = $notas_cursos->total;
        $order->forma_pago = $request->get('metodo_pago');
        $order->fecha = $notas_cursos->fecha;
        $order->estatus = 1;
        $order->code = $code;
        $order->save();

        $id = $notas_cursos->id;
        $nuevosCampos = $request->input('campo');
        $precio = $request->input('precio');

        for ($count = 0; $count < count($precio); $count++) {
            $data = array(
                'id_nota' => $id,
                'id_curso' => $nuevosCampos[$count],
                'precio' => $precio[$count],
            );
            $insert_data2[] = $data;

            $curso = CursosTickets::where('id', '=', $nuevosCampos[$count])->first();
            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = $cliente;
            $order_ticket->id_tickets = $nuevosCampos[$count];
            $order_ticket->id_curso = $curso->id_curso;
            $order_ticket->save();
        }
        NotasInscripcion::insert($insert_data2);

        $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
        $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();

        $user = $orden_ticket2->User->name;
        $id_order = $orden_ticket2->id_order;
        $pago = $orden_ticket2->Orders->pago;
        $forma_pago = $orden_ticket2->Orders->forma_pago;
        // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));

        foreach ($orden_ticket as $details) {
            if ($details->Cursos->modalidad == 'Online') {
                Mail::to($order->User->email)->send(new PlantillaTicket($details));
            } else {
                Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
            }
        }
        Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));

        $notas_pagos = new NotasPagos;
        $notas_pagos->id_nota = $notas_cursos->id;
        $notas_pagos->monto = $request->get('monto');
        $notas_pagos->metodo_pago = $request->get('metodo_pago');
        $notas_pagos->created_at = $request->get('created_at');
        $notas_pagos->save();

        $restante = $notas_cursos->total - $notas_pagos->monto;

        $enotas_cursos = NotasCursos::where('id', '=', $notas_cursos->id)->first();
        $enotas_cursos->restante = $restante;
        $enotas_cursos->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function store_paquete(request $request){

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
            $payer->name = $request->get('name');
            $payer->email = $request->get('email');
            $payer->username = $request->get('telefono');
            $payer->code = $code;
            $payer->telefono = $request->get('telefono');
            $payer->cliente = '1';
            $payer->password = Hash::make($request->get('telefono'));
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
          //  Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        if($request->get('paquete') === 'Paquete1'){
            $precio = "6000";
        }elseif($request->get('paquete') === 'Paquete2'){
            $precio = "8000";
        }elseif($request->get('paquete') === 'Paquete3'){
            $precio = "11000";
        }elseif($request->get('paquete') === 'Paquete4'){
            $precio = "13000";
        }elseif($request->get('paquete') === 'Paquete5'){
            $precio = "14500";
        }

        $notas_cursos = new NotasCursos;
        $notas_cursos->id_usuario = $payer->id;
        $notas_cursos->fecha = $request->get('fecha');
        $notas_cursos->subtotal = $precio;
        $notas_cursos->total = $precio;
        $notas_cursos->paquete = $request->get('paquete');
        $notas_cursos->nota = $request->get('nota');
        $notas_cursos->save();

        $code = Str::random(8);
        $order = new Orders;
        $order->id_usuario = $payer->id;
        $order->pago = $notas_cursos->total;
        $order->forma_pago = 'Nota';
        $order->fecha = $notas_cursos->fecha;
        $order->estatus = 1;
        $order->code = $code;
        $order->save();

        $id = $notas_cursos->id;
        $nuevosCampos = $request->input('campo');
        if ($nuevosCampos) {
            foreach ($nuevosCampos as $campo) {
                $notas_inscripcion = new NotasInscripcion;
                $notas_inscripcion->id_nota = $id;
                $notas_inscripcion->id_curso = intval($campo);
                $notas_inscripcion->save();

                $curso = CursosTickets::where('id', '=', $campo)->first();
                $order_ticket = new OrdersTickets;
                $order_ticket->id_order = $order->id;
                $order_ticket->id_usuario = $payer->id;
                $order_ticket->id_tickets = intval($campo);
                $order_ticket->id_curso = $curso->id_curso;
                $order_ticket->save();
            }
        }

        $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
        $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();
        $user = $orden_ticket2->User->name;
        $id_order = $orden_ticket2->id_order;
        $pago = $orden_ticket2->Orders->pago;
        $forma_pago = $orden_ticket2->Orders->forma_pago;
        // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));
        foreach ($orden_ticket as $details) {
            if ($details->Cursos->modalidad == 'Online') {
                Mail::to($order->User->email)->send(new PlantillaTicket($details));
            } else {
                Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
            }
        }
        Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));

        $notas_pagos = new NotasPagos;
        $notas_pagos->id_nota = $notas_cursos->id;
        $notas_pagos->monto = $request->get('monto');
        $notas_pagos->metodo_pago = $request->get('metodo_pago');
        $notas_pagos->created_at = $request->get('created_at');
        $notas_pagos->save();

        $restante = $notas_cursos->total - $notas_pagos->monto;

        $enotas_cursos = NotasCursos::where('id', '=', $notas_cursos->id)->first();
        $enotas_cursos->restante = $restante;
        $enotas_cursos->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function edit($id)
    {
        $nota = NotasCursos::find($id);
        $notas_pagos = NotasPagos::where('id_nota','=', $id)->get();
        $notas_inscripcion = NotasInscripcion::where('id_nota','=', $id)->get();

        return view('admin.notas_cursos.edit', compact('nota', 'notas_pagos', 'notas_inscripcion'));
    }

    public function update(Request $request, $id)
    {

        $notas_pagos = new NotasPagos;
        $notas_pagos->id_nota = $id;
        $notas_pagos->monto = $request->get('monto');
        $notas_pagos->metodo_pago = $request->get('metodo_pago');
        $notas_pagos->created_at = $request->get('created_at');
        $notas_pagos->save();

        $enotas_cursos = NotasCursos::where('id', '=', $id)->first();
        $restante = $enotas_cursos->restante - $request->get('monto');
        $enotas_cursos->restante = $restante;
        $enotas_cursos->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }
}
