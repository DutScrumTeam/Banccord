<?php
if(!isset($_SESSION))
{
	session_start();
}
include("class/page-builder.inc.php"); ?>
<?php include("class/highchart-builder.inc.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | (Nom du client) - impayés </title>
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
			"Remises", "client-info.php"
		);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Liste des comptes</h1>
			</div>
		</div>
		
		<div class="row">
			<!-- Graphique camembert (miam) -->
			<div class="col-6">
				<?php echoPieUnpaid(); ?>
			</div>
			<!-- Le graphique courbe -->
			<div class="col-6">
				<?php echoColumnUnpaid(); ?>
			</div>
		</div>

		<!-- Champ de recherche -->
		<form action="" method="get" class="form-search">
			<div class="row">
				<div class="col form-group">
					<label for="date-start">Date de début</label>
					<input type="date" class="form-control" id="date-start" name="date-start">
				</div>
				<div class="col form-group">
					<label for="date-end">Date de fin</label>
					<input type="date" class="form-control" id="date-end" name="date-end">
				</div>
				<!-- Bouton de confirmation -->
				<div class="col-auto">
					<button class="btn btn-primary div-center-v">Rechercher</button>
				</div>
			</div>
		</form>

		<!-- Bouton d'export -->
		<?php echoExportButton("impayés client"); ?>

		<!-- Tableau des remises -->
		<table class="table table-striped">
			<?php
				echoTableHead(
					"Numéro de dossier impayés",
					"Date de début",
					"Date de fin",
					"Libellé",
					"Montant"
				);
			?>
			<tbody id="table-result">
				<?php
					include ("class/PdoAccess.php");
					PdoAccess::clientUnpaidTable($_SESSION['pseudo']);
				?>
			</tbody>
		</table>

		<!-- Choix de la page des résultats -->
		<?php echoPageChoice() ?>

		<script>initPageManager();</script>
		<script>createPieUnpaid(lines);</script>
		<script>
			let dateEnd = new Date();
			let dateStart = new Date();
			dateStart.setFullYear(dateEnd.getFullYear()-1);

			// Cas avec les dates de début et de fin définis
			// let dateStart = new Date(sqlDateToJsDate("2020-06-01"));
			// let dateEnd = new Date(sqlDateToJsDate("2021-06-01"));

			createColumnUnpaid(lines, dateStart, dateEnd);
		</script>

	</div>
</body>
</html>