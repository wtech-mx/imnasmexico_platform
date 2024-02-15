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
use App\Models\EnviosOrder;
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

                    $carpetas_carta = Carpetas::join('cursos', 'carpetas.id', '=', 'cursos.carpeta')
                        ->join('carpeta_recursos', 'carpetas.id', '=', 'carpeta_recursos.id_carpeta')
                        ->join('orders_tickets', 'cursos.id', '=', 'orders_tickets.id_curso')
                        ->join('orders', 'orders_tickets.id_order', '=', 'orders.id')
                        ->where('orders_tickets.id_usuario', $usuarioId)
                        ->where('orders.estatus', '=', 1)
                        ->where('carpeta_recursos.area', '=', 'Carta compromiso')
                        ->select('carpetas.nombre as nombre_carpeta', 'carpeta_recursos.nombre as nombre_recurso', 'carpeta_recursos.sub_area as sub_area_recurso','carpetas.id as id_carpeta')
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

        return view('user.profilenew',compact('carpetas_carta', 'clase_grabada','carpetas_literatura','carpetas_precios','carpetas_guia','carpetas_material','estandaresComprados','cliente', 'orders', 'usuario_compro', 'order_ticket', 'documentos', 'documentos_estandares', 'usuario_video', 'publicidad'));
    }

    public function eliminarDocumento($documentoId){
        $documento = DocumentosEstandares::findOrFail($documentoId);
        $documento->delete();

        return redirect()->back()->with('success', 'El documento ha sido eliminado correctamente.');
    }

    public function eliminarDocumentoPer($id, $tipo){
        $documento = Documentos::findOrFail($id);

        // Lógica para determinar el campo específico según el tipo de documento
        $campoDocumento = '';

        switch ($tipo) {
            case 'ine':
                $campoDocumento = 'ine';
                break;
            case 'curp':
                $campoDocumento = 'curp';
                break;
            case 'foto_tam_titulo':
                $campoDocumento = 'foto_tam_titulo';
                break;
            case 'foto_tam_infantil':
                $campoDocumento = 'foto_tam_infantil';
                break;
            case 'firma':
                $campoDocumento = 'firma';
                break;
            case 'carta_compromiso':
                $campoDocumento = 'carta_compromiso';
                break;
        }

        // Establece el campo del documento a NULL en la base de datos
        $documento->$campoDocumento = NULL;
        $documento->save();

        return redirect()->back()->with('success', 'El documento ha sido eliminado correctamente.');
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
        $user->name = $request->get('name');
        $user->email = $request->get('email');
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

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $userIds = [6182, 6180, 6179, 6178, 6177, 6175, 6167, 6166, 6165, 6164, 6163, 6161, 6160, 6159, 6158,
        6157, 6156, 6155, 6154, 6152, 6151, 6150, 6149, 6148, 6147, 6146, 6145, 6144, 6143, 6142, 6141, 6140,
        6136, 6134, 6133, 6130, 6129, 6128, 6126, 6124, 6123, 6122, 6121, 6120, 6119, 6118, 6117, 6116, 6115,
        6114, 6113, 6112, 6111, 6110, 6109, 6108, 6107, 6106, 6105, 6095, 6094, 6093, 6092, 6091, 6090, 6089,
        6088, 6087, 6086, 6084, 6083, 6082, 6080, 6079, 6078, 6075, 6074, 6073, 6072, 6071, 6069, 6067, 6066,
        6065, 6064, 6062, 6061, 6060, 6055, 6051, 6048, 6046, 6044, 6042, 6041, 6032, 6029, 6028, 6027, 6026,
        6023, 6019, 6006, 6004, 5996, 5989, 5988, 5981, 5978, 5975, 5974, 5973, 5970, 5969, 5967, 5966, 5964,
        5961, 5960, 5958, 5956, 5955, 5954, 5953, 5951, 5948, 5946, 5944, 5941, 5940, 5939, 5936, 5935, 5933,
        5932, 5929, 5928, 5927, 5926, 5924, 5921, 5920, 5917, 5916, 5914, 5913, 5910, 5909, 5906, 5904, 5903,
        5902, 5901, 5900, 5898, 5897, 5894, 5893, 5892, 5882, 5881, 5880, 5878, 5876, 5875, 5874, 5873, 5872,
        5869, 5868, 5866, 5862, 5861, 5860, 5858, 5855, 5851, 5849, 5848, 5847, 5845, 5844, 5841, 5838, 5834,
        5833, 5832, 5831, 5830, 5827, 5825, 5824, 5823, 5822, 5821, 5820, 5818, 5817, 5816, 5809, 5808, 5807,
        5805, 5803, 5802, 5800, 5798, 5794, 5788, 5787, 5785];
        // Eliminar registros de enviosorder
        EnviosOrder::whereIn('id_user', $userIds)->delete();

        // Eliminar registros de orders_tickets
        OrdersTickets::whereIn('id_usuario', $userIds)->delete();

        // Eliminar registros de orders
        Orders::whereIn('id_usuario', $userIds)->delete();

        // Eliminar usuarios
        User::whereIn('id', $userIds)->delete();
        return view('admin.clientes.index',compact('clientes'));
    }

    public function buscador(Request $request){
        $id_client = $request->id_client;
        $phone = $request->phone;
        $tickets = CursosTickets::get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        if ($id_client !== 'null' && $id_client !== null) {
            $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id_client)->first();
            $orders = Orders::where('id_usuario', '=', $id_client)->get();
            $order_ticket = OrdersTickets::where('id_usuario', '=', $id_client)->get();
            $documentos = Documentos::where('id_usuario', '=', $id_client)->get();
            $documentos_estandares = DocumentosEstandares::where('id', '=', $id_client)->first();
        } elseif ($phone !== 'null' && $phone !== null) {
            $cliente = User::where('cliente','=' ,'1')->where('id', '=', $phone)->first();
            $orders = Orders::where('id_usuario', '=', $phone)->get();
            $order_ticket = OrdersTickets::where('id_usuario', '=', $phone)->get();
            $documentos = Documentos::where('id_usuario', '=', $phone)->get();
            $documentos_estandares = DocumentosEstandares::where('id_usuario', '=', $phone)->get();
        }

        return view('admin.clientes.index',compact('clientes','cliente','tickets','orders','order_ticket','documentos', 'documentos_estandares'));
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
