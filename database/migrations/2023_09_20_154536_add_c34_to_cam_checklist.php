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
        Schema::table('cam_checklist', function (Blueprint $table) {
            $table->text('c13')->nullable();
            $table->text('c14')->nullable();
            $table->text('c15')->nullable();
            $table->text('c16')->nullable();
            $table->text('c17')->nullable();
            $table->text('c18')->nullable();
            $table->text('c19')->nullable();
            $table->text('c20')->nullable();
            $table->text('c21')->nullable();
            $table->text('c22')->nullable();
            $table->text('c23')->nullable();
            $table->text('c24')->nullable();
            $table->text('c25')->nullable();
            $table->text('c26')->nullable();
            $table->text('c27')->nullable();
            $table->text('c28')->nullable();
            $table->text('c29')->nullable();
            $table->text('c30')->nullable();
            $table->text('c31')->nullable();
            $table->text('c32')->nullable();
            $table->text('c33')->nullable();
            $table->text('c34')->nullable();
            $table->text('c35')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cam_checklist', function (Blueprint $table) {
            //
        });
    }
};
