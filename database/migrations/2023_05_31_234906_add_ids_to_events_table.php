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
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('id_profesor');
            $table->foreign('id_profesor')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')
                ->references('id')->on('cursos')
                ->inDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
