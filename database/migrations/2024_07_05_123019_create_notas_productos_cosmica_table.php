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
        Schema::create('notas_productos_cosmica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->inDelete('set null');

           $table->unsignedBigInteger('id_admin');
           $table->foreign('id_admin')
           ->references('id')->on('users')
           ->inDelete('set null');

            $table->string('tipo_nota')->nullable();
            $table->string('envio')->nullable();
            $table->date('fecha')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->string('dinero_recibido')->nullable();
            $table->string('restante')->nullable();
            $table->string('nota')->nullable();
            $table->string('descuento')->nullable();
            $table->string('cambio')->nullable();

            $table->string('metodo_pago')->nullable();
            $table->string('monto')->nullable();
            $table->text('foto_pago')->nullable();
            $table->string('metodo_pago2')->nullable();
            $table->string('monto2')->nullable();
            $table->text('foto_pago2')->nullable();

            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();

            $table->string('factura')->nullable();
            $table->string('situacion_fiscal')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('rfc')->nullable();
            $table->string('cfdi')->nullable();
            $table->string('correo_fac')->nullable();
            $table->string('telefono_fac')->nullable();
            $table->string('direccion_fac')->nullable();
            $table->string('folio')->nullable();
            $table->string('estatus_cotizacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_productos_cosmica');
    }
};
