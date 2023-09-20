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
        Schema::table('cam_nombramientos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mini_exp')->nullable();
            $table->foreign('id_mini_exp')
                ->references('id')->on('cam_mini_exp')
                ->inDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cam_nombramientos', function (Blueprint $table) {
            //
        });
    }
};
