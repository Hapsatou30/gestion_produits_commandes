<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\CommandeProduit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class PanierController extends Controller
{
    public function ajoutPanier(Request $request)
    {
        $produitId = $request->input('produit_id');
        $produit = Produit::find($produitId);

        if (!$produit) {
            return back()->with('status', 'Produit non trouvé.');
        }

        $panier = session()->get('panier', []);

        if (isset($panier[$produitId])) {
            $panier[$produitId]['quantity']++;
        } else {
            $panier[$produitId] = [
                'id' => $produit->id,
                'designation' => $produit->designation,
                'prix_unitaire' => $produit->prix_unitaire,
                'quantity' => 1,
                'image' => $produit->image,
            ];
        }

        session()->put('panier', $panier);

        return back()->with('status', 'Produit ajouté au panier.');
    }
    public function voirPanier()
{
    $panier = session()->get('panier', []);
    return view('paniers/panier', compact('panier'));
}
public function supprimerDuPanier(Request $request)
{
    $panier = session()->get('panier', []);
    $produitId = $request->input('produit_id');

    if (isset($panier[$produitId])) {
        unset($panier[$produitId]);
        session()->put('panier', $panier);
    }

    return back()->with('status', 'Produit retiré du panier.');
}

public function validerCommande()
{
    $panier = session()->get('panier', []);
    return view('commandes/recap', compact('panier'));
}

public function traiterCommande(Request $request)
{
    $panier = session()->get('panier', []);
    if (count($panier) == 0) {
        return redirect('voirPanier')->with('status', 'Votre panier est vide.');
    }

    // Calculer le montant total
    $montantTotal = array_reduce($panier, function ($carry, $item) {
        return $carry + ($item['prix_unitaire'] * $item['quantity']);
    }, 0);

    // Récupérer le client connecté
    $client = $request->session()->get('client');
    if (!$client) {
        return redirect('connexionClient')->with('status', 'Vous devez être connecté pour passer une commande.');
    }

    // Créer une nouvelle commande
    $commande = new Commande();
    $commande->reference = Str::uuid();
    $commande->etat_commande = 'en_cours';
    $commande->montant_total = $montantTotal;
    $commande->client_id = $client->id; // Associer la commande au client
    $commande->save();

    // Enregistrer chaque produit de la commande
    foreach ($panier as $item) {
        $commandeProduit = new CommandeProduit();
        $commandeProduit->commande_id = $commande->id;
        $commandeProduit->produit_id = $item['id'];
        $commandeProduit->quantite = $item['quantity'];
        $commandeProduit->save();
    }

    // Vider le panier
    session()->forget('panier');

    return redirect('/profil')->with('status', 'Votre commande a été validée avec succès.');
}
}