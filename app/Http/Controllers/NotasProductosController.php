<?php

namespace App\Http\Controllers;


use App\Models\ProductosNotasId;
use App\Models\NotasProductos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use Illuminate\Support\Str;
use Session;
use Hash;
use Codexshaper\WooCommerce\Facades\Product;


class NotasProductosController extends Controller
{
    public function index(){
        $notas = NotasProductos::orderBy('id','DESC')->get();

        return view('admin.notas_productos.index', compact('notas'));
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
            Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        $notas_productos = new NotasProductos;
        $notas_productos->id_usuario = $payer->id;
        $notas_productos->tipo = $request->get('tipo');
        $notas_productos->metodo_pago = $request->get('metodo_pago');
        $notas_productos->fecha = $request->get('fecha');
        $notas_productos->restante = $request->get('restante');
        $notas_productos->nota = $request->get('nota');
        $notas_productos->save();

        $notas = NotasProductos::find($notas_productos->id);

        if ($request->get('tipo') == 'Porcentaje') {
            // Aplicar descuento porcentaje al total
            $descuento = $request->get('restante') / 100;
            $total = 0;

            if ($request->has('campo')) {
                $nuevosCampos = $request->input('campo');
                $nuevosCampos2 = $request->input('campo2');
                $nuevosCampos3 = $request->input('campo3');

                foreach ($nuevosCampos as $index => $campo) {

                    $notas_inscripcion = new ProductosNotasId;
                    $notas_inscripcion->id_notas_productos = $notas->id;
                    $notas_inscripcion->producto = $campo;
                    $notas_inscripcion->price = $nuevosCampos2[$index];
                    $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                    $notas_inscripcion->save();

                    $precio = $nuevosCampos2[$index];
                    $cantidad = $nuevosCampos3[$index];
                    $subtotal = $precio * $cantidad;
                    $total += $subtotal;
                }

                $descuentoAplicado = $total * $descuento;
                $total -= $descuentoAplicado;
            }

            $notas->total = $total;
        } elseif ($request->get('tipo') == 'Fijo') {
            // Restar descuento fijo al total
            $descuento = $request->get('restante');
            $total = 0;

            if ($request->has('campo')) {
                $nuevosCampos = $request->input('campo');
                $nuevosCampos2 = $request->input('campo2');
                $nuevosCampos3 = $request->input('campo3');

                foreach ($nuevosCampos as $index => $campo) {
                    $notas_inscripcion = new ProductosNotasId;
                    $notas_inscripcion->id_notas_productos = $notas->id;
                    $notas_inscripcion->producto = $campo;
                    $notas_inscripcion->price = $nuevosCampos2[$index];
                    $notas_inscripcion->cantidad = $nuevosCampos3[$index];
                    $notas_inscripcion->save();

                    $precio = $nuevosCampos2[$index];
                    $cantidad = $nuevosCampos3[$index];
                    $subtotal = $precio * $cantidad;
                    $total += $subtotal;
                }

                $total -= $descuento;
            }

            $notas->total = $total;
        }

        $notas->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');
    }

    public function update(Request $request, $id){
        $notas = NotasProductos::find($id);
        $notas->metodo_pago = $request->get('metodo_pago');
        $notas->tipo = $request->get('tipo');
        $notas->fecha = $request->get('fecha');
        $notas->total = $request->get('total');
        $notas->restante = $request->get('restante');
        $notas->nota = $request->get('nota');

        $productos = ProductosNotasId::where('id_notas_productos', '=', $id)->get();
        $total = 0;

        foreach ($productos as $producto) {
            $precio = $producto->price;
            $cantidad = $producto->cantidad;
            $subtotal = $precio * $cantidad;
            $total += $subtotal;
        }

        if ($request->get('tipo') == 'Porcentaje') {
            // Aplicar descuento porcentaje al total
            $descuento = $request->get('restante') / 100;
            $descuentoAplicado = $total * $descuento;
            $total -= $descuentoAplicado;

        } elseif ($request->get('tipo') == 'Fijo') {
            $descuento = $request->get('restante');
            $total -= $descuento;
        }

        $notas->total = $total;

        $notas->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha actualizada');
    }

    public function delete($id)
    {
        $registro = ProductosNotasId::find($id); // Buscar el registro por su ID
        // Realizar las operaciones necesarias antes de eliminar el registro, si las hay
        $registro->delete();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Se ha eliminado');
    }

}