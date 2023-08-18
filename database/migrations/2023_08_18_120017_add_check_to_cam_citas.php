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
        Schema::table('cam_citas', function (Blueprint $table) {
            $table->text('check1')->nullable();
            $table->text('check2')->nullable();
            $table->text('check3')->nullable();
            $table->text('check4')->nullable();
            $table->text('check5')->nullable();
            $table->text('check6')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cam_citas', function (Blueprint $table) {
            //
        });
    }
};
