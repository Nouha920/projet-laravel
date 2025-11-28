<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Gestion des utilisateurs')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">👥 Liste des utilisateurs</h2>
        <p class="text-gray-600 mt-1">{{ $users->total() }} utilisateur(s) au total</p>
    </div>
    <a href="{{ route('admin.users.create') }}" 
       class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
        <span class="text-xl">➕</span>
        Nouvel utilisateur
    </a>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-blue-100 rounded-full p-3 mr-4">
                <span class="text-3xl">👥</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
                <p class="text-sm text-gray-600">Total utilisateurs</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-purple-100 rounded-full p-3 mr-4">
                <span class="text-3xl">👑</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-purple-600">{{ $stats['admins'] }}</p>
                <p class="text-sm text-gray-600">Administrateurs</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-green-100 rounded-full p-3 mr-4">
                <span class="text-3xl">👤</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-green-600">{{ $stats['users'] }}</p>
                <p class="text-sm text-gray-600">Utilisateurs</p>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rôle</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date d'inscription</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    #{{ $user->id }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($user->role === 'admin')
                        <span class="px-3 py-1 text-xs bg-purple-100 text-purple-800 rounded-full font-semibold">
                            👑 Admin
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">
                            👤 Utilisateur
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $user->created_at->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded hover:bg-blue-50">
                            Éditer
                        </a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900 px-3 py-1 rounded hover:bg-red-50">
                                Supprimer
                            </button>
                        </form>
                        @else
                        <span class="text-gray-400 px-3 py-1">C'est vous</span>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center">
                    <div class="text-6xl mb-4">👥</div>
                    <p class="text-gray-500 text-lg">Aucun utilisateur</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($users->hasPages())
<div class="mt-6">
    {{ $users->links() }}
</div>
@endif
@endsection

