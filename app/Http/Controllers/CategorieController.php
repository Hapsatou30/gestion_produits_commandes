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
    public function ajoutCategorie()
    {
        return view('categories/liste');
    }
    public function sauvegardeCategorie(Request $request)
    {
        Categorie::create($request->all());
        return back();
    }
    public function supprimerCategorie($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();
        return back();
    }
}
