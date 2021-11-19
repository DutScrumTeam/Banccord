<?php include("class/page-builder.inc.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Admin</title>
	<?php include("class/head.inc.php"); ?>
	<script src="js/page-manager.js"></script>
	<script src="js/form-edit.js"></script>
</head>

<body>
	<?php
		echoHeader(
			"Créer un compte", "new-account.php"
		);
	?>

	<div class="container">

		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1 class="div-center-v">Liste des remises</h1>
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

		<!-- Tableau des comptes -->
		<table class="table table-striped">
			<?php 
				echoTableHead(
					"Siren",
					"Nom de compte",
					"Suppression");
			?>
			<tbody id="table-result">
				<tr>
					<th scope="row">432 104 948 47380</th>
					<td>Muchel</td>
					<td><button class="btn btn-danger">Supprimer</button></td>
				</tr>
				<tr>
					<th scope="row">432 104 999 47381</th>
					<td>FKC</td>
					<td><button class="btn btn-danger">Supprimer</button></td>
				</tr>
			</tbody>
		</table>

		<!-- Choix de la page des résultats -->
		<?php echoPageChoice() ?>

		<script>initPageManager()</script>
	</div>

</body>
</html>