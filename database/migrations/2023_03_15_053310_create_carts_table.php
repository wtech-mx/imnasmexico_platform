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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tickets');
            $table->foreign('id_tickets')
                ->references('id')->on('cursos_tickets')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->inDelete('set null');
                
            $table->integer('cantidad')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
