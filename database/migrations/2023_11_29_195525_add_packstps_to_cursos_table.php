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
        Schema::table('cursos', function (Blueprint $table) {
            $table->text('pack_stps')->nullable();
            $table->text('p_stps_1')->nullable();
            $table->text('p_stps_2')->nullable();
            $table->text('p_stps_3')->nullable();
            $table->text('p_stps_4')->nullable();
            $table->text('p_stps_5')->nullable();
            $table->text('p_stps_6')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            //
        });
    }
};
