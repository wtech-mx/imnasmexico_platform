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
        Schema::create('pagos_fuera', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();;
            $table->string('correo')->nullable();;
            $table->string('telefono')->nullable();;
            $table->text('curso')->nullable();;
            $table->text('modalidad')->nullable();;
            $table->string('inscripcion')->nullable();;
            $table->string('pendiente')->nullable();;
            $table->string('deudor')->nullable();;
            $table->string('abono')->nullable();
            $table->string('foto', 900)->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_fuera');
    }
};
