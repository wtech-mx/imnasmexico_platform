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
        Schema::table('orders_cosmica', function (Blueprint $table) {
            $table->text('item_id_meli')->nullable();
            $table->text('item_title_meli')->nullable();
            $table->text('item_descripcion_meli')->nullable();
            $table->text('item_descripcion_permalink')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders_cosmica', function (Blueprint $table) {
            //
        });
    }
};
