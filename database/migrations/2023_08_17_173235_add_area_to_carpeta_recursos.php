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
        Schema::table('carpeta_recursos', function (Blueprint $table) {
            $table->text('nombre_doc')->nullable();
            $table->text('area')->nullable();
            $table->text('sub_area')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publicidad', function (Blueprint $table) {
            //
        });
    }
};
