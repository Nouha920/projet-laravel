<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientCategorieTable extends Migration
{
    public function up()
    {
        Schema::create('ingredient_categorie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade');
            // si ta table catégories s'appelle 'categorie_ingredients' :
            $table->foreignId('categorie_ingredient_id')->constrained('categorie_ingredients')->onDelete('cascade');
            // Si elle s'appelle 'categories' utilise ->constrained('categories')
            $table->timestamps(); // facultatif
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredient_categorie');
    }
}
