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
        // Schema::table('cursos', function (Blueprint $table) {
        //     $table->unsignedBigInteger('id_estandar');
        //     $table->foreign('id_estandar')
        //         ->references('id')->on('estandares')
        //         ->onDelete('set null');
        // });
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
