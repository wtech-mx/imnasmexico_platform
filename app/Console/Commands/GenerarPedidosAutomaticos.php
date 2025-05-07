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
        // 1) Selecciona productos por debajo de su min_stock
        $productosBajoStock = Products::where('categoria', 'Cosmica')
            ->where('subcategoria', 'Producto')
            ->whereRaw('(stock + COALESCE(stock_salon, 0)) < min_stock')
            ->get();

        if ($productosBajoStock->isEmpty()) {
            $this->info('No hay productos con bajo stock en BodegaPedidosCosmica.');
            return;
        }

        // 2) Crea el pedido padre
        $pedido = BodegaPedidosCosmica::create([
            'estatus'        => 'Aprobada',
            'estatus_lab'    => 'Aprobada',
            'fecha_pedido'   => now(),
            'fecha_aprovado' => now(),
            'id_user'        => 2474,
        ]);

        // 3) Recorre y calcula cantidad a pedir
        foreach ($productosBajoStock as $producto) {
            $totalStock    = $producto->stock + ($producto->stock_salon ?? 0);
            $umbral        = (int) $producto->min_stock;
            $cantidadNecesaria = max(0, $umbral - $totalStock);

            if ($cantidadNecesaria > 0) {
                BodegaPedidosProductosCosmica::create([
                    'id_pedido'           => $pedido->id,
                    'id_producto'         => $producto->id,
                    'cantidad_pedido'     => $cantidadNecesaria,
                    'stock_anterior'      => $producto->stock,
                    'cantidad_restante'   => $cantidadNecesaria,
                    'cantidad_entregada_lab' => $cantidadNecesaria,
                ]);
            }
        }

        $this->info('Nuevo pedido generado con éxito en BodegaPedidosCosmica.');
    }

    private function generarPedidoNAS()
    {
        // 1) Selecciona productos por debajo de su min_stock
        $productosBajoStock = Products::where('categoria', 'NAS')
            ->where('subcategoria', 'Producto')
            ->whereRaw('(stock + COALESCE(stock_salon, 0)) < min_stock')
            ->get();

        if ($productosBajoStock->isEmpty()) {
            $this->info('No hay productos con bajo stock en BodegaPedidosNas.');
            return;
        }

        // 2) Crea el pedido padre
        $pedido = BodegaPedidos::create([
            'estatus'        => 'Aprobada',
            'estatus_lab'    => 'Aprobada',
            'fecha_pedido'   => now(),
            'fecha_aprovado' => now(),
            'id_user'        => 2474,
        ]);

        // 3) Recorre y calcula cantidad a pedir
        foreach ($productosBajoStock as $producto) {
            $totalStock    = $producto->stock + ($producto->stock_salon ?? 0);
            $umbral        = (int) $producto->min_stock;
            $cantidadNecesaria = max(0, $umbral - $totalStock);

            if ($cantidadNecesaria > 0) {
                BodegaPedidosProductos::create([
                    'id_pedido'           => $pedido->id,
                    'id_producto'         => $producto->id,
                    'cantidad_pedido'     => $cantidadNecesaria,
                    'stock_anterior'      => $producto->stock,
                    'cantidad_restante'   => $cantidadNecesaria,
                    'cantidad_entregada_lab' => $cantidadNecesaria,
                ]);
            }
        }

        $this->info('Nuevo pedido generado con éxito en BodegaPedidosnas.');
    }

}
