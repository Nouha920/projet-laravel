<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieIngredient extends Model
{
    use HasFactory;

    protected $table = 'categorie_ingredients';

    protected $fillable = [
        'nom',
        'slug',
        'couleur'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_categorie');
    }
}