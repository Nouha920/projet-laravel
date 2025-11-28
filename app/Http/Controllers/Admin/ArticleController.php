<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Afficher la liste des articles (page admin).
     */
    public function index()
    {
        $articles = Article::with('categorie')->orderBy('created_at','desc')->get();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Enregistrer un nouvel article.
     */
   public function store(Request $request)
{
    $request->validate([
        'titre' => 'required',
        'categorie_id' => 'required|exists:categories,id',
        'contenu' => 'required',
        'image' => 'nullable|image|mimes:png,jpg,jpeg',
    ]);

    // Upload Image
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('articles', 'public');
    }

    // Génération automatique du slug à partir du titre
    $slug = Str::slug($request->titre);

    Article::create([
        'titre'        => $request->titre,
        'slug'         => $slug,                // 🔥 OBLIGATOIRE
        'categorie_id' => $request->categorie_id,
        'contenu'      => $request->contenu,
        'image'        => $imagePath,
        'publie'       => $request->has('publie'),
    ]);

    return redirect()->route('admin.articles.index')
                     ->with('success', 'Article créé avec succès');
}

    /**
     * Formulaire d’édition.
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Categorie::all();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Mettre à jour un article.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'contenu' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $article = Article::findOrFail($id);

        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'titre' => $request->titre,
            'categorie_id' => $request->categorie_id,
            'contenu' => $request->contenu,
            'publie' => $request->has('publie') ? 1 : 0,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Supprimer un article.
     */
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé.');
    }
}
