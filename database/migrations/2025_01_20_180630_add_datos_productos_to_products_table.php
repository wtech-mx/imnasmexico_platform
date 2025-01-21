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
            $table->text('linea')->nullable();
            $table->text('sublinea')->nullable();
            $table->text('modo_empleo')->nullable();
            $table->text('beneficios')->nullable();
            $table->text('ingredientes')->nullable();
            $table->text('precauciones')->nullable();
            $table->text('favorito')->nullable();
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
