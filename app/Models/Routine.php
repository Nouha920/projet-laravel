<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_peau_id',
        'titre',
        'description',
        'periode', // 'matin' ou 'soir'
    ];

    /**
     * Relation avec le type de peau
     */
    public function typePeau()
    {
        return $this->belongsTo(TypePeau::class);
    }
}
