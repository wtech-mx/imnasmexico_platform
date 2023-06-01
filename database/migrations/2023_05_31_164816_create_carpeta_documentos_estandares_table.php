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
        Schema::create('carpeta_documentos_estandares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_carpeta');
            $table->foreign('id_carpeta')
                ->references('id')->on('carpetas_estandares')
                ->inDelete('set null');
            $table->text('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpeta_documentos_estandares');
    }
};
