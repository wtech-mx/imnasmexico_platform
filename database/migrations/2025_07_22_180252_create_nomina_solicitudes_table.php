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
        Schema::create('nomina_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->text('tipo_permiso')->nullable();
            $table->text('fecha_inicio')->nullable();
            $table->text('fecha_fin')->nullable();
            $table->text('dias')->nullable();
            $table->text('motivo')->nullable();
            $table->text('estatus')->nullable();
            $table->text('autorizado_por')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomina_solicitudes');
    }
};
