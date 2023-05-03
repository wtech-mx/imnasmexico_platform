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
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('tipo_de_descuento')->nullable();
            $table->string('importe')->nullable();
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_fin')->nullable();
            $table->string('gasto_min')->nullable();
            $table->string('inc_cursos')->nullable();
            $table->string('exc_cursos')->nullable();
            $table->string('estado')->nullable();
            $table->string('limite_uso_por_cupon')->nullable();
            $table->string('limite_uso_por_usuario')->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->timestamps();
            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')
                ->references('id')->on('cursos')
                ->inDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupons');
    }
};
