<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Commande;

class PanierController extends Controller
{
  

    public function afficherPanier()
    {
        // Récupérer les identifiants de produit depuis la session
        $produitsIds = session('panier', []);
    
        // Récupérer les détails de chaque produit à partir de la base de données
        $produits = Produit::whereIn('id', $produitsIds)
                           ->with('commandes')
                           ->get();
    
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
public function update(Request $request, $produitId)
{
    // Récupérer la commande active du client
    $commande = Commande::where('client_id', auth()->user()->id)
                         ->where('etat_commande', 'en_cours')
                         ->first();

    // Vérifier si la commande existe
    if ($commande) {
        // Mettre à jour la quantité du produit dans la commande
        $commande->produits()->updateExistingPivot($produitId, [
            'quantite' => $request->quantite,
        ]);
    }

    // Rediriger vers la page du panier
    return redirect()->route('panier.index')->with('success', 'Quantité mise à jour avec succès.');
}
public function viderPanier()
{
    // Supprimer toutes les données du panier de la session
    session()->forget('panier');

    // Rediriger vers la page du panier vide ou toute autre page appropriée
    return redirect('/panier')->with('success', 'Le panier a été vidé.');
}


}
