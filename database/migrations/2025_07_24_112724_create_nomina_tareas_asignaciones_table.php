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
        Schema::create('nomina_tareas_asignaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_tareas');

            $table->timestamp('visto_en')->nullable();   // si solo lo vio
            $table->timestamp('clic_en')->nullable();    // si hizo clic
            $table->timestamps();
            $table->unique(['id_tareas','id_users']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomina_tareas_asignaciones');
    }
};
