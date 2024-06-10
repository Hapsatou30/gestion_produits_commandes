<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\Commande;

class ClientController extends Controller
{
    // Affiche le formulaire d'inscription du client
    public function ajoutClient(Request $request)
    {
        // Vérifie si un client est déjà connecté
        if ($request->session()->get('client')) {
            // Redirige vers l'espace client avec un message
            return redirect('/profil')->with('status', 'Vous devez vous déconnecter avant de vous ré-inscrire.');
        }
        // Affiche le formulaire d'inscription
        return view('clients/inscription');
    }
       
    // Sauvegarde les données d'un nouveau client
    public function sauvegardeClient(Request $request)
    {
        // Valide les données de la requête
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients,email',
            'mot_de_passe' => 'required|min:8',
        ], [
            'nom.required' => 'Veuillez entrer votre nom.',
            'prenom.required' => 'Veuillez entrer votre prénom.',
            'email.required' => 'Veuillez entrer votre adresse email.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'mot_de_passe.required' => 'Veuillez entrer votre mot de passe.',
            'mot_de_passe.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
        ]);

        // Récupère toutes les données de la requête
        $data = $request->all();
        // Hache le mot de passe avant de le sauvegarder
        $data['mot_de_passe'] = bcrypt($request->input('mot_de_passe'));
        // Crée un nouveau client avec les données validées
        Client::create($data);
        // Redirige vers la vue de connexion
        return view('clients/connexion');
    }
    
    // Affiche le formulaire de connexion du client
    public function connexion(Request $request)
    {
        // Vérifie si un client est déjà connecté
        if ($request->session()->get('client')) {
            // Redirige vers l'espace client avec un message
            return redirect('/profil')->with('status', 'Vous devez vous déconnecter avant de vous reconnecter.');
        }
        // Affiche le formulaire de connexion
        return view('clients/connexion');
    }

    // Traite la demande de connexion du client
    public function traitementConnexion(Request $request)
    {
        // Valide les données de la requête
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ], [
            'email.required' => 'Veuillez entrer votre adresse email.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'mot_de_passe.required' => 'Veuillez entrer votre mot de passe.',
        ]);

        // Récupère le client par son adresse email
        $client = Client::where('email', $request->input('email'))->first();

        if ($client) {
            // Vérifie si le mot de passe est correct
            if (Hash::check($request->input('mot_de_passe'), $client->mot_de_passe)) {
                // Met les informations du client dans la session
                $request->session()->put('client', $client);
                // Redirige l'utilisateur vers la page d'accueil avec un message
                return redirect('/profil')->with('status', 'Connexion réussie.');
            } else {
                // Retourne à la page précédente avec un message d'erreur pour mot de passe incorrect
                return back()->withInput()->withErrors(['mot_de_passe' => 'Mot de passe incorrect.']);
            }
        } else {
            // Retourne à la page précédente avec un message d'erreur pour email non trouvé
            return back()->withInput()->withErrors(['email' => 'Désolé, vous n\'avez pas de compte avec cet email.']);
        }
    }
    
    // Déconnecte le client
    public function deconnexion(Request $request)
    {
        // Supprime les informations du client de la session
        $request->session()->forget('client');
        // Redirige vers la page de connexion avec un message
        return redirect('/')->with('status', 'Vous venez de vous déconnecter.');
    }
    
    // Affiche les commandes du client
    public function mesCommandes(Request $request)
    {
        // Récupère les informations du client depuis la session
        $client = $request->session()->get('client');
        // Vérifie si le client est connecté
        if (!$client) {
            // Redirige vers la page de connexion avec un message d'erreur
            return redirect('/connexionClient')->with('status', 'Vous devez être connecté pour voir vos commandes.');
        }

        // Récupère les commandes du client
        $commandes = Commande::where('client_id', $client->id)->get();

        // Retourne la vue avec les commandes du client
        return view('commandes.mescommandes', compact('commandes'));
    }
    
    // Affiche les détails d'une commande
    public function detailCommande($id, Request $request)
    {
        // Récupère les informations du client depuis la session
        $client = $request->session()->get('client');
        // Vérifie si le client est connecté
        if (!$client) {
            // Redirige vers la page de connexion avec un message d'erreur
            return redirect('/connexionClient')->with('status', 'Vous devez être connecté pour voir les détails de vos commandes.');
        }

        // Récupère les détails de la commande du client avec l'identifiant donné
        $commande = Commande::with('produits')->where('id', $id)->where('client_id', $client->id)->first();

        // Vérifie si la commande existe
        if (!$commande) {
            // Redirige vers la page des commandes avec un message d'erreur
            return redirect('mescommandes')->with('status', 'Commande non trouvée.');
        }

        // Retourne la vue avec les détails de la commande
        return view('commandes.detailCommande', compact('commande'));
    }
}
