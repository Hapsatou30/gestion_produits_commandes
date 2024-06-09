<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    <h1>Votre Panier</h1>
    @foreach ($produits as $produit)
    <li>
        <strong>Nom:</strong> {{ $produit->designation}}, 
        <strong>Prix Unitaire:</strong> {{ $produit->prix_unitaire  }}
    </li>
@endforeach
</body>
</html>
