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
        Schema::table('cam_notas', function (Blueprint $table) {
            $table->text('nombre_encargado')->nullable();
            $table->text('telefono_encargado')->nullable();
            $table->text('correo_encargado')->nullable();
            $table->text('horarios')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cam_notas', function (Blueprint $table) {
            //
        });
    }
};
