<?php include("class/page-builder.inc.php"); ?>
<?php include("class/highchart-builder.inc.php"); ?>
<script src="js/page-manager.js"></script>
<script src="js/highchart.js"></script>

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
				<h1 class="div-center-v">Liste des remises</h1>
			</div>
			
			<!-- Le graphique -->
			<div class="col-6">
				<?php echoPaymentChart(); ?>
				<script>createPaymentChart([1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3]);</script>
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
					"Date de paiement",
					"Type de carte",
					"Numéro de carte",
					"Code d'autorisation",
					"Montant");
			?>
			<tbody id="table-result">
				<tr>
					<th scope="row">03/03/2021</th>
					<td>Issou</td>
					<td>6942 6942 6942 6942</td>
					<td>48</td>
					<td>1.00€</td>
				</tr>
				<tr>
					<th scope="row">02/02/2021</th>
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

		<!-- Choix de la page des résultats -->
		<?php echoPageChoice() ?>

		<script>initPageManager()</script>

	</div>
</body>
</html>