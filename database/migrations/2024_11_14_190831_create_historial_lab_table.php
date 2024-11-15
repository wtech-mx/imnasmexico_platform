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
        Schema::create('historial_lab', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_envase')->nullable();
            $table->foreign('id_envase')
                ->references('id')->on('envases')
                ->inDelete('set null');

            $table->text('user')->nullable();
            $table->text('stock_viejo')->nullable();
            $table->text('ocupado')->nullable();
            $table->text('stock_nuevo')->nullable();
            $table->date('fecha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_lab');
    }
};
