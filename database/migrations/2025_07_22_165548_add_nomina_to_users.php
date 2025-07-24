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
        Schema::table('users', function (Blueprint $table) {
            $table->text('nomina_estatus')->nullable();
            $table->text('fecha_ingreso')->nullable();
            $table->text('seguro_estatus')->nullable();
            $table->text('sueldo')->nullable();

            $table->text('banco')->nullable();
            $table->text('tipo_cuenta')->nullable();
            $table->text('numero_cuenta')->nullable();
            $table->text('clave_stp')->nullable();
            $table->text('genero')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
