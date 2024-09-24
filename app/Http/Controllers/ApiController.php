<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotasPedidos;

class ApiController extends Controller
{
    public function recibirNotasPedidos(Request $request)
    {
        // Validar que se recibió un array de notas de pedido
        $validatedData = $request->validate([
            'notas_pedidos' => 'required|array',
            'notas_pedidos.*.id_user' => 'required|integer',
            'notas_pedidos.*.id_client' => 'required|integer',
            'notas_pedidos.*.metodo_pago' => 'required|string',
            'notas_pedidos.*.fecha' => 'required|date',
            'notas_pedidos.*.total' => 'required|numeric',
            'notas_pedidos.*.foto' => 'nullable|string',
        ]);

        // Recorrer las notas de pedido recibidas y guardarlas en la base de datos
        foreach ($validatedData['notas_pedidos'] as $notaPedido) {
            NotasPedidos::create($notaPedido);
        }

        return response()->json(['success' => true, 'message' => 'Todas las notas de pedido se guardaron correctamente']);
    }
}
