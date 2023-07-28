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
        Schema::table('pagos_fuera', function (Blueprint $table) {
            $table->string('monto')->nullable();
            $table->string('abono2')->nullable();
            $table->text('foto2')->nullable();
            $table->string('usuario')->nullable();
            $table->timestamp('fecha_hora_1')->nullable();
            $table->timestamp('fecha_hora_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos_fuera', function (Blueprint $table) {

        });
    }
};
