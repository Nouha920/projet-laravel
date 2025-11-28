<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::publie()->with('categorie')->recent();
        
        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('contenu', 'like', "%{$search}%");
            });
        }
        
        $articles = $query->paginate(12);
        $categories = Categorie::all();
        
        return view('frontend.articles.index', compact('articles', 'categories'));
    }
    
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->publie()
            ->with(['categorie', 'ingredients'])
            ->firstOrFail();
            
        $article->incrementVues();
        
        // Articles similaires
        $articlesSimilaires = Article::publie()
            ->where('categorie_id', $article->categorie_id)
            ->where('id', '!=', $article->id)
            ->limit(3)
            ->get();
        
        return view('frontend.articles.show', compact('article', 'articlesSimilaires'));
    }
    
    public function categorie($slug)
    {
        $categorie = Categorie::where('slug', $slug)->firstOrFail();
        $articles = Article::publie()
            ->where('categorie_id', $categorie->id)
            ->with('categorie')
            ->recent()
            ->paginate(12);
            
        return view('frontend.articles.categorie', compact('categorie', 'articles'));
    }
}
