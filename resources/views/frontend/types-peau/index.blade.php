@extends('frontend.layout')

@section('title', 'Types de peau')

@section('content')

<div class="bg-gradient-to-br from-pink-50 via-white to-purple-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-4">
                🧴 Types de peau
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Découvrez votre type de peau et les soins adaptés à vos besoins
            </p>
        </div>

        {{-- Grille des types de peau --}}
        @if($typesPeau->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($typesPeau as $typePeau)
                    <a href="{{ route('types-peau.show', $typePeau->slug) }}" 
                       class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all transform hover:scale-105 group">
                        
                        {{-- Image --}}
                        <div class="h-56 bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center overflow-hidden">
                            @if($typePeau->image)
                                <img src="{{ asset('storage/' . $typePeau->image) }}" 
                                     alt="{{ $typePeau->nom }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <span class="text-7xl">
                                    @switch($typePeau->nom)
                                        @case('Normale')
                                            😊
                                            @break
                                        @case('Sèche')
                                            🏜️
                                            @break
                                        @case('Grasse')
                                            💧
                                            @break
                                        @case('Mixte')
                                            🌓
                                            @break
                                        @case('Sensible')
                                            🌸
                                            @break
                                        @case('Acnéique')
                                            🎯
                                            @break
                                        @default
                                            🧴
                                    @endswitch
                                </span>
                            @endif
                        </div>

                        {{-- Contenu --}}
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-pink-600 transition-colors">
                                {{ $typePeau->nom }}
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit($typePeau->description, 120) }}
                            </p>

                            <div class="flex items-center text-pink-600 font-semibold group-hover:translate-x-2 transition-transform">
                                En savoir plus →
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="text-6xl mb-4">🧴</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucun type de peau disponible</h3>
                <p class="text-gray-600">Les types de peau seront bientôt disponibles.</p>
            </div>
        @endif

    </div>
</div>

@endsection