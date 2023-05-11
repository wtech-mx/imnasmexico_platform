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
        Schema::create('notas_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->date('producto')->nullable();
            $table->date('id_product_woo')->nullable();
            $table->date('price')->nullable();
            $table->date('permalink')->nullable();
            $table->date('metodo_pago')->nullable();
            $table->date('fecha')->nullable();
            $table->text('total')->nullable();
            $table->text('restante')->nullable();
            $table->text('nota')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_productos');
    }
};
