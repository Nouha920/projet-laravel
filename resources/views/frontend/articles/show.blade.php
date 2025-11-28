@extends('layouts.app')

@section('title', $article->titre . ' - Skincare Guide')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="mb-8 text-sm text-gray-600">
        <a href="{{ route('home') }}" class="hover:text-pink-600">Accueil</a>
        <span class="mx-2">/</span>
        <a href="{{ route('articles.index') }}" class="hover:text-pink-600">Articles</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800">{{ $article->titre }}</span>
    </nav>

    <!-- Article Header -->
    <article class="bg-white rounded-2xl overflow-hidden shadow-lg">
        @if($article->image)
        <img src="{{ Storage::url($article->image) }}" 
             alt="{{ $article->titre }}" 
             class="w-full h-96 object-cover">
        @endif
        
        <div class="p-8 md:p-12">
            <span class="inline-block px-4 py-2 bg-pink-100 text-pink-600 text-sm rounded-full mb-4">
                {{ $article->categorie->nom }}
            </span>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                {{ $article->titre }}
            </h1>
            
            <div class="flex items-center text-gray-600 text-sm mb-8 pb-8 border-b">
                <span>📅 {{ $article->created_at->translatedFormat('d F Y') }}</span>
                <span class="mx-3">•</span>
                <span>👁️ {{ $article->vues }} vues</span>
            </div>
            
            <!-- Contenu -->
            <div class="prose prose-lg max-w-none">
                {!! $article->contenu !!}
            </div>
            
            <!-- Ingrédients associés -->
            @if($article->ingredients->count() > 0)
            <div class="mt-12 p-6 bg-gradient-to-r from-rose-pastel to-peche rounded-xl">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">🍃 Ingrédients mentionnés</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($article->ingredients as $ingredient)
                    <a href="{{ route('ingredients.show', $ingredient->slug) }}" 
                       class="bg-white p-4 rounded-lg hover:shadow-md transition text-center">
                        <div class="font-semibold text-gray-800">{{ $ingredient->nom }}</div>
                        <div class="text-sm text-gray-600 mt-1">En savoir plus →</div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </article>
    
    <!-- Articles similaires -->
    @if($articlesSimilaires->count() > 0)
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Articles similaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($articlesSimilaires as $similaire)
            <a href="{{ route('articles.show', $similaire->slug) }}" 
               class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition">
                @if($similaire->image)
                <img src="{{ Storage::url($similaire->image) }}" 
                     alt="{{ $similaire->titre }}" 
                     class="w-full h-40 object-cover">
                @else
                <div class="w-full h-40 bg-gradient-to-br from-rose-pastel to-peche flex items-center justify-center">
                    <span class="text-5xl">🌸</span>
                </div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 hover:text-pink-600">
                        {{ $similaire->titre }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection