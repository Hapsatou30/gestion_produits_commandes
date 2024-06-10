<?php

namespace App\Http\Controllers;

use App\Models\Categorie; // Importe le modèle Categorie
use Illuminate\Http\Request; // Importe la classe Request

class CategorieController extends Controller // Définit la classe CategorieController
{
    // Affiche la liste des catégories
    public function listeCategories() // Définit la méthode listeCategories
    {
        $categories = Categorie::all(); // Récupère toutes les catégories
        return view('categories/liste', compact('categories')); // Retourne la vue avec les catégories
    }
    
    // Affiche la liste des catégories dans le profil du client
    public function listeCategoriesProfil() // Définit la méthode listeCategoriesProfil
    {
        $categories = Categorie::all(); // Récupère toutes les catégories
        return view('clients/profil', compact('categories')); // Retourne la vue avec les catégories
    }
   
    // Affiche le formulaire d'ajout de catégorie
    public function ajoutCategorie() // Définit la méthode ajoutCategorie
    {
        return view('categories/liste'); // Retourne la vue pour l'ajout de catégorie
    }
    
    // Sauvegarde une nouvelle catégorie
    public function sauvegardeCategorie(Request $request) // Définit la méthode sauvegardeCategorie avec une requête en paramètre
    {
        Categorie::create($request->all()); // Crée une nouvelle catégorie avec les données de la requête
        return back(); // Retourne à la page précédente
    }
    
    // Affiche le formulaire de modification d'une catégorie
    public function modificationCategorie($id) // Définit la méthode modificationCategorie avec l'identifiant de la catégorie en paramètre
    {
        $categorie = Categorie::find($id); // Trouve la catégorie avec l'identifiant donné
        return view('categories/modification',compact('categorie')); // Retourne la vue pour la modification avec la catégorie trouvée
    }
    
    // Sauvegarde les modifications apportées à une catégorie
    public function sauvegardeModification(Request $request) // Définit la méthode sauvegardeModification avec une requête en paramètre
    {
        $categorie = Categorie::find($request->id); // Trouve la catégorie avec l'identifiant donné dans la requête
        $categorie->update($request->all()); // Met à jour la catégorie avec les données de la requête
        return redirect('categories'); // Redirige vers la liste des catégories
    }
     
    // Supprime une catégorie
    public function supprimerCategorie($id) // Définit la méthode supprimerCategorie avec l'identifiant de la catégorie en paramètre
    {
        $categorie = Categorie::find($id); // Trouve la catégorie avec l'identifiant donné
        $categorie->delete(); // Supprime la catégorie
        return back(); // Retourne à la page précédente
    }
}
