<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Produits</title>
</head>
<body>
   @foreach ($produits as $produit)
   <div class="card" style="width: 18rem;">
    <img src="{{$produit->image}}" class="card-img-top" alt="{{$produit->designation}}">
    <div class="card-body">
      <h5 class="card-title">{{$produit->designation}}</h5>
      <p class="card-text">{{$produit->prix_unitaire}}</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>
   @endforeach
</body>
</html>