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
        Schema::create('registro_imnas_doc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')
                ->references('id')->on('orders')
                ->inDelete('set null');

            $table->text('num_guia')->nullable();
            $table->date('fecha_compra')->nullable();
            $table->date('fecha_realizados')->nullable();
            $table->date('fecha_enviados')->nullable();
            $table->text('nom_curso')->nullable();
            $table->date('fecha_curso')->nullable();
            $table->text('comentario_cliente')->nullable();
            $table->text('folio')->nullable();

            $table->text('estatus_cedula')->nullable();
            $table->text('estatus_titulo')->nullable();
            $table->text('estatus_diploma')->nullable();
            $table->text('estatus_credencial')->nullable();
            $table->text('estatus_tira')->nullable();

            $table->text('nombre')->nullable();
            $table->text('ine')->nullable();
            $table->text('curp')->nullable();
            $table->text('foto_cuadrada')->nullable();
            $table->text('firma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_imnas_doc');
    }
};
