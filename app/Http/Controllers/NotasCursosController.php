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
use App\Models\Tipodocumentos;
use App\Mail\PlantillaDocumentoStps;
use Barryvdh\DomPDF\Facade\Pdf;
use Session;
use Hash;
use App\Models\Factura;

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

        $cursos = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->orderBy('fecha_inicial','asc')->get();

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
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pago_fuera';
        }

        if($request->id_client == NULL){
            if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
                if (User::where('telefono', $request->telefono)->exists()) {
                    $user = User::where('telefono', $request->telefono)->first();
                } else {
                    $user = User::where('email', $request->email)->first();
                }
                $cliente = $user->id;
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
        $notas_cursos->total = $request->get('total');
        $notas_cursos->nota = $request->get('nota');
        $notas_cursos->save();
        
        $code = Str::random(8);
        $monto1 = $request->get('monto1') ?? 0;
        $monto2 = $request->get('monto2') ?? 0;
        $order = new Orders;
        $order->id_usuario = $cliente;
        $order->id_admin = auth()->user()->id;
        $order->pago = $monto1 + $monto2;
        $order->forma_pago = $request->get('metodo_pago');
        $order->fecha = $notas_cursos->fecha;
        $order->id_nota = $notas_cursos->id;
        $order->estatus = 1;
        $order->code = $code;
        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $order->foto = $fileName;
        }
        $order->save();

        $id = $notas_cursos->id;
        $nuevosCampos = $request->input('concepto');
        $precio = $request->input('importe');

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
            $curso = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
            $order_ticket->id_curso = $curso->id_curso;
            $order_ticket->save();
        }

        if($request->get('factura') != NULL){
            $total_con_iva = $request->get('total');
            $sin_iva = $total_con_iva / 1.16;
            $iva = $total_con_iva - $sin_iva;

            $notas_cursos->factura = '1';
            $notas_cursos->total_iva = $iva;
            $notas_cursos->save();

            $facturas = new Factura;

            $facturas->id_usuario = auth()->user()->id;
            $facturas->id_notas_cursos = $notas_cursos->id;
            $facturas->id_orders = $order->id;
            $facturas->estatus = 'En Espera';
            $facturas->save();
        }
        NotasInscripcion::insert($insert_data2);

        $notas_pagos = new NotasPagos;
        $notas_pagos->id_nota = $notas_cursos->id;
        $notas_pagos->monto = $request->get('monto1');
        $notas_pagos->metodo_pago = $request->get('metodo_pago');
        $notas_pagos->monto2 = $request->get('monto2');
        $notas_pagos->metodo_pago2 = $request->get('metodo_pago2');
        $notas_pagos->created_at = $request->get('created_at');
        $notas_pagos->save();

        $restante = $notas_cursos->total - $notas_pagos->monto;

        $enotas_cursos = NotasCursos::where('id', '=', $notas_cursos->id)->first();
        $enotas_cursos->restante = $restante;
        $enotas_cursos->paquete = $order->id;
        $enotas_cursos->update();


        $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();
        $orden_ticket2 = OrdersTickets::where('id_order', '=', $order->id)->first();

        $user = $orden_ticket2->User->name;
        $id_order = $orden_ticket2->id_order;
        $pago = $orden_ticket2->Orders->pago;
        $forma_pago = $orden_ticket2->Orders->forma_pago;

        $email_diplomas = 'imnascenter@naturalesainspa.com';
        $destinatario = [ $order->User->email  , $email_diplomas];
        $datos = $order->User->name;

        foreach ($orden_ticket as $details) {
            $curso = $details->Cursos->nombre;
            $fecha = $details->Cursos->fecha_inicial;
            $nombre = $order->User->name;
            $horas_default = "24";
            $duracion_hrs = $horas_default;
            $tipo_documentos = Tipodocumentos::first();

            if($details->CursosTickets->descripcion == 'Con opción a Documentos de certificadora IMNAS'){

            }else{

                if($details->Cursos->pack_stps == "Si"){

                    $id_ticket = $order_ticket->id;
                    $ticket = OrdersTickets::find($id_ticket);
                    $ticket->estatus_doc = '1';
                    $ticket->estatus_cedula = '1';
                    $ticket->estatus_titulo = '1';
                    $ticket->estatus_diploma = '1';
                    $ticket->estatus_credencial = '1';
                    $ticket->estatus_tira = '1';
                    $ticket->update();

                        $variables = [
                            $details->Cursos->p_stps_1,
                            $details->Cursos->p_stps_2,
                            $details->Cursos->p_stps_3,
                            $details->Cursos->p_stps_4,
                            $details->Cursos->p_stps_5,
                            $details->Cursos->p_stps_6,
                        ];

                        foreach ($variables as $index => $curso) {
                            if (isset($curso) && !empty($curso)) {
                                $sello = 'Si';

                                // Lógica para crear el PDF y enviar el correo aquí
                                $pdf = PDF::loadView('admin.pdf.diploma_stps', compact('curso', 'fecha', 'tipo_documentos', 'nombre','duracion_hrs','sello'));
                                $pdf->setPaper('A4', 'portrait');
                                $contenidoPDF = $pdf->output();

                               Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));
                            }
                        }

                }else{


                    if($details->Cursos->stps == '1' && $details->Cursos->titulo_hono == '1'){
                        $id_ticket = $order_ticket->id;
                        $ticket = OrdersTickets::find($id_ticket);
                        $ticket->estatus_doc = '1';
                        $ticket->estatus_cedula = '1';
                        $ticket->estatus_diploma = '1';
                        $ticket->estatus_credencial = '1';
                        $ticket->estatus_tira = '1';
                        $ticket->update();
                        $sello = 'Si';

                        $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','duracion_hrs','sello'));
                        $pdf->setPaper('A4', 'portrait');
                        $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.
                        Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                    }

                    if($details->Cursos->stps == '1' && $details->Cursos->titulo_hono == NULL){
                        $id_ticket = $order_ticket->id;
                        $ticket = OrdersTickets::find($id_ticket);
                        $ticket->estatus_doc = '1';
                        $ticket->estatus_cedula = '1';
                        $ticket->estatus_titulo = '1';
                        $ticket->estatus_diploma = '1';
                        $ticket->estatus_credencial = '1';
                        $ticket->estatus_tira = '1';
                        $ticket->update();

                        $sello = 'Si';

                        $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre','duracion_hrs','sello'));
                        $pdf->setPaper('A4', 'portrait');
                        $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.
                       Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                    }
                }

            }
        }

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

    public function imprimir($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasCursos::find($id);

        $nota_productos = NotasInscripcion::where('id_nota', $nota->id)->get();
        $nota_pagos = NotasPagos::where('id_nota', $nota->id)->first();

        $pdf = \PDF::loadView('admin.notas_cursos.pdf', compact('nota', 'today', 'nota_productos', 'nota_pagos'));
       return $pdf->stream();

        //  return $pdf->download('Nota curso'. $nota->id .'/'.$today.'.pdf');
    }

    public function imprimir_order($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = Orders::find($id);
        $nota_productos = OrdersTickets::where('id_order', $nota->id)->get();

        $pdf = \PDF::loadView('admin.clientes.perfil.cotizaciones.pdf_order', compact('nota', 'today', 'nota_productos'));
       return $pdf->stream();

        //  return $pdf->download('Nota curso'. $nota->id .'/'.$today.'.pdf');
    }

    public function imprimir_canceladas($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasCursos::find($id);

        $pdf = \PDF::loadView('admin.notas_cursos.pdf_cancelado', compact('nota', 'today'));
       return $pdf->stream();
    }
}
