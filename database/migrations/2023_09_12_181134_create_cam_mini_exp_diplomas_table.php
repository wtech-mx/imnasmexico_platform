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
        Schema::create('cam_mini_exp_diplomas', function (Blueprint $table) {
            $table->id();
            $table->text('diplomas')->nullable();

            $table->unsignedBigInteger('id_mini');
            $table->foreign('id_mini')
                ->references('id')->on('cam_mini_exp')
                ->inDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cam_mini_exp_diplomas');
    }
};
