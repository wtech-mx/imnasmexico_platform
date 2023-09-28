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
        Schema::table('cam_mini_exp', function (Blueprint $table) {
            $table->text('contrato_individual')->nullable();
            $table->text('confidencialidad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cam_mini_exp', function (Blueprint $table) {
            //
        });
    }
};
