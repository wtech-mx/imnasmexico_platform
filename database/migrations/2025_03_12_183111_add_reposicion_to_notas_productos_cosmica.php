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
        Schema::table('notas_productos_cosmica', function (Blueprint $table) {
            $table->unsignedBigInteger('id_reposicion_nas')->nullable();
            $table->foreign('id_reposicion_nas')
                ->references('id')->on('notas_productos')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_reposicion_cosmica')->nullable();
            $table->foreign('id_reposicion_cosmica')
                ->references('id')->on('notas_productos_cosmica')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_reposicion_user')->nullable();
            $table->foreign('id_reposicion_user')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->date('fecha_reposicion')->nullable();
            $table->text('estatus_reposicion')->nullable();
            $table->text('firma_reposicion')->nullable();
            $table->text('nota_reposicion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas_productos_cosmica', function (Blueprint $table) {
            //
        });
    }
};
