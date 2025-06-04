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
        Schema::create('link_pagos', function (Blueprint $table) {
            $table->id();
            $table->text('cliente')->nullable();
            $table->text('estatus')->nullable();
            $table->text('titulo')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('monto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_pagos');
    }
};
