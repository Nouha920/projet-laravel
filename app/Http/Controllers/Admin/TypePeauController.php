<?php
// app/Http\Controllers/Admin/TypePeauController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypePeau;
use Illuminate\Http\Request;

class TypePeauController extends Controller
{
    /**
     * Afficher la liste des types de peau
     */
    public function index()
    {
        $typesPeau = TypePeau::withCount('routines')->get();
        return view('admin.types-peau.index', compact('typesPeau'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('admin.types-peau.create');
    }

    /**
     * Enregistrer un nouveau type de peau
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'erreurs_a_eviter' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'description.required' => 'La description est obligatoire',
            'image.image' => 'Le fichier doit être une image',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('types-peau', 'public');
        }

        TypePeau::create($validated);

        return redirect()->route('admin.types-peau.index')
            ->with('success', 'Type de peau créé avec succès');
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(TypePeau $typesPeau)
    {
        // Laravel crée automatiquement le binding avec le nom du paramètre de route
        return view('admin.types-peau.edit', ['typePeau' => $typesPeau]);
    }

    /**
     * Mettre à jour un type de peau
     */
    public function update(Request $request, TypePeau $typesPeau)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'erreurs_a_eviter' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'description.required' => 'La description est obligatoire',
            'image.image' => 'Le fichier doit être une image',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('types-peau', 'public');
        }

        $typesPeau->update($validated);

        return redirect()->route('admin.types-peau.index')
            ->with('success', 'Type de peau modifié avec succès');
    }

    /**
     * Supprimer un type de peau
     */
    public function destroy(TypePeau $typesPeau)
    {
        // Vérifier s'il y a des routines associées
        if ($typesPeau->routines()->count() > 0) {
            return redirect()->route('admin.types-peau.index')
                ->with('error', 'Impossible de supprimer un type de peau ayant des routines associées. Supprimez d\'abord les routines.');
        }

        $typesPeau->delete();
        
        return redirect()->route('admin.types-peau.index')
            ->with('success', 'Type de peau supprimé avec succès');
    }
}