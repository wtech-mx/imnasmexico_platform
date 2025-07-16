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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->text('nombre')->nullable();
            $table->text('direccion')->nullable();
            $table->text('rfc')->nullable();
            $table->text('correo')->nullable();
            $table->text('telefono')->nullable();
            $table->text('regimen_fiscal')->nullable();
            $table->text('fecha')->nullable();
            $table->text('tipo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
