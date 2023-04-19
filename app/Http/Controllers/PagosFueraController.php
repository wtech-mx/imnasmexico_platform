<?php

namespace App\Http\Controllers;

use App\Models\PagosFuera;
use Illuminate\Http\Request;
use App\Models\OrdersTickets;
use App\Models\Orders;
use Session;
use App\Mail\PlantillaPedidoRecibido;
use App\Mail\PlantillaTicket;
use Illuminate\Support\Facades\Mail;
use MercadoPago\SDK;

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
        );

        $searchResult = \MercadoPago\Payment::search($filters);
        
        // Verificar si la respuesta incluye la clave 'results'
        if (!empty($searchResult)) {
            // Procesar los pagos y mostrarlos en la vista
            $pagos = array();
            foreach ($searchResult as $pago) {
                $pagos = $searchResult;
            }

            return view('admin.pagos.mercado_pago', compact('pagos'));
        } else {
            // Manejar el caso en el que no hay resultados
            return "No se encontraron resultados de pago.";
        }

        return view('admin.pagos.mercado_pago', compact('pagos'));
    }
}
