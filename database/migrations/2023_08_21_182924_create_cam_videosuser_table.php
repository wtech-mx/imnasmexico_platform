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
        Schema::create('cam_videosuser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('cam_notas')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('tipo');

            $table->text('check1')->nullable();
            $table->text('check2')->nullable();
            $table->text('check3')->nullable();
            $table->text('check4')->nullable();
            $table->text('check5')->nullable();
            $table->text('check6')->nullable();
            $table->text('check7')->nullable();
            $table->text('check8')->nullable();
            $table->text('check9')->nullable();
            $table->text('check10')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cam_videosuser');
    }
};
