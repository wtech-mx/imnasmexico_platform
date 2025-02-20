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
            $table->text('orden_firmas')->nullable();
            $table->text('titular1')->nullable();
            $table->text('titular2')->nullable();

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
