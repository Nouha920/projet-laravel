@extends('layouts.admin')

@section('page-title', 'Créer un utilisateur')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
            ← Retour à la liste
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">👤 Créer un nouvel utilisateur</h2>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <!-- Nom -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom complet *
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email *
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                       required>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Mot de passe *
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                       required>
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Minimum 8 caractères</p>
            </div>

            <!-- Confirmation mot de passe -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmer le mot de passe *
                </label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Rôle -->
            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Rôle *
                </label>
                <select id="role" 
                        name="role" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                        required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>👤 Utilisateur</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>👑 Administrateur</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Boutons -->
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Créer l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>
@endsection