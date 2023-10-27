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
        Schema::table('orders_tickets', function (Blueprint $table) {
            $table->string('estatus_cedula')->nullable();
            $table->string('estatus_titulo')->nullable();
            $table->string('estatus_diploma')->nullable();
            $table->string('estatus_credencial')->nullable();
            $table->string('estatus_tira')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders_tickets', function (Blueprint $table) {
            //
        });
    }
};
