
<!-- =================================================== -->
<!-- resources/views/admin/routines/create.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Créer une routine')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.routines.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
            ← Retour à la liste
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">✨ Créer une nouvelle routine</h2>

        <form action="{{ route('admin.routines.store') }}" method="POST">
            @csrf
            
            <!-- Type de peau -->
            <div class="mb-6">
                <label for="type_peau_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Type de peau *
                </label>
                <select id="type_peau_id" 
                        name="type_peau_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('type_peau_id') border-red-500 @enderror"
                        required>
                    <option value="">Sélectionner un type de peau</option>
                    @foreach($typesPeau as $type)
                        <option value="{{ $type->id }}" {{ old('type_peau_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->nom }}
                        </option>
                    @endforeach
                </select>
                @error('type_peau_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Titre -->
            <div class="mb-6">
                <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                    Titre de l'étape *
                </label>
                <input type="text" 
                       id="titre" 
                       name="titre" 
                       value="{{ old('titre') }}"
                       placeholder="Ex: Nettoyant doux"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('titre') border-red-500 @enderror"
                       required>
                @error('titre')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description *
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="4"
                          placeholder="Détails de cette étape de la routine..."
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Période -->
            <div class="mb-6">
                <label for="periode" class="block text-sm font-medium text-gray-700 mb-2">
                    Période *
                </label>
                <select id="periode" 
                        name="periode" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('periode') border-red-500 @enderror"
                        required>
                    <option value="matin" {{ old('periode') == 'matin' ? 'selected' : '' }}>☀️ Matin</option>
                    <option value="soir" {{ old('periode') == 'soir' ? 'selected' : '' }}>🌙 Soir</option>
                    <option value="hebdomadaire" {{ old('periode') == 'hebdomadaire' ? 'selected' : '' }}>📅 Hebdomadaire</option>
                </select>
                @error('periode')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ordre -->
            <div class="mb-6">
                <label for="ordre" class="block text-sm font-medium text-gray-700 mb-2">
                    Ordre d'exécution *
                </label>
                <input type="number" 
                       id="ordre" 
                       name="ordre" 
                       value="{{ old('ordre', 1) }}"
                       min="0"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('ordre') border-red-500 @enderror"
                       required>
                @error('ordre')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">1 = première étape, 2 = deuxième étape, etc.</p>
            </div>

            <!-- Boutons -->
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('admin.routines.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Créer la routine
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
