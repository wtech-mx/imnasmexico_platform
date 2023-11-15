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
        Schema::table('notas_productos', function (Blueprint $table) {
            $table->string('cambio')->nullable();
            $table->string('factura')->nullable();
            $table->string('situacion_fiscal')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('rfc')->nullable();
            $table->string('cfdi')->nullable();
            $table->string('correo_fac')->nullable();
            $table->string('telefono_fac')->nullable();
            $table->string('direccion_fac')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas_productos', function (Blueprint $table) {
            //
        });
    }
};
