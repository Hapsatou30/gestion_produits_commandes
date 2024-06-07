<!DOCTYPE html>
<html>
<head>
    <title>Détails du Produit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Détails du Produit</h2>
        <div class="card">
            <div class="card-header">
                <h3>{{ $produit->designation }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Référence:</strong> {{ $produit->reference }}</p>
                <p><strong>Prix Unitaire:</strong> {{ $produit->prix_unitaire }} €</p>
                <p><strong>État:</strong> 
                    @if ($produit->etat == 'disponible')
                        Disponible
                    @elseif ($produit->etat == 'en_rupture')
                        En rupture
                    @else
                        En stock
                    @endif
                </p>
                <p><strong>Catégorie:</strong> {{ $produit->categorie->libelle }}</p>
                @if ($produit->image)
                    <p><strong>Image:</strong></p>
                    <img src="{{ $produit->image }}" alt="{{ $produit->designation }}" class="img-thumbnail" width="150">
                @endif
            </div>
        </div>
    </div>
</body>
</html>
