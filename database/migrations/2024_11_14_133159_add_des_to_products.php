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
        Schema::table('products', function (Blueprint $table) {
            $table->text('conteo_lab')->nullable();
            $table->text('etiqueta_lateral')->nullable();
            $table->text('etiqueta_tapa')->nullable();
            $table->text('etiqueta_frente')->nullable();
            $table->text('etiqueta_reversa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
