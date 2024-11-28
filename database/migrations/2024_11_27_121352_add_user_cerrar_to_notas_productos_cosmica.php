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
            $table->unsignedBigInteger('id_admin_venta')->nullable();
            $table->foreign('id_admin_venta')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('cantidad_kit')->nullable();
            $table->text('cantidad_kit2')->nullable();
            $table->text('cantidad_kit3')->nullable();
            $table->text('cantidad_kit4')->nullable();
            $table->text('cantidad_kit5')->nullable();
            $table->text('cantidad_kit6')->nullable();
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
