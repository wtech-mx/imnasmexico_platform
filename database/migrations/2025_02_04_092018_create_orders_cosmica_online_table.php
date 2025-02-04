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
        Schema::create('orders_cosmica_online', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order')->nullable();
            $table->unsignedBigInteger('id_producto')->nullable();
            $table->text('nombre')->nullable();
            $table->integer('cantidad')->nullable();
            $table->integer('precio')->nullable();
            $table->integer('estatus')->nullable();
            $table->integer('escaneados')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_cosmica_online');
    }
};
