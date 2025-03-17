<?php

namespace App\Http\Controllers;

use App\Models\Cosmikausers;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\Orders;
use App\Models\OrdersTickets;
use App\Models\ProductosNotasCosmica;
use App\Models\ProductosNotasId;
use App\Models\Products;
use App\Models\ReportesCotizaciones;
use App\Models\ReportesCotizacionesMensajes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Google\Service\CloudSourceRepositories\Repo;
use DB;

class PerfilClienteController extends Controller
{
    public function index(){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        return view('admin.clientes.perfil.index',compact('clientes'));
    }

    public function searchName(Request $request){
        $search = $request->get('q');

        $users = User::where('name', 'LIKE', "%{$search}%")->get();
        $notasProductos = NotasProductos::where('nombre', 'LIKE', "%{$search}%")->get();
        $notasProductosCosmica = NotasProductosCosmica::where('nombre', 'LIKE', "%{$search}%")->get();

        // Combina los resultados y elimina duplicados
        $results = $users->merge($notasProductos)->merge($notasProductosCosmica)->unique('name');

        return response()->json($results);
    }

    public function searchPhone(Request $request){
        $search = $request->get('q');

        $users = User::where('telefono', 'LIKE', "%{$search}%")->get();
        $notasProductos = NotasProductos::where('telefono', 'LIKE', "%{$search}%")->get();
        $notasProductosCosmica = NotasProductosCosmica::where('telefono', 'LIKE', "%{$search}%")->get();

        // Combina los resultados y elimina duplicados
        $results = $users->merge($notasProductos)->merge($notasProductosCosmica)->unique('telefono');

        return response()->json($results);
    }

    public function buscador(Request $request)
    {
        $phone = $request->phone;
        $name = $request->name;

        $clientes = User::where('cliente', '=', '1')->orderBy('id', 'DESC')->get();
        $cliente = null;

        if ($phone !== null) {
            $cliente = User::where('cliente', '=', '1')->where('telefono', '=', $phone)->first();
            $tipo = 'Usuario';
            if (!$cliente) {
                $cliente = NotasProductos::where('telefono', '=', $phone)->first();
                $tipo = 'Nota';
            }

            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('telefono', '=', $phone)->first();
                $tipo = 'Nota';
            }
        }

