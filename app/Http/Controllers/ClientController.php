<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\Commande;
class ClientController extends Controller
{
    public function ajoutClient(Request $request)
    {   // Vérifier si un client est déjà connecté
        if ($request->session()->get('client')) {
            // Rediriger vers l'espace client avec un message
            return redirect('/profil')->with('status', 'Vous devez vous déconnecter avant de vous ré-inscrire.');
        }
        // Afficher le formulaire d'inscription
        return view('clients/inscription');
    }
       
    public function sauvegardeClient(Request $request)
    {
        // Valider les données de la requête
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
    
        // Récupérer toutes les données de la requête
        $data = $request->all();
        // Hacher le mot de passe avant de le sauvegarder
        $data['mot_de_passe'] = bcrypt($request->input('mot_de_passe'));
        // Créer un nouveau client avec les données validées
        Client::create($data);
        // Rediriger vers la vue de connexion
        return view('clients/connexion');
    }
    
    public function connexion(Request $request)
    {   // Vérifier si un client est déjà connecté
        if ($request->session()->get('client')) {
            // Rediriger vers l'espace client avec un message
            return redirect('/profil')->with('status', 'Vous devez vous déconnecter avant de vous reconnecter.');
        }
        // Afficher le formulaire de connexion
        return view('clients/connexion');
    }public function traitementConnexion(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ], [
            'email.required' => 'Veuillez entrer votre adresse email.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'mot_de_passe.required' => 'Veuillez entrer votre mot de passe.',
        ]);
    
        // Récupérer le client par son adresse email
        $client = Client::where('email', $request->input('email'))->first();
    
        if ($client) {
            // Vérifier si le mot de passe est correct
            if (Hash::check($request->input('mot_de_passe'), $client->mot_de_passe)) {
                // Mettre les informations du client dans la session
                $request->session()->put('client', $client);
    
                // Rediriger l'utilisateur vers la page d'accueil avec un message
                return redirect('/profil')->with('status', 'Connexion réussie.');
            } else {
                // Retourner à la page précédente avec un message d'erreur pour mot de passe incorrect
                return back()->withInput()->withErrors(['mot_de_passe' => 'Mot de passe incorrect.']);
            }
        } else {
            // Retourner à la page précédente avec un message d'erreur pour email non trouvé
            return back()->withInput()->withErrors(['email' => 'Désolé, vous n\'avez pas de compte avec cet email.']);
        }
    }
    
    
    // Méthode pour déconnecter le client
    public function deconnexion(Request $request)
    {
        // Supprimer les informations du client de la session
        $request->session()->forget('client');
        // Rediriger vers la page de connexion avec un message
        return redirect('/')->with('status', 'Vous venez de vous déconnecter.');
    }
    public function mesCommandes(Request $request)
    {
        $client = $request->session()->get('client');
        if (!$client) {
            return redirect('/connexionClient')->with('status', 'Vous devez être connecté pour voir vos commandes.');
        }

        $commandes = Commande::where('client_id', $client->id)->get();

        return view('commandes.mescommandes', compact('commandes'));
    }
    public function detailCommande($id, Request $request)
{
    $client = $request->session()->get('client');
    if (!$client) {
        return redirect('/connexionClient')->with('status', 'Vous devez être connecté pour voir les détails de vos commandes.');
    }

    $commande = Commande::with('produits')->where('id', $id)->where('client_id', $client->id)->first();

    if (!$commande) {
        return redirect('mescommandes')->with('status', 'Commande non trouvée.');
    }

    return view('commandes.detailCommande', compact('commande'));
}

}
