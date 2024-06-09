<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class CommandeController extends Controller
{
    public function listeCommande()
    {
        $commandes = Commande::with('client')->get();
        return view('personnels/espacePerso', compact('commandes'));
    }
    public function ajoutCommande()
    {
        return view('commandes/ajout');
    }
    public function sauveardeCommande(Request $request)
    {
        Commande::create($request->all());
        return redirect('listeCommande');
    }
}
