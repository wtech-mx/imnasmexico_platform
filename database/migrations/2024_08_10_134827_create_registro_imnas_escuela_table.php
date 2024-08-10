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
        Schema::create('registro_imnas_escuela', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->inDelete('set null');
                
            $table->text('direccion_escuela')->nullable();
            $table->text('city_escuela')->nullable();
            $table->text('state_escuela')->nullable();
            $table->text('postcode_escuela')->nullable();
            $table->text('country_escuela')->nullable();

            $table->text('nombre_referencia')->nullable();
            $table->text('direccion_referencia')->nullable();
            $table->text('city_referencia')->nullable();
            $table->text('state_referencia')->nullable();
            $table->text('postcode_referencia')->nullable();
            $table->text('country_referencia')->nullable();
            $table->text('telefono_referencia')->nullable();
            $table->text('email_referencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_imnas_escuela');
    }
};
