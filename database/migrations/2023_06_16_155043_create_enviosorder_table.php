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
        Schema::create('enviosorder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')
                ->references('id')->on('orders')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->string('estatus')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enviosorder');
    }
};
