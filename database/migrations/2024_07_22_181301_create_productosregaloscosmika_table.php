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
        Schema::create('productosregaloscosmika', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cosmikausers');
            $table->foreign('id_cosmikausers')
                ->references('id')->on('cosmikausers')
                ->inDelete('set null');

            $table->string('tipo_amenidad')->nullable();

            $table->string('cantidad')->nullable();
            $table->string('productos')->nullable();
            $table->string('estatus')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productosregaloscosmika');
    }
};
