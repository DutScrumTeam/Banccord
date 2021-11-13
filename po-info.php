<?php include("class/header.php"); ?>
<script src="js/form-edit.js"></script>
<script src="js/page-manager.js"></script>

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

		<!-- Champ de recherche -->
		<form action="" method="get">
			<div class="row action-option">

				<!-- Type de recherche -->
				<div class="col-auto">
					<div class="form-group">
						<select class="form-control" name="search-mod" id="search-mod">
							<option 
									value="siren" selected 
									onclick="changeInput('search-value', 'Entrez le numéro de Siren', 'number');">
								Recherche par Siren
							</option>
							<option 
									value="name" 
									onclick="changeInput('search-value', 'Entrez la raison sociale', 'text');">
								Recherche par raison sociale
							</option>
						</select>
					</div>
				</div>

				<!-- Valeur de recherche -->
				<div class="col">
					<div class="form-group">
						<input type="number" class="form-control" id="search-value" name="search-value" placeholder="Entrez le numéro de Siren">
					</div>
				</div>

				<!-- Bouton de confirmation -->
				<div class="col-auto">
					<button class="btn btn-primary div-center-v">Rechercher</button>
				</div>
			</div>
		</form>

		<!-- Tableau des remises -->
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Siren</th>
					<th scope="col">Raison sociale</th>
					<th scope="col">Nombre de transaction</th>
					<th scope="col">Trésorerie</th>
				</tr>
			</thead>
			<tbody id="table-result">
				<?php
					for ($i=0; $i < 50; $i++) { 
						echo '
							<tr>
								<th scope="row">'.$i.'</th>
								<td>Ikea</td>
								<td>798</td>
								<td>5000€</td>
							</tr>
						';
					}
				?>
				<tr>
					<th scope="row">489 025 603 68250</th>
					<td>Ikea</td>
					<td>798</td>
					<td>5000€</td>
				</tr>
				<tr>
					<th scope="row">489 025 603 68250</th>
					<td>KFC</td>
					<td>798</td>
					<td>5000€</td>
				</tr>
				<tr>
					<th scope="row">789 567 343 68250</th>
					<td>Muchel Pabo</td>
					<td>97</td>
					<td>10€</td>
				</tr>
			</tbody>
		</table>
		
		<!-- Choix de la page des résultats -->
		<div class="row justify-content-center">
			<button type="button" class="btn btn-primary col-auto" onclick="previousPage()">Page précédente</button>
			<div class="col-auto" id="result-count">
				Résultat 1-3<br>
				97 résultat au total.
			</div>
			<button type="button" class="btn btn-primary col-auto" onclick="nextPage()">Page suivante</button>
		</div>
		<script>initPageManager()</script>

	</div>
</body>
</html>