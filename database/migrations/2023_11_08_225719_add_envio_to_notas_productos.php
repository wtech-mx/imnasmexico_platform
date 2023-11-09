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
        Schema::table('notas_productos', function (Blueprint $table) {
            $table->string('tipo_nota')->nullable();
            $table->string('envio')->nullable();
            $table->string('dinero_recibido')->nullable();
            $table->string('foto_pago')->nullable();

            $table->unsignedBigInteger('id_admin');

            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notas_productos', function (Blueprint $table) {
            //
        });
    }
};
