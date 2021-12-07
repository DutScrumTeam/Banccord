<?php
if (!isset($_SESSION)) {
	session_start();
}
include("class/page-builder.inc.php");
?>
<?php
include("class/highchart-builder.inc.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Banccord | Client - informations</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/result-table.css"/>
	<link rel="stylesheet" href="css/highchart.css"/>
	<link rel="stylesheet" href="css/header.css"/>
	<link rel="stylesheet" href="css/connect.css"/>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="js/page-manager.js"></script>
	<script src="js/highchart.js"></script>
	<script src="js/export-file.js"></script>
	<script src="js/form-edit.js"></script>
</head>

<body>
	<?php
	echoHeader(
		"Client",
		"Impayés",
		"client-unpaid.php"
	);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<?php
				// echo '<h1>Compte de <b>' . $_SESSION['pseudo'] . '</b></h1>';
				?>
				<p>
					<?php
					// include "class/PdoAccess.php";
					// echo PdoAccess::getSiren($_SESSION['pseudo']);
					?>
				</p>
				<?php
				// $chiffre = PdoAccess::getTotalAmount($_SESSION['pseudo']);
				// $color = $chiffre < 0 ? "red" : "green";
				?>
				<?= '<h2>Montant total : <span style="color: <?= $color ?>;"><?= $chiffre ?>€</span></h2>' ?>
			</div>
		</div>
		<!-- Le graphique -->
		<?php echoPaymentChart(); ?>

		<!-- Champ de recherche -->
		<form action="" method="get">
			<div class="row action-option">

				<!-- Valeur de recherche -->
				<div class="col">
					<div class="form-group">
						<input type="number" class="form-control" id="search-value" name="search-value" placeholder="Entrez le numéro de remise">
					</div>
				</div>

				<!-- Bouton de confirmation -->
				<div class="col-auto">
					<button class="btn btn-primary div-center-v" onclick="search()">Rechercher</button>
				</div>
			</div>
		</form>

		<!-- Bouton d'export -->
		<?php echoExportButton("remises client"); ?>

		<!-- Tableau des remises -->
		<table class="table">
			<?php
			echoTableHead(
				"Numéro de remise",
				"Date de paiement",
				"Type de carte",
				"Numéro de carte",
				"Code d'autorisation",
				"Montant",
				"" // Colonne des boutons "plus d'infos"
			);
			?>
			<tbody id="table-result">
				<tr>
					<td>47685</td>
					<td>2021-02-01</td>
					<td>MC</td>
					<td>**** **** **** 7219</td>
					<td>213</td>
					<td>50€</td>
					<td><button class="btn btn-primary" onclick="switchDisplayMoreContent(this.parentNode.parentNode.id)">+</button></td>
				</tr>
				<tr class="table-row-more">
					<td colspan="<?= $columnCount ?>">
						<table class="table">
							<thead>
								<th>titre 1</th>
								<th>titre 2</th>
							</thead>
							<tbody>
								<td>contenu 1</td>
								<td>contenu 2</td>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>9999</td>
					<td>2021-04-02</td>
					<td>CB</td>
					<td>**** **** **** 3456</td>
					<td>200</td>
					<td>40€</td>
					<td><button class="btn btn-primary" onclick="switchDisplayMoreContent(this.parentNode.parentNode.id)">+</button></td>
				</tr>
				<tr class="table-row-more table-row-hidden">
					<td colspan="<?= $columnCount ?>">
						<table class="table">
							<thead>
								<th>aled</th>
								<th>oscur</th>
							</thead>
							<tbody>
								<td>gefdsfgqfd</td>
								<td>POYOYOOOOOFOIDFIDOIFPFJKLJSDLFKJLS</td>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>

		<!-- Choix de la page des résultats -->
		<?php echoPageChoice() ?>

		<script>
			initPageManager()
		</script>
		<script>
			// Cas par défaut
			let dateEnd = new Date();
			let dateStart = new Date();
			dateStart.setFullYear(dateEnd.getFullYear() - 1);

			// Cas avec les dates de début et de fin définis
			// let dateStart = new Date(sqlDateToJsDate("2020-06-01"));
			// let dateEnd = new Date(sqlDateToJsDate("2021-06-01"));

			createPaymentChart(lines, dateStart, dateEnd);
		</script>

	</div>
</body>

</html>