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
        Schema::table('historial_stock', function (Blueprint $table) {
            $table->text('tipo_cambio')->nullable();
            $table->text('stock_laboratorio')->nullable();
            $table->text('stock_etiqueta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_stock', function (Blueprint $table) {
            //
        });
    }
};
