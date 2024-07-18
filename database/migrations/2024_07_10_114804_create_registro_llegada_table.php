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
        Schema::create('registro_llegada', function (Blueprint $table) {
            $table->id();
            $table->text('nombre')->nullable();
            $table->text('telefono')->nullable();
            $table->text('correo')->nullable();
            $table->text('ciudad')->nullable();
            $table->text('conociste')->nullable();
            $table->text('espectativa')->nullable();
            $table->text('sugerencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_llegada');
    }
};
