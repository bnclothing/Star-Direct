<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-navbr />
    <form class="form-inline" method="POST" action="{{ route('StoreUser') }}">
        @csrf
        <div class="row mb-2">
            <div class="col">
                <label class="pr-2">Nom :</label>
                <input type="text" class="form-control" name="LastName" placeholder="Hilali">
            </div>
            <div class="col">
                <label  class="pr-2">Prénom :</label>
                <input type="text" class="form-control" placeholder="Mohamed" name="FirstName">
            </div>
            <div class="col">
                <label class="pr-2">Email :</label>
                <input type="text" class="form-control" placeholder="example@example.com" name="email">
            </div>
        </div>
    
        <div class="row mb-2">
           
            <div class="col">
                <label class="pr-2">Téléphone :</label>
                <input type="tel" class="form-control" placeholder="+212 6XXX-XXX" name="phone">
            </div>
           <div class="col">
                <label class="pr-2">Type :</label>
                <select class="form-control" name="type">
                    <option value="">Sélectionner un type</option>
                    <option value="1">Responsable</option>
                    <option value="2">Vendeur</option>
                    <option value="3">Client</option>
                    <option value="4">Fournisseur</option>
                </select>
            </div>
            <div class="row mb-6">           
                 <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
            </div>

     </div>
    
           
    </form>
    
      
    


    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
