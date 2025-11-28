<!-- resources/views/frontend/home.blade.php -->
@extends('layouts.app')

@section('title', 'Skincare Guide - Prenez soin de votre peau naturellement')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-rose-pastel via-peche to-vert-mint py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6">
            🌸 Bienvenue sur Skincare Guide
        </h1>
        <p class="text-xl text-gray-700 mb-8 max-w-2xl mx-auto">
            Découvrez des conseils personnalisés, des routines adaptées et tout ce qu'il faut savoir pour une peau éclatante
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('types-peau.index') }}" class="bg-pink-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-pink-700 transition">
                Découvrir mon type de peau
            </a>
            <a href="{{ route('articles.index') }}" class="bg-white text-pink-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-50 transition border-2 border-pink-600">
                Explorer les articles
            </a>
        </div>
    </div>
</div>

<!-- Catégories Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Explorez par catégorie</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        @foreach($categories as $categorie)
        <a href="{{ route('articles.categorie', $categorie->slug) }}" 
           class="bg-white rounded-2xl p-6 text-center hover:shadow-lg transition group">
            <div class="text-4xl mb-3">
                @switch($categorie->nom)
                    @case('Acné') 🎯 @break
                    @case('Anti-âge') ✨ @break
                    @case('Hydratation') 💧 @break
                    @case('Protection solaire') ☀️ @break
                    @case('Nettoyage') 🧼 @break
                    @default 🌟
                @endswitch
            </div>
            <h3 class="font-semibold text-gray-800 group-hover:text-pink-600 transition">
                {{ $categorie->nom }}
            </h3>
            <p class="text-sm text-gray-500 mt-1">{{ $categorie->articles_count }} articles</p>
        </a>
        @endforeach
    </div>
</div>

<!-- Types de peau rapide -->
<div class="bg-gradient-to-br from-lavande to-rose-pastel py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Quel est votre type de peau ?</h2>
        <p class="text-center text-gray-700 mb-8">Découvrez des conseils adaptés à vos besoins spécifiques</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('types-peau.show', 'peau-grasse') }}" 
               class="bg-white rounded-xl p-6 text-center hover:shadow-xl transition group">
                <div class="text-5xl mb-3">💧</div>
                <h3 class="font-semibold text-gray-800 group-hover:text-pink-600">Peau grasse</h3>
            </a>
            <a href="{{ route('types-peau.show', 'peau-seche') }}" 
               class="bg-white rounded-xl p-6 text-center hover:shadow-xl transition group">
                <div class="text-5xl mb-3">🏜️</div>
                <h3 class="font-semibold text-gray-800 group-hover:text-pink-600">Peau sèche</h3>
            </a>
            <a href="{{ route('types-peau.show', 'peau-mixte') }}" 
               class="bg-white rounded-xl p-6 text-center hover:shadow-xl transition group">
                <div class="text-5xl mb-3">⚖️</div>
                <h3 class="font-semibold text-gray-800 group-hover:text-pink-600">Peau mixte</h3>
            </a>
            <a href="{{ route('types-peau.show', 'peau-sensible') }}" 
               class="bg-white rounded-xl p-6 text-center hover:shadow-xl transition group">
                <div class="text-5xl mb-3">🌺</div>
                <h3 class="font-semibold text-gray-800 group-hover:text-pink-600">Peau sensible</h3>
            </a>
        </div>
    </div>
</div>

<!-- Articles récents -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Derniers articles</h2>
        <a href="{{ route('articles.index') }}" class="text-pink-600 hover:text-pink-700 font-semibold">
            Voir tous →
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($articlesRecents as $article)
        <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition">
            @if($article->image)
            <img src="{{ Storage::url($article->image) }}" 
                 alt="{{ $article->titre }}" 
                 class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gradient-to-br from-rose-pastel to-peche flex items-center justify-center">
                <span class="text-6xl">🌸</span>
            </div>
            @endif
            <div class="p-6">
                <span class="inline-block px-3 py-1 bg-pink-100 text-pink-600 text-sm rounded-full mb-3">
                    {{ $article->categorie->nom }}
                </span>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-pink-600 transition">
                        {{ $article->titre }}
                    </a>
                </h3>
                <p class="text-gray-600 text-sm mb-4">{{ $article->extrait }}</p>
                <div class="flex items-center text-sm text-gray-500">
                    <span>📅 {{ $article->created_at->format('d/m/Y') }}</span>
                    <span class="mx-2">•</span>
                    <span>👁️ {{ $article->vues }} vues</span>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</div>

<!-- CTA Section -->
<div class="bg-pink-600 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Prêt à prendre soin de votre peau ?</h2>
        <p class="text-xl mb-8 opacity-90">
            Découvrez nos routines personnalisées et commencez votre voyage vers une peau éclatante
        </p>
        <a href="{{ route('routines.index') }}" 
           class="inline-block bg-white text-pink-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
            Voir les routines skincare
        </a>
    </div>
</div>
@endsection