<?php

namespace App\Console\Commands;

use App\Models\BodegaPedidos;
use Illuminate\Console\Command;
use App\Models\Products; // Modelo de productos
use App\Models\BodegaPedidosCosmica; // Modelo del pedido
use App\Models\BodegaPedidosProductos;
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
                             ->orWhere('nombre', 'LIKE', '%Hydraboosters%')
                             ->orWhereIn('sku', ['324191', '197263', '116862', '902417', '631363', '868760', '631091', '362230']);
                })
                ->orWhere(function ($subQuery) {
                    $subQuery->where('stock', '<', 30)
                             ->where('nombre', 'NOT LIKE', '%Hydrabooster%')
                             ->where('nombre', 'NOT LIKE', '%Hydraboosters%')
                             ->where('nombre', 'NOT LIKE', '%Protector Solar%')
                             ->where('nombre', 'NOT LIKE', '%Shampoo%')
                             ->where('nombre', 'NOT LIKE', '%Micelar%')
                             ->whereNotIn('sku', ['324191', '197263', '116862', '902417', '631363', '868760', '631091', '362230']);
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
            $umbral = (stripos($producto->nombre, 'Hydrabooster') !== false || stripos($producto->nombre, 'Hydraboosters') !== false || in_array($producto->sku, ['324191', '197263', '116862', '902417', '631363', '868760', '631091', '362230']))
            ? 60
            : 30;
            $cantidadNecesaria = max(0, $umbral - $producto->stock);

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

        // =================================  S T O C K  P A R A  C A T E G O R I A  N A S  =================================
        $pedidoExistente = BodegaPedidos::whereDate('fecha_pedido', $fechaHoy)->first();

        if ($pedidoExistente) {
            $this->info('Ya se generó un pedido para hoy.');
            return 0;
        }

        // Obtener productos con bajo stock para la categoría NAS
        $productosBajoStock = Products::where(function ($query) {
            $query->where('categoria', '=', 'NAS')
                ->where('subcategoria', '=', 'Producto')
                ->where(function ($subQuery) {
                    $subQuery->where(function ($q) {
                        $q->where('nombre', 'LIKE', '%1.3 kg%')
                          ->orWhere('nombre', 'LIKE', '%1300 g%')
                          ->where('stock', '<', 15);
                    })
                    ->orWhere(function ($q) {
                        $q->where('nombre', 'LIKE', '%125ml%')
                          ->where('stock', '<', 30);
                    })
                    ->orWhere(function ($q) {
                        $q->where('nombre', 'LIKE', '%500 g%')
                          ->where('stock', '<', 15);
                    })
                    ->orWhere(function ($q) {
                        $q->whereIn('sku', ['392959', '771609', '753403'])
                          ->where('stock', '<', 10);
                    })
                    ->orWhere(function ($q) {
                        $q->where('stock', '<', 20)
                          ->where('nombre', 'NOT LIKE', '%1.3 kg%')
                          ->where('nombre', 'NOT LIKE', '%1300 g%')
                          ->where('nombre', 'NOT LIKE', '%125ml%')
                          ->where('nombre', 'NOT LIKE', '%500 g%')
                          ->whereNotIn('sku', ['392959', '771609', '753403']);
                    });
                });
        })
        ->get();

        if ($productosBajoStock->isEmpty()) {
            $this->info('No hay productos con bajo stock.');
            return 0;
        }

        // Crear un nuevo pedido para la categoría NAS
        $pedido = BodegaPedidos::create([
            'estatus' => 'Aprobada',
            'estatus_lab' => 'Aprobada',
            'fecha_pedido' => Carbon::now()->format('Y-m-d H:i:s'),
            'fecha_aprovado' => Carbon::now()->format('Y-m-d H:i:s'),
            'id_user' => 2474,
        ]);

        foreach ($productosBajoStock as $producto) {
            // Determinar el umbral de stock según las condiciones
            $umbral = 20; // Valor predeterminado para productos no especificados

            if (stripos($producto->nombre, '1.3 kg') !== false || stripos($producto->nombre, '1300 g') !== false) {
                $umbral = 15;
            } elseif (stripos($producto->nombre, '125ml') !== false) {
                $umbral = 30;
            } elseif (stripos($producto->nombre, '500 g') !== false) {
                $umbral = 15;
            } elseif (in_array($producto->sku, ['392959', '771609', '753403'])) {
                $umbral = 10;
            }

            $cantidadNecesaria = max(0, $umbral - $producto->stock);

            if ($cantidadNecesaria <= 0) {
                continue;
            }

            // Agregar producto al detalle del pedido
            BodegaPedidosProductos::create([
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
