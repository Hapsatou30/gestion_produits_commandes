<?php

use App\Http\Controllers\CategorieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/categories', [CategorieController::class, 'listeCategories']);
Route::get('/ajoutCategorie', [CategorieController::class, 'ajoutCategorie']);
Route::post('/sauvegardeCategorie', [CategorieController::class, 'sauvegardeCategorie']);