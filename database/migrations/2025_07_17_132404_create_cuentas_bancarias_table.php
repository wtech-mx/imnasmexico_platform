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
        Schema::create('cuentas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedores');
            $table->foreign('id_proveedores')
                ->references('id')->on('proveedores')
                ->inDelete('set null');

            $table->string('nombre_beneficiario')->nullable();
            $table->text('cuenta_bancaria')->nullable();
            $table->text('nombre_banco')->nullable();
            $table->text('cuenta_clabe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_bancarias');
    }
};
