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
        Schema::table('registro_imnas_escuela', function (Blueprint $table) {
            $table->text('invertir_firmas')->nullable();
            $table->text('otra_firma_director')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_imnas_escuela', function (Blueprint $table) {
            //
        });
    }
};
