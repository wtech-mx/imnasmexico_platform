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
        Schema::table('productos_notas_cosmica', function (Blueprint $table) {
            $table->unsignedBigInteger('id_reposicion_producto')->nullable();
            $table->foreign('id_reposicion_producto')
                ->references('id')->on('notas_productos')
                ->inDelete('set null');

            $table->text('cantidad_reposicion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos_notas_cosmica', function (Blueprint $table) {
            //
        });
    }
};
