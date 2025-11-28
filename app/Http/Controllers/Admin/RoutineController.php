<?php
// ===================================================
// app/Http/Controllers/Admin/RoutineController.php
// ===================================================

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Models\TypePeau;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    /**
     * Afficher la liste des routines
     */
    public function index()
    {
        $routines = Routine::with('typePeau')
            ->orderBy('type_peau_id')
            ->orderBy('periode')
            ->orderBy('ordre')
            ->paginate(30);
            
        return view('admin.routines.index', compact('routines'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $typesPeau = TypePeau::all();
        return view('admin.routines.create', compact('typesPeau'));
    }

    /**
     * Enregistrer une nouvelle routine
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_peau_id' => 'required|exists:types_peau,id',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'periode' => 'required|in:matin,soir,hebdomadaire',
            'ordre' => 'required|integer|min:0'
        ], [
            'type_peau_id.required' => 'Le type de peau est obligatoire',
            'type_peau_id.exists' => 'Le type de peau sélectionné n\'existe pas',
            'titre.required' => 'Le titre est obligatoire',
            'description.required' => 'La description est obligatoire',
            'periode.required' => 'La période est obligatoire',
            'periode.in' => 'La période doit être matin, soir ou hebdomadaire',
            'ordre.required' => 'L\'ordre est obligatoire',
            'ordre.min' => 'L\'ordre doit être supérieur ou égal à 0',
        ]);

        Routine::create($validated);

        return redirect()->route('admin.routines.index')
            ->with('success', 'Routine créée avec succès');
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Routine $routine)
    {
        return view('admin.routines.edit', compact('routine', 'typesPeau'));
    }

    /**
     * Mettre à jour une routine
     */
    public function update(Request $request, Routine $routine)
    {
        $validated = $request->validate([
            'type_peau_id' => 'required|exists:types_peau,id',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'periode' => 'required|in:matin,soir,hebdomadaire',
            'ordre' => 'required|integer|min:0'
        ], [
            'type_peau_id.required' => 'Le type de peau est obligatoire',
            'type_peau_id.exists' => 'Le type de peau sélectionné n\'existe pas',
            'titre.required' => 'Le titre est obligatoire',
            'description.required' => 'La description est obligatoire',
            'periode.required' => 'La période est obligatoire',
            'periode.in' => 'La période doit être matin, soir ou hebdomadaire',
            'ordre.required' => 'L\'ordre est obligatoire',
            'ordre.min' => 'L\'ordre doit être supérieur ou égal à 0',
        ]);

        $routine->update($validated);

        return redirect()->route('admin.routines.index')
            ->with('success', 'Routine modifiée avec succès');
    }

    /**
     * Supprimer une routine
     */
    public function destroy(Routine $routine)
    {
        $routine->delete();
        
        return redirect()->route('admin.routines.index')
            ->with('success', 'Routine supprimée avec succès');
    }
}
