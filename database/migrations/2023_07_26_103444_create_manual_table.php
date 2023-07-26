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
        Schema::create('manual', function (Blueprint $table) {
            $table->id();
            $table->string('modulo')->nullable();
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('imagen_portada')->nullable();

            $table->string('step1_name')->nullable();
            $table->string('foto1', 900)->nullable();

            $table->string('step2_name')->nullable();
            $table->string('foto2', 900)->nullable();

            $table->string('step3_name')->nullable();
            $table->string('foto3', 900)->nullable();

            $table->string('step4_name')->nullable();
            $table->string('foto4', 900)->nullable();

            $table->string('step5_name')->nullable();
            $table->string('foto5', 900)->nullable();

            $table->string('step6_name')->nullable();
            $table->string('foto6', 900)->nullable();

            $table->string('step7_name')->nullable();
            $table->string('foto7', 900)->nullable();

            $table->string('step8_name')->nullable();
            $table->string('foto8', 900)->nullable();

            $table->string('step9_name')->nullable();
            $table->string('foto9', 900)->nullable();

            $table->string('step10_name')->nullable();
            $table->string('foto10', 900)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual');
    }
};
