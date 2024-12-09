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
        Schema::create('meli', function (Blueprint $table) {
            $table->id();
            $table->text('app_id')->nullable();
            $table->text('client_secret')->nullable();
            $table->text('link_renovacion_token')->nullable();
            $table->text('accesstoken')->nullable();
            $table->text('autorizacion')->nullable();
            $table->text('sellerId')->nullable();
            $table->text('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meli_talble');
    }
};
