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
            $table->unsignedBigInteger('id_ticket')->nullable();
            $table->foreign('id_ticket')
                ->references('id')->on('cursos_tickets')
                ->inDelete('set null');
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
