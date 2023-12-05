<?php

namespace App\Http\Controllers;

use App\Models\PagosFuera;
use Illuminate\Http\Request;
use App\Models\OrdersTickets;
use App\Models\Orders;
use Session;
use App\Mail\PlantillaPedidoRecibido;
use App\Mail\PlantillaTicketPresencial;
use App\Mail\PlantillaTicket;
use App\Mail\PlantillaDocumentoStps;
use App\Mail\PlantillaPagoExterno;
use App\Models\CursosTickets;
use App\Models\Tipodocumentos;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use MercadoPago\SDK;
use MercadoPago\SDK\AdvancedPayments\RangeDateTime;
use App\Models\WebPage;
use Hash;
use App\Mail\PlantillaNuevoUser;
use App\Models\Cursos;
use Illuminate\Support\Str;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PagosFueraController extends Controller
{
    public function inscripcion(){
        $fechaActual = date('Y-m-d');
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->get();
        $cursos = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->orderBy('fecha_inicial','asc')->get();

        $clases_grabadas = CursosTickets::where('fecha_final','<=', $fechaActual)->orderBy('fecha_inicial','asc')->get();

        return view('admin.pagos_fuera.inscripcion', compact('pagos_fuera', 'cursos', 'clases_grabadas'));
    }

    public function store(Request $request)
    {
        $webpage = WebPage::first();

        $code = Str::random(8);
        $fechaActual = date('Y-m-d');

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pago_fuera';
        }

        $order_ticket = $request->get('campo1');
        $order_ticket2 = $request->get('campo2');
        $order_ticket3 = $request->get('campo3');
        $clase_grabada = $request->get('clase_grabada');
        $cursos = CursosTickets::where('id','=', $order_ticket)->first();
        $cursos2 = CursosTickets::where('id','=', $order_ticket2)->first();
        $cursos3 = CursosTickets::where('id','=', $order_ticket3)->first();
        $clase = CursosTickets::where('id','=', $clase_grabada)->first();

        if($request->get('name2') == NULL){
            $usuario = $request->get('name') . " " . $request->get('apellido');
        }else{
            $usuario = $request->get('name') . " " . $request->get('apellido') . "\n" . $request->get('name2') . " " . $request->get('apellido2');
        }

        if($request->get('campo3') != NULL){
            $curso = $cursos->Cursos->nombre . "\n" . $cursos2->Cursos->nombre . "\n" . $cursos3->Cursos->nombre;
        }elseif($request->get('campo2') != NULL){
            $curso = $cursos->Cursos->nombre . "\n" . $cursos2->Cursos->nombre;
        }elseif($request->get('clase_grabada') != NULL){
            $curso = $clase->Cursos->nombre . '- clase grabada.';
        }else{
            $curso = $cursos->Cursos->nombre;
        }

        $pagos_fuera = new PagosFuera;
        $pagos_fuera->nombre = $usuario;
        $pagos_fuera->correo = $request->get('email');
        $pagos_fuera->telefono = $request->get('telefono');
        $pagos_fuera->curso = $curso;
        $pagos_fuera->inscripcion = '1';
        $pagos_fuera->pendiente = '0';
        $pagos_fuera->modalidad = $request->get('forma_pago');
        $pagos_fuera->deudor = $request->get('deudor');
        $pagos_fuera->abono = $request->get('abono');
        $pagos_fuera->monto = $request->get('pago');
        $pagos_fuera->fecha_hora_1 = $request->get('fecha_hora_1');
        $pagos_fuera->usuario = $request->get('usuario');
        $pagos_fuera->ticket1 = $request->get('campo1');
        $pagos_fuera->ticket2 = $request->get('campo2');
        $pagos_fuera->ticket3 = $request->get('campo3');
        $pagos_fuera->comentario = $request->get('comentario');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $pagos_fuera->foto = $fileName;
        }
        $pagos_fuera->save();

            if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
                if (User::where('telefono', $request->telefono)->exists()) {
                    $user = User::where('telefono', $request->telefono)->first();
                } else {
                    $user = User::where('email', $request->email)->first();
                }
                $payer = $user;
            } else {
                $payer = new User();
                $payer->name = $request->get('name') . " " . $request->get('apellido');
                $payer->email = $request->get('email');
                $payer->username = $request->get('telefono');
                $payer->code = $code;
                $payer->telefono = $request->get('telefono');
                $payer->cliente = '1';
                $payer->password = Hash::make($request->get('telefono'));
                $payer->save();
                $datos = User::where('id', '=', $payer->id)->first();
                Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
            }

        if($request->get('deudor') != '1'){
            $order = new Orders;
            $order->id_usuario = $payer->id;
            $order->pago = $request->get('pago');
            $order->forma_pago = $request->get('forma_pago');
            $order->fecha = $fechaActual;
            $order->estatus = 1;
            if($request->get('clase_grabada') != NULL){
                $order->clase_grabada_orden = '1';
            }
            $order->code = $code;
            $order->id_externo = $pagos_fuera->id;
            $order->save();

            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = $payer->id;
            if($request->get('clase_grabada') != NULL){
                $order_ticket->id_tickets = $request->get('clase_grabada');
                $cursos = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
                $order_ticket->id_curso = $cursos->id_curso;
            }else{
                $order_ticket->id_tickets = $request->get('campo1');
                $cursos = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
                $order_ticket->id_curso = $cursos->id_curso;
            }
            $order_ticket->save();

            if($request->get('campo2') != NULL){
                $order_ticket2 = new OrdersTickets;
                $order_ticket2->id_order = $order->id;
                $order_ticket2->id_usuario = $payer->id;
                $order_ticket2->id_tickets = $request->get('campo2');
                $cursos2 = CursosTickets::where('id','=', $order_ticket2->id_tickets)->first();
                $order_ticket2->id_curso = $cursos2->id_curso;
                $order_ticket2->save();
            }

            if($request->get('campo3') != NULL){
                $order_ticket3 = new OrdersTickets;
                $order_ticket3->id_order = $order->id;
                $order_ticket3->id_usuario = $payer->id;
                $order_ticket3->id_tickets = $request->get('campo3');
                $cursos3 = CursosTickets::where('id','=', $order_ticket3->id_tickets)->first();
                $order_ticket3->id_curso = $cursos3->id_curso;
                $order_ticket3->save();
            }

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();

            $email_diplomas = 'diplomas_imnas@naturalesainspa.com';
            $destinatario = [ $order->User->email  , $email_diplomas];
            $datos = $order->User->name;


            foreach ($orden_ticket as $details) {

                $curso = $details->Cursos->nombre;
                $fecha = $details->Cursos->fecha_inicial;
                $nombre = $order->User->name;
                $tipo_documentos = Tipodocumentos::first();

                if ($details->Cursos->modalidad == 'Online') {
                    Mail::to($order->User->email)->send(new PlantillaTicket($details));
                } else {
                    Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
                }

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
                                    // Lógica para crear el PDF y enviar el correo aquí
                                    $pdf = PDF::loadView('admin.pdf.diploma_stps', compact('curso', 'fecha', 'tipo_documentos', 'nombre'));
                                    $pdf->setPaper('A4', 'portrait');
                                    $contenidoPDF = $pdf->output();

                                    Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                                    // Si solo quieres generar uno, puedes agregar un break después del Mail::send
                                    // break;
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

                            $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
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

                            $pdf = PDF::loadView('admin.pdf.diploma_stps',compact('curso','fecha','tipo_documentos','nombre'));
                            $pdf->setPaper('A4', 'portrait');
                            $contenidoPDF = $pdf->output(); // Obtiene el contenido del PDF como una cadena.
                            Mail::to($destinatario)->send(new PlantillaDocumentoStps($contenidoPDF, $datos));

                        }
                    }

                }
            }

            if($request->get('name2') != NULL){
                $code2 = Str::random(8);
                if (User::where('telefono', $request->get('telefono2'))->exists() || User::where('email', $request->get('email2'))->exists()) {
                    if (User::where('telefono', $request->get('telefono2'))->exists()) {
                        $user = User::where('telefono', $request->get('telefono2'))->first();
                    } else {
                        $user = User::where('email', $request->get('email2'))->first();
                    }
                    $payer2 = $user;
                } else {
                    $payer2 = new User();
                    $payer2->name = $request->get('name2') . " " . $request->get('apellido2');
                    $payer2->email = $request->get('email2');
                    $payer2->username = $request->get('telefono2');
                    $payer2->code = $code2;
                    $payer2->telefono = $request->get('telefono2');
                    $payer2->cliente = '1';
                    $payer2->password = Hash::make($request->get('telefono2'));
                    $payer2->save();
                    $datos = User::where('id', '=', $payer2->id)->first();
                    Mail::to($payer2->email)->send(new PlantillaNuevoUser($datos));
                }

                $order2 = new Orders;
                $order2->id_usuario = $payer2->id;
                $order2->pago = $request->get('pago');
                $order2->forma_pago = $request->get('forma_pago');
                $order2->fecha = $fechaActual;
                $order2->estatus = 1;
                $order2->code = $code;
                $order2->id_externo = $pagos_fuera->id;
                $order2->save();

                $order_ticket = new OrdersTickets;
                $order_ticket->id_order = $order2->id;
                $order_ticket->id_usuario = $payer2->id;
                $order_ticket->id_tickets = $request->get('campo1');
                $cursos = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
                $order_ticket->id_curso = $cursos->id_curso;
                $order_ticket->save();

                if($request->get('campo2') != NULL){
                    $order_ticket2 = new OrdersTickets;
                    $order_ticket2->id_order = $order2->id;
                    $order_ticket2->id_usuario = $payer2->id;
                    $order_ticket2->id_tickets = $request->get('campo2');
                    $cursos2 = CursosTickets::where('id','=', $order_ticket2->id_tickets)->first();
                    $order_ticket2->id_curso = $cursos2->id_curso;
                    $order_ticket2->save();
                }

                if($request->get('campo3') != NULL){
                    $order_ticket3 = new OrdersTickets;
                    $order_ticket3->id_order = $order2->id;
                    $order_ticket3->id_usuario = $payer2->id;
                    $order_ticket3->id_tickets = $request->get('campo3');
                    $cursos3 = CursosTickets::where('id','=', $order_ticket3->id_tickets)->first();
                    $order_ticket3->id_curso = $cursos3->id_curso;
                    $order_ticket3->save();
                }

                $orden_ticket2 = OrdersTickets::where('id_order', '=', $order2->id)->get();

                foreach ($orden_ticket2 as $details) {
                    if ($details->Cursos->modalidad == 'Online') {
                        Mail::to($order2->User->email)->send(new PlantillaTicket($details));
                    } else {
                        Mail::to($order2->User->email)->send(new PlantillaTicketPresencial($details));
                    }
                }
            }

        }else{
            $order = new Orders;
            $order->id_usuario = $payer->id;
            $order->pago = $request->get('pago');
            $order->forma_pago = $request->get('forma_pago');
            $order->fecha = $fechaActual;
            $order->estatus = 0;
            if($request->get('clase_grabada') != NULL){
                $order->clase_grabada_orden = '1';
            }
            $order->code = $code;
            $order->id_externo = $pagos_fuera->id;
            $order->save();

            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = $payer->id;
            if($request->get('clase_grabada') != NULL){
                $order_ticket->id_tickets = $request->get('clase_grabada');
                $cursos = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
                $order_ticket->id_curso = $cursos->id_curso;
            }else{
                $order_ticket->id_tickets = $request->get('campo1');
                $cursos = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
                $order_ticket->id_curso = $cursos->id_curso;
            }
            $order_ticket->save();

            if($request->get('campo2') != NULL){
                $order_ticket2 = new OrdersTickets;
                $order_ticket2->id_order = $order->id;
                $order_ticket2->id_usuario = $payer->id;
                $order_ticket2->id_tickets = $request->get('campo2');
                $cursos2 = CursosTickets::where('id','=', $order_ticket2->id_tickets)->first();
                $order_ticket2->id_curso = $cursos2->id_curso;
                $order_ticket2->save();
            }

            if($request->get('campo3') != NULL){
                $order_ticket3 = new OrdersTickets;
                $order_ticket3->id_order = $order->id;
                $order_ticket3->id_usuario = $payer->id;
                $order_ticket3->id_tickets = $request->get('campo3');
                $cursos3 = CursosTickets::where('id','=', $order_ticket3->id_tickets)->first();
                $order_ticket3->id_curso = $cursos3->id_curso;
                $order_ticket3->save();
            }

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();

            if($request->get('name2') != NULL){
                $code2 = Str::random(8);
                if (User::where('telefono', $request->get('telefono2'))->exists() || User::where('email', $request->get('email2'))->exists()) {
                    if (User::where('telefono', $request->get('telefono2'))->exists()) {
                        $user = User::where('telefono', $request->get('telefono2'))->first();
                    } else {
                        $user = User::where('email', $request->get('email2'))->first();
                    }
                    $payer2 = $user;
                } else {
                    $payer2 = new User();
                    $payer2->name = $request->get('name2') . " " . $request->get('apellido2');
                    $payer2->email = $request->get('email2');
                    $payer2->username = $request->get('telefono2');
                    $payer2->code = $code2;
                    $payer2->telefono = $request->get('telefono2');
                    $payer2->cliente = '1';
                    $payer2->password = Hash::make($request->get('telefono2'));
                    $payer2->save();
                    $datos = User::where('id', '=', $payer2->id)->first();
                    Mail::to($payer2->email)->send(new PlantillaNuevoUser($datos));
                }

                $order2 = new Orders;
                $order2->id_usuario = $payer2->id;
                $order2->pago = $request->get('pago');
                $order2->forma_pago = $request->get('forma_pago');
                $order2->fecha = $fechaActual;
                $order2->estatus = 1;
                $order2->code = $code;
                $order2->id_externo = $pagos_fuera->id;
                $order2->save();

                $order_ticket = new OrdersTickets;
                $order_ticket->id_order = $order2->id;
                $order_ticket->id_usuario = $payer2->id;
                $order_ticket->id_tickets = $request->get('campo1');
                $cursos = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
                $order_ticket->id_curso = $cursos->id_curso;
                $order_ticket->save();

                if($request->get('campo2') != NULL){
                    $order_ticket2 = new OrdersTickets;
                    $order_ticket2->id_order = $order2->id;
                    $order_ticket2->id_usuario = $payer2->id;
                    $order_ticket2->id_tickets = $request->get('campo2');
                    $cursos2 = CursosTickets::where('id','=', $order_ticket2->id_tickets)->first();
                    $order_ticket2->id_curso = $cursos2->id_curso;
                    $order_ticket2->save();
                }

                if($request->get('campo3') != NULL){
                    $order_ticket3 = new OrdersTickets;
                    $order_ticket3->id_order = $order2->id;
                    $order_ticket3->id_usuario = $payer2->id;
                    $order_ticket3->id_tickets = $request->get('campo3');
                    $cursos3 = CursosTickets::where('id','=', $order_ticket3->id_tickets)->first();
                    $order_ticket3->id_curso = $cursos3->id_curso;
                    $order_ticket3->save();
                }

                $orden_ticket2 = OrdersTickets::where('id_order', '=', $order2->id)->get();
            }
        }

        // $datos = PagosFuera::where('id', '=', $pagos_fuera->id)->first();
        // Mail::to($webpage->email_developer)->bcc($webpage->email_developer_two, 'Destinatario dev 2')->send(new PlantillaPagoExterno($datos));

        return redirect()->route('pagos.pendientes')
            ->with('success', 'pago fuera creado con exito.');
    }

    public function update_deudores(Request $request, $id){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pago_fuera';
        }

        $code = Str::random(8);
        $fechaActual = date('Y-m-d');

        $pagos_fuera = PagosFuera::find($id);
        $pagos_fuera->abono2 = $request->get('abono2');
        $pagos_fuera->fecha_hora_2 = $request->get('fecha_hora_2');
        $pagos_fuera->comentario = $request->get('comentario');
        $pagos_fuera->deudor = '0';

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $pagos_fuera->foto2 = $fileName;
        }

        $pagos_fuera->update();

        if($request->get('abono2') != NULL){

            if (User::where('telefono', $pagos_fuera->telefono)->exists() || User::where('email', $pagos_fuera->correo)->exists()) {
                if (User::where('telefono', $pagos_fuera->telefono)->exists()) {
                    $user = User::where('telefono', $pagos_fuera->telefono)->first();
                } else {
                    $user = User::where('email', $pagos_fuera->correo)->first();
                }
                $payer = $user;
            }

            $suma_abonos = $pagos_fuera->abono + $pagos_fuera->abono2;

            $order = new Orders;
            $order->id_usuario = $payer->id;
            $order->pago = $suma_abonos;
            $order->forma_pago = $pagos_fuera->modalidad;
            $order->fecha = $fechaActual;
            $order->estatus = 1;
            $order->code = $code;
            $order->id_externo = $pagos_fuera->id;
            $order->save();

            $order_ticket = new OrdersTickets;
            $order_ticket->id_order = $order->id;
            $order_ticket->id_usuario = $payer->id;
            $order_ticket->id_tickets = $pagos_fuera->ticket1;
            $cursos = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
            $order_ticket->id_curso = $cursos->id_curso;
            $order_ticket->save();

            if($request->get('campo2') != NULL){
                $order_ticket2 = new OrdersTickets;
                $order_ticket2->id_order = $order->id;
                $order_ticket2->id_usuario = $payer->id;
                $order_ticket2->id_tickets = $pagos_fuera->ticket;
                $cursos2 = CursosTickets::where('id','=', $order_ticket2->id_tickets)->first();
                $order_ticket2->id_curso = $cursos2->id_curso;
                $order_ticket2->save();
            }

            if($request->get('campo3') != NULL){
                $order_ticket3 = new OrdersTickets;
                $order_ticket3->id_order = $order->id;
                $order_ticket3->id_usuario = $payer->id;
                $order_ticket3->id_tickets = $pagos_fuera->ticket;
                $cursos3 = CursosTickets::where('id','=', $order_ticket3->id_tickets)->first();
                $order_ticket3->id_curso = $cursos3->id_curso;
                $order_ticket3->save();
            }

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();

            foreach ($orden_ticket as $details) {
                if ($details->Cursos->modalidad == 'Online') {
                    Mail::to($order->User->email)->send(new PlantillaTicket($details));
                } else {
                    Mail::to($order->User->email)->send(new PlantillaTicketPresencial($details));
                }
            }

            if($request->get('name2') != NULL){
                $code2 = Str::random(8);
                if (User::where('telefono', $request->get('telefono2'))->exists() || User::where('email', $request->get('email2'))->exists()) {
                    if (User::where('telefono', $request->get('telefono2'))->exists()) {
                        $user = User::where('telefono', $request->get('telefono2'))->first();
                    } else {
                        $user = User::where('email', $request->get('email2'))->first();
                    }
                    $payer2 = $user;
                } else {
                    $payer2 = new User();
                    $payer2->name = $request->get('name2') . " " . $request->get('apellido2');
                    $payer2->email = $request->get('email2');
                    $payer2->username = $request->get('telefono2');
                    $payer2->code = $code2;
                    $payer2->telefono = $request->get('telefono2');
                    $payer2->cliente = '1';
                    $payer2->password = Hash::make($request->get('telefono2'));
                    $payer2->save();
                    $datos = User::where('id', '=', $payer2->id)->first();
                    Mail::to($payer2->email)->send(new PlantillaNuevoUser($datos));
                }

                $order2 = new Orders;
                $order2->id_usuario = $payer2->id;
                $order2->pago = $request->get('pago');
                $order2->forma_pago = $request->get('forma_pago');
                $order2->fecha = $fechaActual;
                $order2->estatus = 1;
                $order2->code = $code;
                $order2->id_externo = $pagos_fuera->id;
                $order2->save();

                $order_ticket = new OrdersTickets;
                $order_ticket->id_order = $order2->id;
                $order_ticket->id_usuario = $payer2->id;
                $order_ticket->id_tickets = $request->get('campo1');
                $cursos = CursosTickets::where('id','=', $order_ticket->id_tickets)->first();
                $order_ticket->id_curso = $cursos->id_curso;
                $order_ticket->save();

                if($request->get('campo2') != NULL){
                    $order_ticket2 = new OrdersTickets;
                    $order_ticket2->id_order = $order2->id;
                    $order_ticket2->id_usuario = $payer2->id;
                    $order_ticket2->id_tickets = $request->get('campo2');
                    $cursos2 = CursosTickets::where('id','=', $order_ticket2->id_tickets)->first();
                    $order_ticket2->id_curso = $cursos2->id_curso;
                    $order_ticket2->save();
                }

                if($request->get('campo3') != NULL){
                    $order_ticket3 = new OrdersTickets;
                    $order_ticket3->id_order = $order2->id;
                    $order_ticket3->id_usuario = $payer2->id;
                    $order_ticket3->id_tickets = $request->get('campo3');
                    $cursos3 = CursosTickets::where('id','=', $order_ticket3->id_tickets)->first();
                    $order_ticket3->id_curso = $cursos3->id_curso;
                    $order_ticket3->save();
                }

                $orden_ticket2 = OrdersTickets::where('id_order', '=', $order2->id)->get();

                foreach ($orden_ticket2 as $details) {
                    if ($details->Cursos->modalidad == 'Online') {
                        Mail::to($order2->User->email)->send(new PlantillaTicket($details));
                    } else {
                        Mail::to($order2->User->email)->send(new PlantillaTicketPresencial($details));
                    }
                }
            }


        }

        Session::flash('success', 'Se ha actualizado es comprobante de la orden');
        return redirect()->back()->with('success', 'actualizado es comprobante de la orden.');

    }

    public function ChangeInscripcionStatus(Request $request)
    {
        $servicio = PagosFuera::find($request->id);
        $servicio->inscripcion = $request->inscripcion;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    public function pendientes(){
        $fechaActual = date('Y-m-d');
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->where('pendiente', '=', '0')->get();
        $cursos = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->orderBy('fecha_inicial','asc')->get();
        $clases_grabadas = CursosTickets::where('fecha_final','<=', $fechaActual)->orderBy('fecha_inicial','asc')->get();

        return view('admin.pagos_fuera.pendiente', compact('pagos_fuera', 'cursos', 'clases_grabadas'));
    }

    public function ChangePendienteStatus(Request $request)
    {
        $servicio = PagosFuera::find($request->id);
        $servicio->pendiente = $request->pendiente;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    public function deudores(){
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->where('deudor', '=', '1')->get();

        return view('admin.pagos_fuera.deudores', compact('pagos_fuera'));
    }

    public function ChangeDeudorStatus(Request $request){
        $servicio = PagosFuera::find($request->id);
        $servicio->deudor = $request->deudor;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    public function index_pago(){
        $orders = Orders::orderBy('id','DESC')->where('estatus', '=', '1')->where('forma_pago', '!=', 'Clase Gratis')->get();

        $orders_clase_gratis = Orders::orderBy('id','DESC')->Where('forma_pago', '=', 'Clase Gratis')->get();
        return view('admin.pagos.index', compact('orders','orders_clase_gratis'));
    }

    public function index_pago_pendiente(){
        $orders = Orders::orderBy('id','DESC')->where('estatus', '=', '0')->get();

        return view('admin.pagos.index_pendiente', compact('orders'));
    }

    public function edit_pago($id){
        $fechaActual = date('Y-m-d');
        $orders = Orders::find($id);
        $order_tickets = OrdersTickets::where('id_order', '=', $id)->get();
        $cursos = Cursos::where('fecha_final','>=', $fechaActual)->get();

        return view('admin.pagos.edit', compact('orders', 'order_tickets', 'cursos'));
    }

    public function update_pago(Request $request, $id){

        $curso = Orders::find($id);
        $curso->estatus = $request->get('estatus');
        $curso->update();

        if($curso->estatus == '1'){
            $orden_ticket = OrdersTickets::where('id_order', '=', $id)->get();
            $orden_ticket2 = OrdersTickets::where('id_order', '=', $id)->first();
            $user = $orden_ticket2->User->name;
            $id_order = $orden_ticket2->id_order;
            $pago = $orden_ticket2->Orders->pago;
            $forma_pago = $orden_ticket2->Orders->forma_pago;
            // Mail::to($order->User->email)->send(new PlantillaPedidoRecibido($orden_ticket));
            foreach($orden_ticket as $details){
                Mail::to($orden_ticket2->User->email)->send(new PlantillaTicket($details));
            }
            Mail::to($orden_ticket2->User->email)->send(new PlantillaPedidoRecibido($orden_ticket, $user, $id_order, $pago, $forma_pago, $orden_ticket2));
        }

        return redirect()->route('pagos.index_pago')
            ->with('success', 'curso created successfully.');
    }

    public function mercado_pago(){
        // Configuración de la SDK de MercadoPago
        SDK::setAccessToken(config('services.mercadopago.token'));

        // Obtener pagos desde MercadoPago
        $today = date('Y-m-d');
        $lastMonthEndDate = date('Y-m-d', strtotime('-1 month -1 day'));
        $lastMonthStartDate = date('Y-m-01', strtotime('-1 month'));

        $filters = array(
            "status" => "approved",
            "begin_date" => $lastMonthStartDate."T00:00:00.000-00:00",
            "end_date" => $today."T23:59:59.999-00:00",
            "limit" => 100,
            "offset" => 0
        );

        $pagos = array();

        do {
            // Obtener siguiente página de resultados
            $searchResult = \MercadoPago\Payment::search($filters);

            // Obtener los resultados de la búsqueda
            $results = $searchResult->getArrayCopy();

            // Concatenar los resultados de la siguiente página con los resultados anteriores
            $pagos = array_merge($pagos, $results);

            // Incrementar el offset para obtener la siguiente página de resultados
            $filters["offset"] += $filters["limit"];

        } while (count($results) > 0);


            return view('admin.pagos.mercado_pago', compact('pagos'));

    }

    public function getTicketsByCurso($id)
    {
        $fechaActual = date('Y-m-d');
        echo json_encode(DB::table('cursos_tickets')->where('id_curso', $id)->where('fecha_inicial', '<=', $fechaActual)
        ->where('fecha_final', '>=', $fechaActual)->get());
    }

    public function cambio(Request $request, $id){

        $orden = OrdersTickets::where('id_order', '=', $id)->first();
        $orden->id_curso = $request->get('curso_ticket');
        $orden->id_tickets = $request->get('ticket');
        $orden->update();

        return redirect()->back()
        ->with('success', 'Usuario cambiado con exito.');
    }
}
