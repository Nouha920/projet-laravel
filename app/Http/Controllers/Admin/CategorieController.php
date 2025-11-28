<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    /**
     * Liste des catégories
     */
    public function index()
    {
        $categories = Categorie::withCount('articles')->orderBy('nom')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Enregistrer une catégorie
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom',
            'description' => 'nullable|string'
        ]);

        $validated['slug'] = Str::slug($validated['nom']);

        Categorie::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès ! 🎉');
    }

    /**
     * Formulaire d'édition
     */
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categories.edit', compact('categorie'));
    }

    /**
     * Mettre à jour une catégorie
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom,' . $id,
            'description' => 'nullable|string'
        ]);

        $validated['slug'] = Str::slug($validated['nom']);

        $categorie->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès ! ✅');
    }

    /**
     * Supprimer une catégorie
     */
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        
        // Vérifier si la catégorie a des articles
        if ($categorie->articles()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des articles.');
        }

        $categorie->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès ! 🗑️');
    }
}