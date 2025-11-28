<!-- resources/views/frontend/contact.blade.php -->
@extends('layouts.app')

@section('title', 'Contact - Skincare Guide')

@section('content')
<div class="bg-gradient-to-r from-rose-pastel to-lavande py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">💌 Contactez-nous</h1>
        <p class="text-xl text-gray-700">Une question ? Une suggestion ? N'hésitez pas à nous écrire</p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg mb-8 animate-pulse">
        <div class="flex items-center">
            <span class="text-3xl mr-4">✅</span>
            <div>
                <h3 class="font-bold text-green-800 mb-1">Message envoyé !</h3>
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">
                    👤 Votre nom *
                </label>
                <input type="text" 
                       id="nom" 
                       name="nom" 
                       value="{{ old('nom') }}"
                       placeholder="Ex: Marie Dubois"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition @error('nom') border-red-500 @enderror"
                       required>
                @error('nom')
                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    📧 Votre email *
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="Ex: marie@exemple.com"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                       required>
                @error('email')
                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                    💬 Votre message *
                </label>
                <textarea id="message" 
                          name="message" 
                          rows="6"
                          placeholder="Écrivez votre message ici... (minimum 10 caractères)"
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition @error('message') border-red-500 @enderror"
                          required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    Minimum 10 caractères requis
                </p>
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-pink-600 to-purple-600 text-white py-4 rounded-lg font-semibold text-lg hover:from-pink-700 hover:to-purple-700 transition transform hover:scale-105 shadow-lg flex items-center justify-center gap-2">
                    <span class="text-2xl">📨</span>
                    Envoyer le message
                </button>
            </div>
        </form>
    </div>

    <!-- Info supplémentaires -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition text-center">
            <div class="text-5xl mb-3">⏱️</div>
            <h3 class="font-semibold text-gray-800 mb-2 text-lg">Réponse rapide</h3>
            <p class="text-sm text-gray-600">Nous répondons sous 24-48h ouvrées</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition text-center">
            <div class="text-5xl mb-3">🔒</div>
            <h3 class="font-semibold text-gray-800 mb-2 text-lg">Données sécurisées</h3>
            <p class="text-sm text-gray-600">Vos informations sont protégées</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition text-center">
            <div class="text-5xl mb-3">💚</div>
            <h3 class="font-semibold text-gray-800 mb-2 text-lg">À votre écoute</h3>
            <p class="text-sm text-gray-600">Nous sommes là pour vous aider</p>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="mt-16 bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">❓ Questions fréquentes</h2>
        <div class="space-y-4">
            <div class="bg-white rounded-lg p-5 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-2">📦 Proposez-vous des produits ?</h3>
                <p class="text-gray-600 text-sm">Non, nous sommes un guide informatif. Nous partageons des conseils et informations sur les soins de la peau.</p>
            </div>
            <div class="bg-white rounded-lg p-5 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-2">💡 Puis-je demander des conseils personnalisés ?</h3>
                <p class="text-gray-600 text-sm">Oui ! N'hésitez pas à nous contacter avec vos questions spécifiques sur votre routine skincare.</p>
            </div>
            <div class="bg-white rounded-lg p-5 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-2">🕐 Combien de temps pour recevoir une réponse ?</h3>
                <p class="text-gray-600 text-sm">Nous répondons généralement sous 24 à 48 heures ouvrées.</p>
            </div>
        </div>
    </div>

    <!-- Retour accueil -->
    <div class="mt-12 text-center">
        <a href="{{ route('home') }}" 
           class="inline-flex items-center text-pink-600 hover:text-pink-700 font-semibold transition">
            <span class="mr-2">←</span>
            Retour à l'accueil
        </a>
    </div>
</div>
@endsection