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
        Schema::table('orders_cosmica', function (Blueprint $table) {
            $table->text('guia_doc')->nullable();
            $table->date('fecha_preparacion')->nullable();
            $table->date('fecha_preparado')->nullable();
            $table->date('fecha_envio')->nullable();
            $table->text('estatus_bodega')->nullable();
            $table->text('forma_envio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders_cosmica', function (Blueprint $table) {
            //
        });
    }
};
