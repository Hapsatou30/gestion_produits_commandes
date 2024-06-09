<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class PanierController extends Controller
{
  

public function afficherPanier()
{
    // Récupérer les identifiants de produit depuis la session
    $produitsIds = session('panier', []);

    // Récupérer les détails de chaque produit à partir de la base de données
    $produits = Produit::whereIn('id', $produitsIds)->get();

    // Retourner la vue du panier avec les détails des produits
    return view('paniers.panier', compact('produits'));
}

public function ajoutPanier(Request $request, $produitId)
{
    // Ajouter le produit au panier
    $panier = session('panier', []);
    $panier[] = $produitId;
    session(['panier' => $panier]);
    // Rediriger vers la page du panier
    return redirect('/')->with('success', 'Produit ajouté au panier.');
}
public function supprimerDuPanier($produitId)
{
    // Supprimer le produit du panier
    $panier = session()->pull('panier', []);
    $panier = array_diff($panier, [$produitId]);
    
    // Mettre à jour la session avec le nouveau panier
    session(['panier' => $panier]);

    // Rediriger vers la page du panier
    return redirect('/panier')->with('success', 'Produit supprimé du panier.');
}

}
