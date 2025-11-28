@extends('admin.layout')

@section('title', 'Ingrédients')

@section('content')

<div class="max-w-7xl mx-auto">
    
    {{-- Header --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent">
                    🧪 Gestion des ingrédients
                </h1>
                <p class="text-gray-600 mt-1">Base de données des ingrédients skincare</p>
            </div>
            <a href="{{ route('admin.ingredients.create') }}" 
               class="bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-pink-600 hover:to-purple-600 transition-all transform hover:scale-[1.02] shadow-lg flex items-center gap-2">
                ➕ Nouvel ingrédient
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
            <div class="flex items-center">
                <span class="text-green-500 text-xl mr-3">✅</span>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
            <div class="flex items-center">
                <span class="text-red-500 text-xl mr-3">❌</span>
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Stats --}}
    <div class="grid md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-pink-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">🧪</span>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Total ingrédients</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $ingredients->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-green-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">✅</span>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Actifs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $ingredients->where('actif', true)->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-purple-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">📊</span>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Types différents</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $ingredients->pluck('type')->filter()->unique()->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Liste des ingrédients --}}
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
        @if($ingredients->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-pink-50 to-purple-50 border-b-2 border-pink-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Ingrédient</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Type</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Types de peau</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Statut</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($ingredients as $ingredient)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($ingredient->image)
                                            <img src="{{ asset('storage/' . $ingredient->image) }}" 
                                                 alt="{{ $ingredient->nom }}"
                                                 class="w-12 h-12 rounded-lg object-cover border-2 border-gray-200">
                                        @else
                                            <div class="w-12 h-12 bg-gradient-to-br from-pink-100 to-purple-100 rounded-lg flex items-center justify-center">
                                                <span class="text-xl">🧪</span>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $ingredient->nom }}</p>
                                            @if($ingredient->nom_scientifique)
                                                <p class="text-xs text-gray-500 italic">{{ $ingredient->nom_scientifique }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($ingredient->type)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-700">
                                            {{ $ingredient->type }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">
                                        @php
                                            // Décoder le JSON si c'est une chaîne
                                            $typesPeau = is_string($ingredient->types_peau) 
                                                ? json_decode($ingredient->types_peau, true) 
                                                : $ingredient->types_peau;
                                            $typesPeau = is_array($typesPeau) ? $typesPeau : [];
                                        @endphp
                                        
                                        @if(count($typesPeau) > 0)
                                            {{ implode(', ', array_slice($typesPeau, 0, 2)) }}
                                            @if(count($typesPeau) > 2)
                                                <span class="text-pink-600">+{{ count($typesPeau) - 2 }}</span>
                                            @endif
                                        @else
                                            <span class="text-gray-400">Non spécifié</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($ingredient->actif)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            ✓ Actif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                            ✗ Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.ingredients.edit', $ingredient->id) }}" 
                                           class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-sm font-medium">
                                            ✏️ Modifier
                                        </a>
                                        <form action="{{ route('admin.ingredients.destroy', $ingredient->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet ingrédient ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
                                                🗑️ Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $ingredients->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center text-gray-500">
                <div class="text-6xl mb-4">🧪</div>
                <p class="text-lg font-medium mb-2">Aucun ingrédient pour le moment</p>
                <p class="text-sm text-gray-400 mb-4">Commencez à construire votre base de données d'ingrédients</p>
                <a href="{{ route('admin.ingredients.create') }}" 
                   class="inline-flex items-center gap-2 text-pink-600 hover:text-pink-700 font-semibold">
                    Créer votre premier ingrédient →
                </a>
            </div>
        @endif
    </div>

</div>

@endsection