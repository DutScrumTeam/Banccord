<?php include("class/header.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Admin</title>
	<?php include("class/head.inc.php"); ?>
</head>

<body>
  <?php
		echoHeader(
			"Créer un compte", "new-account.php"
		);
	?>

<div class="container">
	<h1 class="centered">Admin</h1>

  <!-- Champ de recherche -->
  <div class="row justify-content-md-center">
    <div class="col-md-6">
      <div class="row action-option">
        <div class="col col-offset-4">
          <form action="client-unpaid.php">
            <input type="number" class="form-control" id="search-siren" name="search-siren" placeholder="Rechercher par numéro de Siret">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Choix de page de résultat -->
  <div class="row justify-content-center">
    <button class="col-auto">Page précédente</button>
    <div class="col-auto">
      Résultat 1-3<br>
      97 résultat au total.
    </div>
    <button class="col-auto">Page suivante</button>
  </div>

  <!-- Tableau des comptes -->
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Siret</th>
        <th scope="col">Nom de compte</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">432 104 948 47380</th>
        <td>Muchel</td>
        <td><button class="btn btn-danger">Supprimer</button></td>
      </tr>
      <tr>
        <th scope="row">432 104 948 47380</th>
        <td>Muchel</td>
        <td><button class="btn btn-danger">Supprimer</button></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>