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
        Schema::create('historial_vendidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')
                ->references('id')->on('products')
                ->inDelete('set null');

            $table->text('stock_viejo')->nullable();
            $table->text('cantidad_restado')->nullable();
            $table->text('stock_actual')->nullable();

            $table->unsignedBigInteger('id_cotizacion_nas')->nullable();
            $table->unsignedBigInteger('id_cotizacion_cosmica')->nullable();
            $table->unsignedBigInteger('id_venta_nas')->nullable();
            $table->unsignedBigInteger('id_paradisus')->nullable();
            $table->unsignedBigInteger('id_nas_online')->nullable();
            $table->unsignedBigInteger('id_cosmica_online')->nullable();
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_vendidos');
    }
};
