<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ArticleController as FrontendArticleController;
use App\Http\Controllers\Frontend\TypePeauController;
use App\Http\Controllers\Frontend\IngredientController as FrontendIngredientController;
use App\Http\Controllers\Frontend\RoutineController as FrontendRoutineController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\TypePeauController as AdminTypePeauController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Articles
Route::get('/articles', [FrontendArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [FrontendArticleController::class, 'show'])->name('articles.show');
Route::get('/categorie/{slug}', [FrontendArticleController::class, 'categorie'])->name('articles.categorie');

// Types de peau
Route::get('/types-de-peau', [TypePeauController::class, 'index'])->name('types-peau.index');
Route::get('/types-de-peau/{slug}', [TypePeauController::class, 'show'])->name('types-peau.show');

// Routines
Route::get('/routines', [FrontendRoutineController::class, 'index'])->name('routines.index');

// Ingrédients
Route::get('/ingredients', [FrontendIngredientController::class, 'index'])->name('ingredients.index');
Route::get('/ingredients/{slug}', [FrontendIngredientController::class, 'show'])->name('ingredients.show');

// Contact
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin Routes - PROTÉGÉES
|--------------------------------------------------------------------------
*/

// ⚠️ CHANGEMENT ICI : 'is_admin' → 'admin'
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('ingredients', IngredientController::class);
    Route::resource('routines', RoutineController::class);
    Route::resource('types-peau', AdminTypePeauController::class);

    // Routes personnalisées pour ingredients
    Route::post('ingredients/{id}/toggle-actif', [IngredientController::class, 'toggleActif'])
         ->name('ingredients.toggle-actif');
    Route::get('ingredients/search', [IngredientController::class, 'search'])
         ->name('ingredients.search');

    // Contacts
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    Route::patch('contacts/{contact}/marquer-lu', [AdminContactController::class, 'marquerLu'])
         ->name('contacts.marquer-lu');
});

require __DIR__.'/auth.php';