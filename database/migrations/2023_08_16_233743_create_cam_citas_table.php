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
        Schema::create('cam_citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('cam_notas')
                ->inDelete('set null');

            $table->text('evaluacion_ec0076')->nullable();
            $table->unsignedBigInteger('id_usuario_ec');
            $table->foreign('id_usuario_ec')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('evaluacion_afines')->nullable();
            $table->unsignedBigInteger('id_usuario_afin');
            $table->foreign('id_usuario_afin')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('refuerzo_conocimiento')->nullable();
            $table->unsignedBigInteger('id_usuario_cono');
            $table->foreign('id_usuario_cono')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('refuerzo_formatos')->nullable();
            $table->unsignedBigInteger('id_usuario_form');
            $table->foreign('id_usuario_form')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('coaching_empresarial')->nullable();
            $table->unsignedBigInteger('id_usuario_empr');
            $table->foreign('id_usuario_empr')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('carpeta_cam')->nullable();
            $table->unsignedBigInteger('id_usuario_carpeta');
            $table->foreign('id_usuario_carpeta')
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
        Schema::dropIfExists('cam_citas');
    }
};
