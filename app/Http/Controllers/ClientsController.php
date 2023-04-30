<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersTickets;
use App\Models\CursosTickets;
use App\Models\Documentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;

class ClientsController extends Controller
{
    public function index($code){
        $cliente = User::where('code', $code)->firstOrFail();
        $orders = Orders::where('id_usuario', '=', auth()->user()->id)->get();
        $order_ticket = OrdersTickets::where('id_usuario', '=', auth()->user()->id)->get();

        $usuarioId = Auth::id(); // Obtén el ID del usuario logueado
        // Verifica si el usuario ha comprado un ticket para el curso
        $usuario_compro = OrdersTickets::join('cursos', 'orders_tickets.id_curso', '=', 'cursos.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('cursos.video_cad','=', 1)
                        ->get();

        return view('user.profile',compact('cliente', 'orders', 'usuario_compro', 'order_ticket'));
    }

    public function index_admin(){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $orders = Orders::get();
        $tickets = CursosTickets::get();
        $order_ticket = OrdersTickets::get();
        $documentos = Documentos::get();

        return view('admin.clientes.index',compact('clientes','tickets','orders','order_ticket','documentos'));
    }

    public function update(Request $request, $code)
    {
        $user = User::where('code', $code)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->telefono = $request->get('telefono');
        $user->password = Hash::make($request->get('telefono'));
        $user->cfdi = $request->get('cfdi');
        $user->rfc = $request->get('rfc');
        $user->razon_social = $request->get('razon_social');
        $user->direccion = $request->get('direccion');
        $user->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('perfil.index', $code)
            ->with('success', 'usuario editado con exito.');
    }

    public function update_documentos(Request $request, $id){

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos');
        }else{
            $ruta_estandar = public_path() . '/documentos';
        }

        $documentos_id = Documentos::where('id_usuario','=',$id)->first();

        if($documentos_id == null){
            $documentos = new Documentos;

            $documentos->id_usuario = $id;

            if ($request->hasFile("ine")) {
                $file = $request->file('ine');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->ine = $fileName;
            }

            if ($request->hasFile("curp")) {
                $file = $request->file('curp');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->curp = $fileName;
            }

            if ($request->hasFile("foto_tam_titulo")) {
                $file = $request->file('foto_tam_titulo');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->foto_tam_titulo = $fileName;
            }

            if ($request->hasFile("foto_tam_infantil")) {
                $file = $request->file('foto_tam_infantil');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->foto_tam_infantil = $fileName;
            }

            if ($request->hasFile("carta_compromiso")) {
                $file = $request->file('carta_compromiso');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->carta_compromiso = $fileName;
            }

            if ($request->hasFile("firma")) {
                $file = $request->file('firma');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->firma = $fileName;
            }

            $documentos->save();
            return redirect()->back()->with('success', 'Creado con exito');
        }


        if($documentos_id->id_usuario == $id){

            $documentos = Documentos::find($documentos_id->id);

            if ($request->hasFile("ine")) {
                $file = $request->file('ine');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->ine = $fileName;
            }

            if ($request->hasFile("curp")) {
                $file = $request->file('curp');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->curp = $fileName;
            }

            if ($request->hasFile("foto_tam_titulo")) {
                $file = $request->file('foto_tam_titulo');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->foto_tam_titulo = $fileName;
            }

            if ($request->hasFile("foto_tam_infantil")) {
                $file = $request->file('foto_tam_infantil');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->foto_tam_infantil = $fileName;
            }

            if ($request->hasFile("carta_compromiso")) {
                $file = $request->file('carta_compromiso');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->carta_compromiso = $fileName;
            }

            if ($request->hasFile("firma")) {
                $file = $request->file('firma');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $documentos->firma = $fileName;
            }

            $documentos->update();

        }

        return redirect()->back()->with('success', 'Creado con exito');

    }

}
