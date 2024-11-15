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
        Schema::table('registro_imnas_doc', function (Blueprint $table) {
            $table->text('texto_firma_personalizada')->nullable();
            $table->text('texto_firma_personalizada2')->nullable();
            $table->text('otra_firma_director')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_imnas_doc', function (Blueprint $table) {
            //
        });
    }
};
