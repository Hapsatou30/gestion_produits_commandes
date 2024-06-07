<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function listeCategories()
    {
        $categories = Categorie::all();
        return view('categories/liste', compact('categories'));
    }
}
