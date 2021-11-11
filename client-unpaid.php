<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Banccord | (Nom du client) - impayés </title>
  <?php include("class/head.inc.php"); ?>
</head>

<body>
<?php include("class/header.inc.php"); ?>

<div class="container">
  <div class="row">
    <div class="col-auto" style="background-color:aqua;">
      <p>Schéma camembert des impayés par libellé.<p>
      <button class="btn btn-primary div-center-h">Exporter en pdf</button>
    </div>
    <!-- Les différents titres -->
    <div class="col titles">
      <h1>Compte de <b>Muchel Pabo</b></h1>
      <p>Siren : 749 547 487 47239</p>
      <h2>Montant total : 5€</h2>
    </div>
    <!-- Le graphique -->
    <div class="col-auto" style="background-color:aqua;">
      <p>Graphique des impayés au format<br>
      "courbe" ou "histogramme".</p>
      <button class="btn btn-primary div-center-h">Exporter en pdf</button>
    </div>
  </div>

  <!-- Champs de recherche -->
  <div class="row justify-content-md-center">
    <div class="col-md-6">
      <div class="row action-option">
        <div class="col-auto">
          <select class="form-control">
            <option selected>Trier par...</option>
            <option value="date">Date</option>
            <option value="amount">Montant</option>
          </select>
        </div>
        <div class="col col-offset-4">
          <form action="client-unpaid.php">
            <input type="number" class="form-control" id="search-siren" name="search-siren" placeholder="Rechercher">
          </form>
        </div>
        <!-- Bouton d'export en fichier -->
        <div class="col-auto">
          <button class="btn btn-primary">Exporter au format...</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Choix de la page de résultat -->
  <div class="row justify-content-center">
    <button class="col-auto">Page précédente</button>
    <div class="col-auto">
      Résultat 1-3<br>
      97 résultat au total.
    </div>
    <button class="col-auto">Page suivante</button>
  </div>

  <!-- Tableau des remises -->
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Date de début</th>
        <th scope="col">Date de fin</th>
        <th scope="col">Libellé</th>
        <th scope="col">Montant</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td scope="row">03/01/2021</th>
        <td>03/02/2021</td>
        <td>titulaire décédé</td>
        <td>10€</td>
      </tr>
      <tr>
        <td scope="row">03/01/2021</th>
        <td>03/02/2021</td>
        <td>compte bloqué</td>
        <td>10€</td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>