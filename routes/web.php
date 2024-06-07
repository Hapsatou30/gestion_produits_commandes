<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Models\Categorie;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//routes catégories
Route::get('/categories', [CategorieController::class, 'listeCategories']);
Route::get('/ajoutCategorie', [CategorieController::class, 'ajoutCategorie']);
Route::post('/sauvegardeCategorie', [CategorieController::class, 'sauvegardeCategorie']);
Route::get('/supprimer/{id}', [CategorieController::class, 'supprimerCategorie']);
Route::get('/modificationCategorie/{id}', [CategorieController::class, 'modificationCategorie']);
Route::post('/modificationCategorie',[CategorieController::class, 'sauvegardeModification']);

//routes produits
Route::get('/produits', [ProduitController::class,'listeProduits']);
Route::get('/ajoutProduit', [ProduitController::class,'ajoutProduit']);
Route::post('/sauvegardeProduit', [ProduitController::class, 'sauvegardeProduit']);
Route::get('/supprimeProduit/{id}', [ProduitController::class, 'supprimeProduit']);