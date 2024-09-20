<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bodega_pedidos_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedido');
            $table->foreign('id_pedido')
                ->references('id')->on('bodega_pedidos')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')
                ->references('id')->on('products')
                ->inDelete('set null');

            $table->integer('stock_anterior')->nullable();
            $table->integer('cantidad_pedido')->nullable();
            $table->integer('cantidad_recibido')->nullable();
            $table->integer('cantidad_restante')->nullable();
            $table->integer('cantidad_liquidado')->nullable();
            $table->datetime('fecha_recibido')->nullable();
            $table->datetime('fecha_liquidado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodega_pedidos_productos');
    }
};
