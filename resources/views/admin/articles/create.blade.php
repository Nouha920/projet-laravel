@extends('admin.layout')

@section('title', 'Créer un article')

@section('content')

<div class="bg-white shadow-lg rounded-2xl p-8 max-w-4xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent mb-2">
            ➕ Créer un nouvel article
        </h1>
        <p class="text-gray-600">Remplissez les informations ci-dessous pour créer votre article</p>
    </div>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
            <div class="flex items-start">
                <span class="text-red-500 text-xl mr-3">⚠️</span>
                <div>
                    <h3 class="font-semibold text-red-800 mb-2">Erreurs de validation</h3>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700 text-sm">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Titre --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                📝 Titre de l'article
            </label>
            <input type="text" 
                   name="titre" 
                   value="{{ old('titre') }}"
                   class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300" 
                   placeholder="Entrez le titre de votre article..."
                   required>
        </div>

        {{-- Catégorie --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                📂 Catégorie
            </label>
            <select name="categorie_id" 
                    class="w-full border-2 border-gray-200 rounded-xl p-3 bg-white focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 cursor-pointer" 
                    required>
                <option value="">Sélectionnez une catégorie</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Image --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                🖼️ Image de couverture
            </label>
            <div class="relative">
                <input type="file" 
                       name="image" 
                       accept="image/*"
                       class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer">
                <p class="mt-2 text-sm text-gray-500">Format accepté: JPG, PNG, GIF (max 2MB)</p>
            </div>
        </div>

        {{-- Contenu --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                ✍️ Contenu de l'article
            </label>
            <textarea name="contenu" 
                      rows="8" 
                      class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 resize-y" 
                      placeholder="Rédigez le contenu de votre article ici..."
                      required>{{ old('contenu') }}</textarea>
        </div>

        {{-- Publier --}}
        <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-xl p-4 border-2 border-pink-100">
            <div class="flex items-center gap-3">
                <input type="checkbox" 
                       name="publie" 
                       value="1" 
                       id="publie"
                       {{ old('publie') ? 'checked' : '' }}
                       class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400 cursor-pointer">
                <label for="publie" class="font-medium text-gray-700 cursor-pointer select-none">
                    🌐 Publier cet article immédiatement
                </label>
            </div>
            <p class="text-sm text-gray-600 mt-2 ml-8">L'article sera visible publiquement sur votre site</p>
        </div>

        {{-- Boutons --}}
        <div class="flex gap-4 pt-4 border-t-2 border-gray-100">
            <button type="submit"
                    class="flex-1 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-pink-600 hover:to-purple-600 transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                💾 Enregistrer l'article
            </button>
            <a href="{{ route('admin.articles.index') }}" 
               class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                ↩️ Annuler
            </a>
        </div>

    </form>
</div>

@endsection