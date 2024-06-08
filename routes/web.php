<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Models\Categorie;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProduitController::class,'listeAccueil']);
Route::get('/categorie/{categorie}', [ProduitController::class, 'produitsParCategorie'])->name('produits.par.categorie');


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
Route::get('/modificationProduit/{id}', [ProduitController::class, 'modificationProduit']);
Route::post('/modificationProduit', [ProduitController::class, 'sauvegardeModification']);
Route::get('/detailsProduit/{id}', [ProduitController::class, 'detailsProduit']);