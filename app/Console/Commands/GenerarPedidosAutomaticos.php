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
        $productosBajoStock = Products::where('stock', '<', 30)->where('categoria', '=', 'Cosmica')->where('subcategoria', '=', 'Producto')->get();

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
            $cantidadNecesaria = 30 - $producto->stock;

            // Agregar producto al detalle del pedido
            BodegaPedidosProductosCosmica::create([
                'id_pedido' => $pedido->id,
                'id_producto' => $producto->id,
                'cantidad_pedido' => $cantidadNecesaria,
                'stock_anterior' => $producto->stock,
                'cantidad_restante' => $cantidadNecesaria,
                'cantidad_entregada_lab' => $cantidadNecesaria,
            ]);

            // Actualizar el stock del producto (si corresponde)
            //$producto->update(['stock' => 30]);
        }

        $this->info('Pedido generado con éxito.');
        return 0;
    }
}
