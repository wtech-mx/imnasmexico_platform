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
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->integer('visible_1')->nullable();
            $table->integer('precio_1')->nullable();
            $table->integer('precio_rebajado_1')->nullable();
            $table->integer('precio_curso_1')->nullable();
            $table->integer('visible_2')->nullable();
            $table->integer('precio_2')->nullable();
            $table->integer('precio_rebajado_2')->nullable();
            $table->integer('precio_curso_2')->nullable();
            $table->integer('visible_3')->nullable();
            $table->integer('precio_3')->nullable();
            $table->integer('precio_rebajado_3')->nullable();
            $table->integer('precio_curso_3')->nullable();
            $table->integer('visible_4')->nullable();
            $table->integer('precio_4')->nullable();
            $table->integer('precio_rebajado_4')->nullable();
            $table->integer('precio_curso_4')->nullable();
            $table->integer('visible_5')->nullable();
            $table->integer('precio_5')->nullable();
            $table->integer('precio_rebajado_5')->nullable();
            $table->integer('precio_curso_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquetes');
    }
};
