@extends('layouts.app')

@section('title', 'Contact - Skincare Guide')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Contactez-nous</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="nom" class="block font-semibold mb-1">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                   class="w-full border rounded px-3 py-2">
            @error('nom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                   class="w-full border rounded px-3 py-2">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block font-semibold mb-1">Message</label>
            <textarea name="message" id="message" rows="5" 
                      class="w-full border rounded px-3 py-2">{{ old('message') }}</textarea>
            @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-pink-600 text-white px-6 py-2 rounded font-semibold hover:bg-pink-700 transition">
            Envoyer
        </button>
    </form>
</div>
@endsection