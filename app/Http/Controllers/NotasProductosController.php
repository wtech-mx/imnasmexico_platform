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

        $nuevosCampos = $request->input('campo');
        $nuevosCampos2 = $request->input('campo2');
        $nuevosCampos3 = $request->input('campo3');

        $notas_productos = new NotasProductos;
        $notas_productos->id_usuario = $payer->id;
        $notas_productos->metodo_pago = $request->get('metodo_pago');
        $notas_productos->fecha = $request->get('fecha');
        $notas_productos->restante = $request->get('restante');
        $notas_productos->total = $request->get('total');
        $notas_productos->nota = $request->get('nota');
        $notas_productos->save();


        if ($request->has('campo')) {
            $nuevosCampos = $request->input('campo');
            $nuevosCampos2 = $request->input('campo2');
            $nuevosCampos3 = $request->input('campo3');

            foreach ($nuevosCampos as $index => $campo) {
                // Aquí puedes realizar las operaciones necesarias con cada campo adicional
                // Por ejemplo, guardar en la base de datos
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
        $notas = NotasProductos::find($id);
        $notas->metodo_pago = $request->get('metodo_pago');
        $notas->fecha = $request->get('fecha');
        $notas->total = $request->get('total');
        $notas->restante = $request->get('restante');
        $notas->nota = $request->get('nota');
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
