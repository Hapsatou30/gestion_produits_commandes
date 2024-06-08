<!DOCTYPE html>
<html>
<head>
    <title>Détails du Produit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html> 
<!-- Modal -->
 {{-- <div class="container mt-5">
        <h2>Détails du Produit</h2>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    @if ($produit->image)
                        <img src="{{ $produit->image }}" alt="{{ $produit->designation }}" class="img-fluid rounded-start">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produit->designation }}</h5>
                        <p class="card-text"><strong>Référence:</strong> {{ $produit->reference }}</p>
                        <p class="card-text"><strong>Prix Unitaire:</strong> {{ $produit->prix_unitaire }} €</p>
                        <p class="card-text"><strong>État:</strong> 
                            @if ($produit->etat == 'disponible')
                                Disponible
                            @elseif ($produit->etat == 'en_rupture')
                                En rupture
                            @else
                                En stock
                            @endif
                        </p>
                        <p class="card-text"><strong>Catégorie:</strong> {{ $produit->categorie->libelle }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>