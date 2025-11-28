@extends('layouts.app')

@section('title', 'Tous les articles - Skincare Guide')

@section('content')
<div class="bg-gradient-to-r from-rose-pastel to-peche py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">📚 Tous nos articles</h1>
        <p class="text-gray-700">Explorez nos conseils et guides pour une peau éclatante</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Recherche et filtres -->
    <div class="mb-8 flex flex-col md:flex-row gap-4">
        <form action="{{ route('articles.index') }}" method="GET" class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Rechercher un article..." 
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent">
        </form>
    </div>

    <!-- Catégories -->
    <div class="mb-8 flex flex-wrap gap-2">
        <a href="{{ route('articles.index') }}" 
           class="px-4 py-2 rounded-full {{ !request('categorie') ? 'bg-pink-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Tous
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('articles.categorie', $cat->slug) }}" 
           class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-pink-100 hover:text-pink-600 transition">
            {{ $cat->nom }}
        </a>
        @endforeach
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $article)
        <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition">
            @if($article->image)
            <img src="{{ Storage::url($article->image) }}" 
                 alt="{{ $article->titre }}" 
                 class="w-full h-56 object-cover">
            @else
            <div class="w-full h-56 bg-gradient-to-br from-rose-pastel to-peche flex items-center justify-center">
                <span class="text-7xl">🌸</span>
            </div>
            @endif
            <div class="p-6">
                <span class="inline-block px-3 py-1 bg-pink-100 text-pink-600 text-sm rounded-full mb-3">
                    {{ $article->categorie->nom }}
                </span>
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-pink-600 transition">
                        {{ $article->titre }}
                    </a>
                </h2>
                <p class="text-gray-600 text-sm mb-4">{{ $article->extrait }}</p>
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span>{{ $article->created_at->format('d/m/Y') }}</span>
                    <span>👁️ {{ $article->vues }}</span>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-500 text-lg">Aucun article trouvé.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $articles->links() }}
    </div>
</div>
@endsection