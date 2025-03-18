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
        $fechaHoy = Carbon::now()->startOfDay();
        $fechaAyer = Carbon::yesterday()->startOfDay();

        // ===================== Lógica para BodegaPedidosCosmica =====================
        // Verificar si existe un pedido del día anterior con estatus 'Aprobada'
        $pedidoAyerCosmica = BodegaPedidosCosmica::where('estatus', 'Aprobada')
            ->whereDate('fecha_pedido', $fechaAyer)
            ->first();

        if ($pedidoAyerCosmica) {
            // Cambiar el estatus del pedido del día anterior a 'Cancelada'
            $pedidoAyerCosmica->update(['estatus' => 'Cancelada']);
            $this->info('El pedido del día anterior en BodegaPedidosCosmica con estatus "Aprobada" ha sido cambiado a "Cancelada".');
        }

        // Verificar si ya existe un pedido para el día actual
        $pedidoHoyCosmica = BodegaPedidosCosmica::whereDate('fecha_pedido', $fechaHoy)->first();

        if ($pedidoHoyCosmica) {
            $this->info('Ya existe un pedido en BodegaPedidosCosmica para el día de hoy. No se generará un nuevo pedido.');
        } else {
            // Generar un nuevo pedido para BodegaPedidosCosmica
            $this->generarPedidoCosmica();
        }

        // ===================== Lógica para BodegaPedidos =====================
        // Verificar si existe un pedido del día anterior con estatus 'Aprobada'
        $pedidoAyer = BodegaPedidos::where('estatus', 'Aprobada')
            ->whereDate('fecha_pedido', $fechaAyer)
            ->first();

        if ($pedidoAyer) {
            // Cambiar el estatus del pedido del día anterior a 'Cancelada'
            $pedidoAyer->update(['estatus' => 'Cancelada']);
            $this->info('El pedido del día anterior en BodegaPedidos con estatus "Aprobada" ha sido cambiado a "Cancelada".');
        }

        // Verificar si ya existe un pedido para el día actual
        $pedidoHoy = BodegaPedidos::whereDate('fecha_pedido', $fechaHoy)->first();

        if ($pedidoHoy) {
            $this->info('Ya existe un pedido en BodegaPedidos para el día de hoy. No se generará un nuevo pedido.');
            return 0;
        }

        // Generar un nuevo pedido para BodegaPedidos
        $this->generarPedidoNAS();

        return 0;
    }

    private function generarPedidoCosmica()
    {
        // Obtener productos con bajo stock para BodegaPedidosCosmica
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
            $this->info('No hay productos con bajo stock en BodegaPedidosCosmica.');
            return;
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

        $this->info('Nuevo pedido generado con éxito en BodegaPedidosCosmica.');
    }

    private function generarPedidoNAS()
    {
        // Obtener productos con bajo stock para BodegaPedidos
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
            $this->info('No hay productos con bajo stock en BodegaPedidos.');
            return;
        }

        // Crear un nuevo pedido
        $pedido = BodegaPedidos::create([
            'estatus' => 'Aprobada',
            'estatus_lab' => 'Aprobada',
            'fecha_pedido' => Carbon::now()->format('Y-m-d H:i:s'),
            'fecha_aprovado' => Carbon::now()->format('Y-m-d H:i:s'),
            'id_user' => 2474,
        ]);

        foreach ($productosBajoStock as $producto) {
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

        $this->info('Nuevo pedido generado con éxito en BodegaPedidos.');
    }
}
