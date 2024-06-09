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
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Image</th>
          <th scope="col">Désignation</th>
          <th scope="col">Prix unitaire</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($produits as $produit)
        <tr>
          <td><img src="{{ $produit->image }}" alt="{{ $produit->designation }}" style="max-width: 100px;"></td>
          <td>{{ $produit->designation }}</td>
          <td>{{ $produit->prix_unitaire }}</td>
          <td>
            <a href="/modificationProduit/{{ $produit->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Modifier</a>
            <a href="/detailsProduit/{{ $produit->id }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Détails</a>
            <a href="/supprimeProduit/{{ $produit->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')"><i class="fas fa-trash-alt"></i> Supprimer</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
   </div>
</body>
</html> 

