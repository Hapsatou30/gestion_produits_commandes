<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function listeProduits()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits/liste', compact('produits'));

    }

    public function ajoutProduit()
    {
        $categories = Categorie::all();
        return view('produits/ajout', compact('categories'));
    }
    public function sauvegardeProduit(Request $request)
    {
        Produit::create($request->all());
        return redirect('produits');
    }
    public function supprimeProduit($id)
    {
        $produit=  Produit::find($id);
        $produit->delete();
        return back();
    }
}
