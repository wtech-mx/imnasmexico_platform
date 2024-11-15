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
        Schema::create('envases_prosuctos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_envase')->nullable();
            $table->foreign('id_envase')
                ->references('id')->on('envases')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_producto')->nullable();
            $table->foreign('id_producto')
                ->references('id')->on('products')
                ->inDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envases_prosuctos');
    }
};
