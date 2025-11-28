<!-- resources/views/admin/routines/index.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Gestion des routines')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">✨ Liste des routines</h2>
        <p class="text-gray-600 mt-1">{{ $routines->total() }} routine(s) au total</p>
    </div>
    <a href="{{ route('admin.routines.create') }}" 
       class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
        <span class="text-xl">➕</span>
        Nouvelle routine
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type de peau</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Période</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ordre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($routines as $routine)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 text-xs bg-purple-100 text-purple-600 rounded-full">
                        {{ $routine->typePeau->nom }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-900">{{ $routine->titre }}</div>
                    <div class="text-sm text-gray-500">{{ Str::limit($routine->description, 60) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($routine->periode === 'matin')
                        <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">☀️ Matin</span>
                    @elseif($routine->periode === 'soir')
                        <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-full">🌙 Soir</span>
                    @else
                        <span class="px-3 py-1 text-xs bg-green-100 text-green-800 rounded-full">📅 Hebdo</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full font-semibold">
                        {{ $routine->ordre }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $routine->created_at->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.routines.edit', $routine) }}" 
                           class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded hover:bg-blue-50">
                            Éditer
                        </a>
                        <form action="{{ route('admin.routines.destroy', $routine) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Supprimer cette routine ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900 px-3 py-1 rounded hover:bg-red-50">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center">
                    <div class="text-6xl mb-4">✨</div>
                    <p class="text-gray-500 text-lg mb-4">Aucune routine pour le moment</p>
                    <a href="{{ route('admin.routines.create') }}" 
                       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Créer la première routine
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($routines->hasPages())
<div class="mt-6">
    {{ $routines->links() }}
</div>
@endif
@endsection
