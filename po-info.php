<?php include("class/header.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Remises</title>
	<?php include("class/head.inc.php") ?>
</head>
<body>
	<?php
		echoHeader(
			"Impayés", "po-unpaid.php"
		);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Liste des comptes</b></h1>
			</div>
		</div>

		<div class="row justify-content-md-center">
			<div class="col-md-6">
				<div class="row action-option">
					<!-- Champ de recherche -->
					<div class="col col-offset-4">
						<form action="client-info.php">
							<input type="number" class="form-control" id="search-siren" name="search-siren" placeholder="Rechercher un numéro de Siren">
						</form>
					</div>
				</div>
			</div>
		</div>

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
					<th scope="col">Siren</th>
					<th scope="col">Nom du compte</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">489 025 603 68250</td>
					<td>Ikea</td>
				</tr>
				<tr>
					<th scope="row">489 025 603 68250</td>
					<td>KFC</td>
				</tr>
				<tr>
					<th scope="row">489 025 603 68250</td>
					<td>Muchel</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>