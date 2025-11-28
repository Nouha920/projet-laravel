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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('nom_scientifique')->nullable();
            $table->string('slug')->unique();
            $table->string('type')->nullable();
            $table->text('bienfaits');
            $table->text('utilisation')->nullable();
            $table->text('precautions')->nullable();
            $table->string('concentration')->nullable();
            $table->string('image')->nullable();
            $table->json('types_peau')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};