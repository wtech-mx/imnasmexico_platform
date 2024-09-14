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
        Schema::table('notas_productos_cosmica', function (Blueprint $table) {
            $table->date('fecha_entrega')->nullable();
            $table->text('direccion_entrega')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas_productos_cosmica', function (Blueprint $table) {
            //
        });
    }
};
