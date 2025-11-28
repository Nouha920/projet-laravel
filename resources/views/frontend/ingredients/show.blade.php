@extends('layouts.app')

@section('title', $ingredient->nom . ' - Skincare Guide')

@section('content')
<div class="bg-gradient-to-r from-rose-pastel to-peche py-12 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">🍃 {{ $ingredient->nom }}</h1>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto">
        {{ $ingredient->description ?? 'Pas de description disponible pour cet ingrédient.' }}
    </p>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($ingredient->articles->count() > 0)
    <h2 class="text-2xl font-bold mb-6">Articles liés à {{ $ingredient->nom }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($ingredient->articles as $article)
        <a href="{{ route('articles.show', $article->slug) }}" 
           class="bg-white rounded-xl shadow-sm hover:shadow-lg transition p-4">
            <h3 class="text-lg font-semibold text-gray-800">{{ $article->titre }}</h3>
            <p class="text-gray-600 text-sm mt-2">{{ \Illuminate\Support\Str::limit($article->resume ?? '', 80) }}</p>
        </a>
        @endforeach
    </div>
    @else
    <p class="text-gray-500 text-center">Aucun article lié pour cet ingrédient.</p>
    @endif
</div>
@endsection
