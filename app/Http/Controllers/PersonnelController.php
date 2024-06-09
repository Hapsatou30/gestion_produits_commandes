<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    public function ajoutPersonnel(Request $request)
    {   // Vérifier si un personnel est déjà connecté
        if ($request->session()->get('personnel')) {
            // Rediriger vers l'espace personnel avec un message
            return redirect('/espacePerso')->with('status', 'Vous devez vous déconnecter avant de vous ré-inscrire.');
        }
        // Afficher le formulaire d'inscription
        return view('personnels/inscription');
    }
       
    public function sauvegardePersonnel(Request $request)
    {
         // Récupérer toutes les données de la requête
         $data = $request->all();
         // Hacher le mot de passe avant de le sauvegarder
         $data['mot_de_passe'] = bcrypt($request->input('mot_de_passe'));
         // Créer un nouveau personnel avec les données validées
         Personnel::create($data);
         // Rediriger vers la vue de connexion
         return view('personnels/connexion');
    }
    public function connexion(Request $request)
    {   // Vérifier si un personnel est déjà connecté
        if ($request->session()->get('personnel')) {
            // Rediriger vers l'espace personnel avec un message
            return redirect('/espacePerso')->with('status', 'Vous devez vous déconnecter avant de vous reconnecter.');
        }
        // Afficher le formulaire de connexion
        return view('personnels/connexion');
    }
    public function traitementConnexion(Request $request)
    {
         // Récupérer le personnel par son adresse email
         $personnel = Personnel::where('email', $request->input('email'))->first();
         if ($personnel) {
             // Vérifier si le mot de passe est correct
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
    // Méthode pour déconnecter le personnel
    public function deconnexion(Request $request)
    {
        // Supprimer les informations du personnel de la session
        $request->session()->forget('personnel');
        // Rediriger vers la page de connexion avec un message
        return redirect('/connexion')->with('status', 'Vous venez de vous déconnecter.');
    }

}
