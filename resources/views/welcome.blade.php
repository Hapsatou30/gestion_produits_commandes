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
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="{{asset('images/logo1.png')}}" alt="logo" class="logo-img"></a>
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
              <a class="nav-link" href="#"> Boutique</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a></li>
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

  <div class="container">
    <div class="row categorie">
      <div class="col-md-6">
        <div class="image">
          <img src="{{asset('images/categorie.jpg')}}" alt="">
        </div>
      </div>
      <div class="col-md-5" >
        <!-- Liste de catégories à droite -->
         <div class="category-list">
          <h2>Catégories</h2>
          <div id="categoryButtons" class="row" >
            @foreach ($categories as $categorie)
                <div class="col-md-6">
                    <a href="{{ route('produits.par.categorie', $categorie->id) }}" class="btn btn-custom">
                        {{ $categorie->libelle }}
                    </a>
                </div>
            @endforeach
        </div>                                        
        </div> 
      </div>
    </div>
  </div>
  <h2>Nos Produits</h2>
  
  <div class="container produits row row-cols-1 row-cols-md-3 g-4" style="margin-left: auto; margin-right:auto;">
    @foreach ($produits as $produit)
    <div class="col">
        <div class="card">
            <div class="position-relative">
                <img src="{{ $produit->image }}" class="card-img-top img-fluid" alt="{{ $produit->designation }}" style="height: 300px;border-top-right-radius: 10px; border-top-left-radius: 10px;">
                <div class="overlay"></div> <!-- Ajout de l'overlay -->
                <div class="details-icon-container">
                    <a href="/detailsProduit/{{ $produit->id }}" class="details-icon" data-bs-toggle="tooltip" title="Détails">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $produit->designation }}</h5>
                <div class="infos">
                    <p class="card-text">Prix: {{ $produit->prix_unitaire }}€</p>
                    <p class="card-text">
                        @if($produit->etat == 'disponible')
                            <span style="background: #007F01; color:white; padding:8px; border-radius: 8px;" >{{ $produit->etat }}</span>
                        @else
                            <span style="background: red;color:white; padding:8px; border-radius: 8px; ">{{ $produit->etat }}</span>
                        @endif
                    </p>
                </div>
                <button class="btn  btn-sm" data-bs-toggle="tooltip" title="Ajouter au panier" style="color: #ffb624; font-size:30px">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </div>
        </div>
    </div>
    @endforeach
  </div>  
  </div>
  <footer class="footer mt-auto py-3 ">
    <div class="container">
      <img src="{{asset('images/logo1.png')}}" alt="logo" class="logo-img">
        <p >© {{ date('Y') }} Kane & frère. Tous droits réservés.</p>
    </div>
</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
