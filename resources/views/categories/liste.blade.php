<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listes des Catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <!-- Pour les icônes de Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Libelle</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
              <tr>
                <th scope="row"> {{$categorie->id}}</th>
                <td> {{$categorie->libelle}}</td>
                <td>
                    <a href="/modificationCategorie/{{$categorie->id}}" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> </a>
                    <a href="/supprimer/{{$categorie->id}}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                        <i class="fas fa-trash-alt"></i> 
                    </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <form action="/sauvegardeCategorie" method="post">
            @csrf
            <div class="mb-3">
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Nom de la categorie">
              </div>
              <button type="submit">Ajouter</button>
          </form>
       
    </div>
</body>
</html>