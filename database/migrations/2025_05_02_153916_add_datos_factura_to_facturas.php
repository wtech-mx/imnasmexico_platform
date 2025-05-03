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
        Schema::table('facturas', function (Blueprint $table) {

            $table->unsignedBigInteger(column: 'id_notas_cosmica');
            $table->foreign('id_notas_cosmica')
                ->references('id')->on('notas_productos_cosmica')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_notas_nas');
            $table->foreign('id_notas_nas')
                ->references('id')->on('notas_productos')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_notas_nas_tiendita');
            $table->foreign('id_notas_nas_tiendita')
                ->references('id')->on('notas_productos')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_notas_cursos');
            $table->foreign('id_notas_cursos')
                ->references('id')->on('notas_curso')
                ->inDelete('set null');

            $table->text('situacion_fiscal')->nullable();
            $table->text('razon_social')->nullable();
            $table->text('rfc')->nullable();
            $table->text('cfdi')->nullable();
            $table->text('regimen_fiscal')->nullable();
            $table->text('codigo_postal')->nullable();
            $table->text('colonia')->nullable();
            $table->text('ciudad')->nullable();
            $table->text('municipio')->nullable();
            $table->text('direccion_cliente')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturas', function (Blueprint $table) {
            //
        });
    }
};
