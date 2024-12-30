<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Products; // Modelo de productos
use App\Models\BodegaPedidosCosmica; // Modelo del pedido
use App\Models\BodegaPedidosProductosCosmica; // Modelo del detalle del pedido
use Carbon\Carbon;

class GenerarPedidosAutomaticos extends Command
{
    protected $signature = 'pedidos:generar';
    protected $description = 'Generar pedidos automáticamente para productos con stock bajo';

    public function handle()
    {
        // Verificar si ya existe un pedido para el día actual
        $fechaHoy = Carbon::now()->startOfDay(); // Inicio del día actual
        $pedidoExistente = BodegaPedidosCosmica::whereDate('fecha_pedido', $fechaHoy)->first();

        if ($pedidoExistente) {
            $this->info('Ya se generó un pedido para hoy.');
            return 0;
        }

        // Obtener productos con bajo stock
        $productosBajoStock = Products::where(function ($query) {
            $query->where('stock', '<', 60)
                ->where(function ($subQuery) {
                    $subQuery->where('nombre', 'LIKE', '%Hydrabooster%')
                             ->orWhere('nombre', 'LIKE', '%Hydraboosters%');
                })
                ->orWhere(function ($subQuery) {
                    $subQuery->where('stock', '<', 30)
                             ->where('nombre', 'NOT LIKE', '%Hydrabooster%')
                             ->where('nombre', 'NOT LIKE', '%Hydraboosters%');
                });
        })
        ->where('categoria', '=', 'Cosmica')
        ->where('subcategoria', '=', 'Producto')
        ->get();

        if ($productosBajoStock->isEmpty()) {
            $this->info('No hay productos con bajo stock.');
            return 0;
        }

        // Crear un nuevo pedido
        $pedido = BodegaPedidosCosmica::create([
            'estatus' => 'Aprobada',
            'estatus_lab' => 'Aprobada',
            'fecha_pedido' => Carbon::now()->format('Y-m-d H:i:s'),
            'fecha_aprovado' => Carbon::now()->format('Y-m-d H:i:s'),
            'id_user' => 2474,
        ]);

        foreach ($productosBajoStock as $producto) {
            $umbral = (stripos($producto->nombre, 'Hydrabooster') !== false || stripos($producto->nombre, 'Hydraboosters') !== false) ? 60 : 30;
            $cantidadNecesaria = $umbral - $producto->stock;

            // Agregar producto al detalle del pedido
            BodegaPedidosProductosCosmica::create([
                'id_pedido' => $pedido->id,
                'id_producto' => $producto->id,
                'cantidad_pedido' => $cantidadNecesaria,
                'stock_anterior' => $producto->stock,
                'cantidad_restante' => $cantidadNecesaria,
                'cantidad_entregada_lab' => $cantidadNecesaria,
            ]);
        }

        $this->info('Pedido generado con éxito.');
        return 0;
    }
}
