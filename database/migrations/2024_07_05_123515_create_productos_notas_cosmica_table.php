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
        Schema::create('productos_notas_cosmica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_notas_productos');
            $table->foreign('id_notas_productos')
                ->references('id')->on('notas_productos_cosmica')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')
                ->references('id')->on('products')
                ->inDelete('set null');
            $table->string('producto')->nullable();
            $table->string('price')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('descuento')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_notas_cosmica');
    }
};
