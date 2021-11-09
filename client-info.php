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

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>