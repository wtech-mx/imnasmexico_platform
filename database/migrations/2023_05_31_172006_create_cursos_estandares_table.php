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
        Schema::create('cursos_estandares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')
                ->references('id')->on('cursos')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_carpeta');
            $table->foreign('id_carpeta')
                ->references('id')->on('carpetas_estandares')
                ->inDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos_estandares');
    }
};
