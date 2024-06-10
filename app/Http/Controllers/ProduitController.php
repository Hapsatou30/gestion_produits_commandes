<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Client;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    // Affiche la liste des produits avec des informations supplémentaires
    public function listeProduits()
    {
        // Récupère les produits avec leurs catégories et pagine les résultats
        $produits = Produit::with('categorie')->paginate(5);
        // Compte le nombre total de produits, de commandes, de catégories et de clients
        $totalProduits = Produit::count();
        $totalCommandes = Commande::count();
        $totalCategories = Categorie::count();
        $totalClients = Client::count();
        // Retourne la vue avec les données
        return view('personnels/espacePerso', compact('produits','totalProduits', 'totalCommandes' , 'totalCategories', 'totalClients'));
    }
   
    // Affiche les détails d'un produit spécifique
    public function detailsProduit($id)
    {
        // Récupère le produit par son ID et le passe à la vue
        $produit = Produit::find($id);
        return view('welcome', compact('produit'));
    }

    // Affiche le formulaire d'ajout d'un produit avec les catégories disponibles
    public function ajoutProduit()
    {
        $categories = Categorie::all();
        return view('produits/ajout', compact('categories'));
    }

    // Sauvegarde les données d'un nouveau produit
    public function sauvegardeProduit(Request $request)
    {
        // Valide les données de la requête
        $request->validate([
            'reference' => 'required',
            'designation' => 'required',
            'prix_unitaire' => 'required|numeric|min:0',
            'image' => 'required|url',
            'etat' => 'required|in:disponible,en_rupture,en_stock',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        // Crée un nouveau produit avec les données validées
        Produit::create($request->all());
        // Redirige vers l'espace personnel
        return redirect('/espacePerso');
    }

    // Affiche le formulaire de modification d'un produit avec les catégories disponibles
    public function modificationProduit($id)
    {
        $produit = Produit::find($id);
        $categories = Categorie::all();
        return view('produits/modification', compact('produit','categories'));
    }

    // Sauvegarde les modifications d'un produit
    public function sauvegardeModification(Request $request)
    {
        // Récupère le produit à modifier par son ID et met à jour ses données avec les nouvelles
        $produit = Produit::find($request->id);
        $produit->update($request->all());
        // Redirige vers l'espace personnel
        return redirect('/espacePerso');
    }

    // Supprime un produit
    public function supprimeProduit($id)
    {
        // Trouve le produit par son ID et le supprime
        $produit = Produit::find($id);
        $produit->delete();
        // Redirige vers la page précédente
        return back();
    }

    // Affiche les produits d'une catégorie spécifique (pour les clients)
    public function produitsParCategorie(Categorie $categorie)
    {
        // Récupère les produits associés à cette catégorie
        $produits = Produit::where('categorie_id', $categorie->id)->get();
        // Retourne la vue avec les données des produits de la catégorie
        return view('produits.produitCategorie', compact('produits', 'categorie'));
    }

    // Affiche les produits d'une catégorie spécifique (pour les clients)
    public function produitsParCategories(Categorie $categorie)
    {
        // Récupère les produits associés à cette catégorie
        $produits = Produit::where('categorie_id', $categorie->id)->get();
        // Retourne la vue avec les données des produits de la catégorie
        return view('clients.produitCategorie', compact('produits', 'categorie'));
    }

    // Affiche la liste des produits pour la page d'accueil
    public function listeAccueil()
    {
        // Récupère les 9 premiers produits avec leurs catégories
        $produits = Produit::with('categorie')->take(9)->get();
        $categories = Categorie::all();
        // Retourne la vue avec les données des produits et des catégories
        return view('welcome', compact('produits', 'categories'));
    }

    // Affiche les produits d'une catégorie spécifique pour la page d'accueil (pour les clients)
    public function produitCategorie()
    {
        // Récupère les 9 premiers produits avec leurs catégories
        $produits = Produit::with('categorie')->take(9)->get();
        $categories = Categorie::all();
        // Retourne la vue avec les données des produits et des catégories
        return view('clients/profil', compact('produits', 'categories'));
    }

    // Affiche tous les produits pour la boutique
    public function boutique()
    {
        // Récupère tous les produits avec leurs catégories et pagine les résultats
        $produits = Produit::with('categorie')->paginate(12);
        $categories = Categorie::all();
        // Retourne la vue avec les données des produits et des catégories
        return view('/boutique', compact('produits', 'categories'));
    }

    // Affiche tous les produits pour la boutique (pour les clients)
    public function shop()
    {
        // Récupère tous les produits avec leurs catégories et pagine les résultats
        $produits = Produit::with('categorie')->paginate(12);
        $categories = Categorie::all();
        // Retourne la vue avec les données des produits et des catégories
        return view('clients/shop', compact('produits', 'categories'));
    }
}
