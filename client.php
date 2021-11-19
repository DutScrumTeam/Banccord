<?php include("class/page-builder.inc.php"); ?>
<script src="js/page-manager.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Banccord | Accueil</title>
	<?php include("class/head.inc.php") ?>
</head>

<body>
	<?php
		echoHeader(
			"Remises", "client-info.php",
			"Impayés", "client-unpaid.php"
		);
	?>

	<div class="container">
		<div class="row">
			<!-- Les différents titres -->
			<div class="col titles">
				<h1>Compte de <b>Muchel Pabo</b></h1>
				<p>Siren : 749 547 487 47239</p>
				<h2>Montant total : 5€</h2>
			</div>
		</div>

		<!-- Lien vers les autres pages -->
            <a href="client-info.php">
                <button type="button" class="btn btn-primary">
                    Liste des remises
                </button>
            </a>
            <a href="client-unpaid.php">
                <button type="button" class="btn btn-primary">
                    Liste des impayés
                </button>
            </a>
	</div>
</body>
</html>