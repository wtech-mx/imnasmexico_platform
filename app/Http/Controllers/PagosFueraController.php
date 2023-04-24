<?php

namespace App\Http\Controllers;

use App\Models\PagosFuera;
use Illuminate\Http\Request;
use App\Models\OrdersTickets;
use App\Models\Orders;
use Session;
use App\Mail\PlantillaPedidoRecibido;
use App\Mail\PlantillaTicket;
use App\Mail\PlantillaPagoExterno;
use Illuminate\Support\Facades\Mail;
use MercadoPago\SDK;
use MercadoPago\SDK\AdvancedPayments\RangeDateTime;

class PagosFueraController extends Controller
{
    public function inscripcion(){
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->where('inscripcion', '=', '0')->get();

        return view('admin.pagos_fuera.inscripcion', compact('pagos_fuera'));
    }

    public function store(Request $request)
    {
        $pagos_fuera = new PagosFuera;
        $pagos_fuera->nombre = $request->get('nombre');
        $pagos_fuera->correo = $request->get('correo');
        $pagos_fuera->telefono = $request->get('telefono');
        $pagos_fuera->modalidad = $request->get('modalidad');
        $pagos_fuera->curso = $request->get('curso');
        $pagos_fuera->inscripcion = '0';
        $pagos_fuera->pendiente = '0';
        $pagos_fuera->deudor = $request->get('deudor');
        $pagos_fuera->abono = $request->get('abono');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/pago_fuera';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $pagos_fuera->foto = $fileName;
        }
        $pagos_fuera->save();

        $email_custom = 'dayanna.wtech@gmail.com';
        $datos = PagosFuera::where('id', '=', $pagos_fuera->id)->first();
        Mail::to($email_custom)->send(new PlantillaPagoExterno($datos));

        return redirect()->route('pagos.inscripcion')
            ->with('success', 'pago fuera created successfully.');
    }

    public function ChangeInscripcionStatus(Request $request)
    {
        $servicio = PagosFuera::find($request->id);
        $servicio->inscripcion = $request->inscripcion;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    public function pendientes(){
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->where('pendiente', '=', '0')->get();

        return view('admin.pagos_fuera.pendiente', compact('pagos_fuera'));
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
        $orders = Orders::orderBy('id','DESC')->get();

        return view('admin.pagos.index', compact('orders'));
    }

    public function edit_pago($id){
        $orders = Orders::find($id);
        $order_tickets = OrdersTickets::where('id_order', '=', $id)->get();

        return view('admin.pagos.edit', compact('orders', 'order_tickets'));
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
        $filters = array(
            "status" => "approved", // Filtro opcional para obtener solo pagos aprobados
            "begin_date" => date('Y-m')."-01T00:00:00.000-00:00",
            "end_date" => date('Y-m-t')."T23:59:59.999-00:00",
            "limit" => 100, // Obtener un máximo de 100 registros por página
            "offset" => 0 // Empezar desde el primer registro
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
}
