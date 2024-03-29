<?php

namespace App\Http\Controllers;

use App\Models\ProductosNotasId;
use App\Models\NotasProductos;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Str;
use Session;
use Hash;
use DB;
use Carbon\Carbon;

class CotizacionController extends Controller
{
    public function index(){

        $primerDiaDelMes = date('Y-m-01');
        $ultimoDiaDelMes = date('Y-m-t');

        $now = Carbon::now();
        $administradores = User::where('cliente','=' , NULL)->orWhere('cliente','=' ,'5')->get();
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();

        $notas = NotasProductos::whereBetween('fecha', [$primerDiaDelMes, $ultimoDiaDelMes])
        ->orderBy('id','DESC')->where('tipo_nota','=' , 'Cotizacion')->get();

        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.cotizacion.index', compact('notas', 'products', 'clientes', 'administradores'));
    }

    public function create(){
        $clientes = User::where('cliente','=' ,'1')->orderBy('id','DESC')->get();
        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.cotizacion.create', compact('products', 'clientes'));
    }

    public function store(request $request){
        // Creacion de user
        $code = Str::random(8);

        $notas_productos = new NotasProductos;
        if($request->get('email') == NULL){
            $notas_productos->nombre = $request->get('name');
            $notas_productos->telefono = $request->get('telefono');
        }else{
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
                // Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
            }
            $notas_productos->id_usuario = $payer->id;
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
            $envio = 250;
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

        $notas_productos->tipo_nota = 'Cotizacion';
        $notas_productos->metodo_pago = $request->get('metodo_pago');
        $notas_productos->fecha = $request->get('fecha');
        $notas_productos->tipo = $sumaCampo4;
        $notas_productos->restante = $request->get('descuento');
        $notas_productos->total = $totalConDescuento;
        $notas_productos->nota = $request->get('nota');
        $notas_productos->metodo_pago2 = $request->get('metodo_pago2');
        $notas_productos->monto = $request->get('monto');
        $notas_productos->monto2 = $request->get('monto2');

        $tipoNota = $notas_productos->tipo_nota;
        $ultimoFolio = NotasProductos::where('tipo_nota', $tipoNota)
            ->max('folio');

        $numeroFolio = ($ultimoFolio) ? intval(substr($ultimoFolio, 1)) + 1 : 1;
        $folio = $tipoNota[0] . $numeroFolio;

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

            foreach ($nuevosCampos as $index => $campo) {
                $notas_inscripcion = new ProductosNotasId;
                $notas_inscripcion->id_notas_productos = $notas_productos->id;
                $notas_inscripcion->producto = $campo;
                $notas_inscripcion->price = $nuevosCampos2[$index];
                $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                $notas_inscripcion->save();
            }
        }

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('notas_cotizacion.index')
        ->with('success', 'Creado exitosamente.');
    }

    public function update(Request $request, $id){
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pagos';
        }
        $notas = NotasProductos::find($id);
        $notas->metodo_pago = $request->get('metodo_pago');
        $notas->tipo = $request->get('tipo');
        $notas->fecha = $request->get('fecha');
        $notas->nota = $request->get('nota');
        $notas->metodo_pago2 = $request->get('metodo_pago2');
        $notas->monto = $request->get('monto');
        $notas->monto2 = $request->get('monto2');

        $sum_total = ProductosNotasId::where('id_notas_productos', '=', $id)->get();
        $total_pro = $sum_total->sum('price');

            $descuento = $notas->restante / 100;
            $total1 = 0;

            if ($request->has('campo')) {
                $nuevosCampos = $request->input('campo');
                $nuevosCampos2 = $request->input('campo4');
                $nuevosCampos3 = $request->input('campo3');

                foreach ($nuevosCampos as $index => $campo) {

                    $notas_inscripcion = new ProductosNotasId;
                    $notas_inscripcion->id_notas_productos = $notas->id;
                    $notas_inscripcion->producto = $campo;
                    $notas_inscripcion->price = $nuevosCampos2[$index];
                    $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                    $notas_inscripcion->save();

                    $precio = $nuevosCampos2[$index];
                    $subtotal = $precio;
                    $total1 += $subtotal;
                    $total = $total_pro + $total1;

                }

                $descuentoAplicado = $total * $descuento;
                $total -= $descuentoAplicado;

            }
            $notas->total = $total;
        if ($request->hasFile("foto_pago2")) {
            $file = $request->file('foto_pago2');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas->foto_pago2 = $fileName;
        }
        $notas->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');
    }

    public function imprimir($id){
        $diaActual = date('Y-m-d');
        $today =  date('d-m-Y');

        $nota = NotasProductos::find($id);

        $nota_productos = ProductosNotasId::where('id_notas_productos', $nota->id)->get();

        $pdf = \PDF::loadView('admin.notas_productos.pdf_nota', compact('nota', 'today', 'nota_productos'));
        if($nota->folio == null){
            $folio = $nota->id;
        }else{
            $folio = $nota->folio;
        }
       // return $pdf->stream();
         return $pdf->download('Nota cotizacion'. $folio .'/'.$today.'.pdf');
    }

    public function delete($id)
    {
        $registro = ProductosNotasId::find($id); // Buscar el registro por su ID
        // Realizar las operaciones necesarias antes de eliminar el registro, si las hay
        $registro->delete();

        $sum_total = DB::table('productos_notas_id')->get();
        $total_pro = 0;
        foreach($sum_total as  $productos){
            $precio = $productos->price;
            $cantidad = $productos->cantidad;
            $subtotal = $precio * $cantidad;
            $total_pro += $subtotal;
        }

        $nota = NotasProductos::where('id', '=', $registro->id_notas_productos)->first();
        if ($nota->tipo == 'Fijo') {
            $descuento = $nota->restante;
            $total_pro -= $descuento;
        }elseif ($nota->tipo == 'Porcentaje') {
            $descuento = $nota->restante / 100;
            $descuentoAplicado = $total_pro * $descuento;
            $total_pro -= $descuentoAplicado;
        }
        $nota->total = $total_pro;
        $nota->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha eliminado');
    }

    public function update_productos(Request $request){
        $productos = $request->input('productos');

        foreach ($productos as $id => $data) {
            $producto = ProductosNotasId::findOrFail($id);

            // Actualizar los campos modificados
            $producto->producto = $data['producto'];
            $producto->price = $data['price'];
            $producto->cantidad = $data['cantidad'];
            $producto->save();
        }

        $sum_total = DB::table('productos_notas_id')->get();
        $total_pro = 0;
        foreach($sum_total as  $productos){
            $precio = $productos->price;
            $cantidad = $productos->cantidad;
            $subtotal = $precio * $cantidad;
            $total_pro += $subtotal;
        }

        $nota = NotasProductos::where('id', '=', $producto->id_notas_productos)->first();
        if ($nota->tipo == 'Fijo') {
            $descuento = $nota->restante;
            $total_pro -= $descuento;
        }elseif ($nota->tipo == 'Porcentaje') {
            $descuento = $nota->restante / 100;
            $descuentoAplicado = $total_pro * $descuento;
            $total_pro -= $descuentoAplicado;
        }
        $nota->total = $total_pro;
        $nota->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');
    }

    public function eliminar($id){
        // Encuentra la nota por su ID
        $nota = NotasProductos::find($id);

        // Elimina todos los productos relacionados
        $nota->ProductosNotasId()->delete();

        // Verifica si la nota existe
        if (!$nota) {
            abort(404, 'La nota no existe');
        }

        // Elimina la nota
        $nota->delete();

        // Redirecciona o responde según tus necesidades
        return redirect()->back()->with('success', 'La nota se eliminó correctamente');
    }
}
