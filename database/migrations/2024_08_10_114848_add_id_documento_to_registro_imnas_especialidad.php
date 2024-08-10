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
        Schema::table('registro_imnas_especialidad', function (Blueprint $table) {
            $table->unsignedBigInteger('id_documento');
            $table->foreign('id_documento')
                ->references('id')->on('tipo_documentos')
                ->inDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_imnas_especialidad', function (Blueprint $table) {
            //
        });
    }
};
