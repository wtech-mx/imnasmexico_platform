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
        Schema::table('users', function (Blueprint $table) {
            $table->text('num_user')->nullable();
            $table->text('usuario_eva')->nullable();
            $table->text('contrasena_eva')->nullable();
            $table->text('costo_emi')->nullable();
            $table->text('pagina_web')->nullable();
            $table->text('otra_red')->nullable();
            $table->text('curp')->nullable();
            $table->text('estatus_exp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
