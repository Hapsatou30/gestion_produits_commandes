{{-- <!DOCTYPE html>
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
      <a href="/detailsProduit/{{$produit->id}}" class="btn btn-primary btn-sm"> <i class="fas fa-eye"></i> </a>
                    <a href="/supprimeProduit/{{$produit->id}}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                        <i class="fas fa-trash-alt"></i> 
                    </a>
    </div>
  </div>
   @endforeach
   </div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Accueil</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg ">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="{{asset('images/logo1.png')}}" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">A propos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Catégories
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="banner" style="display: flex; align-items: center; justify-content: space-between; background: linear-gradient(rgba(5, 31, 5, 0.6), rgba(24, 73, 24, 0.6)),url('{{ asset('images/boutique.jpg') }}'); background-size: cover; background-position: center; height:80vh">
    <div class="banner-content">
      <div class="banner-text">
        <h1>Bienvenue chez <br> Kane & Frères</h1>
        <p>Votre boutique en ligne pour des produits alimentaires de qualité</p>
        <a href="#" class="btn btn-custom">Voir les produits</a>
      </div>
      <div class="banner-image">
        <img src="{{ asset('images/banner-img.png') }}" alt="Produit">
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
