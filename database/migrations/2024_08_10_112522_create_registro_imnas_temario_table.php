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
        Schema::create('registro_imnas_temario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_materia');
            $table->foreign('id_materia')
                ->references('id')->on('registro_imnas_especialidad')
                ->inDelete('set null');

            $table->text('subtema')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_imnas_temario');
    }
};
