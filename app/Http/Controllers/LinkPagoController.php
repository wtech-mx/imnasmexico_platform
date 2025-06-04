<?php

namespace App\Http\Controllers;

use App\Models\LinkPago;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LinkPagoController extends Controller
{
    /**
     * Mostrar listado (index).
     */
    public function index()
    {
        // Obtiene todos los registros para la tabla
        // (en AJAX usaremos JSON solo para store/update/destroy,
        //  index devolverá la vista completa con $linkPagos).
        $linkPagos = LinkPago::orderBy('id','desc')->get();
        return view('admin.link_pago.index', compact('linkPagos'));
    }

    public function custom_link_pago($id)
    {
        // Obtiene todos los registros para la tabla
        // (en AJAX usaremos JSON solo para store/update/destroy,
        //  index devolverá la vista completa con $linkPagos).
        $linkPago = LinkPago::find($id);
        return view('admin.link_pago.customlinkpago', compact('linkPago'));
    }

    /**
     * Almacenar nuevo LinkPago (store vía AJAX).
     */
    public function store(Request $request)
    {
        // Validar campos
        $data = $request->validate([
            'cliente'     => 'required|string|max:191',
            'titulo'      => 'required|string|max:191',
            'descripcion' => 'nullable|string',
            'estatus'     => ['required', Rule::in(['Activo','Inactivo'])],
            'monto'       => 'required|numeric|min:0',
        ]);

        $nuevo = LinkPago::create($data);

        // Devolver JSON con el nuevo registro
        return response()->json([
            'success' => true,
            'linkPago' => $nuevo,
            'message' => 'Link de pago creado correctamente.'
        ], 201);
    }

    /**
     * Obtener datos de un LinkPago para editar (edit vía AJAX).
     */
    public function edit($id)
    {
        $lp = LinkPago::find($id);
        if (! $lp) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado.'], 404);
        }
        return response()->json(['success' => true, 'linkPago' => $lp]);
    }

    /**
     * Actualizar un LinkPago existente (update vía AJAX).
     */
    public function update(Request $request, $id)
    {
        $lp = LinkPago::find($id);
        if (! $lp) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado.'], 404);
        }

        $data = $request->validate([
            'cliente'     => 'required|string|max:191',
            'titulo'      => 'required|string|max:191',
            'descripcion' => 'nullable|string',
            'estatus'     => ['required', Rule::in(['Activo','Inactivo'])],
            'monto'       => 'required|numeric|min:0',
        ]);

        $lp->update($data);

        return response()->json([
            'success' => true,
            'linkPago' => $lp,
            'message' => 'Link de pago actualizado correctamente.'
        ]);
    }

    /**
     * Eliminar un LinkPago (destroy vía AJAX).
     */
    public function destroy($id)
    {
        $lp = LinkPago::find($id);
        if (! $lp) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado.'], 404);
        }
        $lp->delete();

        return response()->json([
            'success' => true,
            'message' => 'Link de pago eliminado correctamente.'
        ]);
    }
}
