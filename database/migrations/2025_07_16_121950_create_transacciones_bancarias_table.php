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
        Schema::create('transacciones_bancarias', function (Blueprint $table) {
            $table->id(); // ID interno de Laravel

            $table->unsignedBigInteger('id_transaccion'); // Este es tu 'id' del request
            $table->string('fechaOperacion', 8);
            $table->string('institucionOrdenante', 5);
            $table->string('institucionBeneficiaria', 5);
            $table->string('claveRastreo', 30);
            $table->decimal('monto', 15, 2);

            $table->string('nombreOrdenante', 120)->nullable();
            $table->string('tipoCuentaOrdenante', 2)->nullable();
            $table->string('cuentaOrdenante', 20)->nullable();
            $table->string('rfcCurpOrdenante', 18)->nullable();

            $table->string('nombreBeneficiario', 40);
            $table->string('tipoCuentaBeneficiario', 2);
            $table->string('cuentaBeneficiario', 20);

            $table->string('nombreBeneficiario2', 40)->nullable();
            $table->string('tipoCuentaBeneficiario2')->nullable(); // No se especificó longitud
            $table->string('cuentaBeneficiario2', 18)->nullable();

            $table->string('rfcCurpBeneficiario', 18);
            $table->string('conceptoPago', 40);
            $table->string('referenciaNumerica', 7);
            $table->string('empresa', 15);
            $table->string('tipoPago', 2);
            $table->string('tsLiquidacion', 13);
            $table->string('folioCo')->nullable(); // este quedó incompleto en tu código, puedes ajustar

            $table->timestamps();

            $table->unique('id_transaccion'); // Evita duplicados del ID externo
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones_bancarias');
    }
};
