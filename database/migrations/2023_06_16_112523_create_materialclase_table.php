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
        Schema::create('materialclase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')
                ->references('id')->on('cursos')
                ->inDelete('set null');
            $table->string('nombre')->nullable();
            $table->text('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materialclase');
    }
};
