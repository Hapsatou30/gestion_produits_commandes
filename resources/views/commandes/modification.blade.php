<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="{{ asset('images/logo1.png') }}" alt="logo"
                        class="logo-img"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " href="/profil">Accueil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/shop">Boutique</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/mesCommandes">Commande</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/deconnexionClient">{{ session('status') }}Deconnexion</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge bg-danger">{{ count(session('panier', [])) }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (session('panier'))
                                    @foreach (session('panier') as $item)
                                        <li class="dropdown-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <img src="{{ $item['image'] }}" alt="{{ $item['designation'] }}"
                                                    style="width: 50px; height: 50px;">
                                                <span style=" color: #007F01">{{ $item['designation'] }}</span>
                                            </div>
                                            <span style=" color: #007F01">{{ $item['quantity'] }} x
                                                {{ $item['prix_unitaire'] }}CFA</span>
                                        </li>
                                    @endforeach
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
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
        <h2>Modifier la Commande</h2>
        <form action="{{ route('commande.update', $commande->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="reference" class="form-label">Référence</label>
                <input type="text" class="form-control" id="reference" name="reference"
                    value="{{ $commande->reference }}" readonly>
            </div>
            <div class="mb-3">
                <label for="etat_commande" class="form-label">État</label>
                <select class="form-control" id="etat_commande" name="etat_commande">
                    <option value="en_cours" {{ $commande->etat_commande == 'en_cours' ? 'selected' : '' }}>En cours
                    </option>
                    <option value="valide" {{ $commande->etat_commande == 'valide' ? 'selected' : '' }}>Validée
                    </option>
                    <option value="annule" {{ $commande->etat_commande == 'annule' ? 'selected' : '' }}>Annulée
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="montant_total" class="form-label">Montant Total</label>
                <input type="number" class="form-control" id="montant_total" name="montant_total"
                    value="{{ $commande->montant_total }}"readonly>
            </div>
            <button type="submit" class="btn btn-custom">Enregistrer</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentLocation = window.location.pathname;
            var navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(function(link) {
                if (link.getAttribute('href') === currentLocation) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    <footer class="footer m-3 py-3 ">
        <div class="container">
            <img src="{{ asset('images/logo1.png') }}" alt="logo" class="logo-img">
            <p>© {{ date('Y') }} Kane & frère. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
