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
        Schema::table('notas_productos', function (Blueprint $table) {
            $table->text('doc_guia')->nullable();
            $table->timestamp('fecha_preparacion')->nullable();
            $table->timestamp('fecha_preparado')->nullable();
            $table->timestamp('fecha_envio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas_productos', function (Blueprint $table) {
            //
        });
    }
};
