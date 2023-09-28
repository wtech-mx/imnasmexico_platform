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
        Schema::table('cam_notestandares', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pago')->nullable();
            $table->foreign('id_pago')
                ->references('id')->on('cam_pagos_estandar')
                ->inDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cam_notestandares', function (Blueprint $table) {
            //
        });
    }
};
