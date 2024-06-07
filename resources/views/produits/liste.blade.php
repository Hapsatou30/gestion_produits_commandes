<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Liste des Produits</title>
</head>
<body>
   <div class="container">
    <a href="/ajoutProduit"><button>AJouter</button></a>
    @foreach ($produits as $produit)
   <div class="card" style="width: 18rem;">
    <img src="{{$produit->image}}" class="card-img-top" alt="{{$produit->designation}}">
    <div class="card-body">
      <h5 class="card-title">{{$produit->designation}}</h5>
      <p class="card-text">{{$produit->prix_unitaire}}</p>
      <a href="/modificationProduit/{{$produit->id}}" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> </a>
                    <a href="/supprimeProduit/{{$produit->id}}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                        <i class="fas fa-trash-alt"></i> 
                    </a>
    </div>
  </div>
   @endforeach
   </div>
</body>
</html>