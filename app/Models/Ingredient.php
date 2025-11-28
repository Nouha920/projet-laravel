<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'nom_scientifique',
        'slug',
        'type',
        'bienfaits',
        'utilisation',
        'precautions',
        'concentration',
        'image',
        'types_peau',
        'actif'
    ];

    protected $casts = [
        'types_peau' => 'array',
        'actif' => 'boolean'
    ];

    /**
     * Relation : Un ingrédient peut appartenir à plusieurs catégories
     */
    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'categorie_ingredient');
    }

    public function getTypesPeauListAttribute()
    {
        if (is_string($this->types_peau)) {
            $types = json_decode($this->types_peau, true);
            return is_array($types) ? implode(', ', $types) : '';
        }
        
        return is_array($this->types_peau) ? implode(', ', $this->types_peau) : '';
    }
}