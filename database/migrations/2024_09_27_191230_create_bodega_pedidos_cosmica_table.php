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
        Schema::create('bodega_pedidos_cosmica', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha_pedido')->nullable();
            $table->datetime('fecha_aprovado')->nullable();
            $table->datetime('fecha_enviado')->nullable();
            $table->datetime('fecha_recibido')->nullable();
            $table->text('comentario')->nullable();
            $table->text('estatus')->nullable();
            $table->text('firma')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodega_pedidos_cosmica');
    }
};
