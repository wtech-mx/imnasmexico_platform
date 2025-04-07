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
        $pedidoAyerCosmica = BodegaPedidosCosmica::where('estatus_lab', 'Aprobada')
            ->whereDate('fecha_pedido', $fechaAyer)
            ->first();

        if ($pedidoAyerCosmica) {
            // Cambiar el estatus del pedido del día anterior a 'Cancelada'
            $pedidoAyerCosmica->update(['estatus_lab' => 'Cancelada']);
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
        $pedidoAyer = BodegaPedidos::where('estatus_lab', 'Aprobada')
            ->whereDate('fecha_pedido', $fechaAyer)
            ->first();

        if ($pedidoAyer) {
            // Cambiar el estatus del pedido del día anterior a 'Cancelada'
            $pedidoAyer->update(['estatus_lab' => 'Cancelada']);
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
        // Obtener productos que estén por debajo del umbral considerando stock + stock_salon
        $productosBajoStock = Products::where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->where(function ($query) {
                $query->whereRaw('(stock + stock_salon) < 60')
                    ->where(function ($subQuery) {
                        $subQuery->where('nombre', 'LIKE', '%Hydrabooster%')
                                 ->orWhere('nombre', 'LIKE', '%Hydraboosters%')
                                 ->orWhereIn('sku', ['324191', '197263', '116862', '902417', '631363', '868760', '631091', '362230']);
                    })
                    ->orWhere(function ($subQuery) {
                        $subQuery->whereRaw('(stock + stock_salon) < 20')
                                 ->orWhereIn('sku', ['638320']);
                    })
                    ->orWhere(function ($subQuery) {
                        $subQuery->whereRaw('(stock + stock_salon) < 10')
                                 ->orWhereIn('sku', ['551406', '995323', '319895', '604407', '478898']);
                    })
                    ->orWhere(function ($subQuery) {
                        $subQuery->whereRaw('(stock + stock_salon) < 30')
                                 ->where('nombre', 'NOT LIKE', '%Hydrabooster%')
                                 ->where('nombre', 'NOT LIKE', '%Hydraboosters%')
                                 ->where('nombre', 'NOT LIKE', '%Shampoo%')
                                 ->where('nombre', 'NOT LIKE', '%Micelar%')
                                 ->whereNotIn('sku', ['324191', '197263', '116862', '902417', '631363', '868760', '631091', '362230','638320', '551406', '995323', '319895', '604407', '478898']);
                    });
            })
            ->whereNotIn('sku', ['551406', '995323', '604407', '478898', '319895', '631091', '631363', '197263', '868760'])
            ->get();

        if ($productosBajoStock->isEmpty()) {
            $this->info('No hay productos con bajo stock en BodegaPedidosCosmica.');
            return;
        }

        // Crear nuevo pedido
        $pedido = BodegaPedidosCosmica::create([
            'estatus' => 'Aprobada',
            'estatus_lab' => 'Aprobada',
            'fecha_pedido' => now(),
            'fecha_aprovado' => now(),
            'id_user' => 2474,
        ]);

        foreach ($productosBajoStock as $producto) {
            $totalStock = $producto->stock + $producto->stock_salon;

            $umbral = (stripos($producto->nombre, 'Hydrabooster') !== false || stripos($producto->nombre, 'Hydraboosters') !== false || in_array($producto->sku, ['324191', '197263', '116862', '902417', '631363', '868760', '631091', '362230']))
                ? 60
                : 30;

            if (in_array($producto->sku, ['638320'])) {
                $umbral = 20;
            }

            if (in_array($producto->sku, ['551406', '995323', '319895', '604407', '478898'])) {
                $umbral = 10;
            }

            $cantidadNecesaria = max(0, $umbral - $totalStock);

            if ($cantidadNecesaria > 0) {
                BodegaPedidosProductosCosmica::create([
                    'id_pedido' => $pedido->id,
                    'id_producto' => $producto->id,
                    'cantidad_pedido' => $cantidadNecesaria,
                    'stock_anterior' => $producto->stock,
                    'cantidad_restante' => $cantidadNecesaria,
                    'cantidad_entregada_lab' => $cantidadNecesaria,
                ]);
            }
        }

        $this->info('Nuevo pedido generado con éxito en BodegaPedidosCosmica.');
    }

    private function generarPedidoNAS()
    {
        $productosBajoStock = Products::where('categoria', 'NAS')
            ->where('subcategoria', 'Producto')
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->whereRaw('(stock + stock_salon) < 15')
                      ->where(function ($q2) {
                          $q2->where('nombre', 'LIKE', '%1.3 kg%')
                             ->orWhere('nombre', 'LIKE', '%1300 g%');
                      });
                })
                ->orWhere(function ($q) {
                    $q->whereRaw('(stock + stock_salon) < 30')
                      ->where('nombre', 'LIKE', '%125ml%');
                })
                ->orWhere(function ($q) {
                    $q->whereRaw('(stock + stock_salon) < 15')
                      ->where('nombre', 'LIKE', '%500 g%');
                })
                ->orWhere(function ($q) {
                    $q->whereRaw('(stock + stock_salon) < 10')
                      ->whereIn('sku', ['392959', '771609', '753403']);
                })
                ->orWhere(function ($q) {
                    $q->whereRaw('(stock + stock_salon) < 20')
                      ->where('nombre', 'NOT LIKE', '%1.3 kg%')
                      ->where('nombre', 'NOT LIKE', '%1300 g%')
                      ->where('nombre', 'NOT LIKE', '%125ml%')
                      ->where('nombre', 'NOT LIKE', '%500 g%')
                      ->whereNotIn('sku', ['392959', '771609', '753403']);
                });
            })
            ->whereNotIn('sku', [
                '263292', '805359', '959657', '244210', '754705', '937604', '386082',
                '441220', '209024', '787771', '231249', '731016', '391267', '350675',
                '960248', '768448'
            ])
            ->get();

        if ($productosBajoStock->isEmpty()) {
            $this->info('No hay productos con bajo stock en BodegaPedidos.');
            return;
        }

        $pedido = BodegaPedidos::create([
            'estatus' => 'Aprobada',
            'estatus_lab' => 'Aprobada',
            'fecha_pedido' => now(),
            'fecha_aprovado' => now(),
            'id_user' => 2474,
        ]);

        foreach ($productosBajoStock as $producto) {
            $stockTotal = $producto->stock + $producto->stock_salon;

            $umbral = 20;

            if (stripos($producto->nombre, '1.3 kg') !== false || stripos($producto->nombre, '1300 g') !== false) {
                $umbral = 15;
            } elseif (stripos($producto->nombre, '125ml') !== false) {
                $umbral = 30;
            } elseif (stripos($producto->nombre, '500 g') !== false) {
                $umbral = 15;
            } elseif (in_array($producto->sku, ['392959', '771609', '753403'])) {
                $umbral = 10;
            }

            $cantidadNecesaria = max(0, $umbral - $stockTotal);

            if ($cantidadNecesaria > 0) {
                BodegaPedidosProductos::create([
                    'id_pedido' => $pedido->id,
                    'id_producto' => $producto->id,
                    'cantidad_pedido' => $cantidadNecesaria,
                    'stock_anterior' => $producto->stock,
                    'cantidad_restante' => $cantidadNecesaria,
                    'cantidad_entregada_lab' => $cantidadNecesaria,
                ]);
            }
        }

        $this->info('Nuevo pedido generado con éxito en BodegaPedidos.');
    }

}
