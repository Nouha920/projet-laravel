<!-- resources/views/admin/articles/edit.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Modifier l\'article')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.articles.index') }}" class="text-blue-600 hover:text-blue-700">
            ← Retour à la liste
        </a>
        <a href="{{ route('articles.show', $article->slug) }}" 
           target="_blank"
           class="text-green-600 hover:text-green-700">
            Voir sur le site →
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Titre -->
            <div class="mb-6">
                <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                    Titre de l'article *
                </label>
                <input type="text" 
                       id="titre" 
                       name="titre" 
                       value="{{ old('titre', $article->titre) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('titre') border-red-500 @enderror"
                       required>
                @error('titre')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catégorie -->
            <div class="mb-6">
                <label for="categorie_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Catégorie *
                </label>
                <select id="categorie_id" 
                        name="categorie_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('categorie_id') border-red-500 @enderror"
                        required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" 
                                {{ old('categorie_id', $article->categorie_id) == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Extrait -->
            <div class="mb-6">
                <label for="extrait" class="block text-sm font-medium text-gray-700 mb-2">
                    Extrait
                </label>
                <textarea id="extrait" 
                          name="extrait" 
                          rows="3"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('extrait', $article->extrait) }}</textarea>
            </div>

            <!-- Contenu -->
            <div class="mb-6">
                <label for="contenu" class="block text-sm font-medium text-gray-700 mb-2">
                    Contenu *
                </label>
                <textarea id="contenu" 
                          name="contenu" 
                          rows="15"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('contenu') border-red-500 @enderror"
                          required>{{ old('contenu', $article->contenu) }}</textarea>
                @error('contenu')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image actuelle -->
            @if($article->image)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Image actuelle
                </label>
                <img src="{{ Storage::url($article->image) }}" 
                     alt="{{ $article->titre }}" 
                     class="w-48 h-32 object-cover rounded-lg">
            </div>
            @endif

            <!-- Nouvelle image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $article->image ? 'Remplacer l\'image' : 'Image de couverture' }}
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

            <!-- Ingrédients -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Ingrédients associés
                </label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-64 overflow-y-auto p-4 border rounded-lg bg-gray-50">
                    @foreach($ingredients as $ingredient)
                        <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded">
                            <input type="checkbox" 
                                   name="ingredients[]" 
                                   value="{{ $ingredient->id }}"
                                   {{ in_array($ingredient->id, old('ingredients', $article->ingredients->pluck('id')->toArray())) ? 'checked' : '' }}
                                   class="rounded text-blue-600 focus:ring-blue-500">
                            <span class="text-sm">{{ $ingredient->nom }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Statistiques -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Vues:</span>
                        <span class="font-semibold ml-2">{{ $article->vues }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Créé le:</span>
                        <span class="font-semibold ml-2">{{ $article->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Publié -->
            <div class="mb-6">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" 
                           name="publie" 
                           value="1"
                           {{ old('publie', $article->publie) ? 'checked' : '' }}
                           class="rounded text-blue-600 focus:ring-blue-500">
                    <span class="text-sm font-medium text-gray-700">Article publié</span>
                </label>
            </div>

            <!-- Boutons -->
            <div class="flex justify-between">
                <form action="{{ route('admin.articles.destroy', $article) }}" 
                      method="POST"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Supprimer
                    </button>
                </form>
                
                <div class="flex space-x-4">
                    <a href="{{ route('admin.articles.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection