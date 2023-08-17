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
        Schema::create('cam_docusers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('cam_notas')
                ->inDelete('set null');

            $table->text('acuerdo_confidencialidad')->nullable();
            $table->text('logo')->nullable();
            $table->text('comprobante_domicilio')->nullable();
            $table->text('contrato_individual')->nullable();
            $table->text('curriculum')->nullable();
            $table->text('ine')->nullable();
            $table->text('curp')->nullable();
            $table->text('acta_nacimiento')->nullable();
            $table->text('estandar_76')->nullable();

            $table->text('foto')->nullable();
            $table->unsignedBigInteger('id_usuario_foto');
            $table->foreign('id_usuario_foto')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('contrato_general')->nullable();
            $table->unsignedBigInteger('id_usuario_con');
            $table->foreign('id_usuario_con')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('solicitud_acreditacion')->nullable();
            $table->unsignedBigInteger('id_usuario_sol');
            $table->foreign('id_usuario_sol')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('carta_compromiso')->nullable();
            $table->unsignedBigInteger('id_usuario_com');
            $table->foreign('id_usuario_com')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('carta_responsabilidad')->nullable();
            $table->unsignedBigInteger('id_usuario_res');
            $table->foreign('id_usuario_res')
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
        Schema::dropIfExists('cam_docusers');
    }
};
