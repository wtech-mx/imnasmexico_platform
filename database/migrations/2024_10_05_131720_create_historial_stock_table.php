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
        Schema::create('historial_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')
                ->references('id')->on('products')
                ->inDelete('set null');

            $table->text('user')->nullable();
            $table->string('sku')->nullable();
            $table->float('precio_normal')->nullable();
            $table->float('precio_rebajado')->nullable();
            $table->string('stock')->nullable();
            $table->string('stock_nas')->nullable();
            $table->string('stock_cosmica')->nullable();
            $table->text('categoria')->nullable();
            $table->text('subcategoria')->nullable();
            $table->text('laboratorio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_stock');
    }
};
