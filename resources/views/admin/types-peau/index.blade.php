<!-- resources/views/admin/types-peau/index.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Gestion des types de peau')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">💧 Liste des types de peau</h2>
        <p class="text-gray-600 mt-1">{{ $typesPeau->count() }} type(s) au total</p>
    </div>
    <a href="{{ route('admin.types-peau.create') }}" 
       class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
        <span class="text-xl">➕</span>
        Nouveau type de peau
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($typesPeau as $type)
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full flex items-center justify-center text-3xl mr-4">
                    @switch($type->nom)
                        @case('Peau grasse') 💧 @break
                        @case('Peau sèche') 🏜️ @break
                        @case('Peau mixte') ⚖️ @break
                        @case('Peau sensible') 🌺 @break
                        @default 🌟
                    @endswitch
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $type->nom }}</h3>
                    <p class="text-sm text-gray-500">{{ $type->routines_count }} routine(s)</p>
                </div>
            </div>
        </div>

        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($type->description, 100) }}</p>

        @if($type->erreurs_a_eviter)
        <div class="bg-red-50 border-l-4 border-red-400 p-3 mb-4">
            <p class="text-xs text-red-700">
                <strong>⚠️ Erreurs à éviter :</strong><br>
                {{ Str::limit($type->erreurs_a_eviter, 80) }}
            </p>
        </div>
        @endif

        <div class="flex justify-end gap-2 pt-4 border-t">
            <a href="{{ route('types-peau.show', $type->slug) }}" 
               target="_blank"
               class="text-green-600 hover:text-green-700 px-3 py-2 rounded hover:bg-green-50 text-sm font-semibold">
                🌐 Voir
            </a>
            <a href="{{ route('admin.types-peau.edit', $type) }}" 
               class="text-blue-600 hover:text-blue-700 px-3 py-2 rounded hover:bg-blue-50 text-sm font-semibold">
                ✏️ Éditer
            </a>
            <form action="{{ route('admin.types-peau.destroy', $type) }}" 
                  method="POST" 
                  class="inline"
                  onsubmit="return confirm('Supprimer ce type de peau et toutes ses routines ?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="text-red-600 hover:text-red-700 px-3 py-2 rounded hover:bg-red-50 text-sm font-semibold">
                    🗑️ Supprimer
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-2 bg-white rounded-lg shadow p-12 text-center">
        <div class="text-6xl mb-4">💧</div>
        <p class="text-gray-500 text-lg mb-4">Aucun type de peau</p>
        <a href="{{ route('admin.types-peau.create') }}" 
           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
            Créer le premier type
        </a>
    </div>
    @endforelse
</div>
@endsection
