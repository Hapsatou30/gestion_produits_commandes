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
    public function modificationCategorie($id)
    {
        $categorie = Categorie::find($id);
        return view('categories/modification',compact('categorie'));
    }
    public function sauvegardeModification(Request $request)
    {
        $categorie = Categorie::find($request->id);
        $categorie->update($request->all());
        return redirect('categories');
    }
     
    public function supprimerCategorie($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();
        return back();
    }
}
