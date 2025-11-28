@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6">Articles</h1>

<a href="{{ route('admin.articles.create') }}" class="bg-pink-600 text-white px-4 py-2 rounded">Nouvel article</a>

<table class="w-full mt-6 bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-3">Titre</th>
            <th class="p-3">Catégorie</th>
            <th class="p-3">Publié</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $a)
        <tr class="border-t">
            <td class="p-3">{{ $a->titre }}</td>
            <td class="p-3">{{ $a->categorie->nom }}</td>
            <td class="p-3">{{ $a->publie ? 'Oui' : 'Non' }}</td>
            <td class="p-3 flex gap-2">
                <a href="{{ route('admin.articles.edit', $a) }}" class="text-blue-600">Modifier</a>
                <form method="POST" action="{{ route('admin.articles.destroy', $a) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
