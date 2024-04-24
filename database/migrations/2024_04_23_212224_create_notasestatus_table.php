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
        Schema::create('notasestatus', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->text('time')->nullable();
            $table->text('num_portafolio')->nullable();
            $table->text('tipo')->nullable();
            $table->text('tipo_modalidad')->nullable();
            $table->text('tipo_alumno')->nullable();
            $table->text('nombre_centro')->nullable();
            $table->text('nombre_persona')->nullable();
            $table->text('celular')->nullable();
            $table->text('email')->nullable();
            $table->text('estatus')->nullable();
            $table->text('subida_portafolio')->nullable();
            $table->text('evaluador')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notasestatus');
    }
};
