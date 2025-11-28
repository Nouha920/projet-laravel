<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('types_peau', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('caracteristiques')->nullable();
            $table->text('problemes_communs')->nullable();
            $table->text('conseils')->nullable();
            $table->text('ingredients_recommandes')->nullable();
            $table->text('ingredients_eviter')->nullable();
            $table->string('image')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('types_peau');
    }
};