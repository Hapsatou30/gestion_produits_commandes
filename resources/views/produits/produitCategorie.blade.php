<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Produits de la catégorie</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      @foreach ($produits as $produit)
      <div class="col-md-4">
        <div class="card mb-3">
          <img src="{{ $produit->image }}" class="card-img-top" alt="{{ $produit->designation }}">
          <div class="card-body">
            <h5 class="card-title">{{ $produit->designation }}</h5>
            <p class="card-text">Prix : {{ $produit->prix_unitaire }} €</p>
            <a href="/detailsProduit/{{ $produit->id }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <a href="/" class="btn btn-secondary mt-3">Retour à l'accueil</a>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
