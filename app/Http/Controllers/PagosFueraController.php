<?php

namespace App\Http\Controllers;

use App\Models\PagosFuera;
use Illuminate\Http\Request;
use session;

class PagosFueraController extends Controller
{
    public function inscripcion(){
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->where('inscripcion', '=', '0')->get();

        return view('admin.pagos_fuera.inscripcion', compact('pagos_fuera'));
    }

    public function store(Request $request)
    {
        $pagos_fuera = new PagosFuera;
        $pagos_fuera->nombre = $request->get('nombre');
        $pagos_fuera->correo = $request->get('correo');
        $pagos_fuera->telefono = $request->get('telefono');
        $pagos_fuera->modalidad = $request->get('modalidad');
        $pagos_fuera->curso = $request->get('curso');
        $pagos_fuera->inscripcion = '0';
        $pagos_fuera->pendiente = '0';
        $pagos_fuera->deudor = $request->get('deudor');
        $pagos_fuera->abono = $request->get('abono');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/pago_fuera';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $pagos_fuera->foto = $fileName;
        }

        $pagos_fuera->save();

        return redirect()->route('pagos.inscripcion')
            ->with('success', 'pago fuera created successfully.');
    }

    public function ChangeInscripcionStatus(Request $request)
    {
        $servicio = PagosFuera::find($request->id);
        $servicio->inscripcion = $request->inscripcion;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    public function pendientes(){
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->where('pendiente', '=', '0')->get();

        return view('admin.pagos_fuera.pendiente', compact('pagos_fuera'));
    }
    public function ChangePendienteStatus(Request $request)
    {
        $servicio = PagosFuera::find($request->id);
        $servicio->pendiente = $request->pendiente;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    public function deudores(){
        $pagos_fuera = PagosFuera::orderBy('id','DESC')->where('deudor', '=', '1')->get();

        return view('admin.pagos_fuera.deudores', compact('pagos_fuera'));
    }
    public function ChangeDeudorStatus(Request $request){
        $servicio = PagosFuera::find($request->id);
        $servicio->deudor = $request->deudor;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }


}
