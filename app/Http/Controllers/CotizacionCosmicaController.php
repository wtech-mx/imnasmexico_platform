<?php

namespace App\Http\Controllers;

use App\Models\Bitacora_cosmikausers;
use App\Models\Cosmikausers;
use App\Models\NotasProductosCosmica;
use App\Models\ProductosNotasCosmica;
use App\Models\Products;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CotizacionCosmicaController extends Controller
{
    public function index(){

        $this->checkMembresia();

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();

        $notas = NotasProductosCosmica::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->get();

        return view('admin.cotizacion_cosmica.index', compact('notas', 'administradores'));
    }

    public function index_protocolo(Request $request, $id)
    {
        // Obtén el distribuidora
        $distribuidora = Cosmikausers::find($id);

        // Verifica si hay una cookie con la clave de acceso
        $claveAcceso = Cookie::get('claves_protocolo' . $id);

        // Si la cookie existe, muestra el iframe
        if ($claveAcceso) {
            return view('user.revista', ['distribuidora' => $distribuidora, 'show_iframe' => true]);
        }

        // Si no, muestra el formulario para ingresar la clave
        return view('user.revista', ['distribuidora' => $distribuidora, 'show_iframe' => false]);
    }

    public function validate_protocolo(Request $request, $id)
    {
        // Verifica la clave de acceso (aquí deberías agregar la lógica para verificar la clave)
        $inputClave = $request->input('claves_protocolo');
        $distribuidora = Cosmikausers::find($id)->first();

        // Si la clave es correcta, guarda una cookie por 24 horas
        if ($inputClave == $distribuidora->claves_protocolo) { // Aquí asumo que 'claves_protocolo' es el campo con la clave correcta

            Cookie::queue('claves_protocolo' . $id, $inputClave, 1440); // 1440 minutos = 24 horas
            return redirect()->route('distribuidoras.index_protocolo', $id)->with('show_iframe', true);
        }

        // Si la clave es incorrecta, redirige de vuelta al formulario con un mensaje de error
        return redirect()->route('distribuidoras.index_protocolo', $id)->withErrors(['claves_protocolo' => 'Clave incorrecta']);
    }


    public function buscador(Request $request){
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $id_client = $request->id_client;
        $phone = $request->phone;
        $admin = $request->administradores;
        if ($id_client !== 'null' && $id_client !== null) {
            $notas = NotasProductosCosmica::where('id_usuario', $id_client)->get();
        } elseif ($phone !== 'null' && $phone !== null) {
            $notas = NotasProductosCosmica::where('id_usuario', $phone)->get();
        }
        if ($admin !== 'null' && $admin !== null) {
            $notas = NotasProductosCosmica::where('id_admin', $admin)->get();
        }

        return view('admin.cotizacion_cosmica.index',compact('notas', 'administradores'));
    }

    public function create(){
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $products = Products::where('descripcion', '=', 'Cosmica')->orderBy('nombre','ASC')->get();

        return view('admin.cotizacion_cosmica.create', compact('products', 'clientes'));
    }

    public function store(request $request){
        // Creacion de user
        $code = Str::random(8);

        $notas_productos = new NotasProductosCosmica;
        if($request->get('email') == NULL && $request->get('id_cliente') == NULL){
            $notas_productos->nombre = $request->get('name');
            $notas_productos->telefono = $request->get('telefono');
        }else{
            if ($request->get('id_cliente')) {
                $id_cliente = $request->get('id_cliente');
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

                $id_cliente = $payer->id;
            }
            $notas_productos->id_usuario = $id_cliente;
        }

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pagos';
        }

        if($request->get('envio') == NULL){
            $envio = 0;
        }else{
            $envio = 180;
        }

        $descuento = floatval($request->get('descuento', 0));

        $nuevosCampos4 = $request->input('campo4', []);
        $nuevosCampos4 = array_map('floatval', $nuevosCampos4); // Convierte a números
        $sumaCampo4 = array_sum($nuevosCampos4);
        // Aplicar descuento si $descuento es mayor que 0
        if ($descuento > 0) {
            $descuentoAplicado = $sumaCampo4 * ($descuento / 100);
            $totalDesc = ($envio + $sumaCampo4) - $descuentoAplicado;
            if($request->get('factura') == NULL){
                $factura = 0;
                $totalConDescuento = $totalDesc;
            }else{
                $factura = $totalDesc * .16;
                $totalConDescuento = $totalDesc + $factura;
            }
        } else {
            $descuentoAplicado = 0;
            $totalDesc = $envio + $sumaCampo4;
            if($request->get('factura') == NULL){
                $factura = 0;
                $totalConDescuento = $totalDesc;
            }else{
                $factura = $totalDesc * .16;
                $totalConDescuento = $totalDesc + $factura;
            }
        }

        $notas_productos->metodo_pago = $request->get('metodo_pago');
        $notas_productos->fecha = $request->get('fecha');
        $notas_productos->subtotal = $sumaCampo4;
        $notas_productos->restante = $request->get('descuento');
        $notas_productos->total = $totalConDescuento;
        $notas_productos->nota = $request->get('nota');
        $notas_productos->metodo_pago2 = $request->get('metodo_pago2');
        $notas_productos->monto = $request->get('monto');
        $notas_productos->monto2 = $request->get('monto2');

        $notas_productos->tipo_nota = 'Cotizacion';
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

        if($request->get('envio') == NULL){
            $notas_productos->envio = 'No';
        }else{
            $notas_productos->envio = 'Si';
        }
        $notas_productos->id_admin = auth()->user()->id;

        if ($request->hasFile("foto_pago2")) {
            $file = $request->file('foto_pago2');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_productos->foto_pago2 = $fileName;
        }

        if($request->get('factura') != NULL){
            if ($request->hasFile("situacion_fiscal")) {
                $file = $request->file('situacion_fiscal');
                $path = $pago_fuera;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $notas_productos->situacion_fiscal = $fileName;
            }
            $notas_productos->factura = $request->get('factura');
            $notas_productos->razon_social = $request->get('razon_social');
            $notas_productos->rfc = $request->get('rfc');
            $notas_productos->cfdi = $request->get('cfdi');
            $notas_productos->correo_fac = $request->get('correo_fac');
            $notas_productos->telefono_fac = $request->get('telefono_fac');
            $notas_productos->direccion_fac = $request->get('direccion_fac');
        }
        $notas_productos->save();

        if ($request->has('campo')) {
            $nuevosCampos = $request->input('campo');
            $nuevosCampos2 = $request->input('campo4');
            $nuevosCampos3 = $request->input('campo3');
            $nuevosCampos4 = $request->input('descuento_prod');

            foreach ($nuevosCampos as $index => $campo) {
                $notas_inscripcion = new ProductosNotasCosmica;
                $notas_inscripcion->id_notas_productos = $notas_productos->id;
                $notas_inscripcion->producto = $campo;
                $notas_inscripcion->price = $nuevosCampos2[$index];
                $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                $notas_inscripcion->descuento = $nuevosCampos4[$index];
                $notas_inscripcion->save();
            }
        }

        return redirect()->route('cotizacion_cosmica.index')
        ->with('success', 'Se ha creado su cotizacion con exito');
    }

    public function edit($id){
        $cotizacion = NotasProductosCosmica::find($id);
        $cotizacion_productos = ProductosNotasCosmica::where('id_notas_productos', '=', $id)->where('price', '!=', NULL)->get();
        $products = Products::where('descripcion', '=', 'Cosmica')->orderBy('nombre','ASC')->get();

        return view('admin.cotizacion_cosmica.edit', compact('products', 'cotizacion', 'cotizacion_productos'));
    }

    public function update(Request $request, $id){
        $campo = $request->input('campo');
        $campo4 = $request->input('campo4');
        $campo3 = $request->input('campo3');
        $descuento_prod = $request->input('descuento_prod');

        // Agregar nuevos productos
        for ($count = 0; $count < count($campo); $count++) {
            $price = $campo4[$count];
            $cleanPrice = floatval(str_replace(['$', ','], '', $price));
            $data = array(
                'id_notas_productos' => $id,
                'producto' => $campo[$count],
                'price' => $cleanPrice,
                'cantidad' => $campo3[$count],
                'descuento' => $descuento_prod[$count],
            );
            ProductosNotasCosmica::create($data);
        }

        $producto = $request->input('productos');
        $price = $request->input('price');
        $cantidad = $request->input('cantidad');
        $descuento = $request->input('descuento');

        for ($count = 0; $count < count($producto); $count++) {
            $productos = ProductosNotasCosmica::where('producto', $producto[$count])
            ->where('id_notas_productos', $id)
            ->firstOrFail();

            $precio = $price[$count];
            $cleanPrice2 = floatval(str_replace(['$', ','], '', $precio));
            $data = array(
                'price' => $cleanPrice2,
                'cantidad' => $cantidad[$count],
                'descuento' => $descuento[$count],
            );
            $productos->update($data);
        }

        $nota = NotasProductosCosmica::findOrFail($id);
        $total_final = $request->get('total_final');
        $cleanPrice3 = floatval(str_replace(['$', ','], '', $total_final));
        $cleanPrice4 = floatval(str_replace(['$', ','], '', $request->get('subtotal_final')));
        $nota->subtotal = $cleanPrice4;
        $nota->total = $cleanPrice3;
        $nota->save();

        return redirect()->back()->with('success', 'Se ha actualizado con exito');
    }

    public function imprimir($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasProductosCosmica::find($id);

        $nota_productos = ProductosNotasCosmica::where('id_notas_productos', $nota->id)->get();

        $pdf = \PDF::loadView('admin.cotizacion_cosmica.pdf_nota', compact('nota', 'today', 'nota_productos'));
        if($nota->folio == null){
            $folio = $nota->id;
        }else{
            $folio = $nota->folio;
        }
        return $pdf->stream();
       //  return $pdf->download('Cotizacion Cosmica'. $folio .'/'.$today.'.pdf');
    }

    public function update_estatus(Request $request, $id){

        $nota = NotasProductosCosmica::find($id);
        $nota->estatus_cotizacion = 'Aprobada';
        $nota->update();

        if($nota->id_usuario){
            if(Cosmikausers::where('id_cliente', $nota->id_usuario)->exists()){
                $distribuidora = Cosmikausers::where('id_cliente', $nota->id_usuario)->first();
                $suma = $distribuidora->puntos_acomulados + $nota->subtotal;
                $distribuidora->puntos_acomulados = $suma;
                $distribuidora->consumido_totalmes = $suma;
                $distribuidora->update();
            }
        }

        return redirect()->back()->with('success', 'Se ha actualizado con exito');
    }

    public function update_protocolo(Request $request, $id){

        $distribuidora = Cosmikausers::find($id);
        $distribuidora->claves_protocolo = $request->input('claves_protocolo');
        $distribuidora->update();

        return redirect()->back()->with('success', 'Se ha actualizado con exito');
    }

    protected function checkMembresia()
    {
        $users = Cosmikausers::all();

        foreach ($users as $user) {
            $this->handleUserMembresia($user);
            $user->save();
        }
    }

    protected function handleUserMembresia($user)
    {
        $membresiaFin = Carbon::parse($user->membresia_fin);
        $diasRestantes = Carbon::now()->diffInDays($membresiaFin, false);
        $meta = $user->membresia === 'Cosmos' ? 1500 : ($user->membresia === 'Estelar' ? 2500 : 0);

        if ($diasRestantes == 0 && $user->consumido_totalmes >= $meta) {
            $this->createBitacora($user);
            $user->membresia_fin = $membresiaFin->addMonth()->format('Y-m-d');
            $user->consumido_totalmes = 0;
            $user->meses_acomulados += 1;
        } elseif ($diasRestantes < 0 && $diasRestantes >= -5) {
            if ($user->consumido_totalmes < $meta && $diasRestantes == -5) {
                $this->createBitacora($user);
                $user->puntos_acomulados = 0;
                $user->meses_acomulados = 0;
                $user->membresia_estatus = 'Inactiva';
            }
        } elseif ($diasRestantes < -5) {
            $this->createBitacora($user);
            $user->puntos_acomulados = 0;
            $user->meses_acomulados = 0;
            $user->membresia_estatus = 'Inactiva';
        }
    }

    protected function createBitacora($user)
    {
        $bitacora = new Bitacora_cosmikausers();
        $bitacora->id_cliente = $user->id_cliente;
        $bitacora->membresia = $user->membresia;
        $bitacora->puntos_acomulados = $user->puntos_acomulados;
        $bitacora->membresia_inicio = $user->membresia_inicio;
        $bitacora->membresia_fin = $user->membresia_fin;
        $bitacora->meses_acomulados = $user->meses_acomulados;
        $bitacora->consumido_totalmes = $user->consumido_totalmes;
        $bitacora->claves_protocolo = $user->claves_protocolo;
        $bitacora->save();
    }
}
