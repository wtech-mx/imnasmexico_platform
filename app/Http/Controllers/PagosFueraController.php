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
use App\Models\RegistroImnas;
use Illuminate\Support\Str;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PagosFueraController extends Controller
{
    public function inscripcion(){
        $fechaActual = date('Y-m-d');
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->get();
        $cursos = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->orderBy('fecha_inicial','asc')->get();
        $envio = CursosTickets::where('id_curso','=', 109)->first();

        $clases_grabadas = CursosTickets::where('fecha_final','<=', $fechaActual)->orderBy('fecha_inicial','asc')->get();

        return view('admin.pagos_fuera.inscripcion', compact('pagos_fuera', 'cursos', 'clases_grabadas', 'envio'));
    }

    public function index_mp(){
        $fechaInicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $fechaFinSemana = Carbon::now()->endOfWeek()->toDateString();

        $orders = Orders::orderBy('id','DESC')->where('estatus', '=', '1')->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('forma_pago', '=', 'Mercado Pago')->get();

        return view('admin.pagos.index_mp', compact('orders'));
    }

    public function store(Request $request){
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
        $order_ticket4 = $request->get('campo4');
        $clase_grabada = $request->get('clase_grabada');
        $cursos = CursosTickets::where('id','=', $order_ticket)->first();
        $cursos2 = CursosTickets::where('id','=', $order_ticket2)->first();
        $cursos3 = CursosTickets::where('id','=', $order_ticket3)->first();
        $cursos4 = CursosTickets::where('id','=', $order_ticket4)->first();
        $clase = CursosTickets::where('id','=', $clase_grabada)->first();

        if($request->get('name2') == NULL){
            $usuario = $request->get('name') . " " . $request->get('apellido');
        }else{
            $usuario = $request->get('name') . " " . $request->get('apellido') . "\n" . $request->get('name2') . " " . $request->get('apellido2');
        }

        if($request->get('campo4') != NULL){
            $curso = $cursos->nombre . "\n" . $cursos2->nombre . "\n" . $cursos3->nombre . "\n" . $cursos4->nombre;
        }elseif($request->get('campo3') != NULL){
            $curso = $cursos->nombre . "\n" . $cursos2->nombre . "\n" . $cursos3->nombre;
        }elseif($request->get('campo2') != NULL){
            $curso = $cursos->nombre . "\n" . $cursos2->nombre;
        }elseif($request->get('clase_grabada') != NULL){
            $curso = $clase->nombre . '- clase grabada.';
        }else{
            $curso = $request->get('cantidad') .' '. $cursos->nombre;
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
        $pagos_fuera->ticket4 = $request->get('campo4');
        $pagos_fuera->comentario = $request->get('comentario');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $pagos_fuera->foto = $fileName;
        }

        if ($request->hasFile("foto2")) {
            $file = $request->file('foto2');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $pagos_fuera->foto2 = $fileName;
        }
        $pagos_fuera->save();

            if (User::where('telefono', $request->telefono)->exists() || User::where('email', $request->email)->exists()) {
                if (User::where('telefono', $request->telefono)->exists()) {
                    $user = User::where('telefono', $request->telefono)->first();
                    $user->name = $request->get('name') . " " . $request->get('apellido');
                    $user->update();
                } else {
                    $user = User::where('email', $request->email)->first();
                    $user->name = $request->get('name') . " " . $request->get('apellido');
                    $user->update();
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

                for($i = 1; $i <= $request->get('cantidad'); $i++){
                    if($order_ticket->id_tickets == 1008 || $order_ticket->id_tickets == 1372 || $order_ticket->id_tickets == 1355){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo1');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket->id_tickets == 1185){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo1');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket->id_tickets == 1257 || $order_ticket->id_tickets == 1258 || $order_ticket->id_tickets == 1259 || $order_ticket->id_tickets == 1260 || $order_ticket->id_tickets == 1261){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo1');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket->id_tickets == 1009){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo1');
                        $envio->tipo = 2;
                        $envio->save();
                    }else if($order_ticket->id_tickets == 137){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo1');
                        $envio->tipo = 2;
                        $envio->num_guia = 1;
                        $envio->save();
                    }
                }
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

                for($i = 1; $i <= $request->get('cantidad2'); $i++){
                    if($order_ticket2->id_tickets == 1008 || $order_ticket2->id_tickets == 1372 || $order_ticket2->id_tickets == 1355){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo2');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket2->id_tickets == 1185){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo2');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket2->id_tickets == 1257 || $order_ticket2->id_tickets == 1258 || $order_ticket2->id_tickets == 1259 || $order_ticket2->id_tickets == 1260 || $order_ticket2->id_tickets == 1261){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo2');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket2->id_tickets == 1009){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo2');
                        $envio->tipo = 2;
                        $envio->save();
                    }else if($order_ticket2->id_tickets == 137){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo2');
                        $envio->tipo = 2;
                        $envio->num_guia = 1;
                        $envio->save();
                    }
                }
            }

            if($request->get('campo3') != NULL){
                $order_ticket3 = new OrdersTickets;
                $order_ticket3->id_order = $order->id;
                $order_ticket3->id_usuario = $payer->id;
                $order_ticket3->id_tickets = $request->get('campo3');
                $cursos3 = CursosTickets::where('id','=', $order_ticket3->id_tickets)->first();
                $order_ticket3->id_curso = $cursos3->id_curso;
                $order_ticket3->save();

                for($i = 1; $i <= $request->get('cantidad3'); $i++){
                    if($order_ticket3->id_tickets == 1008 || $order_ticket3->id_tickets == 1372 || $order_ticket3->id_tickets == 1355){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo3');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket3->id_tickets == 1185){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo3');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket3->id_tickets == 1257 || $order_ticket3->id_tickets == 1258 || $order_ticket3->id_tickets == 1259 || $order_ticket3->id_tickets == 1260 || $order_ticket3->id_tickets == 1261){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo3');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket3->id_tickets == 1009){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo3');
                        $envio->tipo = 2;
                        $envio->save();
                    }else if($order_ticket3->id_tickets == 137){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo3');
                        $envio->tipo = 2;
                        $envio->num_guia = 1;
                        $envio->save();
                    }
                }
            }

            if($request->get('campo4') != NULL){
                $order_ticket4 = new OrdersTickets;
                $order_ticket4->id_order = $order->id;
                $order_ticket4->id_usuario = $payer->id;
                $order_ticket4->id_tickets = $request->get('campo4');
                $cursos4 = CursosTickets::where('id','=', $order_ticket4->id_tickets)->first();
                $order_ticket4->id_curso = $cursos4->id_curso;
                $order_ticket4->save();

                for($i = 1; $i <= $request->get('cantidad4'); $i++){
                    if($order_ticket4->id_tickets == 1008 || $order_ticket4->id_tickets == 1372 || $order_ticket4->id_tickets == 1355){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo4');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket4->id_tickets == 1185){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo4');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket4->id_tickets == 1257 || $order_ticket4->id_tickets == 1258 || $order_ticket4->id_tickets == 1259 || $order_ticket4->id_tickets == 1260 || $order_ticket4->id_tickets == 1261){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo4');
                        $envio->tipo = 1;
                        $envio->save();
                    }else if($order_ticket4->id_tickets == 1009){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo4');
                        $envio->tipo = 2;
                        $envio->save();
                    }else if($order_ticket4->id_tickets == 137){
                        $envio = new RegistroImnas;
                        $envio->id_order = $order->id;
                        $envio->id_usuario = $payer->id;
                        $envio->id_ticket = $request->get('campo4');
                        $envio->tipo = 2;
                        $envio->num_guia = 1;
                        $envio->save();
                    }
                }
            }

            $orden_ticket = OrdersTickets::where('id_order', '=', $order->id)->get();

           $email_diplomas = 'imnascenter@naturalesainspa.com';
           $destinatario = [ $order->User->email  , $email_diplomas];
            $datos = $order->User->name;

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
                   // Mail::to($payer2->email)->send(new PlantillaNuevoUser($datos));
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

            if($order_ticket->Cursos->certificacion_webinar == 1){
                $user_certificacion = User::where('id', $order_ticket->User->id)->first();
                $user_certificacion->estatus_constancia = 'documentos';
                $user_certificacion->agendar_cita = 1;
                $user_certificacion->update();
            }

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

            if($request->get('campo4') != NULL){
                $order_ticket4 = new OrdersTickets;
                $order_ticket4->id_order = $order->id;
                $order_ticket4->id_usuario = $payer->id;
                $order_ticket4->id_tickets = $request->get('campo4');
                $cursos4 = CursosTickets::where('id','=', $order_ticket4->id_tickets)->first();
                $order_ticket4->id_curso = $cursos4->id_curso;
                $order_ticket4->save();
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
                   // Mail::to($payer2->email)->send(new PlantillaNuevoUser($datos));
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

                if($request->get('campo4') != NULL){
                    $order_ticket4 = new OrdersTickets;
                    $order_ticket4->id_order = $order->id;
                    $order_ticket4->id_usuario = $payer->id;
                    $order_ticket4->id_tickets = $request->get('campo4');
                    $cursos3 = CursosTickets::where('id','=', $order_ticket4->id_tickets)->first();
                    $order_ticket4->id_curso = $cursos3->id_curso;
                    $order_ticket4->save();
                }

                $orden_ticket2 = OrdersTickets::where('id_order', '=', $order2->id)->get();
            }
        }

        Session::flash('success', 'Se ha subido el pago correctamente');
        return redirect()->back()->with('success', 'Se ha subido el pago correctamente');
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

        $total = $pagos_fuera->abono - $pagos_fuera->abono2;

        $order = Orders::where('id_externo', '=', $pagos_fuera->id)->first();
        $order->estatus = 1;
        $order->pago = $total;
        $order->update();

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

        return view('admin.pagos_fuera.pendiente', compact('pagos_fuera'));
    }

    public function create(){
        $fechaActual = date('Y-m-d');
        $cursos = CursosTickets::where('fecha_inicial','<=', $fechaActual)->where('fecha_final','>=', $fechaActual)->orderBy('fecha_inicial','asc')->get();
        $clases_grabadas = CursosTickets::where('fecha_final','<=', $fechaActual)->orderBy('fecha_inicial','asc')->get();
        $envio = CursosTickets::where('id_curso','=', 109)->first();

        return view('admin.pagos_fuera.create', compact('cursos', 'clases_grabadas', 'envio'));
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

    public function mercado_pago()
    {
        // Configuración de la SDK de MercadoPago
        SDK::setAccessToken(config('services.mercadopago.token'));

        // Fechas para el filtro
        $today = date('Y-m-d');
        $lastMonthEndDate = date('Y-m-d', strtotime('-1 month -1 day'));
        $lastMonthStartDate = date('Y-m-01', strtotime('-1 month'));

        // Filtros para la búsqueda de pagos
        $filters = array(
            "status" => "approved",
            "begin_date" => $lastMonthStartDate."T00:00:00.000-00:00",
            "end_date" => $today."T23:59:59.999-00:00",
            "limit" => 100,
            "offset" => 0
        );

        // Arrays para almacenar pagos
        $pagos = array();
        $comprasSinEmail = array();

        do {
            // Obtener siguiente página de resultados
            $searchResult = \MercadoPago\Payment::search($filters);

            // Obtener los resultados de la búsqueda
            $results = $searchResult->getArrayCopy();

            // Clasificar los pagos en función de si el email está vacío o no
            foreach ($results as $pago) {
                if (empty($pago->payer->email)) {
                    // Categorizar como "compras" si el email está vacío
                    $comprasSinEmail[] = $pago;
                } else {
                    // Categorizar como pagos normales si el email no está vacío
                    $pagos[] = $pago;
                }
            }

            // Incrementar el offset para obtener la siguiente página de resultados
            $filters["offset"] += $filters["limit"];

        } while (count($results) > 0);

        // Pasar los datos a la vista
        return view('admin.pagos.mercado_pago', compact('pagos', 'comprasSinEmail'));
    }

    public function mercado_pago_recibo ($id)
    {
        // Inicializa la SDK de Mercado Pago
        SDK::setAccessToken(config('services.mercadopago.token'));

        $payment = \MercadoPago\Payment::find_by_id($id);

        // Verifica si el pago existe
        if (!$payment) {
            abort(404, 'Pago no encontrado');
        }

        // Prepara los datos que te interesan
        $data = [
            'id' => $payment->id,
            'status' => $payment->status,
            'transaction_amount' => $payment->transaction_amount,
            'date_approved' => $payment->date_approved,
            'payment_method_id' => $payment->payment_method_id,
            'payment_type_id' => $payment->payment_type_id,
            'description' => $payment->description,
            'payer_email' => $payment->payer->email,
        ];

        // Pasando los datos a la vista del recibo
        $pdf = Pdf::loadView('admin.pagos.recibomp', compact('data'));

        return $pdf->stream('recibo_mercadopago.pdf', ['Attachment' => true]);
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

        if($orden->Cursos->certificacion_webinar == 1){
            $user_certificacion = User::where('id', $orden->User->id)->first();
            $user_certificacion->estatus_constancia = 'documentos';
            $user_certificacion->agendar_cita = 1;
            $user_certificacion->update();
        }

        return redirect()->back()
        ->with('success', 'Usuario cambiado con exito.');
    }
}
