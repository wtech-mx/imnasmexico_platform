<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Cupon;


class MarketingController extends Controller
{

    public function index_cupon(Request $request)
    {
        $cupones = Cupon::orderBy('id','DESC')->get();
        return view('admin.marketing.cupones', compact('cupones'));
    }

    public function store_cupon(Request $request)
    {
        $cupon = new Cupon;
        $cupon->nombre = $request->get('nombre');
        $cupon->tipo_de_descuento = $request->get('tipo_de_descuento');
        $cupon->importe = $request->get('importe');
        $cupon->fecha_inicio = $request->get('fecha_inicio');
        $cupon->fecha_fin = $request->get('fecha_fin');
        $cupon->gasto_min = $request->get('gasto_min');
        $cupon->inc_cursos = $request->get('inc_cursos');
        $cupon->exc_cursos = $request->get('exc_cursos');
        $cupon->estado = $request->get('estado');
        $cupon->limite_uso_por_cupon = $request->get('limite_uso_por_cupon');
        $cupon->limite_uso_por_usuario = $request->get('limite_uso_por_usuario');
        $cupon->id_usuario = $request->get('id_usuario');
        $cupon->id_curso = $request->get('id_curso');
        $cupon->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

    public function update_cupon(Request $request, $id)
    {
        $cupon = Cupon::find($id);
        $cupon->nombre = $request->get('nombre');
        $cupon->tipo_de_descuento = $request->get('tipo_de_descuento');
        $cupon->importe = $request->get('importe');
        $cupon->fecha_inicio = $request->get('fecha_inicio');
        $cupon->fecha_fin = $request->get('fecha_fin');
        $cupon->gasto_min = $request->get('gasto_min');
        $cupon->inc_cursos = $request->get('inc_cursos');
        $cupon->exc_cursos = $request->get('exc_cursos');
        $cupon->estado = $request->get('estado');
        $cupon->limite_uso_por_cupon = $request->get('limite_uso_por_cupon');
        $cupon->limite_uso_por_usuario = $request->get('limite_uso_por_usuario');
        $cupon->id_usuario = $request->get('id_usuario');
        $cupon->id_curso = $request->get('id_curso');
        $cupon->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Envio de correo exitoso.');

    }

}
