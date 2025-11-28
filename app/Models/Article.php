<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
    'titre',
    'slug',
    'categorie_id',
    'contenu',
    'image',
    'publie',
    'vues',
];

    /**
     * Relation avec la catégorie
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Relation avec les ingrédients (table pivot article_ingredient)
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'article_ingredient');
    }

    /**
     * Scope pour ne récupérer que les articles publiés
     */
    public function scopePublie($query)
    {
        return $query->where('publie', true);
    }

    /**
     * Scope pour trier les articles du plus récent au plus ancien
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Incrémenter le compteur de vues
     */
    public function incrementVues()
    {
        $this->increment('vues');
    }
}
