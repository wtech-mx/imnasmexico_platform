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

            $table->text('c1')->nullable();
            $table->unsignedBigInteger('id_usuario1');
            $table->foreign('id_usuario1')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c2')->nullable();
            $table->unsignedBigInteger('id_usuario2');
            $table->foreign('id_usuario2')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c3')->nullable();
            $table->unsignedBigInteger('id_usuario3');
            $table->foreign('id_usuario3')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c4')->nullable();
            $table->unsignedBigInteger('id_usuario4');
            $table->foreign('id_usuario4')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c5')->nullable();
            $table->unsignedBigInteger('id_usuario5');
            $table->foreign('id_usuario5')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c6')->nullable();
            $table->unsignedBigInteger('id_usuario6');
            $table->foreign('id_usuario6')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c7')->nullable();
            $table->unsignedBigInteger('id_usuario7');
            $table->foreign('id_usuario7')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c8')->nullable();
            $table->unsignedBigInteger('id_usuario8');
            $table->foreign('id_usuario8')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c9')->nullable();
            $table->unsignedBigInteger('id_usuario9');
            $table->foreign('id_usuario9')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c10')->nullable();
            $table->unsignedBigInteger('id_usuario10');
            $table->foreign('id_usuario10')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c11')->nullable();
            $table->unsignedBigInteger('id_usuario11');
            $table->foreign('id_usuario11')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('c12')->nullable();
            $table->unsignedBigInteger('id_usuario12');
            $table->foreign('id_usuario12')
                ->references('id')->on('users')
                ->inDelete('set null');

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
