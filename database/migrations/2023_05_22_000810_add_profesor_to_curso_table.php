<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // Deshabilitar la verificación de restricciones de clave externa
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('cursos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_profesor');
            $table->foreign('id_profesor')
                ->references('id')->on('users')
                ->inDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            //
        });
    }
};
