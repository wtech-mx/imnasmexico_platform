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
        Schema::create('tipo_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_documentos');
            $table->foreign('id_documentos')
                ->references('id')->on('documentos')
                ->inDelete('set null')->nullable();;
            $table->string('tipo')->nullable();
            $table->string('nombre')->nullable();
            $table->text('img_portada')->nullable();
            $table->text('img_reverso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipodocumentos');
    }
};
