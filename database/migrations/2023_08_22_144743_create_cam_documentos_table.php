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
        Schema::create('cam_documentos', function (Blueprint $table) {
            $table->id();
            $table->text('nombre')->nullable();

            $table->unsignedBigInteger('id_carpdoc');
            $table->foreign('id_carpdoc')
                ->references('id')->on('cam_carpeta_documentos')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_subcarpdoc');
            $table->foreign('id_subcarpdoc')
                ->references('id')->on('cam_subcarpeta_documentos')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cam_documentos');
    }
};
