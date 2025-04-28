<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Factura;
use Wafto\Sepomex\Models\Sepomex;


use App\Models\NotasProductosCosmica;

use Session;
use Hash;

class FacturasController extends Controller
{

    public function facturas_user(){

        return view('user.facturacion.facturacion');

    }

    public function searchFolio(Request $request)
    {
        $folio = $request->query('folio');
        if (! $folio) {
            return response()->json(['success' => false, 'message' => 'Debes proporcionar un folio.'], 422);
        }

        $nota = NotasProductosCosmica::where('folio', $folio)->first();
        if (! $nota) {
            return response()->json(['success' => false, 'message' => 'No existe ninguna nota con ese folio.'], 404);
        }
        if ($nota->factura != 1) {
            return response()->json(['success' => false, 'message' => 'Esta nota no está marcada para facturar.'], 403);
        }

        // Renderizamos el partial con Blade
        $html = view('user.facturacion.resultado', compact('nota'))->render();

        return response()->json([
            'success' => true,
            'html'    => $html,
        ]);
    }

    public function buscarCP(Request $request){
        $codigoPostal = $request->codigo_postal;

        $registros = Sepomex::where('d_codigo', $codigoPostal)->get();

        if ($registros->isEmpty()) {
            return response()->json(['message' => 'Código postal no encontrado'], 404);
        }
        return response()->json([
            'colonias' => $registros->pluck('d_asenta')->unique()->values(),
            'municipio' => $registros->first()->getAttribute('D_mnpio'),
            'estado' => $registros->first()->d_estado,
            'ciudad' => $registros->first()->d_ciudad,
            'clave_estado' => $registros->first()->c_estado,
            'clave_municipio' => $registros->first()->c_mnpio,
        ]);

    }


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
