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
        Schema::create('reportes_cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cotizacion_cosmica')->nullable();
            $table->foreign('id_cotizacion_cosmica')
                ->references('id')->on('notas_productos_cosmica')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_cotizacion_nas')->nullable();
            $table->foreign('id_cotizacion_nas')
                ->references('id')->on('notas_productos')
                ->inDelete('set null');

            $table->dateTime('fecha')->nullable();
            $table->text('descripcion')->nullable();

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
        Schema::dropIfExists('reportes_cotizaciones');
    }
};
