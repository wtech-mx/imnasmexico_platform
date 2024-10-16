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
        Schema::table('registro_imnas_doc', function (Blueprint $table) {
            $table->text('tam_letra_especialidad_th')->nullable();
            $table->text('tam_letra_credencial_especialidad')->nullable();
            $table->text('tam_letra_nombre_th')->nullable();
            $table->text('tam_letra_folio_th')->nullable();
            $table->text('tam_letra_especialidad_cedula')->nullable();
            $table->text('tam_letra_folio_cedula')->nullable();
            $table->text('tam_letra_folioTrasero_cedula')->nullable();
            $table->text('tam_letra_lista_tira_materias')->nullable();
            $table->text('capitalizar_nombre')->nullable();
            $table->text('firma_director')->nullable();
            $table->text('texto_director')->nullable();
            $table->text('promedio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
