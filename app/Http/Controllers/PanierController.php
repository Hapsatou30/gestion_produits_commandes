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
    // Ajoute un produit au panier
    public function ajoutPanier(Request $request)
    {
        // Récupère l'ID du produit depuis la requête
        $produitId = $request->input('produit_id');
        // Trouve le produit dans la base de données
        $produit = Produit::find($produitId);
    
        // Vérifie si le produit existe
        if (!$produit) {
            // Redirige avec un message d'erreur si le produit n'est pas trouvé
            return back()->with('status', 'Produit non trouvé.');
        }
    
        // Récupère le panier depuis la session, initialise un tableau vide si le panier n'existe pas encore
        $panier = session()->get('panier', []);
    
        // Vérifie si le produit est déjà dans le panier
        if (isset($panier[$produitId])) {
            // Incrémente la quantité du produit dans le panier
            $panier[$produitId]['quantity']++;
        } else {
            // Ajoute le produit au panier avec une quantité de 1
            $panier[$produitId] = [
                'id' => $produit->id,
                'designation' => $produit->designation,
                'prix_unitaire' => $produit->prix_unitaire,
                'quantity' => 1,
                'image' => $produit->image,
            ];
        }
    
        // Met à jour le panier dans la session
        session()->put('panier', $panier);
    
        // Redirige avec un message de succès
        return back()->with('status', 'Produit ajouté au panier.');
    }
    
    // Affiche le contenu du panier
    public function voirPanier()
    {
        // Récupère le panier depuis la session
        $panier = session()->get('panier', []);
        // Retourne la vue avec les données du panier
        return view('paniers/panier', compact('panier'));
    }

    // Supprime un produit du panier
    public function supprimerDuPanier(Request $request)
    {
        // Récupère le panier depuis la session
        $panier = session()->get('panier', []);
        // Récupère l'ID du produit à supprimer depuis la requête
        $produitId = $request->input('produit_id');

        // Vérifie si le produit existe dans le panier
        if (isset($panier[$produitId])) {
            // Supprime le produit du panier
            unset($panier[$produitId]);
            // Met à jour le panier dans la session
            session()->put('panier', $panier);
        }

        // Redirige avec un message de succès
        return back()->with('status', 'Produit retiré du panier.');
    }

    // Affiche le récapitulatif du panier avant de passer commande
    public function validerCommande()
    {
        // Récupère le panier depuis la session
        $panier = session()->get('panier', []);
        // Retourne la vue avec les données du panier
        return view('commandes/recap', compact('panier'));
    }

    // Traite la commande et enregistre dans la base de données
    public function traiterCommande(Request $request)
    {
        // Récupère le panier depuis la session
        $panier = session()->get('panier', []);
        // Vérifie si le panier est vide
        if (count($panier) == 0) {
            // Redirige avec un message d'erreur si le panier est vide
            return redirect('voirPanier')->with('status', 'Votre panier est vide.');
        }

        // Calculer le montant total de la commande
        $montantTotal = array_reduce($panier, function ($carry, $item) {
            return $carry + ($item['prix_unitaire'] * $item['quantity']);
        }, 0);

        // Récupère le client connecté
        $client = $request->session()->get('client');
        // Vérifie si un client est connecté
        if (!$client) {
            // Redirige vers la page de connexion avec un message d'erreur
            return redirect('connexionClient')->with('status', 'Vous devez être connecté pour passer une commande.');
        }

        // Crée une nouvelle commande dans la base de données
        $commande = new Commande();
        $commande->reference = Str::uuid(); // Génère une référence unique pour la commande
        $commande->etat_commande = 'en_cours';
        $commande->montant_total = $montantTotal;
        $commande->client_id = $client->id; // Associe la commande au client connecté
        $commande->save();

        // Enregistre chaque produit de la commande dans la base de données
        foreach ($panier as $item) {
            $commandeProduit = new CommandeProduit();
            $commandeProduit->commande_id = $commande->id;
            $commandeProduit->produit_id = $item['id'];
            $commandeProduit->quantite = $item['quantity'];
            $commandeProduit->save();
        }

        // Vide le panier dans la session après la commande
        session()->forget('panier');

        // Redirige vers le profil avec un message de succès
        return redirect('/profil')->with('status', 'Votre commande a été validée avec succès.');
    }

    // Affiche le formulaire de modification de commande
    public function edit($id)
    {
        // Récupère la commande à modifier
        $commande = Commande::findOrFail($id);
        // Retourne la vue avec les données de la commande
        return view('commandes.modification', compact('commande'));
    }

    // Met à jour les informations de la commande dans la base de données
    public function update(Request $request, $id)
    {
        // Récupère la commande à modifier
        $commande = Commande::findOrFail($id);
        // Met à jour les données de la commande
        $commande->etat_commande = $request->input('etat_commande');
        $commande->montant_total = $request->input('montant_total');
        $commande->save();

        // Redirige vers la liste des commandes avec un message de succès
        return redirect()->route('mesCommandes');
    }
}
