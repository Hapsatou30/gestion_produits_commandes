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
    public function detailsProduit($id)
    {
        $produit = Produit::find($id);
        return view('produits/detail', compact('produit'));
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
    public function modificationProduit($id)
    {
        $produit = Produit::find($id);
        $categories = Categorie::all();
        return view('produits/modification', compact('produit','categories'));
    }
    public function sauvegardeModification(Request $request)
    {
        $produit = Produit::find($request->id);
        $produit->update($request->all());
        return redirect('produits');
    }
    public function supprimeProduit($id)
    {
        $produit=  Produit::find($id);
        $produit->delete();
        return back();
    }
}
