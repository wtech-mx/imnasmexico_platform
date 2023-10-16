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
        Schema::create('documentos_generador', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')
                ->references('id')->on('cursos')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_curso_ticket');
            $table->foreign('id_curso_ticket')
                ->references('id')->on('cursos_tickets')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_usuario_bitacora');
            $table->foreign('id_usuario_bitacora')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->string('estatus')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('folio');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_generador');
    }
};
