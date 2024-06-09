<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Votre Panier</h1>
    @foreach ($produits as $produit)
    <li>
        <strong>Nom:</strong> {{ $produit->designation }}, 
        <strong>Prix Unitaire:</strong> {{ $produit->prix_unitaire  }}
         <!-- Boutons pour augmenter et diminuer la quantité -->
         <form action="/panier/{{$produit->id}}" method="post" style="display: inline;">
            @csrf
            <input type="number" name="quantite" value="{{ $produit->pivot ? $produit->pivot->quantite : 1 }}" min="1">
            <button type="submit">Mettre à jour</button>
        </form>
        <form action="/supprimerDuPanier/{{$produit->id}}" method="post" style="display: inline;">
            @csrf
            <button type="submit">Supprimer</button>
        </form>
    </li>
@endforeach

<form action="/viderPanier" method="post">
    @csrf
    <button type="submit">Vider le panier</button>
</form>
</body>
</html>
