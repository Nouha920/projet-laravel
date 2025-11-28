@extends('layouts.admin')

@section('page-title', 'Détails du message')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
        ← Retour aux messages
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 text-white p-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">💌 Message de {{ $contact->nom }}</h1>
                <p class="text-lg opacity-90 mt-2">{{ $contact->email }}</p>
            </div>
            <div class="text-right">
                @if(!$contact->lu)
                    <span class="inline-block px-4 py-2 bg-white text-pink-600 rounded-full font-semibold">
                        ● Nouveau message
                    </span>
                @else
                    <span class="inline-block px-4 py-2 bg-white bg-opacity-20 text-white rounded-full">
                        ✓ Déjà lu
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Infos -->
    <div class="p-8 border-b">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">👤 Nom</p>
                <p class="font-semibold text-gray-800">{{ $contact->nom }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">📧 Email</p>
                <p class="font-semibold text-gray-800">
                    <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:underline">
                        {{ $contact->email }}
                    </a>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">📅 Date d'envoi</p>
                <p class="font-semibold text-gray-800">
                    {{ $contact->created_at->format('d/m/Y à H:i') }}
                    <span class="text-sm text-gray-500">({{ $contact->created_at->diffForHumans() }})</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Message -->
    <div class="p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">📄 Message :</h2>
        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
            <p class="text-gray-800 whitespace-pre-wrap leading-relaxed">{{ $contact->message }}</p>
        </div>
    </div>

    <!-- Actions -->
    <div class="p-8 bg-gray-50 border-t flex justify-between items-center">
        <div>
            @if(!$contact->lu)
                <form action="{{ route('admin.contacts.marquer-lu', $contact) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        ✓ Marquer comme lu
                    </button>
                </form>
            @else
                <span class="text-green-600 font-semibold flex items-center gap-2">
                    <span class="text-2xl">✓</span>
                    Message traité
                </span>
            @endif
        </div>

        <div class="flex gap-3">
            <a href="mailto:{{ $contact->email }}" 
               class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-semibold inline-flex items-center gap-2">
                <span>📧</span>
                Répondre par email
            </a>

            <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                  method="POST"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-semibold">
                    🗑️ Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection