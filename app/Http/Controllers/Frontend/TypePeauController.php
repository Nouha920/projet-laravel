<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TypePeau;
use Illuminate\Http\Request;

class TypePeauController extends Controller
{
    /**
     * Liste des types de peau
     */
    public function index()
    {
        $typesPeau = TypePeau::where('actif', true)
            ->orderBy('nom')
            ->get();

        return view('frontend.types-peau.index', compact('typesPeau'));
    }

    /**
     * Détails d'un type de peau
     */
    public function show($slug)
    {
        $typePeau = TypePeau::where('slug', $slug)
            ->where('actif', true)
            ->firstOrFail();

        // Routines recommandées pour ce type de peau (si vous avez une relation)
        // $routines = $typePeau->routines()->where('actif', true)->get();

        return view('frontend.types-peau.show', compact('typePeau'));
    }
}