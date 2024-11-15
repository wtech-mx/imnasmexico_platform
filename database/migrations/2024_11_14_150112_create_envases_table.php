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
        Schema::create('envases', function (Blueprint $table) {
            $table->id();
            $table->text('envase')->nullable();
            $table->text('conteo')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('cama')->nullable();
            $table->text('imagen')->nullable();
            $table->text('tipo')->nullable();
            $table->text('categoria')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envases');
    }
};
