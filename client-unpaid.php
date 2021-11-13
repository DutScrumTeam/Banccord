<?php include("class/page-builder.inc.php"); ?>
<?php include("class/highchart-builder.inc.php"); ?>
<script src="js/page-manager.js"></script>
<script src="js/highchart.js"></script>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | (Nom du client) - impayés </title>
	<?php include("class/head.inc.php"); ?>
</head>

<body>
	<?php
		echoHeader(
			"Accueil", "client.php",
			"Remises", "client-info.php"
		);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Liste des impayés</h1>
			</div>
		</div>
		
		<div class="row">
			<!-- Graphique camembert (miam) -->
			<div class="col-6">
				<?php echoPieUnpaid(); ?>
				<script>createPieUnpaid();</script>
			</div>
			<!-- Le graphique courbe -->
			<div class="col-6">
				<p>Graphique des impayés au format<br>
				"courbe" ou "histogramme".</p>
			</div>
		</div>

		<!-- Champ de recherche -->
		<script src="js/form-edit.js"></script>
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

		<!-- Bouton d'export -->
		<?php echoExportButton(); ?>

		<!-- Tableau des remises -->
		<table class="table table-striped">
			<?php
				echoTableHead(
					"Numéro de dossier",
					"Date de vente",
					"Date de remise",
					"N° carte",
					// "Réseau", // Reseau de quoi jsp
					"Libellé",
					"Montant"
				);
			?>
			<tbody id="table-result">
				<tr>
					<th scope="row">36262</th>
					<td>03/11/2020</td>
					<td>03/02/2021</td>
					<td>7432 9579 2659 0269</td>
					<td>titulaire décédé</td>
					<td>-10€</td>
				</tr>
				<tr>
					<th scope="row">32023</th>
					<td>03/11/2020</td>
					<td>03/02/2021</td>
					<td>7432 9579 2659 0269</td>
					<td>titulaire décédé</td>
					<td>-99€</td>
				</tr>
				<tr>
					<th scope="row">64145</th>
					<td>03/11/2020</td>
					<td>03/02/2021</td>
					<td>7432 9579 2659 0269</td>
					<td>fraude à la carte</td>
					<td>-1€</td>
				</tr>
			</tbody>
		</table>

		<!-- Choix de la page des résultats -->
		<?php echoPageChoice() ?>

		<script>initPageManager()</script>

	</div>
</body>
</html>