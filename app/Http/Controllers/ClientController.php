<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
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
         // Récupérer toutes les données de la requête
         $data = $request->all();
         // Hacher le mot de passe avant de le sauvegarder
         $data['mot_de_passe'] = bcrypt($request->input('mot_de_passe'));
         // Créer un nouveau client avec les données validées
         client::create($data);
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
    }
    public function traitementConnexion(Request $request)
    {
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
                // Rediriger avec un message d'erreur pour mot de passe incorrect
                return back()->with('status', 'Mot de passe incorrect.');
            }
        } else {
            // Rediriger avec un message d'erreur pour email non trouvé
            return back()->with('status', 'Désolé, vous n\'avez pas de compte avec cet email.');
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
}
