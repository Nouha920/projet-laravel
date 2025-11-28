<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<!-- Bienvenue -->
<div class="bg-gradient-to-r from-pink-500 to-purple-500 rounded-lg shadow p-8 text-white mb-8">
    <h1 class="text-3xl font-bold mb-2">🌸 Bienvenue, {{ auth()->user()->name }} !</h1>
    <p class="text-lg opacity-90">Gérez votre site Skincare Guide depuis ce tableau de bord</p>
</div>

<!-- Actions rapides -->
<div class="mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">🚀 Actions rapides</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.articles.create') }}" 
           class="bg-white hover:shadow-lg transition rounded-lg p-6 text-center shadow">
            <div class="text-5xl mb-3">📝</div>
            <h3 class="font-semibold text-gray-800">Nouvel article</h3>
            <p class="text-sm text-gray-600 mt-1">Créer un article</p>
        </a>

        <a href="{{ route('admin.ingredients.create') }}" 
           class="bg-white hover:shadow-lg transition rounded-lg p-6 text-center shadow">
            <div class="text-5xl mb-3">🍃</div>
            <h3 class="font-semibold text-gray-800">Nouvel ingrédient</h3>
            <p class="text-sm text-gray-600 mt-1">Ajouter un ingrédient</p>
        </a>

        <a href="{{ route('admin.routines.create') }}" 
           class="bg-white hover:shadow-lg transition rounded-lg p-6 text-center shadow">
            <div class="text-5xl mb-3">✨</div>
            <h3 class="font-semibold text-gray-800">Nouvelle routine</h3>
            <p class="text-sm text-gray-600 mt-1">Créer une routine</p>
        </a>

        <a href="{{ route('admin.contacts.index') }}" 
           class="bg-white hover:shadow-lg transition rounded-lg p-6 text-center shadow">
            <div class="text-5xl mb-3">💌</div>
            <h3 class="font-semibold text-gray-800">Messages</h3>
            <p class="text-sm text-gray-600 mt-1">Voir les contacts</p>
        </a>
    </div>
</div>

<!-- Menu principal -->
<div class="mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">📋 Gestion du contenu</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Articles -->
        <a href="{{ route('admin.articles.index') }}" 
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">📝 Articles</h3>
                <span class="text-3xl">→</span>
            </div>
            <p class="text-gray-600">Gérer tous vos articles de blog</p>
        </a>

        <!-- Catégories -->
        <a href="{{ route('admin.categories.index') }}" 
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">📁 Catégories</h3>
                <span class="text-3xl">→</span>
            </div>
            <p class="text-gray-600">Organiser vos catégories</p>
        </a>

        <!-- Ingrédients -->
        <a href="{{ route('admin.ingredients.index') }}" 
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">🍃 Ingrédients</h3>
                <span class="text-3xl">→</span>
            </div>
            <p class="text-gray-600">Base de données des ingrédients</p>
        </a>

        <!-- Routines -->
        <a href="{{ route('admin.routines.index') }}" 
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">✨ Routines</h3>
                <span class="text-3xl">→</span>
            </div>
            <p class="text-gray-600">Gérer les routines skincare</p>
        </a>

        <!-- Types de peau -->
        <a href="{{ route('admin.types-peau.index') }}" 
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">💧 Types de peau</h3>
                <span class="text-3xl">→</span>
            </div>
            <p class="text-gray-600">Gérer les types de peau</p>
        </a>

        <!-- Messages -->
        <a href="{{ route('admin.contacts.index') }}" 
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">💌 Messages</h3>
                <span class="text-3xl">→</span>
            </div>
            <p class="text-gray-600">Consulter les messages reçus</p>
        </a>
    </div>
</div>

<!-- Lien vers le site -->
<div class="bg-blue-500 rounded-lg shadow p-6 text-white text-center">
    <h3 class="text-xl font-bold mb-2">🌐 Voir le site public</h3>
    <p class="mb-4 opacity-90">Découvrez comment les visiteurs voient votre site</p>
    <a href="{{ route('home') }}" 
       target="_blank"
       class="inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
        Ouvrir le site →
    </a>
</div>
@endsection