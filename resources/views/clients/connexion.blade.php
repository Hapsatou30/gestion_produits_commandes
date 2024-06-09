<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{asset('css/connexion.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
    .form-control{
    padding: 10px;
    border-radius: 10px;
}
    .btn-custom {
    background-color: var(--couleur--secondaire);
    color: white;
    border-radius: 20px;
    padding: 10px 20px;
    margin: 20px;
    text-transform: uppercase;
    font-weight: bold;
    font-size: var(--taille--texte);
    transition: all 0.3s ease;
  }
  .btn-custom:hover {
    background-color: var(--couleur--principal);
    color: #fff;
  }
</style>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Connexion</h1>
            <form method="POST" action="/traitementConnexionClient">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" >
                </div>
                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
                </div>
                <button type="submit" class="btn btn-custom">Connexion</button>
            </form>
            <div style="font-weight: bold">
                <p style="float: left; color:white;">Vous êtes nouveau?</p>
                <a href="/inscriptionClient" style="float: right; color:white;"> S'inscrire</a>
            </div>
        </div>
    </div>
</div>
</body>

</html>