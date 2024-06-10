<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/ajout.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h1>Ajouter un Nouveau Produit</h1>
        <form action="/sauvegardeProduit" method="post">
            @csrf
            <div class="form-group">
                <label for="reference">Référence</label>
                <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference"
                    name="reference" value="{{ old('reference') }}">
                @error('reference')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="designation">Désignation</label>
                <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation"
                    name="designation" value="{{ old('designation') }}">
                @error('designation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="prix_unitaire">Prix Unitaire</label>
                <input type="number" step="0.01" class="form-control @error('prix_unitaire') is-invalid @enderror"
                    id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire') }}">
                @error('prix_unitaire')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" value="{{ old('image') }}">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="etat">État</label>
                <select class="form-control @error('etat') is-invalid @enderror" id="etat" name="etat">
                    <option value="disponible">Disponible</option>
                    <option value="en_rupture">En rupture</option>
                    <option value="en_stock">En stock</option>
                </select>
                @error('etat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="categorie_id">Catégorie</label>
                <select class="form-control @error('categorie_id') is-invalid @enderror" id="categorie_id"
                    name="categorie_id">
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-custom">Ajouter</button>
        </form>
    </div>

</body>

</html>
