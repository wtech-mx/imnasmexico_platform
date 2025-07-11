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
        Schema::table('productos_notas_id', function (Blueprint $table) {
            $table->text('precio_iva')->nullable();
            $table->text('precio_uni')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos_notas_id', function (Blueprint $table) {
            //
        });
    }
};
