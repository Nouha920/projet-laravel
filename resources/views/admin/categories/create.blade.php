@extends('admin.layout')

@section('title', 'Créer une catégorie')

@section('content')

<div class="bg-white shadow-lg rounded-2xl p-8 max-w-2xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent mb-2">
            📂 Créer une nouvelle catégorie
        </h1>
        <p class="text-gray-600">Ajoutez une catégorie pour organiser vos articles</p>
    </div>

    {{-- Alerts --}}
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

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Nom --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                🏷️ Nom de la catégorie
            </label>
            <input type="text" 
                   name="nom" 
                   value="{{ old('nom') }}"
                   class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300" 
                   placeholder="Ex: Soins du visage, Hydratation..."
                   required>
        </div>

        {{-- Description --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                📝 Description (optionnelle)
            </label>
            <textarea name="description" 
                      rows="4" 
                      class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 resize-y" 
                      placeholder="Décrivez brièvement cette catégorie...">{{ old('description') }}</textarea>
        </div>

        {{-- Boutons --}}
        <div class="flex gap-4 pt-4 border-t-2 border-gray-100">
            <button type="submit"
                    class="flex-1 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-pink-600 hover:to-purple-600 transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                💾 Enregistrer la catégorie
            </button>
            <a href="{{ route('admin.categories.index') }}" 
               class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                ↩️ Annuler
            </a>
        </div>

    </form>
</div>