        if ($name !== null) {
            $cliente = User::where('cliente', '=', '1')->where('name', '=', $name)->first();
            $tipo = 'Usuario';
            if (!$cliente) {
                $cliente = NotasProductos::where('nombre', '=', $name)->first();
                $tipo = 'Nota';
            }

            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('nombre', '=', $name)->first();
                $tipo = 'Nota';
            }
        }

        $distribuidora = $cliente ? Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id', 'DESC')->first() : null;

        return view('admin.clientes.perfil.index', compact('clientes', 'cliente', 'distribuidora', 'tipo'));
    }

    public function informacion(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();
        $tipo = 'Usuario';

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'tipo'));
    }

    public function cursos(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cursos = OrdersTickets::join('orders', 'orders_tickets.id_order', '=', 'orders.id')
        ->where('orders.id_usuario','=' ,$id)->where('orders.estatus','=' , '1')->get();
        $tipo = 'Usuario';

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cursos', 'tipo'));
    }

    public function compras_tiendita(Request $request, $phone){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('telefono', '=', $phone)->first();
        if ($cliente) {
            $distribuidora = Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id','DESC')->first();
            $tipo = 'Usuario';
            $compras = NotasProductos::where('id_usuario', $cliente->id)
            ->orWhere('telefono', $phone)
            ->where('tipo_nota','=' , 'Venta Presencial')
            ->get();
        }else{
            $distribuidora = null;
            $tipo = 'Nota';
            $cliente = NotasProductos::where('telefono', '=', $phone)->first();
            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('telefono', '=', $phone)->first();
            }
            $compras = NotasProductos::where('tipo_nota','=' , 'Venta Presencial')->where('telefono','=' ,$phone)->get();
        }

        $products = Products::orderBy('nombre','ASC')->get();
        $fechaPerfil = date('Y-m-d');

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'compras', 'tipo', 'products', 'fechaPerfil'));
    }

    public function cotizaciones_nas(Request $request, $phone){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('telefono', '=', $phone)->first();
        if ($cliente) {
            $distribuidora = Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id','DESC')->first();
            $tipo = 'Usuario';
            $cotizaciones = NotasProductos::where(function($query) use ($cliente, $phone) {
                $query->where('id_usuario', $cliente->id)
                      ->orWhere('telefono', $phone);
            })
            ->where('tipo_nota', '=', 'Cotizacion')
            ->orderBy('id','DESC')
            ->get();
        }else{
            $distribuidora = null;
            $tipo = 'Nota';
            $cliente = NotasProductos::where('telefono', '=', $phone)->first();
            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('telefono', '=', $phone)->first();
            }
            $cotizaciones = NotasProductos::where('tipo_nota', '=', 'Cotizacion')->where('telefono', $phone)->get();
        }

        $cotizacionIds = $cotizaciones->pluck('id');
        $reportes = ReportesCotizaciones::whereIn('id_cotizacion_nas', $cotizacionIds)->get();
        $reporteIds = $reportes->pluck('id');
        $reportes_archivos = ReportesCotizacionesMensajes::whereIn('id_reporte', $reporteIds)->get();

        // Formatear la fecha de los reportes
        foreach ($reportes as $reporte) {
            $reporte->fecha = Carbon::parse($reporte->fecha)->format('d F Y h:i a');
        }

        // Contar los mensajes para cada cotización
        $mensajesPorCotizacion = ReportesCotizaciones::whereIn('id_cotizacion_nas', $cotizacionIds)
            ->select('id_cotizacion_nas', DB::raw('count(*) as total'))
            ->groupBy('id_cotizacion_nas')
            ->pluck('total', 'id_cotizacion_nas');

        $products = Products::orderBy('nombre','ASC')->get();
        $fechaPerfil = date('Y-m-d');

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cotizaciones', 'tipo', 'reportes', 'reportes_archivos', 'mensajesPorCotizacion', 'products', 'fechaPerfil'));
    }

    public function cotizaciones_cosmica(Request $request, $phone){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('telefono', '=', $phone)->first();
        if ($cliente) {
            $distribuidora = Cosmikausers::where('id_cliente', $cliente->id)->orderBy('id', 'DESC')->first();
            $tipo = 'Usuario';
            // Si el cliente no es null, busca por id_usuario y telefono
            $cotizaciones_cosmica = NotasProductosCosmica::where('id_usuario', $cliente->id)
                ->orWhere('telefono', $phone)
                ->orderBy('id','DESC')
                ->get();
        } else {
            $distribuidora = null;
            $tipo = 'Nota';
            $cliente = NotasProductos::where('telefono', '=', $phone)->first();
            if (!$cliente) {
                $cliente = NotasProductosCosmica::where('telefono', '=', $phone)->first();
            }
            // Si el cliente es null, busca solo por telefono
            $cotizaciones_cosmica = NotasProductosCosmica::where('telefono', $phone)->get();
        }

        $cotizacionIds = $cotizaciones_cosmica->pluck('id');
        $reportes = ReportesCotizaciones::whereIn('id_cotizacion_cosmica', $cotizacionIds)->get();
        $reporteIds = $reportes->pluck('id');
        $reportes_archivos = ReportesCotizacionesMensajes::whereIn('id_reporte', $reporteIds)->get();

        // Formatear la fecha de los reportes
        foreach ($reportes as $reporte) {
            $reporte->fecha = Carbon::parse($reporte->fecha)->format('d F Y h:i a');
        }

        // Contar los mensajes para cada cotización
        $mensajesPorCotizacion = ReportesCotizaciones::whereIn('id_cotizacion_cosmica', $cotizacionIds)
            ->select('id_cotizacion_cosmica', DB::raw('count(*) as total'))
            ->groupBy('id_cotizacion_cosmica')
            ->pluck('total', 'id_cotizacion_cosmica');

        $products = Products::where('categoria', '=', 'Cosmica')->orderBy('nombre','ASC')->get();
        $fechaPerfil = date('Y-m-d');
            return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cotizaciones_cosmica', 'tipo', 'reportes', 'reportes_archivos', 'mensajesPorCotizacion', 'products', 'fechaPerfil'));
    }

    public function reposicion(Request $request, $id){

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cosmica_user = Cosmikausers::where('id_cliente', '=', $id)->first();
        $tipo = 'Usuario';
        $cotizaciones = NotasProductosCosmica::where('tipo_nota', '=', 'Reposicion')->where('id_usuario', $id)->get();
        $products = Products::orderBy('nombre','ASC')->get();
        $fechaPerfil = date('Y-m-d');

        return view('admin.clientes.perfil.index',compact('cliente', 'distribuidora', 'cosmica_user', 'tipo', 'cotizaciones', 'products', 'fechaPerfil'));
    }

    public function getNotasByUsuario($id)
    {
        // Obtener las notas de la tabla notas_productos por id_usuario
        $notas = NotasProductos::where('id_usuario', $id)->get();

        // Retornar las notas como JSON
        return response()->json($notas);
    }
    public function getProductosByNota($notaId)
    {
        $productos = ProductosNotasId::where('id_notas_productos', $notaId)->get();
        return response()->json($productos);
    }

    public function getAllProductos()
    {
        $productos = Products::orderBy('nombre','ASC')->get();
        return response()->json($productos);
    }

    public function create_reposicion(request $request){

        $notas_productos = new NotasProductosCosmica;
        $notas_productos->id_usuario = $request->id_cliente;
        $notas_productos->tipo_nota = 'Reposicion';
        $notas_productos->metodo_pago = 'Reposicion';
        $notas_productos->fecha = date('Y-m-d');
        $notas_productos->restante = '0';
        $notas_productos->total = '0';
        $notas_productos->estatus_reposicion = 'Pendiente';
        $notas_productos->nota_reposicion = $request->get('nota_reposicion');
        $notas_productos->id_reposicion_user = auth()->user()->id;
        $notas_productos->id_reposicion_nas = $request->notas;
        $tipoNota = $notas_productos->tipo_nota;

        // Obtener todos los folios del tipo de nota específico
        $folios = NotasProductosCosmica::where('tipo_nota', $tipoNota)->pluck('folio');

        // Extraer los números de los folios y encontrar el máximo
        $maxNumero = $folios->map(function ($folio) use ($tipoNota) {
            return intval(substr($folio, strlen($tipoNota[0])));
        })->max();

        // Si hay un folio existente, sumarle 1 al máximo número
        if ($maxNumero) {
            $numeroFolio = $maxNumero + 1;
        } else {
            // Si no hay un folio existente, empezar desde 1
            $numeroFolio = 1;
        }

        // Crear el nuevo folio con el tipo de nota y el número
        $folio = $tipoNota[0] . $numeroFolio;

        // Asignar el nuevo folio al objeto
        $notas_productos->folio = $folio;

        $notas_productos->envio = 'Si';
        $notas_productos->id_admin = auth()->user()->id;
        $notas_productos->save();

        $productos = $request->input('productos', []);

        foreach ($productos as $productoId => $detalles) {
            if($detalles['reemplazo'] != null){
                $originalId = (int) $detalles['original'];
                $reemplazoId = (int) $detalles['reemplazo'];
                $cantidadId = (int) $detalles['cantidad'];

                $produc = Products::where('id', $reemplazoId)->first();

                $productos = new ProductosNotasCosmica;
                $productos->id_notas_productos = $notas_productos->id;
                $productos->id_reposicion_producto = $originalId;
                $productos->id_producto = $reemplazoId;
                $productos->producto = $produc->nombre;
                $productos->cantidad = $cantidadId;
                $productos->price = '0';
                $productos->save();
            }
        }

        return redirect()->back()->with('success', 'Se ha creado su reposicion con exito');
    }

    public function liga_reposicion($id){
        $pedido = NotasProductosCosmica::where('id', $id)->first();
        $pedido_productos = ProductosNotasCosmica::where('id_notas_productos', $id)->get();

        $pedido_original = NotasProductos::where('id', $pedido->id_reposicion_nas)->first();
        $pedido_original_productos = ProductosNotasId::where('id_notas_productos', $pedido->id_reposicion_nas)->get();
        return view('admin.clientes.perfil.pdf_reposicion', compact('pedido', 'pedido_productos', 'pedido_original', 'pedido_original_productos'));
    }

    public function getNotasCosmicaByUsuario($id)
    {
        // Obtener las notas de la tabla notas_productos_cosmica por id_usuario
        $notasCosmica = NotasProductosCosmica::where('id_usuario', $id)->get();

        // Retornar las notas como JSON
        return response()->json($notasCosmica);
    }

    public function membresia_cosmica(Request $request, $id){

        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $cliente = User::where('cliente','=' ,'1')->where('id', '=', $id)->first();
        $distribuidora = Cosmikausers::where('id_cliente', $id)->orderBy('id','DESC')->first();

        $cosmica_user = Cosmikausers::where('id_cliente', '=', $id)->first();
        $tipo = 'Usuario';

        return view('admin.clientes.perfil.index',compact('clientes', 'cliente', 'distribuidora', 'cosmica_user', 'tipo'));
    }

    public function reporte_cosmica(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string',
            'fotos.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx'
        ]);

        $reporte = new ReportesCotizaciones();
        $reporte->descripcion = $request->get('mensaje');
        $reporte->id_usuario = Auth::user()->id;
        $reporte->fecha = Carbon::now()->format('Y/m/d H:i:s');
        $reporte->id_cotizacion_cosmica = $request->get('id_cotizacion');
        $reporte->save();

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_publicidad = base_path('../public_html/plataforma.imnasmexico.com/reportes_cosmica');
        }else{
            $ruta_publicidad = public_path() . '/reportes_cosmica';
        }

        if ($request->hasFile('fotos')) {
            $archivos = $request->file('fotos');
            foreach ($archivos as $archivo) {
                $path = $ruta_publicidad;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $publicidad = new ReportesCotizacionesMensajes();
                $publicidad->id_reporte = $reporte->id;
                $publicidad->foto = $fileName;
                $publicidad->save();
            }
        }

        return redirect()->back()->with('success', 'Producto creado exitosamente.');
    }

    public function reporte_nas(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string',
            'fotos.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx'
        ]);

        $reporte = new ReportesCotizaciones();
        $reporte->descripcion = $request->get('mensaje');
        $reporte->id_usuario = Auth::user()->id;
        $reporte->fecha = Carbon::now()->format('Y/m/d H:i:s');
        $reporte->id_cotizacion_nas = $request->get('id_cotizacion');
        $reporte->save();

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_publicidad = base_path('../public_html/plataforma.imnasmexico.com/reportes_cosmica');
        }else{
            $ruta_publicidad = public_path() . '/reportes_cosmica';
        }

        if ($request->hasFile('fotos')) {
            $archivos = $request->file('fotos');
            foreach ($archivos as $archivo) {
                $path = $ruta_publicidad;
                $fileName = uniqid() . $archivo->getClientOriginalName();
                $archivo->move($path, $fileName);
                $publicidad = new ReportesCotizacionesMensajes();
                $publicidad->id_reporte = $reporte->id;
                $publicidad->foto = $fileName;
                $publicidad->save();
            }
        }

        return redirect()->back()->with('success', 'Producto creado exitosamente.');
    }
}
