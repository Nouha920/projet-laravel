@extends('layouts.admin')

@section('page-title', 'Messages de contact')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">💌 Messages reçus</h2>
        <p class="text-gray-600 mt-1">{{ $contacts->total() }} message(s) au total</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Statut
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nom
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Message
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($contacts as $contact)
            <tr class="hover:bg-gray-50 transition {{ !$contact->lu ? 'bg-pink-50' : '' }}">
                <td class="px-6 py-4 whitespace-nowrap">
                    @if(!$contact->lu)
                        <span class="px-3 py-1 text-xs bg-pink-500 text-white rounded-full font-semibold flex items-center gap-1 w-fit">
                            ● Nouveau
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs bg-gray-200 text-gray-600 rounded-full flex items-center gap-1 w-fit">
                            ✓ Lu
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="font-medium text-gray-900">{{ $contact->nom }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $contact->email }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">{{ Str::limit($contact->message, 80) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <div>{{ $contact->created_at->format('d/m/Y') }}</div>
                    <div class="text-xs text-gray-400">{{ $contact->created_at->format('H:i') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.contacts.show', $contact) }}" 
                           class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded hover:bg-blue-50">
                            Voir
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Supprimer ce message ?')">
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
                    <div class="text-6xl mb-4">📭</div>
                    <p class="text-gray-500 text-lg">Aucun message reçu</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($contacts->hasPages())
<div class="mt-6">
    {{ $contacts->links() }}
</div>
@endif

<!-- Stats -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-blue-100 rounded-full p-3 mr-4">
                <span class="text-3xl">📊</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $contacts->total() }}</p>
                <p class="text-sm text-gray-600">Total messages</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-pink-100 rounded-full p-3 mr-4">
                <span class="text-3xl">🔔</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-pink-600">{{ $contacts->where('lu', false)->count() }}</p>
                <p class="text-sm text-gray-600">Non lus</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-green-100 rounded-full p-3 mr-4">
                <span class="text-3xl">✓</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-green-600">{{ $contacts->where('lu', true)->count() }}</p>
                <p class="text-sm text-gray-600">Traités</p>
            </div>
        </div>
    </div>
</div>
@endsection
