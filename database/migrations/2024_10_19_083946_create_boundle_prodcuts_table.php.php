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
        Schema::create('products_bundle_id', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')
                ->references('id')->on('products')
                ->inDelete('set null');

            $table->string('producto')->nullable();
            $table->string('price')->nullable();
            $table->string('cantidad')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
