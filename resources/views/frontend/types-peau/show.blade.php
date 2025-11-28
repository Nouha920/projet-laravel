@extends('frontend.layout')

@section('title', $typePeau->nom)

@section('content')

<div class="bg-gradient-to-br from-pink-50 via-white to-purple-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4">
        
        {{-- Header avec image --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            <div class="h-80 bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center overflow-hidden">
                @if($typePeau->image)
                    <img src="{{ asset('storage/' . $typePeau->image) }}" 
                         alt="{{ $typePeau->nom }}"
                         class="w-full h-full object-cover">
                @else
                    <span class="text-9xl">
                        @switch($typePeau->nom)
                            @case('Normale') 😊 @break
                            @case('Sèche') 🏜️ @break
                            @case('Grasse') 💧 @break
                            @case('Mixte') 🌓 @break
                            @case('Sensible') 🌸 @break
                            @case('Acnéique') 🎯 @break
                            @default 🧴
                        @endswitch
                    </span>
                @endif
            </div>
            
            <div class="p-8">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Peau {{ $typePeau->nom }}
                </h1>
                <p class="text-lg text-gray-700 leading-relaxed">
                    {{ $typePeau->description }}
                </p>
            </div>
        </div>

        {{-- Caractéristiques --}}
        @if($typePeau->caracteristiques)
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    ✨ Caractéristiques
                </h2>
                <div class="prose prose-pink max-w-none text-gray-700">
                    {!! nl2br(e($typePeau->caracteristiques)) !!}
                </div>
            </div>
        @endif

        {{-- Problèmes communs --}}
        @if($typePeau->problemes_communs)
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    ⚠️ Problèmes courants
                </h2>
                <div class="prose prose-pink max-w-none text-gray-700">
                    {!! nl2br(e($typePeau->problemes_communs)) !!}
                </div>
            </div>
        @endif

        {{-- Conseils --}}
        @if($typePeau->conseils)
            <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-2xl shadow-lg p-8 mb-8 border-2 border-pink-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    💡 Conseils
                </h2>
                <div class="prose prose-pink max-w-none text-gray-700">
                    {!! nl2br(e($typePeau->conseils)) !!}
                </div>
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            
            {{-- Ingrédients recommandés --}}
            @if($typePeau->ingredients_recommandes)
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        ✅ Ingrédients recommandés
                    </h2>
                    <div class="prose prose-pink max-w-none text-gray-700">
                        {!! nl2br(e($typePeau->ingredients_recommandes)) !!}
                    </div>
                </div>
            @endif

            {{-- Ingrédients à éviter --}}
            @if($typePeau->ingredients_eviter)
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        ❌ Ingrédients à éviter
                    </h2>
                    <div class="prose prose-pink max-w-none text-gray-700">
                        {!! nl2br(e($typePeau->ingredients_eviter)) !!}
                    </div>
                </div>
            @endif

        </div>

        {{-- Bouton retour --}}
        <div class="text-center">
            <a href="{{ route('types-peau.index') }}" 
               class="inline-block px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-xl hover:from-pink-600 hover:to-purple-600 transition-all transform hover:scale-105 shadow-lg font-semibold">
                ← Retour aux types de peau
            </a>
        </div>

    </div>
</div>

@endsection