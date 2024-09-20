<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Carbon\Carbon;

class PedidosWooController extends Controller
{
    public function index(Request $request)
    {
        // Obtener las fechas de inicio y fin del mes actual
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

        // Traer las órdenes del mes actual utilizando las fechas como parámetros
        $orders = WooCommerce::all('orders', [
            'after' => $startOfMonth . 'T00:00:00',  // Inicio del mes
            'before' => $endOfMonth . 'T23:59:59',   // Fin del mes
            'per_page' => 100,                       // Limitar a 100 órdenes
        ]);

        // Retornar la vista con los pedidos
        return view('admin.notas_productos.index_woo', compact('orders'));
    }

    public function updateStatuWoo(Request $request, $id)
    {
        // Validar el nuevo estado y el archivo
        $request->validate([
            'status' => 'required|string',
            'guia_de_envio' => 'nullable|file', // Validar si se carga el archivo
        ]);

        // Actualizar el estado de la orden en WooCommerce
        $updatedOrder = WooCommerce::update('orders/' . $id, [
            'status' => $request->status,
        ]);

        // Verificar si se seleccionó el estado "guia_cargada" y si se subió un archivo
        if ($request->status === 'guia_cargada' && $request->hasFile('guia_de_envio')) {
            // Definir la ruta para guardar el archivo
            $dominio = $request->getHost();
            if ($dominio == 'plataforma.imnasmexico.com') {
                $ruta_guia = base_path('../public_html/plataforma.imnasmexico.com/guias');
            } else {
                $ruta_guia = public_path() . '/guias';
            }

            // Guardar el archivo con un nombre único
            $file = $request->file('guia_de_envio');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move($ruta_guia, $fileName);

            // Ruta completa del archivo guardado
            $filePath = $ruta_guia . '/' . $fileName;

            // Actualizar la meta información en WooCommerce para el campo 'guia_de_envio'
            $updatedOrderMeta = WooCommerce::update('orders/' . $id, [
                'meta_data' => [
                    [
                        'key' => 'guia_de_envio',
                        'value' => $fileName, // Guardar la ruta completa del archivo en WooCommerce
                    ],
                ],
            ]);

        }

        // Verificar si la actualización fue exitosa
        if ($updatedOrder) {
            return redirect()->back()->with('success', 'Estado de la orden y archivo actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el estado de la orden.');
        }
    }



}
