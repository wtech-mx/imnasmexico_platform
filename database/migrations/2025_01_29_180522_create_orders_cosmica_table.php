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
        Schema::create('orders_cosmica', function (Blueprint $table) {
            $table->id();
            $table->text('num_order')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->text('pago')->nullable();
            $table->text('forma_pago')->nullable();
            $table->text('estatus')->nullable();
            $table->date('fecha')->nullable();
            $table->text('code')->nullable();
            $table->text('external_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_cosmica');
    }
};
