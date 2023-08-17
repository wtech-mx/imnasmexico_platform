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
        Schema::create('cam_notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('tipo');
            $table->text('membresia')->nullable();
            $table->text('monto1')->nullable();
            $table->text('monto2')->nullable();
            $table->text('metodo_pago')->nullable();
            $table->text('metodo_pago2')->nullable();
            $table->text('nota')->nullable();
            $table->text('comprobante', 900)->nullable();
            $table->text('comprobante2', 900)->nullable();
            $table->text('descuento')->nullable();
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
        Schema::dropIfExists('notas_cam');
    }
};
