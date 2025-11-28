<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'slug'];

    /**
     * Relation : Une catégorie a plusieurs articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'categorie_ingredient');
    }
}