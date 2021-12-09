<?php include("class/page-builder.inc.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Remises</title>
	<?php include("class/head.inc.php") ?>
	<script src="js/page-manager.js"></script>
	<script src="js/export-file.js"></script>
	<script src="js/form-edit.js"></script>
</head>

<body>
	<?php
		echoHeader(
			"Product owner",
			"Comptes", "po-info.php"
		);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Liste des remises</h1>
			</div>
		</div>

		<!-- Champ de recherche -->
		<form action="" method="get">
			<div class="row action-option">

				<!-- Type de recherche -->
				<div class="col-auto">
					<div class="form-group">
						<select class="form-control" name="search-mod" id="search-mod"
							onchange="
								if (this.value === 'siren') changeInput('search-value', 'Entrez le numéro de Siren', 'number');
								else if (this.value === 'name') changeInput('search-value', 'Entrez la raison sociale', 'text');
							"
						>
							<option value="siren" selected>
								Recherche par Siren
							</option>
							<option value="name">
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
		<?php echoExportButton("remises product owner"); ?>

		<!-- Tableau des remises -->
		<table class="table table-striped">
			<?php 
				echoTableHead(
					"Date de paiement",
					"Siren",
					"Type de carte",
					"Numéro de carte",
					"Code d'autorisation",
					"Montant");
			?>
			<tbody id="table-result">
            <?php
            include "class/PdoAccess.php";
            PdoAccess::poRemiseTable();
            ?>
		</table>

		<!-- Choix de la page des résultats -->
		<?php echoPageChoice() ?>

		<script>initPageManager()</script>

	</div>
</body>
</html>