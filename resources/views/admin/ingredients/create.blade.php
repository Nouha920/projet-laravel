@extends('admin.layout')

@section('title', 'Créer un ingrédient')

@section('content')

<div class="bg-white shadow-lg rounded-2xl p-8 max-w-4xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent mb-2">
            🧪 Créer un nouvel ingrédient
        </h1>
        <p class="text-gray-600">Ajoutez un ingrédient à votre base de données skincare</p>
    </div>

    {{-- Alerts --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
            <div class="flex items-start">
                <span class="text-red-500 text-xl mr-3">⚠️</span>
                <div>
                    <h3 class="font-semibold text-red-800 mb-2">Erreurs de validation</h3>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700 text-sm">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.ingredients.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            
            {{-- Nom de l'ingrédient --}}
            <div class="group md:col-span-2">
                <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                    🏷️ Nom de l'ingrédient
                </label>
                <input type="text" 
                       name="nom" 
                       value="{{ old('nom') }}"
                       class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300" 
                       placeholder="Ex: Acide Hyaluronique, Niacinamide, Vitamine C..."
                       required>
            </div>

            {{-- Nom scientifique --}}
            <div class="group">
                <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                    🔬 Nom scientifique (optionnel)
                </label>
                <input type="text" 
                       name="nom_scientifique" 
                       value="{{ old('nom_scientifique') }}"
                       class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300" 
                       placeholder="Ex: Hyaluronic Acid, Niacinamide...">
            </div>

            {{-- Type d'ingrédient --}}
            <div class="group">
                <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                    📋 Type d'ingrédient
                </label>
                <select name="type" 
                        class="w-full border-2 border-gray-200 rounded-xl p-3 bg-white focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 cursor-pointer">
                    <option value="">Sélectionnez un type</option>
                    <option value="Hydratant" {{ old('type') == 'Hydratant' ? 'selected' : '' }}>💧 Hydratant</option>
                    <option value="Antioxydant" {{ old('type') == 'Antioxydant' ? 'selected' : '' }}>🛡️ Antioxydant</option>
                    <option value="Exfoliant" {{ old('type') == 'Exfoliant' ? 'selected' : '' }}>✨ Exfoliant</option>
                    <option value="Anti-âge" {{ old('type') == 'Anti-âge' ? 'selected' : '' }}>⏰ Anti-âge</option>
                    <option value="Apaisant" {{ old('type') == 'Apaisant' ? 'selected' : '' }}>🌿 Apaisant</option>
                    <option value="Éclaircissant" {{ old('type') == 'Éclaircissant' ? 'selected' : '' }}>🌟 Éclaircissant</option>
                    <option value="Anti-acné" {{ old('type') == 'Anti-acné' ? 'selected' : '' }}>🎯 Anti-acné</option>
                    <option value="Autre" {{ old('type') == 'Autre' ? 'selected' : '' }}>📦 Autre</option>
                </select>
            </div>

        </div>

        {{-- Bienfaits --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                ✨ Bienfaits principaux
            </label>
            <textarea name="bienfaits" 
                      rows="4" 
                      class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 resize-y" 
                      placeholder="Décrivez les bienfaits de cet ingrédient pour la peau..."
                      required>{{ old('bienfaits') }}</textarea>
            <p class="text-sm text-gray-500 mt-2">💡 Conseil : Soyez précis et détaillé</p>
        </div>

        {{-- Utilisation recommandée --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                💡 Utilisation recommandée (optionnel)
            </label>
            <textarea name="utilisation" 
                      rows="3" 
                      class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 resize-y" 
                      placeholder="Comment et quand utiliser cet ingrédient...">{{ old('utilisation') }}</textarea>
        </div>

        {{-- Précautions --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                ⚠️ Précautions d'emploi (optionnel)
            </label>
            <textarea name="precautions" 
                      rows="3" 
                      class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 resize-y" 
                      placeholder="Contre-indications, effets secondaires possibles...">{{ old('precautions') }}</textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            
            {{-- Concentration recommandée --}}
            <div class="group">
                <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                    📊 Concentration recommandée (optionnel)
                </label>
                <input type="text" 
                       name="concentration" 
                       value="{{ old('concentration') }}"
                       class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300" 
                       placeholder="Ex: 2-5%, 10%, 0.5%...">
                <p class="text-sm text-gray-500 mt-2">Concentration efficace et sûre</p>
            </div>

            {{-- Image --}}
            <div class="group">
                <label class="block font-semibold mb-2 text-gray-700 group-focus-within:text-pink-600 transition-colors">
                    🖼️ Image de l'ingrédient (optionnel)
                </label>
                <input type="file" 
                       name="image" 
                       accept="image/*"
                       class="w-full border-2 border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all outline-none hover:border-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer">
                <p class="text-sm text-gray-500 mt-2">Format: JPG, PNG (max 2MB)</p>
            </div>

        </div>

        {{-- Types de peau --}}
        <div class="group">
            <label class="block font-semibold mb-2 text-gray-700">
                🧴 Adapté aux types de peau
            </label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <label class="flex items-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-pink-400 cursor-pointer transition-all">
                    <input type="checkbox" 
                           name="types_peau[]" 
                           value="Normale"
                           {{ is_array(old('types_peau')) && in_array('Normale', old('types_peau')) ? 'checked' : '' }}
                           class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400">
                    <span class="font-medium text-gray-700">😊 Normale</span>
                </label>
                
                <label class="flex items-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-pink-400 cursor-pointer transition-all">
                    <input type="checkbox" 
                           name="types_peau[]" 
                           value="Sèche"
                           {{ is_array(old('types_peau')) && in_array('Sèche', old('types_peau')) ? 'checked' : '' }}
                           class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400">
                    <span class="font-medium text-gray-700">🏜️ Sèche</span>
                </label>
                
                <label class="flex items-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-pink-400 cursor-pointer transition-all">
                    <input type="checkbox" 
                           name="types_peau[]" 
                           value="Grasse"
                           {{ is_array(old('types_peau')) && in_array('Grasse', old('types_peau')) ? 'checked' : '' }}
                           class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400">
                    <span class="font-medium text-gray-700">💧 Grasse</span>
                </label>
                
                <label class="flex items-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-pink-400 cursor-pointer transition-all">
                    <input type="checkbox" 
                           name="types_peau[]" 
                           value="Mixte"
                           {{ is_array(old('types_peau')) && in_array('Mixte', old('types_peau')) ? 'checked' : '' }}
                           class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400">
                    <span class="font-medium text-gray-700">🌓 Mixte</span>
                </label>
                
                <label class="flex items-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-pink-400 cursor-pointer transition-all">
                    <input type="checkbox" 
                           name="types_peau[]" 
                           value="Sensible"
                           {{ is_array(old('types_peau')) && in_array('Sensible', old('types_peau')) ? 'checked' : '' }}
                           class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400">
                    <span class="font-medium text-gray-700">🌸 Sensible</span>
                </label>
                
                <label class="flex items-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-pink-400 cursor-pointer transition-all">
                    <input type="checkbox" 
                           name="types_peau[]" 
                           value="Acnéique"
                           {{ is_array(old('types_peau')) && in_array('Acnéique', old('types_peau')) ? 'checked' : '' }}
                           class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400">
                    <span class="font-medium text-gray-700">🎯 Acnéique</span>
                </label>
                
                <label class="flex items-center gap-2 p-3 border-2 border-gray-200 rounded-xl hover:border-pink-400 cursor-pointer transition-all md:col-span-2">
                    <input type="checkbox" 
                           name="types_peau[]" 
                           value="Tous types"
                           {{ is_array(old('types_peau')) && in_array('Tous types', old('types_peau')) ? 'checked' : '' }}
                           class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400">
                    <span class="font-medium text-gray-700">✨ Tous types de peau</span>
                </label>
            </div>
        </div>

        {{-- Statut --}}
        <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-xl p-4 border-2 border-pink-100">
            <div class="flex items-center gap-3">
                <input type="checkbox" 
                       name="actif" 
                       value="1" 
                       id="actif"
                       {{ old('actif', true) ? 'checked' : '' }}
                       class="w-5 h-5 text-pink-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-pink-400 cursor-pointer">
                <label for="actif" class="font-medium text-gray-700 cursor-pointer select-none">
                    🌐 Ingrédient actif et visible
                </label>
            </div>
            <p class="text-sm text-gray-600 mt-2 ml-8">L'ingrédient sera visible dans la base de données</p>
        </div>

        {{-- Boutons --}}
        <div class="flex gap-4 pt-4 border-t-2 border-gray-100">
            <button type="submit"
                    class="flex-1 bg-gradient-to-r from-pink-500 to-purple-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-pink-600 hover:to-purple-600 transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                💾 Enregistrer l'ingrédient
            </button>
            <a href="{{ route('admin.ingredients.index') }}" 
               class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                ↩️ Annuler
            </a>
        </div>

    </form>
</div>

@endsection