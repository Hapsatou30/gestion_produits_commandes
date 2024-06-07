<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function listeProduits()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits/liste', compact('produits'));

    }
}
