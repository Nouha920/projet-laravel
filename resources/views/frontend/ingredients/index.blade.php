@extends('layouts.app')

@section('title', 'Ingrédients Skincare')

@section('content')

<div class="bg-gradient-to-br from-pink-50 via-white to-purple-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-4">
                🧪 Base d'ingrédients
            </h1>
            <p class="text-xl text-gray-600">Découvrez les secrets des ingrédients skincare</p>
        </div>

        {{-- Filtres --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <form method="GET" action="{{ route('ingredients.index') }}" class="grid md:grid-cols-3 gap-4">
                
                {{-- Recherche --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">🔍 Rechercher</label>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Nom de l'ingrédient..."
                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-2 focus:border-pink-400 outline-none">
                </div>

                {{-- Type --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📋 Type</label>
                    <select name="type" class="w-full border-2 border-gray-200 rounded-xl px-4 py-2 focus:border-pink-400 outline-none">
                        <option value="">Tous les types</option>
                        <option value="Hydratant" {{ request('type') == 'Hydratant' ? 'selected' : '' }}>💧 Hydratant</option>
                        <option value="Antioxydant" {{ request('type') == 'Antioxydant' ? 'selected' : '' }}>🛡️ Antioxydant</option>
                        <option value="Exfoliant" {{ request('type') == 'Exfoliant' ? 'selected' : '' }}>✨ Exfoliant</option>
                        <option value="Anti-âge" {{ request('type') == 'Anti-âge' ? 'selected' : '' }}>⏰ Anti-âge</option>
                        <option value="Apaisant" {{ request('type') == 'Apaisant' ? 'selected' : '' }}>🌿 Apaisant</option>
                        <option value="Éclaircissant" {{ request('type') == 'Éclaircissant' ? 'selected' : '' }}>🌟 Éclaircissant</option>
                    </select>
                </div>

                {{-- Type de peau --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">🧴 Type de peau</label>
                    <select name="peau" class="w-full border-2 border-gray-200 rounded-xl px-4 py-2 focus:border-pink-400 outline-none">
                        <option value="">Tous les types</option>
                        <option value="Normale" {{ request('peau') == 'Normale' ? 'selected' : '' }}>😊 Normale</option>
                        <option value="Sèche" {{ request('peau') == 'Sèche' ? 'selected' : '' }}>🏜️ Sèche</option>
                        <option value="Grasse" {{ request('peau') == 'Grasse' ? 'selected' : '' }}>💧 Grasse</option>
                        <option value="Mixte" {{ request('peau') == 'Mixte' ? 'selected' : '' }}>🌓 Mixte</option>
                        <option value="Sensible" {{ request('peau') == 'Sensible' ? 'selected' : '' }}>🌸 Sensible</option>
                    </select>
                </div>

                {{-- Boutons --}}
                <div class="md:col-span-3 flex gap-3">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-pink-600 hover:to-purple-600 transition-all">
                        Rechercher
                    </button>
                    <a href="{{ route('ingredients.index') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        {{-- Résultats --}}
        @if($ingredients->count() > 0)
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                @foreach($ingredients as $ingredient)
                    <a href="{{ route('ingredients.show', $ingredient->slug) }}" 
                       class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all transform hover:scale-105 group">
                        
                        {{-- Image --}}
                        <div class="h-48 bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center overflow-hidden">
                            @if($ingredient->image)
                                <img src="{{ asset('storage/' . $ingredient->image) }}" 
                                     alt="{{ $ingredient->nom }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <span class="text-6xl">🧪</span>
                            @endif
                        </div>

                        {{-- Contenu --}}
                        <div class="p-6">
                            <div class="mb-3">
                                @if($ingredient->type)
                                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">
                                        {{ $ingredient->type }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-pink-600 transition-colors">
                                {{ $ingredient->nom }}
                            </h3>
                            
                            @if($ingredient->nom_scientifique)
                                <p class="text-sm text-gray-500 italic mb-3">{{ $ingredient->nom_scientifique }}</p>
                            @endif
                            
                            <p class="text-gray-600 text-sm line-clamp-3">
                                {{ Str::limit($ingredient->bienfaits, 120) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center">
                {{ $ingredients->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucun ingrédient trouvé</h3>
                <p class="text-gray-600 mb-6">Essayez de modifier vos critères de recherche</p>
                <a href="{{ route('ingredients.index') }}" 
                   class="inline-block bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-pink-600 hover:to-purple-600 transition-all">
                    Voir tous les ingrédients
                </a>
            </div>
        @endif

    </div>
</div>

@endsection