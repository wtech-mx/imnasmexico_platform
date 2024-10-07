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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->foreign('id_admin')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_nota')->nullable();
            $table->foreign('id_nota')
                ->references('id')->on('notas_curso')
                ->inDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
