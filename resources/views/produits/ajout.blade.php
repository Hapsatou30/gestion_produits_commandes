<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/ajout.css')}}">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter un Nouveau Produit</h1>
        <form action="/sauvegardeProduit" method="post" >
            @csrf
            <div class="form-group">
                <label for="reference">Référence</label>
                <input type="text" class="form-control" id="reference" name="reference" >
            </div>
            <div class="form-group">
                <label for="designation">Désignation</label>
                <input type="text" class="form-control" id="designation" name="designation">
            </div>
            <div class="form-group">
                <label for="prix_unitaire">Prix Unitaire</label>
                <input type="number" step="0.01" class="form-control" id="prix_unitaire" name="prix_unitaire" >
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="etat">État</label>
                <select class="form-control" id="etat" name="etat" >
                    <option value="disponible">Disponible</option>
                    <option value="en_rupture">En rupture</option>
                    <option value="en_stock">En stock</option>
                </select>
            </div>
            <div class="form-group">
                <label for="categorie_id">Catégorie</label>
                <select class="form-control" id="categorie_id" name="categorie_id" >
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-custom">Ajouter</button>
        </form>
    </div>
</body>
</html>
