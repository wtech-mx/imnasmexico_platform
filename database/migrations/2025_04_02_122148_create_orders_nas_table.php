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
        Schema::create('orders_nas', function (Blueprint $table) {
            $table->id();
            $table->text('num_order')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->text('pago')->nullable();
            $table->text('forma_pago')->nullable();
            $table->text('estatus')->nullable();
            $table->date('fecha')->nullable();
            $table->text('code')->nullable();
            $table->text('external_reference')->nullable();
            $table->text('guia_doc')->nullable();
            $table->date('fecha_preparacion')->nullable();
            $table->date('fecha_preparado')->nullable();
            $table->date('fecha_envio')->nullable();
            $table->text('estatus_bodega')->nullable();
            $table->text('forma_envio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_nas');
    }
};
