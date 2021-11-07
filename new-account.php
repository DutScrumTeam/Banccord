<!DOCTYPE html>
<html lang="en">
<head>
	<title>Banccord | Nouveau compte</title>
	<?php include("class/head.inc.php"); ?>
</head>

<body>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">

				<h1 class="centered">Créer un compte</h1>
				<form action="new-client.php" method="post">
					<div class="form-group">
						<label for="type">Type du compte</label>
						<select class="form-control" id="type" name="type">
							<option>Client</option>
							<option>Contrôleur de gestion</option>
							<option>Product owner</option>
							<option>Admin</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="pseudo">Nom d'utilisateur</label>
						<input type="password" class="form-control" name="pseudo" id="pseudo" placeholder="Nom du nouvel utlisateur" required>
					</div>
					
					<div class="form-group">
						<label for="mdp">Mot de passe</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe de l'utilisateur" required>
					</div>
					
					<div class="form-group">
						<label for="mdp-confirm">Confirmer le mot de passe</label>
						<input type="password" class="form-control" name="password-confirm" id="password-confirm" placeholder="Retapez le mot de passe" required>
					</div>
					
					<button type="submit" class="btn btn-primary">Nouveau compte</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>