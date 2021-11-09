<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Banccord | (Nom du client) - informations</title>
  <?php include("class/head.inc.php"); ?>
</head>

<body>
  <header>
    <div class="header-disconnect"><p>
      Se déconnecter
    </p></div>
  </header>

  <div class="container">
    <div class="row">
      <!-- Les différents titres -->
      <div class="col titles">
        <h1>Compte de <b>Muchel Pabo</b></h1>
        <p>Siren : 749 547 487 47239</p>
        <h2>Montant totale : 5€</h2>
      </div>
      <!-- Le graphique -->
      <div class="col-auto" style="background-color:aqua;">
        Schema goes brrrrr here.
      </div>
    </div>

    <!-- Champ de recherche -->
    <div class="row justify-content-md-center">
			<div class="col-md-6">
        <div class="row action-option">
          <div class="col col-offset-4">
            <input type="number" class="form-control" id="search-siren" name="search-siren" placeholder="Rechercher par un numéro de Siren">
          </div>
          <div class="col-auto">
            <button class="btn btn-primary">Exporter au format...</button>
          </div>
        </div>
      </div>
    </div>

    <div class="alert alert-primary centered" role="alert">
      Résultat 1-3 / 97 au total.
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Date de payement</th>
          <th scope="col">Siren</th>
          <th scope="col">Type de carte</th>
          <th scope="col">Numéro de carte</th>
          <th scope="col">Code d'autorisation</th>
          <th scope="col">Montant</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td scope="row">03/01/2021</th>
          <td>489 025 603 68250</td>
          <td>Issou</td>
          <td>6942 6942 6942 6942</td>
          <td>48</td>
          <td>1.00€</td>
        </tr>
        <tr>
          <td scope="row">02/01/2021</th>
          <td>489 025 603 68250</td>
          <td>Issou</td>
          <td>6942 6942 6942 6942</td>
          <td>29</td>
          <td>1.00€</td>
        </tr>
        <tr>
          <td scope="row">01/01/2021</th>
          <td>489 025 603 68250</td>
          <td>Issou</td>
          <td>6942 6942 6942 6942</td>
          <td>35</td>
          <td>1.00€</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>