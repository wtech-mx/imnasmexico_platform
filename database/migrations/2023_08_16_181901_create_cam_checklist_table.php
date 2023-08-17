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
        Schema::create('cam_checklist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('cam_notas')
                ->inDelete('set null');

            $table->text('1')->nullable();
            $table->text('2')->nullable();
            $table->text('3')->nullable();
            $table->text('4')->nullable();
            $table->text('5')->nullable();
            $table->text('6')->nullable();
            $table->text('7')->nullable();
            $table->text('8')->nullable();
            $table->text('9')->nullable();
            $table->text('10')->nullable();
            $table->text('11')->nullable();
            $table->text('12')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cam_checklist');
    }
};
