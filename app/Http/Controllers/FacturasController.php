<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Factura;
use Wafto\Sepomex\Models\Sepomex;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;

use Session;
use Hash;

class FacturasController extends Controller
{


    public function facturascion_index(){

        return view('user.facturacion.facturascion_index');

    }

    public function facturas_user(){

        return view('user.facturacion.facturacion');
    }


    public function facturas_userNAS(){

        return view('user.facturacion.facturacion_nas');

    }

    public function searchFolio(Request $request)
    {
        $folio = $request->query('folio');
        if (! $folio) {
            return response()->json(['success' => false, 'message' => 'Debes proporcionar un folio.'], 422);
        }

        $nota = NotasProductosCosmica::with('factura')
        ->where('folio', $folio)
        ->first();

        if (! $nota) {
            return response()->json(['success' => false, 'message' => 'No existe ninguna nota con ese folio.'], 404);
        }
        if ($nota->factura != 1) {
            return response()->json(['success' => false, 'message' => 'Esta nota no está marcada para facturar.'], 403);
        }

        // Renderizamos el partial con Blade
        $html = view('user.facturacion.resultado', [
            'nota' => $nota,
            'tipo' => 'cosmica',      // <-- marcamos que viene de Cosmica
        ])->render();

        return response()->json([
            'success' => true,
            'html'    => $html,
        ]);
    }

    public function emisionfacturaCosmica(Request $request,$id)
    {

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $facturas = base_path('../public_html/plataforma.imnasmexico.com/facturas/');
        }else{
            $facturas = public_path() . '/facturas';
        }

        $factura = Factura::where('id_notas_cosmica', $id)->first();


        // if ($request->hasFile("situacion_fiscal")) {
        //     $file = $request->file('situacion_fiscal');
        //     $path = $facturas;
        //     $fileName = uniqid() . $file->getClientOriginalName();
        //     $file->move($path, $fileName);
        //     $factura->situacion_fiscal = $fileName;
        // }

        $factura->razon_social = $request->get('razon_cliente');
        $factura->rfc = $request->get('rfc_cliente');
        $factura->cfdi = $request->get('cfdi_cliente');
        $factura->regimen_fiscal = $request->get('regimen_fiscal_cliente');
        $factura->codigo_postal = $request->get('codigo_postal');
        $factura->colonia = $request->get('colonia');
        $factura->ciudad = $request->get('ciudad');
        $factura->municipio = $request->get('municipio');
        $factura->direccion_cliente = $request->get('direccion_cliente');
        $factura->update();

        return response()->json([
            'success' => true,
            'message' => 'Factura emitida correctamente.'
        ]);

    }

    public function emisionfacturaNas(Request $request,$id)
    {
        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $facturas = base_path('../public_html/plataforma.imnasmexico.com/facturas/');
        }else{
            $facturas = public_path() . '/facturas';
        }

        $nota = Factura::where('folio', $id)->first();

        if ($request->hasFile("situacion_fiscal")) {
            $file = $request->file('situacion_fiscal');
            $path = $facturas;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->situacion_fiscal = $fileName;
        }

        $nota->razon_social = $request->get('razon_cliente');
        $nota->rfc = $request->get('rfc_cliente');
        $nota->cfdi = $request->get('cfdi_cliente');
        $nota->regimen_fiscal = $request->get('regimen_fiscal_cliente');
        $nota->codigo_postal = $request->get('codigo_postal');
        $nota->colonia = $request->get('colonia');
        $nota->ciudad = $request->get('ciudad');
        $nota->municipio = $request->get('municipio');
        $nota->direccion_cliente = $request->get('direccion_cliente');
        $nota->update();

    }

    public function searchFolioNas(Request $request)
    {
        $folio = $request->query('folio');
        if (! $folio) {
            return response()->json(['success' => false, 'message' => 'Debes proporcionar un folio.'], 422);
        }

        $nota = NotasProductos::where('folio', $folio)->first();
        if (! $nota) {
            return response()->json(['success' => false, 'message' => 'No existe ninguna nota con ese folio.'], 404);
        }
        if ($nota->factura != 1) {
            return response()->json(['success' => false, 'message' => 'Esta nota no está marcada para facturar.'], 403);
        }


        $html = view('user.facturacion.resultado', [
            'nota' => $nota,
            'tipo' => 'nas',          // <-- marcamos que viene de NAS
        ])->render();

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
        $facturas = Factura::where('id_orders', '>', 0)->get();

        return view('admin.facturas.index',compact('facturas'));
    }


    public function indexfacturasCosmica(){
        // Sólo los que tengan id_notas_cosmica distinto de null Y > 0
        $facturas = Factura::with(['User','NotasCosmica'])
            ->where('id_notas_cosmica', '>', 0)
            ->get();

        return view('admin.facturas.indexfacturasCosmica', compact(
            'facturas',
        ));
    }

    public function indexfacturasNas(){
        // Sólo los que tengan id_notas_cosmica distinto de null Y > 0

        $facturas = Factura::with(['User','NotasNas'])
            ->where('id_notas_nas', '>', 0)
            ->get();


        return view('admin.facturas.indexfacturasNas', compact(
            'facturas',
        ));
    }

    public function indexfacturasNasTiendita(){

        // Sólo los que tengan id_notas_nas distinto de null Y > 0
        $facturas = Factura::with('User')
            ->where('id_notas_nas_tiendita', '>', 0)
            ->get();


        return view('admin.facturas.indexfacturasNasTiendita', compact(
            'facturas',
        ));
    }

    public function indexfacturasCursos(){

        // Sólo los que tengan id_notas_cursos distinto de null Y > 0
        $facturas = Factura::with(['User','NotasCursos'])
            ->where('id_notas_cursos', '>', 0)
            ->get();

        return view('admin.facturas.indexfacturasCursos', compact(
            'facturas',
        ));
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
