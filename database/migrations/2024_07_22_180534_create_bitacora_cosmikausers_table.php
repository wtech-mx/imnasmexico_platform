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
        Schema::create('bitacora_cosmikausers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->string('membresia')->nullable();
            $table->string('puntos_acomulados')->nullable();
            $table->string('membresia_inicio')->nullable();
            $table->string('membresia_fin')->nullable();
            $table->string('meses_acomulados')->nullable();
            $table->string('consumido_totalmes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora_cosmikausers');
    }
};
