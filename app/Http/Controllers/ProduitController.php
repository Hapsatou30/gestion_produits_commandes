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

    public function produitsAccueil()
{
    
}
    public function detailsProduit($id)
    {
        $produit = Produit::find($id);
        return view('welcome', compact('produit'));
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
//     }
    public function produitsParCategorie(Categorie $categorie)
    {
        // Récupérer les produits associés à cette catégorie en utilisant une requête directe
        $produits = Produit::where('categorie_id', $categorie->id)->get();

        // Retourner la vue avec les données des produits de la catégorie
        return view('produits.produitCategorie', compact('produits', 'categorie'));
    }
    public function listeAccueil()
    {
        $produits = Produit::with('categorie')->take(9)->get();
        $categories = Categorie::all();
        return view('welcome', compact('produits', 'categories'));
    }
    


}
