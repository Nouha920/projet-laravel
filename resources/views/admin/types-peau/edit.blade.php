
<!-- =================================================== -->
<!-- resources/views/admin/types-peau/edit.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Modifier le type de peau')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.types-peau.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
            ← Retour à la liste
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Modifier {{ $typePeau->nom }}</h2>

        <form action="{{ route('admin.types-peau.update', $typePeau) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Nom -->
            <div class="mb-6">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom du type de peau *
                </label>
                <input type="text" 
                       id="nom" 
                       name="nom" 
                       value="{{ old('nom', $typePeau->nom) }}"
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
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                          required>{{ old('description', $typePeau->description) }}</textarea>
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
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('erreurs_a_eviter') border-red-500 @enderror">{{ old('erreurs_a_eviter', $typePeau->erreurs_a_eviter) }}</textarea>
                @error('erreurs_a_eviter')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image actuelle -->
            @if($typePeau->image)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Image actuelle
                </label>
                <img src="{{ Storage::url($typePeau->image) }}" 
                     alt="{{ $typePeau->nom }}" 
                     class="w-32 h-32 object-cover rounded-lg">
            </div>
            @endif

            <!-- Nouvelle image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $typePeau->image ? 'Remplacer l\'image' : 'Image' }}
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

            <!-- Statistiques -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">
                    <strong>Routines associées :</strong> {{ $typePeau->routines->count() }} routine(s)
                </p>
            </div>

            <!-- Boutons -->
            <div class="flex justify-between pt-4">
                <form action="{{ route('admin.types-peau.destroy', $typePeau) }}" 
                      method="POST"
                      onsubmit="return confirm('Supprimer ce type de peau et toutes ses routines ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Supprimer
                    </button>
                </form>
                
                <div class="flex space-x-4">
                    <a href="{{ route('admin.types-peau.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection