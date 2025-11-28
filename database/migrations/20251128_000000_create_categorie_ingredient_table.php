<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorie_ingredients', function (Blueprint $table) {
            $table->id(); // <- c'est très important ! BIGINT UNSIGNED
            $table->string('nom');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorie_ingredients');
    }
};
