
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace personnel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/espace.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="{{asset('images/logo1.png')}}" alt="Logo">
             <h2>Bonjour {{session('personnel')->prenom}} </h2> 
        </div>
        <nav>
            <ul>
                <li>
                    <a href="/espacePerso">
                        <div class="icon-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="white" d="M12 9.5q-.425 0-.712-.288T11 8.5t.288-.712T12 7.5t.713.288T13 8.5t-.288.713T12 9.5M11 6V1h2v5zM7 22q-.825 0-1.412-.587T5 20t.588-1.412T7 18t1.413.588T9 20t-.587 1.413T7 22m10 0q-.825 0-1.412-.587T15 20t.588-1.412T17 18t1.413.588T19 20t-.587 1.413T17 22M1 4V2h3.275l4.25 9h7l3.9-7H21.7l-4.4 7.95q-.275.5-.737.775T15.55 13H8.1L7 15h12v2H7q-1.125 0-1.713-.975T5.25 14.05L6.6 11.6L3 4z"/></svg>
                            <span>Produits</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/ajoutBien">
                        <div class="icon-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="white" stroke-width="2"><rect width="14" height="17" x="5" y="4" rx="2"/><path stroke-linecap="round" d="M9 9h6m-6 4h6m-6 4h4"/></g></svg>
                            <span>Commandes</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/categories">
                        <div class="icon-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="white" d="M6.5 11L12 2l5.5 9zm11 11q-1.875 0-3.187-1.312T13 17.5t1.313-3.187T17.5 13t3.188 1.313T22 17.5t-1.312 3.188T17.5 22M3 21.5v-8h8v8zM17.5 20q1.05 0 1.775-.725T20 17.5t-.725-1.775T17.5 15t-1.775.725T15 17.5t.725 1.775T17.5 20M5 19.5h4v-4H5zM10.05 9h3.9L12 5.85zm7.45 8.5"/></svg>
                            <span>Categories</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/deconnexion">
                        <div class="icon-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="white" d="m17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5M4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4z"/></svg>
                            <span>Deconnexion</span>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    <a href="/deconnexion">{{session('status')}}</a>
                                </div>
                            @endif
                        </div>

                    </a>
                </li>
            </ul>
            
        </nav>
    </div>
    <div  class="main-content">
        <div class="container">
            <a href="/ajoutProduit" class="btn btn-custom">Ajouter</a>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Image</th>
                  <th scope="col">Désignation</th>
                  <th scope="col">Prix unitaire</th>
                  <th scope="col">Etat</th>
                  <th scope="col">Catégorie</th>
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
                    @if($produit->etat == 'disponible')
                      <span class="badge " style="background: #007F01">Disponible</span>
                    @elseif($produit->etat == 'en_rupture')
                      <span class="badge bg-danger">En rupture</span>
                    @else
                      <span class="badge bg-warning">En stock</span>
                    @endif
                  </td>
                  <td>{{ $produit->categorie->libelle }}</td>
                  <td>
                    <a href="/modificationProduit/{{ $produit->id }}" class="btn btn-lg" style="color: #007F01"><i class="fas fa-edit"></i></a>
                    <a href="/detailsProduit/{{ $produit->id }}" class="btn  btn-lg" style="color: #007F01"><i class="fas fa-eye"></i></a>
                    <a href="/supprimeProduit/{{ $produit->id }}" class="btn  btn-lg" style="color: red" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')"><i class="fas fa-trash-alt"></i></a>
                  </td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
            
           </div>
    </div>
</body>
</html>
