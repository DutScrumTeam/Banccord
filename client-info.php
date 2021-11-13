<?php include("class/header.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | (Nom du client) - informations</title>
	<?php include("class/head.inc.php"); ?>
</head>

<body>
	<?php
		echoHeader(
			"Accueil", "client.php",
			"Impayés", "client-unpaid.php"
		);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Liste des remises</h1>
			</div>
			
			<!-- Le graphique -->
			<div class="col-auto" style="background-color:aqua;">
				Schema goes brrrrr here.
			</div>
		</div>

		<div class="row justify-content-md-center">
			<div class="col-md-6">
				<form action="client-info.php" method="get">
					<div class="form-group row">
						<label for="date" class="col-sm-2 col-form-label">Date</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="date" name="date">
						</div>
					</div>
					<button class="btn btn-success">Rechercher</button>
				</form>
			</div>
		</div>
		<!-- Bouton d'export du fichier -->
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Dropdown button
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="#">Action</a>
				<a class="dropdown-item" href="#">Another action</a>
				<a class="dropdown-item" href="#">Something else here</a>
			</div>
		</div>
		<!-- <button type="button" class="btn">Exporter au format...</button> -->
		
		<!-- Choix de la page des résultats -->
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
					<th scope="col">Date de payement</th>
					<th scope="col">Type de carte</th>
					<th scope="col">Numéro de carte</th>
					<th scope="col">Code d'autorisation</th>
					<th scope="col">Montant</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">03/01/2021</th>
					<td>Issou</td>
					<td>6942 6942 6942 6942</td>
					<td>48</td>
					<td>1.00€</td>
				</tr>
				<tr>
					<th scope="row">02/01/2021</th>
					<td>Issou</td>
					<td>6942 6942 6942 6942</td>
					<td>29</td>
					<td>1.00€</td>
				</tr>
				<tr>
					<th scope="row">01/01/2021</th>
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