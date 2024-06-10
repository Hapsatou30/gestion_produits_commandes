<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Client;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function listeProduits()
    {
        $produits = Produit::with('categorie')->paginate(5);
        $totalProduits = Produit::count();
        $totalCommandes = Commande::count();
        $totalCategories = Categorie::count();
        $totalClients = Client::count();
        return view('personnels/espacePerso', compact('produits','totalProduits', 'totalCommandes' , 'totalCategories', 'totalClients'));
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
        $request->validate([
            'reference' => 'required',
            'designation' => 'required',
            'prix_unitaire' => 'required|numeric|min:0',
            'image' => 'required|url',
            'etat' => 'required|in:disponible,en_rupture,en_stock',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        Produit::create($request->all());
        return redirect('/espacePerso');
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
        return redirect('/espacePerso');
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
    public function produitsParCategories(Categorie $categorie)
    {
        // Récupérer les produits associés à cette catégorie en utilisant une requête directe
        $produits = Produit::where('categorie_id', $categorie->id)->get();

        // Retourner la vue avec les données des produits de la catégorie
        return view('clients.produitCategorie', compact('produits', 'categorie'));
    }
    public function listeAccueil()
    {
        $produits = Produit::with('categorie')->take(9)->get();
        $categories = Categorie::all();
        return view('welcome', compact('produits', 'categories'));
    }
    public function produitCategorie()
    {
        $produits = Produit::with('categorie')->take(9)->get();
        $categories = Categorie::all();
        return view('clients/profil', compact('produits', 'categories'));
    }
    public function boutique()
    {
        $produits = Produit::with('categorie')->paginate(12);
        $categories = Categorie::all();
        return view('/boutique', compact('produits', 'categories'));
    }
    public function shop()
    {
        $produits = Produit::with('categorie')->paginate(12);
        $categories = Categorie::all();
        return view('clients/shop', compact('produits', 'categories'));
    }

    
}
