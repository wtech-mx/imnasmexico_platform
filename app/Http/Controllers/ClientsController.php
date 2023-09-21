<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersTickets;
use App\Models\CursosTickets;
use App\Models\Documentos;
use App\Models\DocumentosEstandares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;
use DB;
use App\Imports\UsersImport;
use App\Models\Carpetas;
use App\Models\CarpetasEstandares;
use App\Models\CursosEstandares;
use App\Models\Publicidad;
use App\Models\Factura;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class ClientsController extends Controller
{
    public function index($code){
            // Verificar si el usuario tiene una sesión activa
            if (!auth()->check()) {
                return redirect()->route('cursos.index_user')->with('warning', 'Inicie sesión para ver su perfil');
            }
        $cliente = User::where('code', $code)->firstOrFail();
        $orders = Orders::where('id_usuario', '=', auth()->user()->id)->get();
        $order_ticket = OrdersTickets::where('id_usuario', '=', auth()->user()->id)->get();

        $usuarioId = Auth::id(); // Obtén el ID del usuario logueado
        // Verifica si el usuario ha comprado un ticket para el curso
        $usuario_video = OrdersTickets::join('cursos', 'orders_tickets.id_curso', '=', 'cursos.id')
                        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('cursos.video_cad','=', 1)
                        ->where('orders.estatus','=', 1)
                        ->get();

        $usuario_compro = OrdersTickets::join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('orders.estatus','=', 1)
                        ->get();

                        $clase_grabada = OrdersTickets::join('cursos', 'orders_tickets.id_curso', '=', 'cursos.id')
                        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('orders.clase_grabada_orden','=', 1)
                        ->where('orders.estatus','=', 1)
                        ->where('orders.fecha', '>=', Carbon::now()->subDays(3))
                        ->get();

                        $carpetas_material = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
                        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
                        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
                        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('orders.estatus', '=', 1)
                        ->where('carpeta_recursos.area', '=', 'Material')
                        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpetas.id as id_carpeta')
                        ->get();

                    $carpetas_literatura = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
                        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
                        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
                        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('orders.estatus', '=', 1)
                        ->where('carpeta_recursos.area', '=', 'Literatura')
                        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpeta_recursos.sub_area as sub_area_recurso','carpetas.id as id_carpeta')
                        ->get();

                    $carpetas_guia = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
                        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
                        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
                        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('orders.estatus', '=', 1)
                        ->where('carpeta_recursos.area', '=', 'Guia')
                        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpetas.id as id_carpeta')
                        ->get();

                    $carpetas_precios = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
                        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
                        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
                        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('orders.estatus', '=', 1)
                        ->where('carpeta_recursos.area', '=', 'Precios')
                        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpetas.id as id_carpeta')
                        ->get();

        $publicidad = Publicidad::get();

        $documentos = Documentos::where('id_usuario', '=', auth()->user()->id)->get();
        $documentos_estandares = DocumentosEstandares::where('id_usuario', '=', auth()->user()->id)->get();

        // Obtener el ID del usuario actualmente autenticado
        $idUsuario = Auth::user()->id;

        // Obtener las órdenes completadas del usuario
        $ordenesCompletadas = Orders::where('id_usuario', $idUsuario)->where('estatus', 1)->pluck('id');

        // Obtener los IDs de los cursos comprados en las órdenes completadas
        $cursosComprados = OrdersTickets::whereIn('id_order', $ordenesCompletadas)->pluck('id_curso');
        // Obtener los IDs de los estándares asociados a los cursos comprados
        $estandares = CursosEstandares::whereIn('id_curso', $cursosComprados)->pluck('id_carpeta');

        // Obtener los datos de los estándares
        $estandaresComprados = CarpetasEstandares::whereIn('id', $estandares)->get();

        return view('user.profilenew',compact('clase_grabada','carpetas_literatura','carpetas_precios','carpetas_guia','carpetas_material','estandaresComprados','cliente', 'orders', 'usuario_compro', 'order_ticket', 'documentos', 'documentos_estandares', 'usuario_video', 'publicidad'));
    }

    public function show($id){
        // Verificar si el usuario tiene una sesión activa
    if (!auth()->check()) {
        return redirect()->route('cursos.index_user')->with('warning', 'Inicie sesión para ver su perfil');
    }

    $cliente = User::where('id', $id)->firstOrFail();
    $orders = Orders::where('id_usuario', '=',$id)->get();
    $order_ticket = OrdersTickets::where('id_usuario', '=',$id)->get();

    $usuarioId = Auth::id(); // Obtén el ID del usuario logueado
    // Verifica si el usuario ha comprado un ticket para el curso
    $usuario_video = OrdersTickets::join('cursos', 'orders_tickets.id_curso', '=', 'cursos.id')
                    ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                    ->where('orders_tickets.id_usuario', $id)
                    ->where('cursos.video_cad','=', 1)
                    ->where('orders.estatus','=', 1)
                    ->get();

    $clase_grabada = OrdersTickets::join('cursos', 'orders_tickets.id_curso', '=', 'cursos.id')
        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders_tickets.id_usuario', $id)
        ->where('orders.clase_grabada_orden','=', 1)
        ->where('orders.estatus','=', 1)
        ->where('orders.fecha', '>=', Carbon::now()->subDays(3))
        ->get();

    $usuario_compro = OrdersTickets::join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                    ->where('orders_tickets.id_usuario', $id)
                    ->where('orders.estatus','=', 1)
                    ->get();

    $carpetas_material = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders_tickets.id_usuario', $id)
        ->where('orders.estatus', '=', 1)
        ->where('carpeta_recursos.area', '=', 'Material')
        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpetas.id as id_carpeta')
        ->get();

    $carpetas_literatura = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders_tickets.id_usuario', $id)
        ->where('orders.estatus', '=', 1)
        ->where('carpeta_recursos.area', '=', 'Literatura')
        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpeta_recursos.sub_area as sub_area_recurso','carpetas.id as id_carpeta')
        ->get();

    $carpetas_guia = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders_tickets.id_usuario', $id)
        ->where('orders.estatus', '=', 1)
        ->where('carpeta_recursos.area', '=', 'Guia')
        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpetas.id as id_carpeta')
        ->get();

    $carpetas_precios = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders_tickets.id_usuario', $id)
        ->where('orders.estatus', '=', 1)
        ->where('carpeta_recursos.area', '=', 'Precios')
        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpetas.id as id_carpeta')
        ->get();

    $carpetas_carta = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders_tickets.id_usuario', $id)
        ->where('orders.estatus', '=', 1)
        ->where('carpeta_recursos.area', '=', 'Carta compromiso')
        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpeta_recursos.sub_area as sub_area_recurso','carpetas.id as id_carpeta')
        ->get();

    $publicidad = Publicidad::get();

    $documentos = Documentos::where('id_usuario', '=',$id)->get();
    $documentos_estandares = DocumentosEstandares::where('id_usuario', '=',$id)->get();

    // Obtener el ID del usuario actualmente autenticado
    $idUsuario = Auth::user()->id;

    // Obtener las órdenes completadas del usuario
    $ordenesCompletadas = Orders::where('id_usuario', $id)->where('estatus', 1)->pluck('id');

    // Obtener los IDs de los cursos comprados en las órdenes completadas
    $cursosComprados = OrdersTickets::whereIn('id_order', $ordenesCompletadas)->pluck('id_curso');
    // Obtener los IDs de los estándares asociados a los cursos comprados
    $estandares = CursosEstandares::whereIn('id_curso', $cursosComprados)->pluck('id_carpeta');

    // Obtener los datos de los estándares
    $estandaresComprados = CarpetasEstandares::whereIn('id', $estandares)->get();

    return view('user.profilenew',compact('carpetas_carta','carpetas_literatura','carpetas_precios','carpetas_guia','carpetas_material','clase_grabada','estandaresComprados','cliente', 'orders', 'usuario_compro', 'order_ticket', 'documentos', 'documentos_estandares', 'usuario_video', 'publicidad'));
}

    public function update(Request $request, $code)
    {
        $user = User::where('code', $code)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->telefono = $request->get('telefono');
        $user->username = $request->get('telefono');
        $user->password = Hash::make($request->get('telefono'));
        $user->cfdi = $request->get('cfdi');
        $user->rfc = $request->get('rfc');
        $user->razon_social = $request->get('razon_social');
        $user->direccion = $request->get('direccion');
        $user->city = $request->get('city');
        $user->postcode = $request->get('postcode');
        $user->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('perfil.index', $code)
            ->with('success', 'usuario editado con exito.');
    }

    public function update_situacionfiscal(Request $request, $id){
        $user = User::where('id', $id)->first();
        $user->username = $request->get('telefono');
        $user->telefono = $request->get('telefono');
        $user->password = Hash::make($request->get('telefono'));
        $user->update();

        $cliente = User::where('id', $id)->first();
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos/' . $cliente->telefono;
        }

        if ($request->hasFile("situacion_fiscal")) {
            $file = $request->file('situacion_fiscal');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $cliente->situacion_fiscal = $fileName;
        }

        $cliente->save();
        return redirect()->back()->with('success', 'Creado con exito');
    }

    public function store_factura(Request $request){
        $facturas = new Factura;
        $facturas->id_usuario = $request->get('id_usuario');
        $facturas->id_orders = $request->get('id_orders');

        $cliente = User::where('id',  $request->get('id_usuario'))->first();
        $dominio = $request->getHost();

        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos/' . $cliente->telefono;
        }

        if ($request->hasFile("factura")) {
            $file = $request->file('factura');
            $path = $ruta_estandar;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $facturas->factura = $fileName;
        }
        $facturas->save();
        return redirect()->back()->with('success', 'Creado con exito');
    }

    public function update_documentos_cliente(Request $request, $id){

        $cliente = User::where('id', $id)->first();
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos/' . $cliente->telefono;
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

    public function documentos_estandares_cliente(Request $request, $id){
        $cliente = User::where('id', $id)->first();
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos/' . $cliente->telefono;
        }

        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            $documento_ids = $request->get('documento_ids'); // Cambio a documento_ids (plural) ya que es un array
            $id_curso = $request->get('curso');
            foreach ($archivos as $key => $archivo) {
                $path = $ruta_estandar;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $documentos = new DocumentosEstandares();
                $documentos->documento = $fileName;
                $documentos->id_documento = $documento_ids[$key]; // Usar el ID correspondiente
                $documentos->id_curso = $id_curso;
                $documentos->id_usuario = $id;
                $documentos->save();
            }
        }
        return redirect()->back()->with('success', 'Creado con exito');
    }
    // =============== A D M I N ===============================

    public function index_admin(){

        //$clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->paginate(100);

        $orders = Orders::get();
        $tickets = CursosTickets::get();
        $order_ticket = OrdersTickets::get();
        $documentos = Documentos::get();
        $documentos_estandares = DocumentosEstandares::get();

        return view('admin.clientes.index',compact('clientes','tickets','orders','order_ticket','documentos', 'documentos_estandares'));
    }

    public function getUsuarios(){

        $clientes = User::query();
        $orders = Orders::get();
        $tickets = CursosTickets::get();
        $order_ticket = OrdersTickets::get();
        $documentos = Documentos::get();
        $documentos_estandares = DocumentosEstandares::get();

        return DataTables::of($clientes)->make(true);
    }


    public function update_documentos(Request $request, $id){

        $cliente = User::where('id', $id)->first();
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos/' . $cliente->telefono;
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

    public function documentos_estandares(Request $request, $id){
        $cliente = User::where('id', $id)->first();
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos/' . $cliente->telefono;
        }

        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            foreach ($archivos as $archivo) {
                $path = $ruta_estandar;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $documentos = new DocumentosEstandares();
                $documentos->documento = $fileName;
                $documentos->id_usuario = $id;
                $documentos->save();
            }
        }
        return redirect()->back();
    }

    public function descargarDocumento(Request $request, $id, $cliente_id){
        $documento = DocumentosEstandares::findOrFail($id);

        $cliente = User::where('id', $cliente_id)->first();
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos/' . $cliente->telefono;
        }

        $pathToFile = $ruta_estandar. '/' . $documento->documento;

        return response()->download($pathToFile);

    }

    public function import_clientes(Request $request)
    {
        Excel::import(new UsersImport,request()->file('file'));

        return redirect()->back()->with('success', 'Creado con exito');
    }

}
