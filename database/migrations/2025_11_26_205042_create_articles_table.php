<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->text('extrait')->nullable();
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->boolean('publie')->default(true);
            $table->integer('vues')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};

