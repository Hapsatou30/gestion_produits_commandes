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
                      <a class="nav-link active" aria-current="page" href="/profil">Accueil</a>
                  </li>
                  
                  <li class="nav-item">
                      <a class="nav-link" href="#">Boutique</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/mesCommandes">Commande</a>
                </li>
                  <li class="nav-item">
                        <a class="nav-link" href="/deconnexionClient">{{session('status')}}Deconnexion</a>
                </li><li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-danger">{{ count(session('panier', [])) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" >
                        @if(session('panier'))
                            @foreach(session('panier') as $item)
                                <li class="dropdown-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <img src="{{ $item['image'] }}" alt="{{ $item['designation'] }}" style="width: 50px; height: 50px;">
                                        <span style=" color: #007F01">{{ $item['designation'] }}</span>
                                    </div>
                                    <span style=" color: #007F01">{{ $item['quantity'] }} x {{ $item['prix_unitaire'] }}CFA</span>
                                </li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li class="dropdown-item text-end">
                                <a href="/voirPanier" class="btn btn-custom">Voir Panier</a>
                            </li>
                        @else
                            <li class="dropdown-item text-center">Votre panier est vide</li>
                        @endif
                    </ul>
                </li>
              </ul>
          </div>
      </div>
  </nav>
  </header>
  

  <div class="container mt-5">
    <h2>Détails de la Commande: {{ $commande->reference }}</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Désignation</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commande->produits as $produit)
                    <tr>
                        <td><img src="{{ $produit->image }}" alt="{{ $produit->designation }}" style="width: 100px; height: 100px;"></td>
                        <td>{{ $produit->designation }}</td>
                        <td>{{ $produit->pivot->prix_unitaire }} CFA</td>
                        <td>{{ $produit->pivot->quantite }}</td>
                        <td>{{ $produit->pivot->prix_unitaire * $produit->pivot->quantite }} CFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        <a href="{{ route('mesCommandes') }}" class="btn btn-primary">Retour à mes commandes</a>
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
