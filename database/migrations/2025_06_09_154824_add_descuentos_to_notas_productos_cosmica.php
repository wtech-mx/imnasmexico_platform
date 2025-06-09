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
        Schema::table('notas_productos_cosmica', function (Blueprint $table) {
            $table->text('descuento_kit')->nullable();
            $table->text('descuento_kit2')->nullable();
            $table->text('descuento_kit3')->nullable();
            $table->text('descuento_kit4')->nullable();
            $table->text('descuento_kit5')->nullable();
            $table->text('descuento_kit6')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas_productos_cosmica', function (Blueprint $table) {
            //
        });
    }
};
