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
        Schema::create('nomina_tareas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->text('fecha')->nullable();
            $table->text('titulo')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('fecha_programada')->nullable();
            $table->text('url')->nullable();
            $table->text('documento1')->nullable();
            $table->text('documento2')->nullable();
            $table->text('tipo')->nullable();
            $table->text('tipo_prioridad')->nullable();
            $table->text('estatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomina_tareas');
    }
};
