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
        Schema::create('cosmikausers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->string('membresia')->nullable();
            $table->string('membresia_estatus')->nullable();
            $table->string('puntos_acomulados')->nullable();
            $table->string('membresia_inicio')->nullable();
            $table->string('membresia_fin')->nullable();
            $table->string('meses_acomulados')->nullable();
            $table->string('consumido_totalmes')->nullable();
            $table->string('direccion_local')->nullable();
            $table->string('direccion_foto')->nullable();
            $table->string('direccion_rs_face')->nullable();
            $table->string('direccion_rs_insta')->nullable();
            $table->string('direccion_rs_whats')->nullable();
            $table->string('claves_protocolo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cosmikausers');
    }
};
