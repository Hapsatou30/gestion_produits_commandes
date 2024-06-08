<!DOCTYPE html>
<html>
<head>
    <title>Modifier un Produit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/ajout.css')}}">
</head>
<body>
    <div class="container mt-5">
        <button type="button" class="btn btn-custom" onclick="window.history.back();">Retour à l'accueil</button>
        <h1>Modifier un Produit</h1>
        <form action="/modificationProduit" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $produit->id }}">
            <div class="form-group">
                <label for="reference">Référence</label>
                <input type="text" class="form-control" id="reference" name="reference" value="{{ $produit->reference }}" required>
            </div>
            <div class="form-group">
                <label for="designation">Désignation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{ $produit->designation }}" required>
            </div>
            <div class="form-group">
                <label for="prix_unitaire">Prix Unitaire</label>
                <input type="number" step="0.01" class="form-control" id="prix_unitaire" name="prix_unitaire" value="{{ $produit->prix_unitaire }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" class="form-control" id="image" name="image" value="{{ $produit->image }}">
            </div>
            <div class="form-group">
                <label for="etat">État</label>
                <select class="form-control" id="etat" name="etat" required>
                    <option value="disponible" {{ $produit->etat == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="en_rupture" {{ $produit->etat == 'en_rupture' ? 'selected' : '' }}>En rupture</option>
                    <option value="en_stock" {{ $produit->etat == 'en_stock' ? 'selected' : '' }}>En stock</option>
                </select>
            </div>
            <div class="form-group">
                <label for="categorie_id">Catégorie</label>
                <select class="form-control" id="categorie_id" name="categorie_id" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>{{ $categorie->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-custom">Modifier</button>
        </form>
    </div>
</body>
</html>
