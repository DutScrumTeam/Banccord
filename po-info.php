<?php include("class/page-builder.inc.php"); ?>
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
			"Remises", "po-payment.php"
		);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Liste des comptes</h1>
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
					"Siren",
					"Raison sociale",
					"Nombre de transaction",
					"Impayés total",
					"Trésorerie");
			?>

			<tbody id="table-result">
				<?php
					// A changer, sert juste a tester la gestion de plein de lignes.
					for ($i=0; $i < 50; $i++) { 
						echo '
							<tr>
								<th scope="row">000 000 000 000'.$i.'</th>
								<td>Nom de société here</td>
								<td>798</td>
								<td>9999€</td>
								<td>5000€</td>
							</tr>
						';
					}
				?>
				<tr>
					<th scope="row">489 025 603 68250</th>
					<td>Ikea</td>
					<td>798</td>
					<td>69342€</td>
					<td>5000€</td>
				</tr>
				<tr>
					<th scope="row">789 567 343 68250</th>
					<td>Muchel Pabo</td>
					<td>97</td>
					<td>1€</td>
					<td>10€</td>
				</tr>
				<tr>
					<th scope="row">489 025 603 68250</th>
					<td>KFC</td>
					<td>798</td>
					<td>69342€</td>
					<td>5000€</td>
				</tr>
			</tbody>
		</table>
		
		<!-- Choix de la page des résultats -->
		<?php echoPageChoice() ?>

		<script>initPageManager()</script>

	</div>
</body>
</html>