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
        Schema::create('web_page', function (Blueprint $table) {
            $table->id();
            $table->string('wb_all_pixel')->nullable();
            $table->string('wb_all_analitics')->nullable();
            $table->string('stone_home_bg')->nullable();
            $table->string('stone_home_tittle')->nullable();
            $table->string('stone_home_text')->nullable();
            $table->string('parallax')->nullable();
            $table->string('stfive_home_tittle')->nullable();
            $table->string('stfive_home_text')->nullable();
            $table->string('stseven_home_tittle')->nullable();
            $table->string('stseven_home_text')->nullable();
            $table->string('stpaquetesone_image')->nullable();
            $table->string('stpaquetestwo_image')->nullable();
            $table->string('stpaquetesthree_image')->nullable();
            $table->string('stpaquetesfour_image')->nullable();
            $table->string('stpaquetesfive_image')->nullable();
            $table->string('stavalesunam_image')->nullable();
            $table->string('stavalesconocer_image')->nullable();
            $table->string('stavalesrevoe_image')->nullable();
            $table->string('stavalesstps_image')->nullable();
            $table->string('stavalesregistro_one_image')->nullable();
            $table->string('stavalesregistro_two_image')->nullable();
            $table->string('stavalesregistro_three_image')->nullable();
            $table->string('stavalesregistro_four_image')->nullable();
            $table->string('stavalesregistro_five_image')->nullable();
            $table->string('stone_nosotros_bg')->nullable();
            $table->string('stone_nosotros_tittle')->nullable();
            $table->string('stone_nosotros_text')->nullable();
            $table->string('stone_instalaciones_bg')->nullable();
            $table->string('stone_instalaciones_tittle')->nullable();
            $table->string('stone_instalaciones_text')->nullable();
            $table->string('timestamps')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_pages');
    }
};
