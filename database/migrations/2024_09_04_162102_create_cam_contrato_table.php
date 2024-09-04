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
        Schema::create('cam_contrato', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('cam_notas')
                ->inDelete('set null');

            $table->text('nombre')->nullable();
            $table->text('dato_general')->nullable();
            $table->text('rfc')->nullable();
            $table->text('identificacion_ofi')->nullable();
            $table->text('domicilio')->nullable();
            $table->text('fecha')->nullable();
            $table->text('firma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cam_contrato');
    }
};
