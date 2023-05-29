<?php

namespace App\Http\Controllers;


use App\Models\ProductosNotasId;
use App\Models\NotasProductos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use App\Models\Products;
use Illuminate\Support\Str;
use Session;
use Hash;
use DB;
use Codexshaper\WooCommerce\Facades\Product;


class NotasProductosController extends Controller
{
    public function index(){
        $notas = NotasProductos::orderBy('id','DESC')->get();
        $products = Products::orderBy('nombre','ASC')->get();

        return view('admin.notas_productos.index', compact('notas', 'products'));
    }

    public function store(request $request){
        // Creacion de user
        $code = Str::random(8);

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

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $pago_fuera = base_path('../public_html/plataforma.imnasmexico.com/pago_fuera');
        }else{
            $pago_fuera = public_path() . '/pagos';
        }

        $notas_productos = new NotasProductos;
        $notas_productos->id_usuario = $payer->id;
        $notas_productos->metodo_pago = $request->get('metodo_pago');
        $notas_productos->fecha = $request->get('fecha');
        $notas_productos->restante = $request->get('descuento');
        $notas_productos->total = $request->get('totalDescuento');
        $notas_productos->nota = $request->get('nota');
        $notas_productos->metodo_pago2 = $request->get('metodo_pago2');
        $notas_productos->monto = $request->get('monto');
        $notas_productos->monto2 = $request->get('monto2');

        if ($request->hasFile("foto_pago2")) {
            $file = $request->file('foto_pago2');
            $path = $pago_fuera;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_productos->foto_pago2 = $fileName;
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
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
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

}
