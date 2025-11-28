<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePeau extends Model
{
    use HasFactory;

    protected $table = 'types_peau';

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'caracteristiques',
        'problemes_communs',
        'conseils',
        'ingredients_recommandes',
        'ingredients_eviter',
        'image',
        'actif'
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    /**
     * Relation : Type de peau peut avoir plusieurs routines
     */
    public function routines()
    {
        return $this->hasMany(Routine::class, 'type_peau_id');
    }
}