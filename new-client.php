<!--
	Création de client atteignable SEULEMENT après avoir
	confirmer la création d'un compte CLIENT (new-account.php)
-->

<?php include("class/page-builder.inc.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Création d'un client</title>
	<?php include("class/head.inc.php"); ?>
</head>
<body>
	<?php
		echoHeader(
			"Création d'un autre compte", "new-account.php",
			"Supprimer un compte", "admin.php"
		);
	?>

	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				
				<h1 class="centered">Créer un client</h1>
				<form action="new-client.php" method="post">

					<div class="form-group">
						<label for="businessname">Nom de société (raison sociale)</label>
						<input type="text" class="form-control" name="business-name" id="businessname" placeholder="Raison sociale" required>
					</div>
					
					<div class="form-group">
						<label for="siren">Numéro de Siren</label>
						<input type="number" class="form-control" name="siren" id="siren" placeholder="012 345 678 09876" required>
					</div>

					<button type="submit" class="btn btn-primary">Nouveau client</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>