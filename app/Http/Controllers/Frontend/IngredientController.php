<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredient::where('actif', true);

        // Recherche par nom
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('nom_scientifique', 'like', '%' . $request->search . '%')
                  ->orWhere('bienfaits', 'like', '%' . $request->search . '%');
            });
        }

        // Filtrer par type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Filtrer par type de peau
        if ($request->has('peau') && $request->peau != '') {
            $query->whereJsonContains('types_peau', $request->peau);
        }

        $ingredients = $query->orderBy('nom')->paginate(12);

        // Statistiques
        $stats = [
            'totalIngredients' => Ingredient::where('actif', true)->count(),
            'types' => Ingredient::where('actif', true)->distinct('type')->count('type'),
        ];

        return view('frontend.ingredients.index', compact('ingredients', 'stats'));
    }

    public function show($slug)
    {
        $ingredient = Ingredient::where('slug', $slug)
            ->where('actif', true)
            ->firstOrFail();

        // Ingrédients similaires
        $similaires = Ingredient::where('actif', true)
            ->where('id', '!=', $ingredient->id)
            ->where('type', $ingredient->type)
            ->limit(3)
            ->get();

        return view('frontend.ingredients.show', compact('ingredient', 'similaires'));
    }
}