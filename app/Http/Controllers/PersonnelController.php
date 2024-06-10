<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;
use App\Models\Commande;

use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    // Affiche le formulaire d'inscription du personnel
    public function ajoutPersonnel(Request $request)
    {
        // Vérifie si un personnel est déjà connecté
        if ($request->session()->get('personnel')) {
            // Redirige vers l'espace personnel avec un message
            return redirect('/espacePerso')->with('status', 'Vous devez vous déconnecter avant de vous ré-inscrire.');
        }
        // Affiche le formulaire d'inscription
        return view('personnels/inscription');
    }
       
    // Sauvegarde les données d'un nouveau personnel
    public function sauvegardePersonnel(Request $request)
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

        // Récupérer toutes les données de la requête
        $data = $request->all();
        // Hacher le mot de passe avant de le sauvegarder
        $data['mot_de_passe'] = bcrypt($request->input('mot_de_passe'));
        // Créer un nouveau personnel avec les données validées
        Personnel::create($data);
        // Rediriger vers la vue de connexion
        return view('personnels/connexion');
    }
    
    // Affiche le formulaire de connexion du personnel
    public function connexion(Request $request)
    {
        // Vérifie si un personnel est déjà connecté
        if ($request->session()->get('personnel')) {
            // Redirige vers l'espace personnel avec un message
            return redirect('/espacePerso')->with('status', 'Vous devez vous déconnecter avant de vous reconnecter.');
        }
        // Affiche le formulaire de connexion
        return view('personnels/connexion');
    }

    // Traite la demande de connexion du personnel
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

        // Récupérer le personnel par son adresse email
        $personnel = Personnel::where('email', $request->input('email'))->first();

        if ($personnel) {
            // Vérifie si le mot de passe est correct
            if (Hash::check($request->input('mot_de_passe'), $personnel->mot_de_passe)) {
                // Mettre les informations du personnel dans la session
                $request->session()->put('personnel', $personnel);
                // Rediriger vers l'espace personnel
                return redirect('/espacePerso');
            } else {
                // Rediriger avec un message d'erreur pour mot de passe incorrect
                return back()->with('status', 'Mot de passe incorrect.');
            }
        } else {
            // Rediriger avec un message d'erreur pour email non trouvé
            return back()->with('status', 'Désolé, vous n\'avez pas de compte avec cet email.');
        }
    }
    
    // Déconnecte le personnel
    public function deconnexion(Request $request)
    {
        // Supprimer les informations du personnel de la session
        $request->session()->forget('personnel');
        // Rediriger vers la page de connexion avec un message
        return redirect('/connexion')->with('status', 'Vous venez de vous déconnecter.');
    }

    // Affiche toutes les commandes
    public function toutesLesCommandes()
    {
        // Récupérer toutes les commandes avec les produits associés
        $commandes = Commande::with('produits')->get();

        return view('commandes.lesCommandes', compact('commandes'));
    }

    // Affiche les détails d'une commande
    public function detailCommande($id)
    {
        // Récupérer les détails de la commande avec les produits associés
        $commande = Commande::with('produits')->where('id', $id)->first();

        if (!$commande) {
            // Rediriger vers la page des commandes avec un message d'erreur
            return redirect('lesCommandes')->with('status', 'Commande non trouvée.');
        }

        // Retourner la vue avec les détails de la commande
        return view('commandes/detailsCommandePerso', compact('commande'));
    }
}
