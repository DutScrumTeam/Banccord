<?php include("class/page-builder.inc.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Banccord | Nouveau compte</title>
	<?php include("class/head.inc.php"); ?>
  <link rel="stylesheet" href="css/connect.css">
	<script src="js/new-account.js"></script>
</head>

	<body>
	<?php
		echoHeader(
			"Supprimer un compte", "admin.php"
		);
	?>

	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				
				<h1 class="centered">Créer un compte</h1>
				<form action="account.php" method="post">

					<!-- Type du nouveau compte -->
					<div class="form-group">
						<label for="type">Type du compte</label>
						<select class="form-control" id="type" name="type" onchange="changeType()">
							<option value="client">Client</option>
							<option value="po">Product owner</option>
							<option value="admin">Admin</option>
						</select>
					</div>
					
					<!-- Pseudo -->
					<div class="form-group">
						<label for="name">Nom d'utilisateur</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Nom du nouvel utilisateur" required>
					</div>
					
					<!-- Mdp -->
					<div class="form-group">
						<label for="password">Mot de passe</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe de l'utilisateur" required>
					</div>
					
					<!-- Confirmation du mdp -->
					<div class="form-group">
						<label for="passwordConfirm">Confirmer le mot de passe</label>
						<input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" placeholder="Retapez le mot de passe" required>
					</div>

					<!-- Nom de société (client uniquement) -->
					<div class="form-group client-only">
						<label for="businessName">Nom de société (raison sociale)</label>
						<input type="text" class="form-control" name="business-name" id="businessName" placeholder="Raison sociale" required>
					</div>
					
					<!-- Numéro de Siren (client uniquement) -->
					<div class="form-group client-only">
						<label for="siren">Numéro de Siren</label>
						<input type="number" class="form-control" name="siren" id="siren" placeholder="012 345 678 09876" required>
					</div>

					<button type="submit" class="btn btn-primary">Nouveau compte</button>
				</form>
				<!-- <script>changeType()</script> -->
			</div>
		</div>
	</div>
</body>
</html>