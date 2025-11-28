<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IngredientController extends Controller
{
     public function index()
    {
        $ingredients = Ingredient::orderBy('nom')->paginate(20);
        
        return view('admin.ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('admin.ingredients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nom_scientifique' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'bienfaits' => 'required|string',
            'utilisation' => 'nullable|string',
            'precautions' => 'nullable|string',
            'concentration' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'types_peau' => 'nullable|array',
            'actif' => 'nullable|boolean'
        ]);

        // Upload image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('ingredients', 'public');
        }

        // Types de peau (JSON)
        $validated['types_peau'] = json_encode($request->input('types_peau', []));
        
        // Slug
        $validated['slug'] = Str::slug($validated['nom']);
        
        // Actif
        $validated['actif'] = $request->has('actif') ? 1 : 0;

        Ingredient::create($validated);

        return redirect()->route('admin.ingredients.index')
            ->with('success', 'Ingrédient créé avec succès ! 🎉');
    }

    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nom_scientifique' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'bienfaits' => 'required|string',
            'utilisation' => 'nullable|string',
            'precautions' => 'nullable|string',
            'concentration' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'types_peau' => 'nullable|array',
            'actif' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($ingredient->image && \Storage::disk('public')->exists($ingredient->image)) {
                \Storage::disk('public')->delete($ingredient->image);
            }
            $validated['image'] = $request->file('image')->store('ingredients', 'public');
        }

        $validated['types_peau'] = json_encode($request->input('types_peau', []));
        $validated['slug'] = Str::slug($validated['nom']);
        $validated['actif'] = $request->has('actif') ? 1 : 0;

        $ingredient->update($validated);

        return redirect()->route('admin.ingredients.index')
            ->with('success', 'Ingrédient mis à jour avec succès ! ✅');
    }

    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        
        if ($ingredient->image && \Storage::disk('public')->exists($ingredient->image)) {
            \Storage::disk('public')->delete($ingredient->image);
        }

        $ingredient->delete();

        return redirect()->route('admin.ingredients.index')
            ->with('success', 'Ingrédient supprimé avec succès ! 🗑️');
    }
}