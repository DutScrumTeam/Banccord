<?php
if (!isset($_SESSION)) {
	session_start();
}
include("class/page-builder.inc.php"); ?>
<?php include("class/highchart-builder.inc.php"); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Banccord | Client - informations</title>
	<?php include("class/head.inc.php"); ?>
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
				echo '<h1>Compte de <b>' . $_SESSION['pseudo'] . '</b></h1>';
				?>
				<p>
					<?php
					include "class/PdoAccess.php";
					echo PdoAccess::getSiren($_SESSION['pseudo']);
					?>
				</p>
				<?php
					$chiffre = PdoAccess::getTotalAmountTresorerie($_SESSION['pseudo']);
					$color = $chiffre < 0 ? "red" : "green";
				?>
				<h2>Montant total : <span style="color: <?=$color?>;"><?=$chiffre?>€</span></h2>
			</div>
		</div>
		<!-- Le graphique -->
		<?php echoPaymentChart(); ?>

		<!-- Champ de recherche -->
		<form action="client-info.php" method="get">
			<div class="row action-option">

				<!-- Valeur de recherche -->
				<div class="col">
					<div class="form-group ">
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
		<table class="table table-striped">
			<?php
			echoTableHead(
				"Numéro de remise",
				"Date de paiement",
				"Type de carte",
				"Numéro de carte",
				"Code d'autorisation",
				"Montant",
                ""//pour le bouton des détails
			);
			?>

			<tbody id="table-result">
				<?php
                if(!isset($_GET['search-value']) || $_GET['search-value'] == ''){
                    PdoAccess::clientSpecificRemiseTable($_SESSION['pseudo'],null);
                } else {
                    PdoAccess::clientSpecificRemiseTable($_SESSION['pseudo'], $_GET['search-value']);
                }
				?>
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