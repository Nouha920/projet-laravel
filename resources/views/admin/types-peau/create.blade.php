
<!-- =================================================== -->
<!-- resources/views/admin/types-peau/create.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Créer un type de peau')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.types-peau.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
            ← Retour à la liste
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">💧 Créer un nouveau type de peau</h2>

        <form action="{{ route('admin.types-peau.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Nom -->
            <div class="mb-6">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom du type de peau *
                </label>
                <input type="text" 
                       id="nom" 
                       name="nom" 
                       value="{{ old('nom') }}"
                       placeholder="Ex: Peau grasse"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('nom') border-red-500 @enderror"
                       required>
                @error('nom')
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
                          rows="5"
                          placeholder="Caractéristiques de ce type de peau..."
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Erreurs à éviter -->
            <div class="mb-6">
                <label for="erreurs_a_eviter" class="block text-sm font-medium text-gray-700 mb-2">
                    Erreurs à éviter
                </label>
                <textarea id="erreurs_a_eviter" 
                          name="erreurs_a_eviter" 
                          rows="4"
                          placeholder="Liste des erreurs courantes pour ce type de peau..."
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('erreurs_a_eviter') border-red-500 @enderror">{{ old('erreurs_a_eviter') }}</textarea>
                @error('erreurs_a_eviter')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Image (optionnel)
                </label>
                <input type="file" 
                       id="image" 
                       name="image" 
                       accept="image/*"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Boutons -->
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('admin.types-peau.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Créer le type
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
