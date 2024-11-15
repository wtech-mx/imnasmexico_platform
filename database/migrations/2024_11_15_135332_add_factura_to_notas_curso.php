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
        Schema::table('notas_curso', function (Blueprint $table) {
            $table->text('factura')->nullable();
            $table->text('total_iva')->nullable();
            $table->text('situacion_fiscal')->nullable();
            $table->text('razon_social')->nullable();
            $table->text('rfc')->nullable();
            $table->text('cfdi')->nullable();
            $table->text('correo')->nullable();
            $table->text('telefono')->nullable();
            $table->text('direccion_factura')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas_curso', function (Blueprint $table) {
            //
        });
    }
};
