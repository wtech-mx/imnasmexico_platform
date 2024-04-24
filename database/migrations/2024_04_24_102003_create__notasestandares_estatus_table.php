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
        Schema::create('_notasestandares_estatus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('notasestatus')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_estandar');
            $table->foreign('id_estandar')
                ->references('id')->on('cam_estandares')
                ->inDelete('set null');

            $table->text('estatus')->nullable();
            $table->text('evaluador')->nullable();
            $table->text('estatus_renovacion')->nullable();
            $table->text('operables')->nullable();


            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')
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
        Schema::dropIfExists('_notasestandares_estatus');
    }
};
