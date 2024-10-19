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
        Schema::create('order_online_cosmica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota')->nullable();
            $table->text('nombre')->nullable();
            $table->integer('cantidad')->nullable();
            $table->integer('estatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_online_cosmica');
    }
};
