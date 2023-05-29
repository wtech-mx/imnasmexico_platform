<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Factura;
use Session;
use Hash;

class FacturasController extends Controller
{
    public function index(){
        $facturas = Factura::get();

        return view('admin.facturas.index',compact('facturas'));
    }

    public function update(Request $request, $id){
        $cliente = User::where('id', $request->get('id_user'))->first();

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $ruta_estandar = base_path('../public_html/plataforma.imnasmexico.com/documentos/' . $cliente->telefono);
        }else{
            $ruta_estandar = public_path() . '/documentos/' . $cliente->telefono;
        }
            $factura = Factura::find($id);
            $factura->estatus = $request->get('estatus');
            $factura->nota = $request->get('nota');

            if ($request->hasFile("factura")) {
                $file = $request->file('factura');
                $path = $ruta_estandar;
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $factura->factura = $fileName;
            }

        $factura->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->back()->with('success', 'Actualziado con exito');

    }
}
