@extends('admin.layout')

@section('title', 'Catégories')

@section('content')

<div class="max-w-6xl mx-auto">
    
    {{-- Header --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent">
                    📂 Gestion des catégories
                </h1>
                <p class="text-gray-600 mt-1">Organisez vos articles par catégorie</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" 
               class="bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-pink-600 hover:to-purple-600 transition-all transform hover:scale-[1.02] shadow-lg">
                ➕ Nouvelle catégorie
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

    {{-- Liste des catégories --}}
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-pink-50 to-purple-50 border-b-2 border-pink-100">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nom</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Description</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Articles</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($categories as $categorie)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <span class="font-semibold text-gray-900">{{ $categorie->nom }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 text-sm">
                            {{ Str::limit($categorie->description, 50) ?? 'Aucune description' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $categorie->articles_count }} article(s)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $categorie->id) }}" 
                                   class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-sm font-medium">
                                    ✏️ Modifier
                                </a>
                                <form action="{{ route('admin.categories.destroy', $categorie->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
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
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="text-6xl mb-4">📂</div>
                            <p class="text-lg font-medium">Aucune catégorie pour le moment</p>
                            <a href="{{ route('admin.categories.create') }}" 
                               class="inline-block mt-4 text-pink-600 hover:text-pink-700 font-semibold">
                                Créer votre première catégorie →
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection