<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;

class HomeController extends Controller
{
    public function index()
    {
        // 1️⃣ Récupérer toutes les catégories avec le nombre d'articles
        $categories = Categorie::withCount('articles')->get();

        // 2️⃣ Récupérer les derniers articles publiés (6 max)
        $articlesRecents = Article::publie()->recent()->take(6)->get();

        // 3️⃣ Passer les variables à la vue
        return view('frontend.home', compact('categories', 'articlesRecents'));
    }
}
